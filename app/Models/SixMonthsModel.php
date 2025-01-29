<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class SixMonthsModel extends Model {
    public function getSixMonths() {
        $stmt = $this->db->prepare("SELECT sm.lot_id, sm.payment_amount, sm.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name 
        FROM six_months AS sm 
        INNER JOIN lot_reservations AS lr ON sm.lot_id = lr.lot_id 
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        WHERE sm.payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservations() {
        $stmt = $this->db->prepare("SELECT lot_id, payment_amount FROM six_months WHERE payment_status = :payment_status");
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

    // Completed the reservation
    public function setLotReservation($lotId) {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id");
        $stmt->bindParam(":lot_id", $lotId);
        $reservationStatus = "Completed";
        $stmt->bindParam(":reservation_status", $reservationStatus);

        return $stmt->execute();
    }

    public function getReserveeId($lotId) {
        $stmt = $this->db->prepare("SELECT reservee_id FROM lot_reservations WHERE lot_id = :lot_id");
        $stmt->execute([":lot_id" => $lotId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setLotOwnership($lotId, $reserveeId) {
        $stmt = $this->db->prepare("UPDATE lots SET owner_id = :owner_id, status = :status WHERE lot_id = :lot_id");
        $stmt->bindParam(":lot_id", $lotId);
        $status = "Sold";
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":owner_id", $reserveeId);

        return $stmt->execute();
    }
}