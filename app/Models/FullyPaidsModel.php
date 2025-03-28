<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class FullyPaidsModel extends Model {
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

    public function getFullyPaidsCashSale() {
        $stmt = $this->db->prepare("SELECT 
        lr.lot_id AS asset_id, 
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
        er.estate_id AS asset_id,
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

    public function getFullyPaidsSixMonths() {
        $stmt = $this->db->prepare("SELECT 
        lr.lot_id AS asset_id, 
        lr.updated_at, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        sm.payment_amount
        FROM lot_reservations AS lr
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN six_months AS sm ON sm.lot_id = lr.lot_id
        WHERE lr.reservation_status = :reservation_status
        
        UNION ALL
        
        SELECT 
        er.estate_id AS asset_id, 
        er.updated_at, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        esm.payment_amount
        FROM estate_reservations AS er
        INNER JOIN customers AS c ON er.reservee_id = c.id
        INNER JOIN estate_six_months AS esm ON esm.estate_id = er.estate_id
        WHERE er.reservation_status = :reservation_status");
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

    public function getFullyPaidsInstallment() {
        $stmt = $this->db->prepare("SELECT 
        lr.lot_id AS asset_id, 
        lr.updated_at, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        i.total_amount, 
        i.down_payment
        FROM lot_reservations AS lr
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN installments AS i ON i.lot_id = lr.lot_id
        WHERE lr.reservation_status = :reservation_status
        
        UNION ALL
        
        SELECT
        er.estate_id AS asset_id, 
        er.updated_at, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        ei.total_amount, 
        ei.down_payment
        FROM estate_reservations AS er
        INNER JOIN customers AS c ON er.reservee_id = c.id
        INNER JOIN estate_installments AS ei ON ei.estate_id = er.estate_id
        WHERE er.reservation_status = :reservation_status");
        $reservationStatus = "Completed";
        $stmt->execute([":reservation_status" => $reservationStatus]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}