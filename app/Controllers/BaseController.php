<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\BadgeModel;

class BaseController {
    protected $secretKey = "123";
    protected $pendingBurialReservations;
    protected $pendingLotReservations;
    protected $pendingEstateReservations;
    protected $pendingReservations;

    public function __construct() {
        session_start();
        date_default_timezone_set("Asia/Manila");

        $badgeModel = new BadgeModel();
        $this->pendingBurialReservations = $badgeModel->getPendingBurialReservations();
        $this->pendingLotReservations = $badgeModel->getPendingLotReservations();
        $this->pendingEstateReservations = $badgeModel->getPendingEstateReservations();
        $this->pendingReservations = $badgeModel->getPendingReservations();
    }

    // Sanitize string input to prevent XSS attacks
    protected function sanitizeInput($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Basic validation for required fields
    protected function validateRequired($data, $fields) {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $errors[] = "{$field} is required.";
            }
        }
        return $errors;
    }

    // Redirect to another page with an optional message
    protected function redirect($url, $icon = '<i class="bi bi-check-lg text-success"></i>', $message = "", $title = "Operation Successful", $link = "", $linkText = "") {
        if ($icon && $message && $title) {

            $_SESSION["flash_message"] = [
                "icon" => $icon,
                "message" => $message,
                "title" => $title,
                "link" => $link,
                "link_text" => $linkText
            ];
        }
        header("Location: {$url}");
        exit;
    }

    // Fetch the flash message for display
    protected function getFlashMessage() {
        $message = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']);
        return $message;
    }

    // Method for logging errors or system messages
    protected function logError($message) {
        // Log error to a file or service
        error_log($message);
    }

    // Method to redirect back to the previous page
    protected function redirectBack() {
        // Redirect to the previous page (using HTTP_REFERER)
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    protected function checkAssetId($assetId) {
        $lotIdPattern = '/^(\d)([A-Z])(\d+)-(\d+)$/';
        $estateIdPattern = '/E-([A-C])(\d+)/';

        if (preg_match($lotIdPattern, $assetId)) {
            return "lot";
        } else if (preg_match($estateIdPattern, $assetId)) {
            return "estate";
        }
    }
    
    protected function checkSession() {
        if (!isset($_SESSION["user_id"])) {
            $this->redirect(BASE_URL . "/sign-in");
        }
    }

    
}
