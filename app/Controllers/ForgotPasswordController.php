<?php

namespace App\Controllers;

use App\Helpers\EmailHelper;
use App\Models\UserModel;
use App\Core\View;

class ForgotPasswordController extends BaseController
{
    private function generateOTP(): string 
    {
        return str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $data = [
            "pageTitle" => "Forgot Password"
        ];

        View::render("forgot-password/index", $data);
    }

    public function resetPassword()
    {
        session_start();

        if (!isset($_POST["forgot-password-submit"])) {
            $this->redirect(BASE_URL . "/forgot-password");
            return;
        }

        $email = $_POST["email-address"];
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if (!$user) {
            $_SESSION["error"] = "No account found with this email address.";
            $this->redirect(BASE_URL . "/forgot-password");
            return;
        }

        // Generate reset token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        if ($userModel->createPasswordResetToken($user["id"], $token, $expiry)) {
            // Prepare email content
            $resetLink = BASE_URL . "/reset-password?token=" . urlencode($token);
            $fullName = trim($user["first_name"] . " " . $user["last_name"]);

            $subject = "Password Reset Request - GHMP";
            $body = $this->getResetEmailTemplate($fullName, $resetLink);
            $altBody = "Hello {$fullName},\n\n"
                . "You recently requested to reset your password.\n"
                . "Click the link below to reset it:\n\n"
                . $resetLink . "\n\n"
                . "This link will expire in 1 hour.\n\n"
                . "If you did not request this, please ignore this email.";

            // Send email
            $emailHelper = new EmailHelper();
            $emailSent = $emailHelper->sendEmail(
                $user["email"],
                $subject,
                $body,
                $altBody
            );

            if ($emailSent) {
                $_SESSION["success"] = "Password reset instructions have been sent to your email.";
            } else {
                $_SESSION["error"] = "Failed to send reset email. Please try again.";
            }
        } else {
            $_SESSION["error"] = "Failed to process request. Please try again.";
        }

        $this->redirect(BASE_URL . "/forgot-password");
    }

    public function sendOTP()
    {
        session_start();

        if (!isset($_POST["forgot-password-submit"])) {
            $this->redirect(BASE_URL . "/forgot-password");
            return;
        }

        $email = $_POST["email-address"];
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if (!$user) {
            $_SESSION["error"] = "No account found with this email address.";
            $this->redirect(BASE_URL . "/forgot-password");
            return;
        }

        // Generate OTP
        $otp = $this->generateOTP();
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        if ($userModel->createPasswordResetOTP($user["id"], $otp, $expiry)) {
            $fullName = trim($user["first_name"] . " " . $user["last_name"]);
            
            $subject = "Password Reset OTP - GHMP";
            $body = $this->getOTPEmailTemplate($fullName, $otp);
            $altBody = "Hello {$fullName},\n\n"
                    . "Your OTP for password reset is: {$otp}\n"
                    . "This code will expire in 15 minutes.\n\n"
                    . "If you did not request this, please ignore this email.";

            $emailHelper = new EmailHelper();
            $emailSent = $emailHelper->sendEmail(
                $user["email"],
                $subject,
                $body,
                $altBody
            );

            if ($emailSent) {
                $_SESSION['reset_email'] = $email; // Store email for verification
                $this->redirect(BASE_URL . "/verify-otp");
            } else {
                $_SESSION["error"] = "Failed to send OTP. Please try again.";
                $this->redirect(BASE_URL . "/forgot-password");
            }
        } else {
            $_SESSION["error"] = "Failed to process request. Please try again.";
            $this->redirect(BASE_URL . "/forgot-password");
        }
    }

    private function getResetEmailTemplate($fullName, $resetLink)
    {
        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { 
                    font-family: 'Arial', sans-serif; 
                    line-height: 1.6; 
                    color: #2C3E50; 
                    background-color: #f8f9fa; 
                }
                .container { 
                    max-width: 600px; 
                    margin: 0 auto; 
                    padding: 30px; 
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 2px solid #2E7D32;
                    padding-bottom: 20px;
                }
                .header h1 {
                    color: #2E7D32;
                    margin: 0;
                    font-size: 24px;
                }
                .button { 
                    display: inline-block; 
                    padding: 12px 24px; 
                    background-color: #2E7D32; 
                    color: #ffffff !important; 
                    text-decoration: none; 
                    border-radius: 5px; 
                    margin: 20px 0;
                    font-weight: bold;
                    text-align: center;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    transition: background-color 0.3s ease;
                }
                .button:hover {
                    background-color: #1B5E20;
                }
                .footer { 
                    font-size: 12px; 
                    color: #666; 
                    margin-top: 30px;
                    text-align: center;
                    border-top: 1px solid #E0E0E0;
                    padding-top: 20px;
                }
                .content {
                    background-color: #F1F8E9;
                    padding: 20px;
                    border-radius: 5px;
                    margin: 20px 0;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Green Haven Memorial Park</h1>
                </div>
                <div class="content">
                    <h2 style="color: #2E7D32;">Password Reset Request</h2>
                    <p>Hello {$fullName},</p>
                    <p>You recently requested to reset your password for your Green Haven Memorial Park account. Click the button below to proceed with resetting your password:</p>
                    
                    <div style="text-align: center;">
                        <a href="{$resetLink}" class="button">Reset Password</a>
                    </div>
                    
                    <p style="color: #666;"><strong>Note:</strong> This link will expire in 1 hour for security purposes.</p>
                    <p style="color: #666;">If you did not request this password reset, please ignore this email or contact our support team if you have concerns.</p>
                </div>
                
                <div class="footer">
                    <p>This is an automated message from Green Haven Memorial Park</p>
                    <p style="color: #2E7D32;">Peace of mind for generations to come</p>
                </div>
            </div>
        </body>
        </html>
        HTML;
    }

    private function getOTPEmailTemplate($fullName, $otp)
    {
        return <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { 
                    font-family: 'Arial', sans-serif; 
                    line-height: 1.6; 
                    color: #2C3E50; 
                    background-color: #f8f9fa; 
                }
                .container { 
                    max-width: 600px; 
                    margin: 0 auto; 
                    padding: 30px; 
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    border-bottom: 2px solid #2E7D32;
                    padding-bottom: 20px;
                }
                .header h1 {
                    color: #2E7D32;
                    margin: 0;
                    font-size: 24px;
                }
                .otp-code {
                    font-size: 32px;
                    font-weight: bold;
                    text-align: center;
                    color: #2E7D32;
                    letter-spacing: 5px;
                    margin: 20px 0;
                    padding: 20px;
                    background-color: #F1F8E9;
                    border-radius: 5px;
                }
                .footer { 
                    font-size: 12px; 
                    color: #666; 
                    margin-top: 30px;
                    text-align: center;
                    border-top: 1px solid #E0E0E0;
                    padding-top: 20px;
                }
                .content {
                    background-color: #F1F8E9;
                    padding: 20px;
                    border-radius: 5px;
                    margin: 20px 0;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Green Haven Memorial Park</h1>
                </div>
                <div class="content">
                    <h2 style="color: #2E7D32;">Password Reset OTP</h2>
                    <p>Hello {$fullName},</p>
                    <p>Your One-Time Password (OTP) for password reset is:</p>
                    
                    <div class="otp-code">{$otp}</div>
                    
                    <p style="color: #666;"><strong>Note:</strong> This code will expire in 15 minutes.</p>
                    <p style="color: #666;">If you did not request this password reset, please ignore this email.</p>
                </div>
                
                <div class="footer">
                    <p>This is an automated message from Green Haven Memorial Park</p>
                    <p style="color: #2E7D32;">Peace of mind for generations to come</p>
                </div>
            </div>
        </body>
        </html>
        HTML;
    }
}
