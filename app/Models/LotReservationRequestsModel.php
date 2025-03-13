<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class LotReservationRequestsModel extends Model {
    public function getReservationRequests() {
        $stmt = $this->db->prepare("SELECT 
        lr.lot_id, lr.reservee_id, lr.lot_type, lr.reservation_status, lr.created_at, c.first_name, c.middle_name, c.last_name, c.suffix_name
        FROM lot_reservations AS lr 
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN lots AS l ON lr.lot_id = l.lot_id 
        WHERE lot_type = :lot_type AND reservation_status = :reservation_status");
        $stmt->execute([':lot_type' => "Pending", ':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getReservationRequestsBadge() {
    //     $stmt = $this->db->prepare("SELECT COUNT(*) AS total_lot_reservation_requests FROM lot_reservations WHERE reservation_status = :reservation_status");
    //     $stmt->execute([':reservation_status' => 'Pending']);
    //     return $stmt->fetch(PDO::FETCH_ASSOC)["total_lot_reservation_requests"];
    // }

    public function getCoordinatesByLotId($lotId) {
        $stmt = $this->db->prepare("SELECT * FROM lots WHERE lot_id = :lot_id LIMIT 1");
        $stmt->execute([":lot_id" => $lotId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setLotType($lotId, $lotType) {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET lot_type = :lot_type, reservation_status = :new_reservation_status WHERE lot_id = :lot_id AND reservation_status = :reservation_status LIMIT 1");
        
        $stmt->bindParam(":lot_type", $lotType);
        $stmt->bindParam(":lot_id", $lotId);
        
        $newReservationStatus = "Confirmed";
        $stmt->bindParam(":new_reservation_status", $newReservationStatus);
        
        $reservationStatus = "Pending";
        $stmt->bindParam(":reservation_status", $reservationStatus);
        
        return $stmt->execute();
    }
}