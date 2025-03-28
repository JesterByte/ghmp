<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailHelper
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com'; // Change to your SMTP server
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'ejjose94@gmail.com'; // Your email
            $this->mail->Password = 'dzftvwdftttloqat'; // Your email password or app password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            // Default sender (change this if needed)
            $this->mail->setFrom('ejjose94@gmail.com', 'Green Haven Memorial Park');
            $this->mail->isHTML(true); // Set email format to HTML

        } catch (Exception $e) {
            error_log("Mailer Error: " . $e->getMessage());
        }
    }

    public function sendEmail($to, $subject, $body, $altBody = "")
    {
        try {
            $this->mail->clearAddresses(); // Clear previous addresses
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = $altBody ?: strip_tags($body); // Plain text fallback

            return $this->mail->send();
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    }
}
