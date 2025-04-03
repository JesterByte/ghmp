<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class FullyPaidsModel extends Model
{
    // public function getFullyPaids() {
    //     $stmt = $this->db->prepare("SELECT lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, cs.payment_amount
    //     FROM lot_reservations AS lr
    //     INNER JOIN customers AS c ON lr.reservee_id = c.id
    //     INNER JOIN cash_sales AS cs ON cs.lot_id = lr.lot_id
    //     WHERE lr.reservation_status = :reservation_status");
    //     $reservationStatus = "Completed";
    //     $stmt->execute([":reservation_status" => $reservationStatus]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getFullyPaidsCashSale() {
    //     $stmt = $this->db->prepare("SELECT lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, cs.payment_amount
    //     FROM lot_reservations AS lr
    //     INNER JOIN customers AS c ON lr.reservee_id = c.id
    //     INNER JOIN cash_sales AS cs ON cs.lot_id = lr.lot_id
    //     WHERE lr.reservation_status = :reservation_status");
    //     $reservationStatus = "Completed";
    //     $stmt->execute([":reservation_status" => $reservationStatus]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getFullyPaidsCashSale()
    {
        $stmt = $this->db->prepare("SELECT 
        lr.id,
        lr.lot_id AS asset_id, 
        lr.certificate,
        lr.issued_at,
        lr.updated_at, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        cs.payment_amount
        FROM lot_reservations AS lr
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN cash_sales AS cs ON cs.lot_id = lr.lot_id
        WHERE lr.reservation_status = :reservation_status
        
        UNION ALL
        
        SELECT 
        er.id,
        er.estate_id AS asset_id,
        er.certificate,
        er.issued_at,
        er.updated_at, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        ecs.payment_amount        
        FROM estate_reservations AS er
        INNER JOIN customers AS c ON er.reservee_id = c.id
        INNER JOIN estate_cash_sales AS ecs ON ecs.estate_id = er.estate_id 
        WHERE er.reservation_status = :reservation_status");
        $reservationStatus = "Completed";
        $stmt->execute([":reservation_status" => $reservationStatus]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getFullyPaidsSixMonths() {
    //     $stmt = $this->db->prepare("SELECT lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, sm.payment_amount
    //     FROM lot_reservations AS lr
    //     INNER JOIN customers AS c ON lr.reservee_id = c.id
    //     INNER JOIN six_months AS sm ON sm.lot_id = lr.lot_id
    //     WHERE lr.reservation_status = :reservation_status");
    //     $reservationStatus = "Completed";
    //     $stmt->execute([":reservation_status" => $reservationStatus]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getFullyPaidsSixMonths()
    {
        $stmt = $this->db->prepare("SELECT 
            lr.id,
            lr.lot_id AS asset_id, 
            lr.certificate,
            lr.issued_at,
            lr.updated_at, 
            c.first_name, 
            c.middle_name, 
            c.last_name, 
            c.suffix_name, 
            'lot' AS asset_type,  -- Add asset type identifier
            SUM(smp.payment_amount) AS payment_amount
        FROM lot_reservations AS lr
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN six_months AS sm ON sm.lot_id = lr.lot_id
        INNER JOIN six_months_payments AS smp ON sm.id = smp.six_months_id
        WHERE lr.reservation_status = :reservation_status
        GROUP BY lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name

        UNION ALL

        SELECT 
            er.id,
            er.estate_id AS asset_id, 
            er.certificate,
            er.issued_at,
            er.updated_at, 
            c.first_name, 
            c.middle_name, 
            c.last_name, 
            c.suffix_name, 
            'estate' AS asset_type,  -- Add asset type identifier
            SUM(smp.payment_amount) AS payment_amount
        FROM estate_reservations AS er
        INNER JOIN customers AS c ON er.reservee_id = c.id
        INNER JOIN estate_six_months AS sm ON sm.estate_id = er.estate_id
        INNER JOIN estate_six_months_payments AS smp ON sm.id = smp.six_months_id
        WHERE er.reservation_status = :reservation_status
        GROUP BY er.estate_id, er.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name;
        ");

        $reservationStatus = "Completed";
        $stmt->execute([":reservation_status" => $reservationStatus]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getFullyPaidsInstallment() {
    //     $stmt = $this->db->prepare("SELECT lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, i.total_amount, i.down_payment
    //     FROM lot_reservations AS lr
    //     INNER JOIN customers AS c ON lr.reservee_id = c.id
    //     INNER JOIN installments AS i ON i.lot_id = lr.lot_id
    //     WHERE lr.reservation_status = :reservation_status");
    //     $reservationStatus = "Completed";
    //     $stmt->execute([":reservation_status" => $reservationStatus]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getFullyPaidsInstallment()
    {
        $stmt = $this->db->prepare("SELECT 
            lr.id,
            lr.lot_id AS asset_id, 
            lr.certificate,
            lr.issued_at,
            lr.updated_at, 
            c.first_name, 
            c.middle_name, 
            c.last_name, 
            c.suffix_name, 
            'lot' AS asset_type,  -- Add asset type identifier
            SUM(ip.payment_amount) AS payment_amount,
            i.down_payment
        FROM lot_reservations AS lr
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN installments AS i ON i.lot_id = lr.lot_id
        INNER JOIN installment_payments AS ip ON i.id = ip.installment_id
        WHERE lr.reservation_status = :reservation_status
        GROUP BY lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name

        UNION ALL

        SELECT 
            er.id,
            er.estate_id AS asset_id, 
            er.certificate,
            er.issued_at,
            er.updated_at, 
            c.first_name, 
            c.middle_name, 
            c.last_name, 
            c.suffix_name, 
            'estate' AS asset_type,  -- Add asset type identifier
            SUM(ip.payment_amount) AS payment_amount,
            i.down_payment
        FROM estate_reservations AS er
        INNER JOIN customers AS c ON er.reservee_id = c.id
        INNER JOIN estate_installments AS i ON i.estate_id = er.estate_id
        INNER JOIN estate_installment_payments AS ip ON i.id = ip.installment_id
        WHERE er.reservation_status = :reservation_status
        GROUP BY er.estate_id, er.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name");
        $reservationStatus = "Completed";
        $stmt->execute([":reservation_status" => $reservationStatus]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveCertificate($data) {
        $stmt = $this->db->prepare("UPDATE {$data["reservations_table"]} SET certificate = :certificate, issued_at = :issued_at WHERE id = :id");
        $stmt->bindParam(":certificate", $data["certificate"]);
        $stmt->bindParam(":issued_at", $data["issued_at"]);
        $stmt->bindParam(":id", $data["id"]);

        return $stmt->execute();
    }
}
