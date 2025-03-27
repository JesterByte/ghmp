<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CustomerNotificationModel extends Model {
    public function setNotification($customer, $message, $link) {
        $stmt = $this->db->prepare("INSERT INTO customer_notifications (customer_id, message, link) VALUES (:customer_id, :message, :link)");
        return $stmt->execute([':customer_id' => $customer, ':message' => $message, ':link' => $link]);
    }
}