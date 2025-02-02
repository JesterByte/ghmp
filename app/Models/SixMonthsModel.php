<?php

namespace App\Models;

use App\Core\Model;
use App\Traits\ReservationOwnershipTrait;
use PDO;

class SixMonthsModel extends Model {
    use ReservationOwnershipTrait;
    // public function getSixMonths() {
    //     $stmt = $this->db->prepare("SELECT sm.lot_id, sm.payment_amount, sm.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name 
    //     FROM six_months AS sm 
    //     INNER JOIN lot_reservations AS lr ON sm.lot_id = lr.lot_id 
    //     INNER JOIN customers AS c ON lr.reservee_id = c.id
    //     WHERE sm.payment_status = :payment_status");
    //     $stmt->execute([":payment_status" => "Paid"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getSixMonths() {
        $stmt = $this->db->prepare("
            SELECT 
                sm.lot_id AS asset_id, 
                sm.payment_amount, 
                sm.updated_at, 
                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM cash_sales AS sm
            INNER JOIN lot_reservations AS lr ON sm.lot_id = lr.lot_id
            INNER JOIN customers AS c ON lr.reservee_id = c.id
            WHERE sm.payment_status = :payment_status
            
            UNION ALL
            
            SELECT 
                esm.estate_id AS asset_id, 
                esm.payment_amount, 
                esm.updated_at, 
                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM estate_six_months AS esm
            INNER JOIN estate_reservations AS er ON esm.estate_id = er.estate_id
            INNER JOIN customers AS c ON er.reservee_id = c.id
            WHERE esm.payment_status = :payment_status
        ");
        
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getReservations() {
    //     $stmt = $this->db->prepare("SELECT lot_id, payment_amount FROM six_months WHERE payment_status = :payment_status");
    //     $stmt->execute([":payment_status" => "Pending"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getReservations() {
        $stmt = $this->db->prepare("SELECT 
        lot_id AS asset_id, 
        payment_amount 
        FROM six_months 
        WHERE payment_status = :payment_status
        
        UNION ALL
        
        SELECT
        estate_id AS asset_id,
        payment_amount
        FROM estate_six_months
        WHERE payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Pending"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setPayment($lotId) {
        $stmt = $this->db->prepare("UPDATE six_months SET payment_status = :payment_status WHERE lot_id = :lot_id");
        $paymentStatus = "Paid";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }
    public function setPaymentEstate($estateId) {
        $stmt = $this->db->prepare("UPDATE estate_six_months SET payment_status = :payment_status WHERE estate_id = :estate_id");
        $paymentStatus = "Paid";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":estate_id", $estateId);
        return $stmt->execute();
    }

    // Completed the reservation
    // public function setLotReservation($lotId) {
    //     $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id");
    //     $stmt->bindParam(":lot_id", $lotId);
    //     $reservationStatus = "Completed";
    //     $stmt->bindParam(":reservation_status", $reservationStatus);

    //     return $stmt->execute();
    // }
    // public function setEstateReservation($estateId) {
    //     $stmt = $this->db->prepare("UPDATE estate_reservations SET reservation_status = :reservation_status WHERE estate_id = :estate_id");
    //     $stmt->bindParam(":estate_id", $estateId);
    //     $reservationStatus = "Completed";
    //     $stmt->bindParam(":reservation_status", $reservationStatus);

    //     return $stmt->execute();
    // }

    // public function getReserveeId($lotId) {
    //     $stmt = $this->db->prepare("SELECT reservee_id FROM lot_reservations WHERE lot_id = :lot_id");
    //     $stmt->execute([":lot_id" => $lotId]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }
    // public function getReserveeIdEstate($estateId) {
    //     $stmt = $this->db->prepare("SELECT reservee_id FROM estate_reservations WHERE estate_id = :estate_id");
    //     $stmt->execute([":estate_id" => $estateId]);
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
    // public function setEstateOwnership($estateId, $reserveeId) {
    //     $stmt = $this->db->prepare("UPDATE estates SET owner_id = :owner_id, status = :status WHERE estate_id = :estate_id");
    //     $stmt->bindParam(":estate_id", $estateId);
    //     $status = "Sold";
    //     $stmt->bindParam(":status", $status);
    //     $stmt->bindParam(":owner_id", $reserveeId);

    //     return $stmt->execute();
    // }
}