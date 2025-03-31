<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class EstateReservationsModel extends Model
{
    public function getEstateReservationRequestsBadge()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_estate_reservation_requests FROM estate_reservations WHERE reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetch(PDO::FETCH_ASSOC)["total_estate_reservation_requests"];
    }
    public function getCashSaleEstateReservations()
    {
        $stmt = $this->db->prepare("SELECT er.estate_id, er.reservation_status, er.payment_option, er.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, ecs.payment_status
        FROM estate_reservations AS er 
        INNER JOIN customers AS c ON er.reservee_id = c.id 
        INNER JOIN estate_cash_sales AS ecs ON er.estate_id = ecs.estate_id
        WHERE er.reservation_status != :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSixMonthsEstateReservations()
    {
        $stmt = $this->db->prepare("SELECT er.estate_id, er.reservation_status, er.payment_option, er.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, esm.payment_status
        FROM estate_reservations AS er 
        INNER JOIN customers AS c ON er.reservee_id = c.id 
        INNER JOIN estate_six_months AS esm ON er.estate_id = esm.estate_id
        WHERE er.reservation_status != :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInstallmentEstateReservations()
    {
        $stmt = $this->db->prepare("SELECT er.estate_id, er.reservation_status, er.payment_option, er.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, ei.payment_status
        FROM estate_reservations AS er 
        INNER JOIN customers AS c ON er.reservee_id = c.id 
        INNER JOIN estate_installments AS ei ON er.estate_id = ei.estate_id
        WHERE er.reservation_status != :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCancelledEstateReservations()
    {
        $stmt = $this->db->prepare("SELECT er.estate_id, er.created_at, er.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
        FROM estate_reservations AS er 
        INNER JOIN customers AS c ON er.reservee_id = c.id 
        WHERE er.reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Cancelled']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOverdueEstateReservations()
    {
        $stmt = $this->db->prepare("SELECT er.estate_id, er.created_at, er.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
            FROM estate_reservations AS er
            INNER JOIN customers AS c ON er.reservee_id = c.id
            LEFT JOIN estate_cash_sales AS cs ON er.id = cs.reservation_id
            LEFT JOIN estate_cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id 
                AND csdd.due_date < CURDATE() 
                AND cs.payment_status = 'Pending'
            LEFT JOIN estate_six_months AS sm ON er.id = sm.reservation_id
            LEFT JOIN estate_six_months_due_dates AS smdd ON sm.id = smdd.six_months_id 
                AND smdd.due_date < CURDATE() 
                AND sm.payment_status = 'Pending'
            LEFT JOIN estate_installments AS i ON er.id = i.reservation_id
            WHERE er.reservation_status != :reservation_status
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

    public function getAvailableEstates()
    {
        $stmt = $this->db->prepare("SELECT * FROM estates WHERE status = :status");
        $stmt->execute([':status' => 'Available']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomers()
    {
        $stmt = $this->db->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPricing($estateType)
    {
        $stmt = $this->db->prepare("SELECT * FROM estate_pricing WHERE estate = :estate LIMIT 1");
        $stmt->execute([':estate' => $estateType]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCashSalePayment($estateId, $reservationId, $paymentAmount)
    {
        $stmt = $this->db->prepare("INSERT INTO estate_cash_sales (estate_id, reservation_id, payment_amount) VALUES (:estate_id, :reservation_id, :payment_amount)");
        $stmt->bindParam(':estate_id', $estateId);
        $stmt->bindParam(':reservation_id', $reservationId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function setCashSaleDueDate($estateId, $cashSaleId)
    {
        $dueDate = date("Y-m-d", strtotime("+7 days"));
        $stmt = $this->db->prepare("INSERT INTO estate_cash_sale_due_dates (estate_id, cash_sale_id, due_date) VALUES (:estate_id, :cash_sale_id, :due_date)");
        $stmt->bindParam(':estate_id', $estateId);
        $stmt->bindParam(':cash_sale_id', $cashSaleId);
        $stmt->bindParam(':due_date', $dueDate);
        return $stmt->execute();
    }

    public function setSixMonthsPayment($estateId, $reservationId, $paymentAmount)
    {
        $stmt = $this->db->prepare("INSERT INTO estate_six_months (estate_id, reservation_id, payment_amount) VALUES (:estate_id, :reservation_id, :payment_amount)");
        $stmt->bindParam(':estate_id', $estateId);
        $stmt->bindParam(':reservation_id', $reservationId);
        $stmt->bindParam(':payment_amount', $paymentAmount);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function setSixMonthsDueDate($estateId, $sixMonthsId)
    {
        $dueDate = date("Y-m-d", strtotime("+6 months"));
        $stmt = $this->db->prepare("INSERT INTO estate_six_months_due_dates (estate_id, six_months_id, due_date) VALUES (:estate_id, :six_months_id, :due_date)");
        $stmt->bindParam(':estate_id', $estateId);
        $stmt->bindParam(':six_months_id', $sixMonthsId);
        $stmt->bindParam(':due_date', $dueDate);
        return $stmt->execute();
    }

    public function setInstallmentPayment($estateId, $reservationId, $termYears, $downPayment, $downPaymentStatus = "Pending", $downPaymentDueDate, $totalAmount, $monthlyPayment, $interestRate, $paymentStatus)
    {
        $stmt = $this->db->prepare("INSERT INTO estate_installments (estate_id, reservation_id, term_years, down_payment, down_payment_status, down_payment_due_date, total_amount, monthly_payment, interest_rate, payment_status) 
                                    VALUES (:estate_id, :term_years, :down_payment, :down_payment_status, :down_payment_due_date, :total_amount, :monthly_payment, :interest_rate, :payment_status)");
        $stmt->bindParam(':estate_id', $estateId);
        $stmt->bindParam(':reservation_id', $reservationId);
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

    public function setReservation($estateId, $reserveeId, $estateType, $paymentOption)
    {
        $stmt = $this->db->prepare("INSERT INTO estate_reservations (estate_id, reservee_id, estate_type, payment_option, reservation_status) VALUES (:estate_id, :reservation_id, :reservee_id, :estate_type, :payment_option, :reservation_status)");
        $stmt->bindParam(':estate_id', $estateId);
        $stmt->bindParam(':reservee_id', $reserveeId);
        $stmt->bindParam(':estate_type', $estateType);
        $stmt->bindParam(':payment_option', $paymentOption);
        $reservationStatus = 'Confirmed'; // Set the default reservation status to 'Pending' later 
        $stmt->bindParam(':reservation_status', $reservationStatus);
        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function setEstateStatus($estateId)
    {
        $stmt = $this->db->prepare("UPDATE estates SET status = :status WHERE estate_id = :estate_id");
        $status = "Reserved";
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':estate_id', $estateId);
        return $stmt->execute();
    }

    // public function setCashSale($lotId) {
    //     $stmt = $this->db->prepare('INSERT INTO cash_sales (lot_reservation_id, payment_amount) VALUES (:lot_reservation_id, :payment_amount)');
    //     $stmt->bindParam(':lot_reservation_id', $lotId);
    //     $stmt->bindParam(':payment_amount', $paymentAmount);
    //     return $stmt->execute();
    // }
}
