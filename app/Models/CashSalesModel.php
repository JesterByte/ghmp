<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CashSalesModel extends Model {
    public function getCashSales() {
        $stmt = $this->db->prepare("SELECT cs.lot_id, cs.payment_amount, cs.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
        FROM cash_sales AS cs
        INNER JOIN lot_reservations AS lr ON cs.lot_id = lr.lot_id
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        WHERE cs.payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservations() {
        $stmt = $this->db->prepare("SELECT lot_id, payment_amount FROM cash_sales WHERE payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Pending"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setPayment($lotId) {
        $stmt = $this->db->prepare("UPDATE cash_sales SET payment_status = :payment_status WHERE lot_id = :lot_id");
        $paymentStatus = "Paid";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }

    public function setLotReservation($lotId) {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id");
        $stmt->bindParam(":lot_id", $lotId);
        $reservationStatus = "Completed";
        $stmt->bindParam(":reservation_status", $reservationStatus);

        return $stmt->execute();
    }
}