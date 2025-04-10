<?php

namespace App\Models;

use App\Core\Model;
use App\Traits\ReservationOwnershipTrait;
use PDO;

class SixMonthsModel extends Model
{
    use ReservationOwnershipTrait;

    public function getSixMonthsPayments()
    {
        $stmt = $this->db->prepare("SELECT 
                sm.lot_id AS asset_id, 
                smp.payment_amount AS payment_amount, 
                smp.receipt_path,
                smp.payment_date, 
                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM six_months_payments AS smp
            INNER JOIN six_months AS sm ON smp.six_months_id = sm.id
            INNER JOIN lot_reservations AS lr ON sm.lot_id = lr.lot_id
            INNER JOIN customers AS c ON lr.reservee_id = c.id
            WHERE smp.payment_status = :payment_status
            
            UNION ALL
            
            SELECT 
                sm.estate_id AS asset_id, 
                smp.payment_amount AS payment_amount, 
                smp.receipt_path,
                smp.payment_date, 

                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM estate_six_months_payments AS smp
            INNER JOIN estate_six_months AS sm ON smp.six_months_id = sm.id
            INNER JOIN estate_reservations AS er ON sm.estate_id = er.estate_id
            INNER JOIN customers AS c ON er.reservee_id = c.id
            WHERE sm.payment_status = :payment_status
        ");

        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSixMonthsDownPayments()
    {
        $stmt = $this->db->prepare("SELECT 
                sm.lot_id AS asset_id, 
                sm.down_payment AS payment_amount, 
                sm.down_receipt_path AS receipt_path,
                sm.down_payment_date AS payment_date,

                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM six_months AS sm
            INNER JOIN lot_reservations AS lr ON sm.lot_id = lr.lot_id
            INNER JOIN customers AS c ON lr.reservee_id = c.id
            WHERE sm.down_payment_status = :down_payment_status
            
            UNION ALL
            
            SELECT 
                sm.estate_id AS asset_id, 
                sm.down_payment AS payment_amount, 
                sm.down_receipt_path AS receipt_path,
                sm.down_payment_date AS payment_date, 

                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM estate_six_months AS sm
            INNER JOIN estate_reservations AS er ON sm.estate_id = er.estate_id
            INNER JOIN customers AS c ON er.reservee_id = c.id
            WHERE sm.down_payment_status = :down_payment_status
        ");

        $stmt->execute([":down_payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservations()
    {
        $stmt = $this->db->prepare("SELECT 
        lot_id AS asset_id, 
        monthly_payment 
        FROM six_months 
        WHERE payment_status = :payment_status
        
        UNION ALL
        
        SELECT
        estate_id AS asset_id,
        monthly_payment
        FROM estate_six_months
        WHERE payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Ongoing"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReserveeId($table, $assetIdKey, $assetId)
    {
        $stmt = $this->db->prepare("SELECT reservee_id FROM $table WHERE $assetIdKey = :asset_id ORDER BY created_at DESC LIMIT 1");
        $stmt->bindParam(":asset_id", $assetId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["reservee_id"];
    }

    public function getReserveeName($reserveeId)
    {
        $stmt = $this->db->prepare("SELECT * FROm customers WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $reserveeId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getReservationId($table, $assetIdKey, $assetId, $reserveeId)
    {
        $stmt = $this->db->prepare("SELECT id FROM $table WHERE $assetIdKey = :asset_id AND reservee_id = :reservee_id AND reservation_status = :reservation_status ORDER BY created_at DESC LIMIT 1");
        $stmt->bindParam(":asset_id", $assetId);
        $stmt->bindParam(":reservee_id", $reserveeId);
        $reservationStatus = "Confirmed";
        $stmt->bindParam(":reservation_status", $reservationStatus);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function getSixMonthsId($table = "six_months", $reservationId)
    {
        $stmt = $this->db->prepare("SELECT id FROM $table WHERE reservation_id = :reservation_id LIMIT 1");
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function getSixMonthsMonthlyPayment($table = "six_months", $sixMonthsId)
    {
        $stmt = $this->db->prepare("SELECT monthly_payment FROM $table WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $sixMonthsId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["monthly_payment"];
    }

    public function setPayment($data)
    {
        $stmt = $this->db->prepare("INSERT INTO {$data["payments_table"]} (six_months_id, payment_amount, receipt_path, payment_status) VALUES (:six_months_id, :payment_amount, :receipt_path, :payment_status)");

        return $stmt->execute([":six_months_id" => $data["six_months_id"], ":payment_amount" => $data["payment_amount"], ":receipt_path" => $data["receipt_path"], ":payment_status" => $data["payment_status"]]);
    }

    public function setNextDueDate($data) {
        $stmt = $this->db->prepare("
            UPDATE {$data["six_months_table"]} 
            SET next_due_date = DATE_ADD(next_due_date, INTERVAL 1 MONTH),
                updated_at = NOW()
            WHERE id = :id
        ");
        
        return $stmt->execute([
            ":id" => $data["six_months_id"]
        ]);
    }

    public function getTotalPaid($sixMonthsId, $sixMonthsPaymentsTable)
    {
        $stmt = $this->db->prepare("SELECT SUM(payment_amount) AS total_paid FROM $sixMonthsPaymentsTable WHERE six_months_id = :six_months_id");
        $stmt->bindParam(":six_months_id", $sixMonthsId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total_paid"];
    }

    public function getPayableAmount($reservationId, $sixMonthsTable)
    {
        $stmt = $this->db->prepare("SELECT total_amount FROM $sixMonthsTable WHERE reservation_id = :reservation_id");
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["total_amount"];
    }

    public function completeInstallment($sixMonthsTable, $reservationId, $paymentStatus = "Completed")
    {
        $stmt = $this->db->prepare("UPDATE $sixMonthsTable SET payment_status = :payment_status WHERE reservation_id = :reservation_id LIMIT 1");
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":reservation_id", $reservationId);

        return $stmt->execute();
    }

    public function completeReservation($reservationTable, $reservationId, $reservationStatus = "Completed")
    {
        $stmt = $this->db->prepare("UPDATE $reservationTable SET reservation_status = :reservation_status WHERE id = :reservation_id");
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->bindParam(":reservation_status", $reservationStatus);
        return $stmt->execute();
    }

    public function setAssetOwnership($assetTable, $assetIdKey, $ownerId, $assetId, $status = "Sold")
    {
        $stmt = $this->db->prepare("UPDATE $assetTable SET owner_id = :owner_id, status = :status WHERE $assetIdKey = :asset_id");
        $stmt->bindParam(":owner_id", $ownerId);
        $stmt->bindParam(":asset_id", $assetId);
        $stmt->bindParam(":status", $status);
        return $stmt->execute();
    }
}
