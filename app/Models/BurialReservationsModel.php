<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class BurialReservationsModel extends Model
{
    public function getBurialReservationRequests()
    {
        $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status = :status");
        $stmt->execute([':status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getEvents() {
    //     $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status = :status");
    //     $stmt->execute([':status' => 'Approved']);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getEvents()
    {
        $stmt = $this->db->prepare("SELECT * FROM burial_reservations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($assetId, $status)
    {
        $stmt = $this->db->prepare("UPDATE burial_reservations SET status = :status WHERE asset_id = :asset_id");
        return $stmt->execute([':asset_id' => $assetId, ':status' => $status]);
    }

    public function updateStatusById($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE burial_reservations SET status = :status WHERE id = :id");
        return $stmt->execute([':id' => $id, ':status' => $status]);
    }

    public function findById($eventId)
    {
        $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE id = :id");
        $stmt->execute([':id' => $eventId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findEstate($estateId, $ownerId)
    {
        $stmt = $this->db->prepare("SELECT * FROM estates WHERE estate_id = :estate_id AND owner_id = :owner_id");
        $stmt->execute(["estate_id" => $estateId, "owner_id" => $ownerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLotOccupancy($lotId, $ownerId)
    {
        $stmt = $this->db->prepare("UPDATE lots SET status = 'Sold and Occupied' WHERE lot_id = :lot_id AND owner_id = :owner_id");
        $stmt->bindParam(':lot_id', $lotId, PDO::PARAM_STR);
        $stmt->bindParam(':owner_id', $ownerId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateEstateOccupancy($estateId, $ownerId)
    {
        $estate = $this->findEstate($estateId, $ownerId);
        if ($estate["status"] === "Sold") {
            $stmt = $this->db->prepare("UPDATE estates SET status = 'Sold and Occupied', occupancy = occupancy + 1 WHERE estate_id = :estate_id AND owner_id = :owner_id");
        } else if ($estate["status"] === "Sold and Occupied") {
            $stmt = $this->db->prepare("UPDATE estates SET occupancy = occupancy + 1 WHERE estate_id = :estate_id AND owner_id = :owner_id");
        }
        $stmt->bindParam(':estate_id', $estateId, PDO::PARAM_STR);
        $stmt->bindParam(':owner_id', $ownerId, PDO::PARAM_INT);


        return $stmt->execute();
    }
}
