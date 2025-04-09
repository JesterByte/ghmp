<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class ReservationSettingsModel extends Model
{
    public function getSettings($category)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM reservation_settings 
            WHERE category = ?
        ");
        $stmt->execute([$category]);
        return $stmt->fetch();
    }

    public function updateSettings($category, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE reservation_settings 
            SET overdue_days_limit = ?,
                notification_days = ?,
                enable_reminders = ?
            WHERE category = ?
        ");

        return $stmt->execute([
            $data['overdue_days_limit'],
            $data['notification_days'],
            $data['enable_reminders'] ? 1 : 0,
            $category
        ]);
    }
}
