<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CustomPaymentPlansModel extends Model
{
    public function getPhasePricing($data) {
        $stmt = $this->db->prepare("SELECT * FROM phase_pricing WHERE phase = :phase AND lot_type = :lot_type");
        $stmt->bindParam(":phase", $data["phase"]);
        $stmt->bindParam(":lot_type", $data["lot_type"]);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEstatePricing($data) {
        $stmt = $this->db->prepare("SELECT * FROM estate_pricing WHERE estate = :estate");
        $stmt->bindParam(":estate", $data["estate"]);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
