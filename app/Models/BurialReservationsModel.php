<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class BurialReservationsModel extends Model {
    public function getBurialReservationRequests() {
        $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status = :status");
        $stmt->execute([':status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvents() {
        $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status = :status");
        $stmt->execute([':status' => 'Approved']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($assetId, $status) {
        $stmt = $this->db->prepare("UPDATE burial_reservations SET status = :status WHERE asset_id = :asset_id");
        $stmt->execute([':asset_id' => $assetId, ':status' => $status]);
    }
}