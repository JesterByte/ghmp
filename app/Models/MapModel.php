<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class MapModel extends Model {
    public function getLots() {
        $stmt = $this->db->prepare("SELECT lot_id AS id, latitude_start, latitude_end, longitude_start, longitude_end, status, 'lot' AS type
        FROM lots
        UNION
        SELECT estate_id AS id, latitude_start, latitude_end, longitude_start, longitude_end, status, 'estate' AS type
        FROM estates");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLotsList() {
        $stmt = $this->db->prepare("SELECT * FROM lots");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getEstatesList() {
        $stmt = $this->db->prepare("SELECT * FROM estates");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function setLotType($lotId, $lotType) {
        $stmt = $this->db->prepare("UPDATE lots SET lot_type = :lot_type WHERE lot_id = :lot_id LIMIT 1");
        $stmt->bindParam(":lot_id", $lotId);
        $stmt->bindParam(":lot_type", $lotType);
        return $stmt->execute();
    }
}