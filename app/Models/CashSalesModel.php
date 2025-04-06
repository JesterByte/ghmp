<?php

namespace App\Models;

use App\Core\Model;
use App\Traits\ReservationOwnershipTrait;
use PDO;

class CashSalesModel extends Model {
    use ReservationOwnershipTrait;
    // public function getCashSales() {
    //     $stmt = $this->db->prepare("SELECT cs.lot_id, cs.payment_amount, cs.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
    //     FROM cash_sales AS cs
    //     INNER JOIN lot_reservations AS lr ON cs.lot_id = lr.lot_id
    //     INNER JOIN customers AS c ON lr.reservee_id = c.id
    //     WHERE cs.payment_status = :payment_status");
    //     $stmt->execute([":payment_status" => "Paid"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getReservations() {
    //     $stmt = $this->db->prepare("SELECT lot_id, payment_amount FROM cash_sales WHERE payment_status = :payment_status");
    //     $stmt->execute([":payment_status" => "Pending"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getCashSales() {
        $stmt = $this->db->prepare("SELECT 
                cs.created_at,
                cs.lot_id AS asset_id, 
                cs.payment_amount, 
                cs.receipt_path,
                cs.payment_date, 
                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM cash_sales AS cs
            INNER JOIN lot_reservations AS lr ON cs.lot_id = lr.lot_id
            INNER JOIN customers AS c ON lr.reservee_id = c.id
            WHERE cs.payment_status = :payment_status
            
            UNION ALL
            
            SELECT 
                cs.created_at,
                cs.estate_id AS asset_id, 
                cs.payment_amount, 
                cs.receipt_path,
                cs.payment_date, 
                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM estate_cash_sales AS cs
            INNER JOIN estate_reservations AS er ON cs.estate_id = er.estate_id
            INNER JOIN customers AS c ON er.reservee_id = c.id
            WHERE cs.payment_status = :payment_status
        ");
        
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getReservations() {
    //     $stmt = $this->db->prepare("SELECT lot_id, payment_amount FROM cash_sales WHERE payment_status = :payment_status");
    //     $stmt->execute([":payment_status" => "Pending"]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getReservations() {
        $stmt = $this->db->prepare("SELECT 
        lot_id AS asset_id, 
        payment_amount 
        FROM cash_sales 
        WHERE payment_status = :payment_status
        
        UNION ALL
        
        SELECT
        estate_id AS asset_id,
        payment_amount
        FROM estate_cash_sales
        WHERE payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Pending"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setPayment($lotId, $receiptPath) {
        $stmt = $this->db->prepare("UPDATE cash_sales SET payment_status = :payment_status, payment_date = :payment_date, receipt_path = :receipt_path WHERE lot_id = :lot_id AND payment_status = :pending_payment_status ORDER BY created_at DESC LIMIT 1");
        $paymentStatus = "Paid";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $paymentDate = date("Y-m-d H:i:s");
        $stmt->bindParam(":payment_date", $paymentDate);
        $stmt->bindParam(":receipt_path", $receiptPath);
        $pendingPaymentStatus = "Pending";
        $stmt->bindParam(":pending_payment_status", $pendingPaymentStatus);
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }
    public function setPaymentEstate($estateId, $receiptPath) {
        $stmt = $this->db->prepare("UPDATE estate_cash_sales SET payment_status = :payment_status, payment_date = :payment_date, receipt_path = :receipt_path WHERE estate_id = :estate_id AND payment_status = :pending_payment_status ORDER BY created_at DESC LIMIT 1");
        $paymentStatus = "Paid";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $paymentDate = date("Y-m-d H:i:s");
        $stmt->bindParam(":payment_date", $paymentDate);
        $stmt->bindParam(":receipt_path", $receiptPath);
        $pendingPaymentStatus = "Pending";
        $stmt->bindParam(":pending_payment_status", $pendingPaymentStatus);
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