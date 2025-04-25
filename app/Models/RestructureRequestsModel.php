<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class RestructureRequestsModel extends Model
{
    public function getRequests()
    {
        $stmt = $this->db->prepare("SELECT 
                rr.id,
                rr.reason,
                rr.reservation_id,
                rr.customer_id,
                rr.asset_id,
                rr.status,
                rr.created_at,
    
                c.first_name,
                c.middle_name,
                c.last_name,
                c.suffix_name,
    
                lr.lot_id,
                lr.payment_option AS lot_payment_option,
                er.estate_id,
                er.payment_option AS estate_payment_option
    
            FROM restructure_requests AS rr
            INNER JOIN customers AS c ON rr.customer_id = c.id
    
            LEFT JOIN lot_reservations AS lr 
                ON rr.reservation_id = lr.id AND rr.asset_id = lr.lot_id
    
            LEFT JOIN estate_reservations AS er 
                ON rr.reservation_id = er.id AND rr.asset_id = er.estate_id

            WHERE 
                (lr.id IS NOT NULL AND lr.reservation_status = :lot_reservation_status) OR 
                (er.id IS NOT NULL AND er.reservation_status = :estate_reservation_status)
        ");
        $stmt->execute([":lot_reservation_status" => "Confirmed", ":estate_reservation_status" => "Confirmed"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRemainingBalance($table, $paymentsTable, $reservationId)
    {
        $stmt = $this->db->prepare("SELECT 
        COALESCE(t.total_amount, 0) AS balance,
        COALESCE(SUM(p.payment_amount), 0) AS total_paid
        FROM $table AS t
        LEFT JOIN $paymentsTable AS p ON p.installment_id = t.id
        WHERE t.reservation_id = :reservation_id
        GROUP BY t.total_amount");
        $stmt->bindParam(":reservation_id", $reservationId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setDiscountedPrice($data)
    {
        $stmt = $this->db->prepare("UPDATE restructure_requests SET discounted_price = :discounted_price, status = :status WHERE id = :id");
        return $stmt->execute([
            ":discounted_price" => $data["discounted_price"],
            ":status" => $data["status"],
            ":id" => $data["request_id"]
        ]);
    }

    public function cancelRequest($data) {
        $stmt = $this->db->prepare("UPDATE restructure_requests SET cancel_reason = :cancel_reason, status = :status WHERE id = :id");
        return $stmt->execute([
            ":id" => $data["request_id"],
            ":cancel_reason" => $data["reason"],
            ":status" => $data["status"]
        ]);
    }

    public function setRestructureId($data) {
        $stmt = $this->db->prepare("UPDATE {$data["table"]} SET restructure_id = :restructure_id WHERE reservation_id = :reservation_id LIMIT 1");
        return $stmt->execute([
            ":restructure_id" => $data["restructure_id"],
            ":reservation_id" => $data["reservation_id"]
        ]);
    }
}
