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
}