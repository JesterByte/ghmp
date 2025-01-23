<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class EstatePricingModel extends Model {
    public function getPricingData() {
        $stmt = $this->db->prepare("SELECT * FROM estate_pricing");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}