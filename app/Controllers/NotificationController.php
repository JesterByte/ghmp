<?php

namespace App\Controllers;

use App\Models\NotificationModel;
use App\Core\View;

class NotificationController extends BaseController {
    protected $notificationModel;

    public function __construct() {
        $this->notificationModel = new NotificationModel();
    }

    public function fetchNotifications($adminId) {
        header('Content-Type: application/json');
        $notifications = $this->notificationModel->getUnreadNotifications($adminId);
        echo json_encode($notifications);
    }

    public function markAsRead($notificationId) {
        header('Content-Type: application/json');
        $this->notificationModel->markAsRead($notificationId);
        echo json_encode(["status" => "success"]);
    }

    public function markAllAsRead($adminId) {
        header('Content-Type: application/json');
        $this->notificationModel->markAllAsRead($adminId);
        echo json_encode(["status" => "success"]);
    }
}