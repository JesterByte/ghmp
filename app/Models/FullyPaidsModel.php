<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class FullyPaidsModel extends Model {
    public function getFullyPaids() {
        $stmt = $this->db->prepare("SELECT lr.lot_id, lr.updated_at, c.first_name, c.middle_name, c.last_name, c.suffix_name, cs.payment_amount
        FROM lot_reservations AS lr
        INNER JOIN customers AS c ON lr.reservee_id = c.id
        INNER JOIN cash_sales AS cs ON cs.lot_id = lr.lot_id
        WHERE lr.reservation_status = :reservation_status");
        $reservationStatus = "Completed";
        $stmt->execute([":reservation_status" => $reservationStatus]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}