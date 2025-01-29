<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class InstallmentsModel extends Model {
    public function getInstallments() {
        $stmt = $this->db->prepare("SELECT i.lot_id, ip.payment_amount, ip.payment_date, c.first_name, c.middle_name, c.last_name, c.suffix_name
        FROM installment_payments AS ip
        INNER JOIN installments AS i ON i.id = ip.installment_id
        INNER JOIN lot_reservations AS lr ON i.lot_id = lr.lot_id
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        WHERE ip.payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);    
    }

    public function getPendingDownPayments() {
        $stmt = $this->db->prepare("SELECT * FROM installments WHERE down_payment_status = :down_payment_status");
        $stmt->execute([":down_payment_status" => "Pending"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOngoingInstallments() {
        $stmt = $this->db->prepare("SELECT * FROM installments WHERE payment_status = :payment_status");
        $stmt->execute([":payment_status" => "Ongoing"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setDownPayment($lotId) {
        $interval = "1 MONTH";
        $stmt = $this->db->prepare("UPDATE installments SET down_payment_status = :down_payment_status, down_payment_date = NOW(), next_due_date = DATE_ADD(NOW(), INTERVAL $interval), payment_status = :payment_status WHERE lot_id = :lot_id");
        $downPaymentStatus = "Paid";
        $stmt->bindParam(":down_payment_status", $downPaymentStatus);
        $paymentStatus = "Ongoing";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }

    public function setNextDueDate($lotId) {
        $interval = "1 MONTH";
        $stmt = $this->db->prepare("UPDATE installments SET next_due_date = DATE_ADD(NOW(), INTERVAL $interval) WHERE lot_id = :lot_id");
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }

    public function setMonthlyPayment($lotId) {
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

    public function getInstallmentByLotId($lotId) {
        $stmt = $this->db->prepare("SELECT * FROM installments WHERE lot_id = :lot_id");
        $stmt->execute([":lot_id" => $lotId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPaymentAmountSum($installmentId) {
        $stmt = $this->db->prepare("SELECT SUM(payment_amount) AS total_paid
        FROM installment_payments
        WHERE installment_id = :installment_id");
        $stmt->execute([":installment_id" => $installmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCompleteInstallment($installmentId) {
        $stmt = $this->db->prepare("UPDATE installments SET payment_status = :payment_status WHERE id = :installment_id");
        $paymentStatus = "Completed";
        $stmt->bindParam(":payment_status", $paymentStatus);
        $stmt->bindParam(":installment_id", $installmentId);
        return $stmt->execute();
    }

    public function setCompleteLotReservation($lotId) {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id");
        $reservationStatus = "Completed";
        $stmt->bindParam(":reservation_status", $reservationStatus);
        $stmt->bindParam(":lot_id", $lotId);
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