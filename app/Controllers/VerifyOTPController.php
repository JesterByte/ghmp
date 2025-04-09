<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Core\View;
use App\Helpers\DisplayHelper;

class VerifyOTPController extends BaseController
{
    public function index()
    {
        if (!isset($_SESSION['reset_email'])) {
            $this->redirect(BASE_URL . "/forgot-password");
            return;
        }

        $data = [
            "pageTitle" => "Verify OTP",
            "email" => $_SESSION['reset_email']
        ];
        
        View::render("verify-otp/index", $data);
    }

    public function verify()
    {
        if (!isset($_POST['verify-otp-submit'], $_SESSION['reset_email'])) {
            $this->redirect(BASE_URL . "/forgot-password");
            return;
        }

        $otp = $_POST['otp'];
        $email = $_SESSION['reset_email'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($newPassword !== $confirmPassword) {
            $_SESSION["error"] = "Passwords do not match.";
            $this->redirect(BASE_URL . "/verify-otp");
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
        
        if (!$user || !$userModel->verifyOTP($user['id'], $otp)) {
            $_SESSION["error"] = "Invalid or expired OTP.";
            $this->redirect(BASE_URL . "/verify-otp");
            return;
        }

        if ($userModel->updateUserPassword($user['id'], $newPassword)) {
            $userModel->markOTPUsed($otp);
            unset($_SESSION['reset_email']);
            $_SESSION["reset_password_success"] = "Password has been reset successfully!";
            $this->redirect(BASE_URL . "/sign-in");
        } else {
            $_SESSION["error"] = "Failed to update password. Please try again.";
            $this->redirect(BASE_URL . "/verify-otp");
        }
    }
}