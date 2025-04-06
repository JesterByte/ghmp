<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class EstateReservationRequestsModel extends Model
{
    public function getEstateReservationRequests()
    {
        $stmt = $this->db->prepare("SELECT 
        er.estate_id, 
        er.reservee_id, 
        c.first_name, 
        c.middle_name, 
        c.last_name, 
        c.suffix_name, 
        er.created_at,

        e.latitude_start AS estate_lat_start,
        e.longitude_start AS estate_lng_start,
        e.latitude_end AS estate_lat_end,
        e.longitude_end AS estate_lng_end

        FROM estate_reservations AS er 
        INNER JOIN customers AS c ON er.reservee_id = c.id
        INNER JOIN estates AS e ON er.estate_id = e.estate_id 
        WHERE reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approveEstateReservation($estateId, $reserveeId)
    {
        $stmt = $this->db->prepare("UPDATE estate_reservations SET reservation_status = :reservation_status WHERE estate_id = :estate_id AND reservee_id = :reservee_id AND reservation_status = :pending_status ORDER BY created_at DESC LIMIT 1");
        $pendingStatus = "Pending";
        $stmt->bindParam(":pending_status", $pendingStatus);
        $stmt->bindParam(":reservation_status", $reservationStatus);
        $reservationStatus = "Confirmed";
        $stmt->bindParam(":estate_id", $estateId);
        $stmt->bindParam(":reservee_id", $reserveeId);

        return $stmt->execute();
    }

    public function cancelEstateReservation($estateId, $reserveeId)
    {
        $stmt = $this->db->prepare("UPDATE estate_reservations SET reservation_status = :reservation_status WHERE estate_id = :estate_id AND reservee_id = :reservee_id AND reservation_status = :pending_status ORDER BY created_at DESC LIMIT 1");
        $pendingStatus = "Pending";
        $stmt->bindParam(":pending_status", $pendingStatus);
        $stmt->bindParam(":reservation_status", $reservationStatus);
        $reservationStatus = "Cancelled";
        $stmt->bindParam(":estate_id", $estateId);
        $stmt->bindParam(":reservee_id", $reserveeId);

        return $stmt->execute();
    }

    public function setEstateStatus($estateId, $status)
    {
        $stmt = $this->db->prepare("UPDATE estates SET status = :status WHERE estate_id = :estate_id");
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":estate_id", $estateId);
        return $stmt->execute();
    }
}
