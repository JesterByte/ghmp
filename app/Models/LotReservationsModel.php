<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class LotReservationsModel extends Model {
    public function getLotReservations() {
        $stmt = $this->db->prepare("SELECT * FROM lot_reservations AS lr INNER JOIN customers AS c ON lr.reservee_id = c.id WHERE reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Confirmed']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableLots() {
        $stmt = $this->db->prepare("SELECT * FROM lots WHERE status = :status");
        $stmt->execute([':status' => 'Available']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomers() {
        $stmt = $this->db->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setReservation($lotId, $reserveeId, $lotType, $paymentOption) {
        $stmt = $this->db->prepare("INSERT INTO lot_reservations (lot_id, reservee_id, lot_type, payment_option, reservation_status) VALUES (:lot_id, :reservee_id, :lot_type, :payment_option, :reservation_status)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':lot_type', $lotType);
        $stmt->bindParam(':payment_option', $paymentOption);
        $reservationStatus = 'Confirmed'; // Set the default reservation status to 'Pending' later 
        $stmt->bindParam(':reservation_status', $reservationStatus);
        
        return $stmt->execute();
    }
}