<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Core\View;

class NotificationController extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    public function fetchNotifications($adminId)
    {
        header('Content-Type: application/json');
        $notifications = $this->notificationModel->getUnreadNotifications($adminId);

        $groupedNotifications = [
            'Today' => [],
            'Yesterday' => [],
            'Earlier' => [],
        ];

        foreach ($notifications as $notification) {
            $date = date('Y-m-d', strtotime($notification['created_at']));
            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime('-1 day'));

            if ($date === $today) {
                $groupedNotifications['Today'][] = $notification;
            } elseif ($date === $yesterday) {
                $groupedNotifications['Yesterday'][] = $notification;
            } else {
                $groupedNotifications['Earlier'][] = $notification;
            }
        }

        echo json_encode($groupedNotifications);

        // echo json_encode($notifications);
    }

    public function markAsRead($notificationId)
    {
        header('Content-Type: application/json');
        $this->notificationModel->markAsRead($notificationId);
        echo json_encode(["status" => "success"]);
    }

    public function markAllAsRead($adminId)
    {
        header('Content-Type: application/json');
        $this->notificationModel->markAllAsRead($adminId);
        echo json_encode(["status" => "success"]);
    }
}
