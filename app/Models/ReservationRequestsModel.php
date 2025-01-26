<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class ReservationRequestsModel extends Model {
    public function getReservationRequests() {
        $stmt = $this->db->prepare("SELECT * FROM lot_reservations AS lr INNER JOIN customers AS c ON lr.reservee_id = c.id WHERE reservation_status = :reservation_status");
        $stmt->execute([':reservation_status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}