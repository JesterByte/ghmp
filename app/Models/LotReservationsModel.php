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
        WHERE lr.reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Confirmed']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSixMonthsLotReservations()
    {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.lot_type, lr.reservation_status, lr.payment_option, lr.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, sm.payment_status
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        INNER JOIN six_months AS sm ON lr.lot_id = sm.lot_id
        WHERE lr.reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Confirmed']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInstallmentLotReservations()
    {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.lot_type, lr.reservation_status, lr.payment_option, lr.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, i.payment_status
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id 
        INNER JOIN installments AS i ON lr.lot_id = i.lot_id
        WHERE lr.reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Confirmed']);
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
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.reservee_id, lr.created_at, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
            FROM lot_reservations AS lr
            INNER JOIN customers AS c ON lr.reservee_id = c.id
            LEFT JOIN cash_sales AS cs ON lr.id = cs.reservation_id
            LEFT JOIN cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id 
                AND csdd.due_date < CURDATE() 
                AND cs.payment_status = 'Pending'
            LEFT JOIN six_months AS sm ON lr.id = sm.reservation_id 
            LEFT JOIN installments AS i ON lr.id = i.reservation_id
            WHERE lr.reservation_status != :reservation_status
              AND (
                    csdd.due_date IS NOT NULL OR 
                    (sm.down_payment_due_date IS NOT NULL AND sm.down_payment_due_date < CURDATE() AND sm.down_payment_status = 'Pending') OR
                    (sm.next_due_date IS NOT NULL AND sm.next_due_date < CURDATE() AND sm.payment_status = 'Ongoing') 
                    OR
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

    public function getCashSalePricing($phase, $lotType, $paymentOptionKey)
    {
        $stmt = $this->db->prepare("SELECT $paymentOptionKey AS price FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type LIMIT 1");
        $stmt->execute([':phase' => $phase, ':lot_type' => $lotType]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result["price"] : null; // Return null if no price is found
    }

    public function getDownPayment($phase, $lotType, $downPaymentKey)
    {
        $stmt = $this->db->prepare("SELECT $downPaymentKey AS down_payment FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type LIMIT 1");
        $stmt->execute([':phase' => $phase, ':lot_type' => $lotType]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result["down_payment"] : null; // Return null if no price is found
    }

    public function getMonthlyPayment($phase, $lotType, $monthlyPaymentKey)
    {
        $stmt = $this->db->prepare("SELECT $monthlyPaymentKey AS monthly_payment FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type LIMIT 1");
        $stmt->execute([':phase' => $phase, ':lot_type' => $lotType]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result["monthly_payment"] : null; // Return null if no price is found
    }

    // public function getTotalPurchasePriceByLotType($phase, $lotType)
    // {
    //     $stmt = $this->db->prepare("SELECT total_purchase_price FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type LIMIT 1");
    //     $stmt->execute([':phase' => $phase, ':lot_type' => $lotType]);

    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //     return $result ? $result["total_purchase_price"] : null; // Return null if no price is found
    // }


    public function setCashSalePayment($lotId, $reservationId, $paymentAmount, $receiptPath)
    {
        $stmt = $this->db->prepare("INSERT INTO cash_sales (lot_id, reservation_id, payment_amount, payment_date, payment_status, receipt_path) VALUES (:lot_id, :reservation_id, :payment_amount, :payment_date, :payment_status, :receipt_path)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(":reservation_id", $reservationId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        $paymentDate = date("Y-m-d H:i:s");
        $stmt->bindParam(':payment_date', $paymentDate);
        $paymentStatus = "Paid";
        $stmt->bindParam(':payment_status', $paymentStatus);
        $stmt->bindParam(":receipt_path", $receiptPath);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function setCashSaleDueDate($lotId, $cashSaleId)
    {
        $dueDate = date("Y-m-d", strtotime("+7 days"));
        $stmt = $this->db->prepare("INSERT INTO cash_sale_due_dates (lot_id, cash_sale_id, due_date) VALUES (:lot_id, :cash_sale_id, :due_date)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(":cash_sale_id", $cashSaleId);
        $stmt->bindParam(':due_date', $dueDate);
        return $stmt->execute();
    }

    public function completeReservation($reservationId)
    {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE id = :id LIMIT 1");
        $reservationStatus = "Completed";
        $stmt->bindParam(":reservation_status", $reservationStatus);
        $stmt->bindParam(":id", $reservationId);
        return $stmt->execute();
    }

    public function setLotOwner($lotId, $reserveeId)
    {
        $stmt = $this->db->prepare("UPDATE lots SET owner_id = :owner_id, status = :status WHERE lot_id = :lot_id");
        $stmt->bindParam(":owner_id", $reserveeId);
        $status = "Sold";
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":lot_id", $lotId);
        return $stmt->execute();
    }

    public function setSixMonthsPayment($data)
    {
        $stmt = $this->db->prepare("INSERT INTO six_months (lot_id, reservation_id, down_payment, down_payment_status, down_payment_date, down_payment_due_date, down_receipt_path, next_due_date, total_amount, monthly_payment, payment_status) VALUES (:lot_id, :reservation_id, :down_payment, :down_payment_status, :down_payment_date, :down_payment_due_date, :down_receipt_path, :next_due_date, :total_amount, :monthly_payment, :payment_status)");
        $stmt->bindParam(':lot_id', $data["lot_id"]);
        $stmt->bindParam(":reservation_id", $data["reservation_id"]);
        $stmt->bindParam(':down_payment', $data["down_payment"]);
        $stmt->bindParam(':down_payment_status', $data["down_payment_status"]);
        $stmt->bindParam(':down_payment_date', $data["down_payment_date"]);
        $stmt->bindParam(':down_payment_due_date', $data["down_payment_due_date"]);
        $stmt->bindParam(':down_receipt_path', $data["down_receipt_path"]);
        $stmt->bindParam(':next_due_date', $data["next_due_date"]);
        $stmt->bindParam(':total_amount', $data["total_amount"]);
        $stmt->bindParam(':monthly_payment', $data["monthly_payment"]);
        $stmt->bindParam(':payment_status', $data["payment_status"]);

        $stmt->execute();
        // $stmt->execute();
        // return $this->db->lastInsertId();
    }

    // public function setSixMonthsDueDate($lotId, $sixMonthsId)
    // {
    //     $dueDate = date("Y-m-d", strtotime("+6 months"));
    //     $stmt = $this->db->prepare("INSERT INTO six_months_due_dates (lot_id, six_months_id, due_date) VALUES (:lot_id, :six_months_id, :due_date)");
    //     $stmt->bindParam(':lot_id', $lotId);
    //     $stmt->bindParam(":six_months_id", $sixMonthsId);
    //     $stmt->bindParam(':due_date', $dueDate);
    //     return $stmt->execute();
    // }

    public function setInstallmentPayment($data)
    {
        $stmt = $this->db->prepare("INSERT INTO installments (lot_id, reservation_id, term_years, down_payment, down_payment_status, down_payment_date, down_payment_due_date, down_receipt_path, next_due_date, total_amount, monthly_payment, interest_rate, payment_status) VALUES (:lot_id, :reservation_id, :term_years, :down_payment, :down_payment_status, :down_payment_date, :down_payment_due_date, :down_receipt_path, :next_due_date, :total_amount, :monthly_payment, :interest_rate, :payment_status)");
        $stmt->bindParam(":lot_id", $data["lot_id"]);
        $stmt->bindParam(":reservation_id", $data["reservation_id"]);
        $stmt->bindParam(":term_years", $data["term_years"]);
        $stmt->bindParam(":down_payment", $data["down_payment"]);
        $stmt->bindParam(":down_payment_status", $data["down_payment_status"]);
        $stmt->bindParam(":down_payment_date", $data["down_payment_date"]);
        $stmt->bindParam(":down_payment_due_date", $data["down_payment_due_date"]);
        $stmt->bindParam(":down_receipt_path", $data["down_receipt_path"]);
        $stmt->bindParam(":next_due_date", $data["next_due_date"]);
        $stmt->bindParam(":total_amount", $data["total_amount"]);
        $stmt->bindParam(":monthly_payment", $data["monthly_payment"]);
        $stmt->bindParam(":interest_rate", $data["interest_rate"]);
        $stmt->bindParam(":payment_status", $data["payment_status"]);
        $stmt->execute();
    }

    // public function setInstallmentPayment($lotId, $reservationId, $termYears, $downPayment, $downPaymentStatus = "Pending", $downPaymentDueDate, $totalAmount, $monthlyPayment, $interestRate, $paymentStatus)
    // {
    //     $stmt = $this->db->prepare("INSERT INTO installments (lot_id, reservation_id, term_years, down_payment, down_payment_status, down_payment_due_date, total_amount, monthly_payment, interest_rate, payment_status) 
    //                                 VALUES (:lot_id, :term_years, :down_payment, :down_payment_status, :down_payment_due_date, :total_amount, :monthly_payment, :interest_rate, :payment_status)");
    //     $stmt->bindParam(':lot_id', $lotId);
    //     $stmt->bindParam(":reservation_id", $reservationId);
    //     $stmt->bindParam(':term_years', $termYears);
    //     $stmt->bindParam(':down_payment', $downPayment);
    //     $stmt->bindParam(':down_payment_status', $downPaymentStatus);
    //     $stmt->bindParam(':down_payment_due_date', $downPaymentDueDate);
    //     $stmt->bindParam(':total_amount', $totalAmount);
    //     $stmt->bindParam(':monthly_payment', $monthlyPayment);
    //     $stmt->bindParam(':interest_rate', $interestRate);
    //     $stmt->bindParam(':payment_status', $paymentStatus);

    //     return $stmt->execute();
    // }

    public function setReservation($lotId, $reserveeId, $lotType, $paymentOption)
    {
        $stmt = $this->db->prepare("INSERT INTO lot_reservations (lot_id, reservee_id, lot_type, payment_option, reservation_status) VALUES (:lot_id, :reservee_id, :lot_type, :payment_option, :reservation_status)");
        $stmt->bindParam(':lot_id', $lotId);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':lot_type', $lotType);
        $stmt->bindParam(':payment_option', $paymentOption);
        $reservationStatus = 'Confirmed'; // Set the default reservation status to 'Pending' later 
        $stmt->bindParam(':reservation_status', $reservationStatus);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function approveLotReservation($lotId, $reserveeId, $status = "Approved")
    {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id AND reservee_id = :reservee_id AND reservation_status = 'Pending'");
        $stmt->bindParam(':reservation_status', $status);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':lot_id', $lotId);
        return $stmt->execute();
    }

    public function cancelLotReservation($lotId, $reserveeId, $reason)
    {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status, cancellation_reason = :cancellation_reason WHERE lot_id = :lot_id AND reservee_id = :reservee_id AND reservation_status = :confirmed_status ORDER BY created_at DESC LIMIT 1");
        $confirmedStatus = "Confirmed";
        $stmt->bindParam(":confirmed_status", $confirmedStatus);
        $reservationStatus = "Cancelled";
        $stmt->bindParam(":reservation_status", $reservationStatus);
        $stmt->bindParam(":cancellation_reason", $reason);
        $stmt->bindParam(":lot_id", $lotId);
        $stmt->bindParam(":reservee_id", $reserveeId);

        return $stmt->execute();
    }
    
    public function freeLot($lotId, $status = "Available")
    {
        $stmt = $this->db->prepare("UPDATE lots SET status = :status WHERE lot_id = :lot_id LIMIT 1");
        return $stmt->execute([":status" => $status, ":lot_id" => $lotId]);
    }

    public function getLotReservation($lotId, $lotType, $status = "Pending")
    {
        $stmt = $this->db->prepare("SELECT * FROM lot_reservations WHERE lot_id = :lot_id AND lot_type = :lot_type AND reservation_status = :reservation_status ORDER BY created_at DESC LIMIT 1");
        $stmt->execute([
            ":lot_id" => $lotId,
            ":lot_type" => $lotType,
            ":reservation_status" => $status
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setLotStatus($lotId, $status = "Reserved")
    {
        $stmt = $this->db->prepare("UPDATE lots SET status = :status WHERE lot_id = :lot_id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':lot_id', $lotId);
        return $stmt->execute();
    }

    // public function setCashSale($lotId) {
    //     $stmt = $this->db->prepare('INSERT INTO cash_sales (lot_reservation_id, payment_amount) VALUES (:lot_reservation_id, :payment_amount)');
    //     $stmt->bindParam(':lot_reservation_id', $lotId);
    //     $stmt->bindParam(':payment_amount', $paymentAmount);
    //     return $stmt->execute();
    // }
}
