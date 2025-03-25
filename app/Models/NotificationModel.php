<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class NotificationModel extends Model {
    public function getUnreadNotifications($adminId) {
        $stmt = $this->db->prepare("SELECT * FROM admin_notifications WHERE admin_id = :admin_id AND is_read = 0 ORDER BY created_at DESC");
        $stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function markAsRead($notificationId) {
        $stmt = $this->db->prepare("UPDATE admin_notifications SET is_read = 1 WHERE id = :id");
        $stmt->bindParam(':id', $notificationId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function markAllAsRead($adminId) {
        $stmt = $this->db->prepare("UPDATE admin_notifications SET is_read = 1 WHERE admin_id = :admin_id");
        $stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);
        return $stmt->execute();
    }

}