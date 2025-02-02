<?php

namespace App\Traits;

use PDO;

trait ReservationOwnershipTrait {
    public function setLotReservation($lotId) {
        $stmt = $this->db->prepare("UPDATE lot_reservations SET reservation_status = :reservation_status WHERE lot_id = :lot_id");
        $stmt->bindParam(":lot_id", $lotId);
        $reservationStatus = "Completed";
        $stmt->bindParam(":reservation_status", $reservationStatus);

        return $stmt->execute();
    }
    public function setEstateReservation($estateId) {
        $stmt = $this->db->prepare("UPDATE estate_reservations SET reservation_status = :reservation_status WHERE estate_id = :estate_id");
        $stmt->bindParam(":estate_id", $estateId);
        $reservationStatus = "Completed";
        $stmt->bindParam(":reservation_status", $reservationStatus);

        return $stmt->execute();
    }

    public function getReserveeId($lotId) {
        $stmt = $this->db->prepare("SELECT reservee_id FROM lot_reservations WHERE lot_id = :lot_id");
        $stmt->execute([":lot_id" => $lotId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getReserveeIdEstate($estateId) {
        $stmt = $this->db->prepare("SELECT reservee_id FROM estate_reservations WHERE estate_id = :estate_id");
        $stmt->execute([":estate_id" => $estateId]);
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
    public function setEstateOwnership($estateId, $reserveeId) {
        $stmt = $this->db->prepare("UPDATE estates SET owner_id = :owner_id, status = :status WHERE estate_id = :estate_id");
        $stmt->bindParam(":estate_id", $estateId);
        $status = "Sold";
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":owner_id", $reserveeId);

        return $stmt->execute();
    }

}