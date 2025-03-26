<?php
require "/home/u714551035/domains/cs42a.com/public_html/group1/ghmp/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // SMTP server configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ejjose94@gmail.com';
    $mail->Password = 'dzftvwdftttloqat'; // Ensure this is a secure app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender and recipient settings
    $mail->setFrom('ejjose94@gmail.com', 'Test Sender');
    $mail->addAddress('ejjose94@gmail.com', 'Test Recipient');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Cron Job Email Test';
    $mail->Body = '<h2>Cron Job Test Successful!</h2><p>This email was sent automatically to verify the cron job.</p>';

    // Send email and log result
    if ($mail->send()) {
        file_put_contents('/home/u714551035/domains/cs42a.com/public_html/group1/ghmp/mail_log.txt', "Email sent successfully!\n", FILE_APPEND);
    }
} catch (Exception $e) {
    file_put_contents('/home/u714551035/domains/cs42a.com/public_html/group1/ghmp/mail_log.txt', "Failed to send email: {$mail->ErrorInfo}\n", FILE_APPEND);
}
?>
