<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class BadgeModel extends Model
{
    public function getPendingBurialReservations()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_burial_reservations FROM burial_reservations WHERE status = :status");
        $status = "Pending";
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["pending_burial_reservations"];
    }

    public function getPendingLotReservations()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_lot_reservations FROM lot_reservations WHERE reservation_status = :reservation_status");
        $reservationStatus = "Pending";
        $stmt->bindParam(":reservation_status", $reservationStatus, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["pending_lot_reservations"];
    }

    public function getPendingEstateReservations()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_estate_reservations FROM estate_reservations WHERE reservation_status = :reservation_status");
        $reservationStatus = "Pending";
        $stmt->bindParam(":reservation_status", $reservationStatus, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["pending_estate_reservations"];
    }

    public function getPendingReservations()
    {
        return $this->getPendingBurialReservations() + $this->getPendingLotReservations() + $this->getPendingEstateReservations();
    }

    public function getPendingInquiries()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS pending_inquiries FROM contacts WHERE status = :status");
        $status = "unread";
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["pending_inquiries"];
    }
}
