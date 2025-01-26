<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class MapModel extends Model {
    public function getLots() {
        $stmt = $this->db->prepare("SELECT * FROM lots");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}