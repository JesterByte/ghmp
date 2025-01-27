<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class LotReservationsModel extends Model {
    public function getLotReservations() {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.lot_type, lr.payment_option, c.first_name, c.middle_name, c.last_name, c.suffix_name, cs.payment_status
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        INNER JOIN cash_sales AS cs ON lr.lot_id = cs.lot_id
        WHERE lr.reservation_status = :reservation_status");
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

    public function getPricing($phase, $lotType) {
        $stmt = $this->db->prepare("SELECT * FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type LIMIT 1");
        $stmt->execute([':phase' => $phase, ':lot_type' => $lotType]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCashSalePayment($lotId, $paymentAmount) {
        $stmt = $this->db->prepare("INSERT INTO cash_sales (lot_id, payment_amount) VALUES (:lot_id, :payment_amount)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        return $stmt->execute();
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

    public function setCashSale($lotId) {
        $stmt = $this->db->prepare('INSERT INTO cash_sales (lot_reservation_id, payment_amount) VALUES (:lot_reservation_id, :payment_amount)');
        $stmt->bindParam(':lot_reservation_id', $lotId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        return $stmt->execute();
    }
}