<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class LotReservationsModel extends Model
{
    public function getReservationRequestsBadge()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_lot_reservation_requests FROM lot_reservations WHERE reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetch(PDO::FETCH_ASSOC)["total_lot_reservation_requests"];
    }

    public function getCashSaleLotReservations()
    {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.lot_type, lr.reservation_status, lr.payment_option, lr.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, cs.payment_status
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        INNER JOIN cash_sales AS cs ON lr.lot_id = cs.lot_id
        WHERE lr.reservation_status != :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSixMonthsLotReservations()
    {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.lot_type, lr.reservation_status, lr.payment_option, lr.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, sm.payment_status
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        INNER JOIN six_months AS sm ON lr.lot_id = sm.lot_id
        WHERE lr.reservation_status != :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInstallmentLotReservations()
    {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.lot_type, lr.reservation_status, lr.payment_option, lr.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, i.payment_status
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        INNER JOIN installments AS i ON lr.lot_id = i.lot_id
        WHERE lr.reservation_status != :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCancelledLotReservations()
    {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.created_at, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        WHERE lr.reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Cancelled']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOverdueLotReservations()
    {
        $stmt = $this->db->prepare("
            SELECT lr.lot_id, lr.created_at, lr.updated_at, 
                   c.first_name, c.middle_name, c.last_name, c.suffix_name
            FROM lot_reservations AS lr
            INNER JOIN customers AS c ON lr.reservee_id = c.id
            LEFT JOIN cash_sales AS cs ON lr.id = cs.reservation_id
            LEFT JOIN cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id 
                AND csdd.due_date < CURDATE() 
                AND cs.payment_status = 'Pending'
            LEFT JOIN six_months AS sm ON lr.id = sm.reservation_id
            LEFT JOIN six_months_due_dates AS smdd ON sm.id = smdd.six_months_id 
                AND smdd.due_date < CURDATE() 
                AND sm.payment_status = 'Pending'
            LEFT JOIN installments AS i ON lr.id = i.reservation_id
            WHERE lr.reservation_status != :reservation_status
              AND (
                    csdd.due_date IS NOT NULL OR 
                    smdd.due_date IS NOT NULL OR
                    (i.down_payment_due_date IS NOT NULL AND i.down_payment_due_date < CURDATE() AND i.down_payment_status = 'Pending') OR
                    (i.next_due_date IS NOT NULL AND i.next_due_date < CURDATE() AND i.payment_status = 'Ongoing')
                  )
        ");

        $stmt->execute([
            ':reservation_status' => 'Cancelled'
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableLots()
    {
        $stmt = $this->db->prepare("SELECT * FROM lots WHERE status = :status");
        $stmt->execute([':status' => 'Available']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomers()
    {
        $stmt = $this->db->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPricing($phase, $lotType)
    {
        $stmt = $this->db->prepare("SELECT * FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type LIMIT 1");
        $stmt->execute([':phase' => $phase, ':lot_type' => $lotType]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function getLotReservationByLotId($lotId) {
    //     $stmt = $this->db->prepare("SELECT * FROM lot_reservations WHERE lot_id = :lot_id");
    //     $stmt->execute([':lot_id' => $lotId]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function setCashSalePayment($lotId, $paymentAmount)
    {
        $stmt = $this->db->prepare("INSERT INTO cash_sales (lot_id, payment_amount) VALUES (:lot_id, :payment_amount)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        return $stmt->execute();
    }

    public function setCashSaleDueDate($lotId)
    {
        $dueDate = date("Y-m-d", strtotime("+7 days"));
        $stmt = $this->db->prepare("INSERT INTO cash_sale_due_dates (lot_id, due_date) VALUES (:lot_id, :due_date)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':due_date', $dueDate);
        return $stmt->execute();
    }

    public function setSixMonthsPayment($lotId, $paymentAmount)
    {
        $stmt = $this->db->prepare("INSERT INTO six_months (lot_id, payment_amount) VALUES (:lot_id, :payment_amount)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        return $stmt->execute();
    }

    public function setSixMonthsDueDate($lotId)
    {
        $dueDate = date("Y-m-d", strtotime("+6 months"));
        $stmt = $this->db->prepare("INSERT INTO six_months_due_dates (lot_id, due_date) VALUES (:lot_id, :due_date)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':due_date', $dueDate);
        return $stmt->execute();
    }

    public function setInstallmentPayment($lotId, $termYears, $downPayment, $downPaymentStatus = "Pending", $downPaymentDueDate, $totalAmount, $monthlyPayment, $interestRate, $paymentStatus)
    {
        $stmt = $this->db->prepare("INSERT INTO installments (lot_id, term_years, down_payment, down_payment_status, down_payment_due_date, total_amount, monthly_payment, interest_rate, payment_status) 
                                    VALUES (:lot_id, :term_years, :down_payment, :down_payment_status, :down_payment_due_date, :total_amount, :monthly_payment, :interest_rate, :payment_status)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':term_years', $termYears);
        $stmt->bindParam(':down_payment', $downPayment);
        $stmt->bindParam(':down_payment_status', $downPaymentStatus);
        $stmt->bindParam(':down_payment_due_date', $downPaymentDueDate);
        $stmt->bindParam(':total_amount', $totalAmount);
        $stmt->bindParam(':monthly_payment', $monthlyPayment);
        $stmt->bindParam(':interest_rate', $interestRate);
        $stmt->bindParam(':payment_status', $paymentStatus);

        return $stmt->execute();
    }

    public function setReservation($lotId, $reserveeId, $lotType, $paymentOption)
    {
        $stmt = $this->db->prepare("INSERT INTO lot_reservations (lot_id, reservee_id, lot_type, payment_option, reservation_status) VALUES (:lot_id, :reservee_id, :lot_type, :payment_option, :reservation_status)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':lot_type', $lotType);
        $stmt->bindParam(':payment_option', $paymentOption);
        $reservationStatus = 'Confirmed'; // Set the default reservation status to 'Pending' later 
        $stmt->bindParam(':reservation_status', $reservationStatus);

        return $stmt->execute();
    }

    public function approveLotReservation($lotId, $reserveeId, $status = "Approved")
    {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id AND reservee_id = :reservee_id AND reservation_status = 'Pending'");
        $stmt->bindParam(':reservation_status', $status);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':lot_id', $lotId);
        return $stmt->execute();
    }

    public function cancelLotReservation($lotId, $reserveeId, $status = "Cancelled")
    {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id AND reservee_id = :reservee_id AND reservation_status = 'Pending'");
        $stmt->bindParam(':reservation_status', $status);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':lot_id', $lotId);
        return $stmt->execute();
    }

    public function getLotReservation($lotId, $lotType, $status = "Pending") {
        $stmt = $this->db->prepare("SELECT * FROM lot_reservations WHERE lot_id = :lot_id AND lot_type = :lot_type AND reservation_status = :reservation_status ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([
            ":lot_id" => $lotId,
            ":lot_type" => $lotType,
            ":reservation_status" => $status
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function setLotStatus($lotId, $status = "Reserved")
    // {
    //     $stmt = $this->db->prepare("UPDATE lots SET status = :status WHERE lot_id = :lot_id");
    //     $stmt->bindParam(':status', $status);
    //     $stmt->bindParam(':lot_id', $lotId);
    //     return $stmt->execute();
    // }

    // public function setCashSale($lotId) {
    //     $stmt = $this->db->prepare('INSERT INTO cash_sales (lot_reservation_id, payment_amount) VALUES (:lot_reservation_id, :payment_amount)');
    //     $stmt->bindParam(':lot_reservation_id', $lotId);
    //     $stmt->bindParam(':payment_amount', $paymentAmount);
    //     return $stmt->execute();
    // }
}
