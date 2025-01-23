<?php

namespace App\Controllers;

use App\Core\View;

class BaseController {

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
    protected function redirect($url, $message = null) {
        if ($message) {
            $_SESSION['flash_message'] = $message;
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
    
}
