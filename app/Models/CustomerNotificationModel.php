<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CustomerNotificationModel extends Model {
    public function setNotification($customerId, $message, $link) {
        $stmt = $this->db->prepare("INSERT INTO notifications (customer_id, message, link) VALUES (:customer_id, :message, :link)");
        return $stmt->execute([':customer_id' => $customerId, ':message' => $message, ':link' => $link]);
    }
}