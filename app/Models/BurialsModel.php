<?php

namespace App\Models;

use App\Core\Model;
use App\Traits\ReservationOwnershipTrait;
use PDO;

class BurialsModel extends Model {
    public function getBurials() {
        $stmt = $this->db->prepare("SELECT 
                br.created_at,
                br.asset_id, 
                br.payment_amount, 
                br.receipt_path,
                br.payment_date, 
                c.first_name, 
                c.middle_name, 
                c.last_name, 
                c.suffix_name
            FROM burial_reservations AS br
            INNER JOIN customers AS c ON br.reservee_id = c.id
            WHERE br.payment_status = :payment_status
        ");
        
        $stmt->execute([":payment_status" => "Paid"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}