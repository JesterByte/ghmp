<?php

namespace App\Models;

use App\Core\Model;
use App\Traits\ReservationOwnershipTrait;
use PDO;

class InstallmentsModel extends Model
{
    use ReservationOwnershipTrait;

    public function getInstallments()
    {
        $stmt = $this->db->prepare("SELECT 
        i.lot_id AS asset_id, 
        ip.payment_amount, 
        ip.payment_date, 
        ip.receipt_path,
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name
        FROM installment_payments AS ip
        INNER JOIN installments AS i ON i.id = ip.installment_id
        INNER JOIN lot_reservations AS lr ON i.lot_id = lr.lot_id
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        WHERE ip.payment_status = :payment_status
        
        UNION ALL
        
        SELECT 
        ei.estate_id AS asset_id, 
        ip.payment_amount, 
        ip.payment_date,
        ip.receipt_path, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name
        FROM estate_installment_payments AS ip
        INNER JOIN estate_installments AS ei ON ei.id = ip.installment_id
        INNER JOIN estate_reservations AS er ON ei.estate_id = er.estate_id
        INNER JOIN customers AS c ON er.reservee_id = c.id
        WHERE ip.payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDownPayments()
    {
        $stmt = $this->db->prepare("SELECT 
        i.lot_id AS asset_id, 
        i.down_payment AS payment_amount, 
        i.down_payment_date AS payment_date, 
        i.down_receipt_path AS receipt_path,
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name
        FROM installments AS i
        INNER JOIN lot_reservations AS lr ON i.lot_id = lr.lot_id
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        WHERE i.down_payment_status = :down_payment_status
        
        UNION ALL
        
        SELECT 
        i.estate_id AS asset_id, 
        i.down_payment AS payment_amount, 
        i.down_payment_date AS payment_date, 
        i.down_receipt_path AS receipt_path,
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name
        FROM estate_installments AS i
        INNER JOIN estate_reservations AS er ON i.estate_id = er.estate_id
        INNER JOIN customers AS c ON er.reservee_id = c.id
        WHERE i.down_payment_status = :down_payment_status");
        $stmt->execute([":down_payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getPendingDownPayments() {
    //     $stmt = $this->db->prepare("SELECT * FROM installments WHERE down_payment_status = :down_payment_status");
    //     $stmt->execute([":down_payment_status" => "Pending"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getPendingDownPayments()
    {
        $stmt = $this->db->prepare("SELECT 
                i.id, 
                i.lot_id AS asset_id, 
                i.down_payment,
                i.down_payment_status, 
                i.down_payment_date, 
                i.next_due_date, 
                i.total_amount, 
                i.monthly_payment, 
                i.interest_rate, 
                i.payment_status, 
                i.created_at, 
                i.updated_at
            FROM installments AS i
            WHERE i.down_payment_status = :down_payment_status
            
            UNION ALL
            
            SELECT 
                ei.id, 
                ei.estate_id AS asset_id, 
                ei.down_payment,
                ei.down_payment_status, 
                ei.down_payment_date, 
                ei.next_due_date, 
                ei.total_amount, 
                ei.monthly_payment, 
                ei.interest_rate, 
                ei.payment_status, 
                ei.created_at, 
                ei.updated_at
            FROM estate_installments AS ei
            WHERE ei.down_payment_status = :down_payment_status
        ");
        $stmt->execute([":down_payment_status" => "Pending"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getOngoingInstallments() {
    //     $stmt = $this->db->prepare("SELECT * FROM installments WHERE payment_status = :payment_status");
    //     $stmt->execute([":payment_status" => "Ongoing"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getOngoingInstallments()
    {
        $stmt = $this->db->prepare("SELECT 
                i.id, 
                i.lot_id AS asset_id, 
                i.down_payment,
                i.down_payment_status, 
                i.down_payment_date, 
                i.next_due_date, 
                i.total_amount, 
                i.monthly_payment, 
                i.interest_rate, 
                i.payment_status, 
                i.created_at, 
                i.updated_at
            FROM installments AS i
            WHERE i.payment_status = :payment_status      

            UNION ALL
            
            SELECT 
                ei.id, 
                ei.estate_id AS asset_id, 
                ei.down_payment,
                ei.down_payment_status, 
                ei.down_payment_date, 
                ei.next_due_date, 
                ei.total_amount, 
                ei.monthly_payment, 
                ei.interest_rate, 
                ei.payment_status, 
                ei.created_at, 
                ei.updated_at
            FROM estate_installments AS ei
            WHERE ei.payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Ongoing"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setDownPayment($lotId)
    {
        $interval = "1 MONTH";
        $stmt = $this->db->prepare("UPDATE installments SET down_payment_status = :down_payment_status, down_payment_date = NOW(), next_due_date = DATE_ADD(NOW(), INTERVAL $interval), payment_status = :payment_status WHERE lot_id = :lot_id");
        $downPaymentStatus = "Paid";
        $stmt->bindParam(":down_payment_status", $downPaymentStatus);
        $paymentStatus = "Ongoing";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }
    public function setDownPaymentEstate($estateId)
    {
        $interval = "1 MONTH";
        $stmt = $this->db->prepare("UPDATE estate_installments SET down_payment_status = :down_payment_status, down_payment_date = NOW(), next_due_date = DATE_ADD(NOW(), INTERVAL $interval), payment_status = :payment_status WHERE estate_id = :estate_id");
        $downPaymentStatus = "Paid";
        $stmt->bindParam(":down_payment_status", $downPaymentStatus);
        $paymentStatus = "Ongoing";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":estate_id", $estateId);
        return $stmt->execute();
    }

    // public function setNextDueDate($lotId)
    // {
    //     $interval = "1 MONTH";
    //     $stmt = $this->db->prepare("UPDATE installments SET next_due_date = DATE_ADD(NOW(), INTERVAL $interval) WHERE lot_id = :lot_id");
    //     $stmt->bindParam(":lot_id", $lotId);
    //     return $stmt->execute();
    // }
    // public function setNextDueDateEstate($estateId)
    // {
    //     $interval = "1 MONTH";
    //     $stmt = $this->db->prepare("UPDATE estate_installments SET next_due_date = DATE_ADD(NOW(), INTERVAL $interval) WHERE estate_id = :estate_id");
    //     $stmt->bindParam(":estate_id", $estateId);
    //     return $stmt->execute();
    // }

    public function setMonthlyPayment($lotId)
    {
        $installmentRow = $this->getInstallmentByLotId($lotId);
        $installmentId = $installmentRow["id"];
        $paymentAmount = $installmentRow["monthly_payment"];
        $paymentStatus = "Paid";

        $stmt = $this->db->prepare("INSERT INTO installment_payments (installment_id, payment_amount, payment_date, payment_status) VALUES (:installment_id, :payment_amount, NOW(), :payment_status)");
        $stmt->bindParam(":installment_id", $installmentId);
        $stmt->bindParam(":payment_amount", $paymentAmount);
        $stmt->bindParam(":payment_status", $paymentStatus);

        return $stmt->execute();
    }
    public function setMonthlyPaymentEstate($estateId)
    {
        $installmentRow = $this->getInstallmentByEstateId($estateId);
        $installmentId = $installmentRow["id"];
        $paymentAmount = $installmentRow["monthly_payment"];
        $paymentStatus = "Paid";

        $stmt = $this->db->prepare("INSERT INTO estate_installment_payments (installment_id, payment_amount, payment_date, payment_status) VALUES (:installment_id, :payment_amount, NOW(), :payment_status)");
        $stmt->bindParam(":installment_id", $installmentId);
        $stmt->bindParam(":payment_amount", $paymentAmount);
        $stmt->bindParam(":payment_status", $paymentStatus);

        return $stmt->execute();
    }

    public function getInstallmentByLotId($lotId)
    {
        $stmt = $this->db->prepare("SELECT * FROM installments WHERE lot_id = :lot_id");
        $stmt->execute([":lot_id" => $lotId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getInstallmentByEstateId($estateId)
    {
        $stmt = $this->db->prepare("SELECT * FROM estate_installments WHERE estate_id = :estate_id");
        $stmt->execute([":estate_id" => $estateId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPaymentAmountSum($installmentId)
    {
        $stmt = $this->db->prepare("SELECT SUM(payment_amount) AS total_paid
        FROM installment_payments
        WHERE installment_id = :installment_id");
        $stmt->execute([":installment_id" => $installmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getPaymentAmountSumEstate($installmentId)
    {
        $stmt = $this->db->prepare("SELECT SUM(payment_amount) AS total_paid
        FROM estate_installment_payments
        WHERE installment_id = :installment_id");
        $stmt->execute([":installment_id" => $installmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCompleteInstallment($installmentId)
    {
        $stmt = $this->db->prepare("UPDATE installments SET payment_status = :payment_status WHERE id = :installment_id");
        $paymentStatus = "Completed";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":installment_id", $installmentId);
        return $stmt->execute();
    }

    public function setCompleteInstallmentEstate($installmentId)
    {
        $stmt = $this->db->prepare("UPDATE estate_installments SET payment_status = :payment_status WHERE id = :installment_id");
        $paymentStatus = "Completed";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":installment_id", $installmentId);
        return $stmt->execute();
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

    public function getInstallmentId($reservationId)
    {
        $stmt = $this->db->prepare("SELECT id FROM installments WHERE reservation_id = :reservation_id LIMIT 1");
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["id"];
    }

    public function getInstallmentMonthlyPayment($table = "installments", $installmentId)
    {
        $stmt = $this->db->prepare("SELECT monthly_payment FROM $table WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $installmentId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)["monthly_payment"];
    }

    public function setPayment($data)
    {
        $stmt = $this->db->prepare("INSERT INTO {$data["table"]} (installment_id, payment_amount, receipt_path, next_due_date, payment_status) VALUES (:installment_id, :payment_amount, :receipt_path, :payment_status)");

        return $stmt->execute([":installment_id" => $data["installment_id"], ":payment_amount" => $data["payment_amount"], ":receipt_path" => $data["receipt_path"], "next_due_date" => $data["next_due_date"], ":payment_status" => $data["payment_status"]]);
    }

    public function setNextDueDate($data)
    {
        $stmt = $this->db->prepare("
            UPDATE {$data["installments_table"]} 
            SET next_due_date = DATE_ADD(next_due_date, INTERVAL 1 MONTH),
                updated_at = NOW()
            WHERE id = :id
        ");

        return $stmt->execute([
            ":id" => $data["six_months_id"]
        ]);
    }

    public function getPaymentCount($installmentPaymentsTable = "installment_payments", $installmentId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS payment_count FROM $installmentPaymentsTable WHERE installment_id = :installment_id");
        $stmt->bindParam(":installment_id", $installmentId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["payment_count"];
    }

    public function getTermYears($installmentsTable = "installments", $reservationId)
    {
        $stmt = $this->db->prepare("SELECT term_years FROM $installmentsTable WHERE reservation_id = :reservation_id");
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["term_years"];
    }

    // public function getTotalPaid($installmentId, $installmentPaymentsTable)
    // {
    //     $stmt = $this->db->prepare("SELECT SUM(payment_amount) AS total_paid FROM $installmentPaymentsTable WHERE installment_id = :installment_id");
    //     $stmt->bindParam(":installment_id", $installmentId);
    //     $stmt->execute();

    //     return $stmt->fetch(PDO::FETCH_ASSOC)["total_paid"];
    // }

    // public function getPayableAmount($reservationId, $installmentsTable)
    // {
    //     $stmt = $this->db->prepare("SELECT total_amount FROM $installmentsTable WHERE reservation_id = :reservation_id");
    //     $stmt->bindParam(":reservation_id", $reservationId);
    //     $stmt->execute();

    //     return $stmt->fetch(PDO::FETCH_ASSOC)["total_amount"];
    // }

    public function completeInstallment($installmentsTable, $reservationId, $paymentStatus = "Completed")
    {
        $stmt = $this->db->prepare("UPDATE $installmentsTable SET payment_status = :payment_status WHERE reservation_id = :reservation_id LIMIT 1");
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

    // public function setCompleteLotReservation($lotId) {
    //     $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id");
    //     $reservationStatus = "Completed";
    //     $stmt->bindParam(":reservation_status", $reservationStatus);
    //     $stmt->bindParam(":lot_id", $lotId);
    //     return $stmt->execute();
    // }

    // public function getReserveeId($lotId) {
    //     $stmt = $this->db->prepare("SELECT reservee_id FROM lot_reservations WHERE lot_id = :lot_id");
    //     $stmt->execute([":lot_id" => $lotId]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // public function setLotOwnership($lotId, $reserveeId) {
    //     $stmt = $this->db->prepare("UPDATE lots SET owner_id = :owner_id, status = :status WHERE lot_id = :lot_id");
    //     $stmt->bindParam(":lot_id", $lotId);
    //     $status = "Sold";
    //     $stmt->bindParam(":status", $status);
    //     $stmt->bindParam(":owner_id", $reserveeId);

    //     return $stmt->execute();
    // }
}
