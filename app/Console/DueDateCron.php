<?php
date_default_timezone_set("Asia/Manila");
// Include PHPMailer
// require 'C:/xampp/htdocs/ghmp/vendor/autoload.php'; // Adjust the path if necessary"
// require "C:/xampp/htdocs/ghmp/app/Utils/Formatter.php";

require "/home/u714551035/domains/cs42a.com/public_html/group1/ghmp/vendor/autoload.php";
require "/home/u714551035/domains/cs42a.com/public_html/group1/ghmp/app/Utils/Formatter.php";

use App\Utils\Formatter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
// $host = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'ghmp_db';  // Change to your DB name

$host = "localhost";
$username = "u714551035_ghmp";
$password = "P~t5GTVnuaZ";
$dbname = "u714551035_ghmp_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for lot reservations due dates
$lotQuery = "
    SELECT lr.id AS reservation_id, lr.lot_id AS asset_id, lr.reservee_id, c.email_address, 'Lot Reservation' AS reservation_type,
        csdd.due_date AS cash_sale_due_date, cs.payment_amount AS cash_sale_amount,
        smdd.due_date AS six_month_due_date, sm.payment_amount AS six_month_amount,
        i.down_payment_due_date AS installment_dp_due_date, i.next_due_date AS installment_next_due_date, 
        i.down_payment AS installment_down_payment, i.monthly_payment AS installment_monthly_payment
    FROM lot_reservations AS lr
    LEFT JOIN customers AS c ON lr.reservee_id = c.id
    LEFT JOIN cash_sales AS cs ON lr.id = cs.reservation_id AND cs.payment_status = 'Pending'
    LEFT JOIN cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id
    LEFT JOIN six_months AS sm ON lr.id = sm.reservation_id AND sm.payment_status = 'Pending'
    LEFT JOIN six_months_due_dates AS smdd ON sm.id = smdd.six_months_id
    LEFT JOIN installments AS i ON lr.id = i.reservation_id AND i.payment_status = 'Ongoing'
    WHERE lr.reservation_status = 'Confirmed'
        AND (
            DATEDIFF(csdd.due_date, CURDATE()) = 3 OR
            DATEDIFF(smdd.due_date, CURDATE()) = 3 OR
            DATEDIFF(i.down_payment_due_date, CURDATE()) = 3 OR
            DATEDIFF(i.next_due_date, CURDATE()) = 3
        )
";


// Query for estate reservations due dates
$estateQuery = "
    SELECT er.id AS reservation_id, er.estate_id AS asset_id, er.reservee_id, c.email_address, 'Estate Reservation' AS reservation_type,
        csdd.due_date AS cash_sale_due_date, cs.payment_amount AS cash_sale_amount,
        smdd.due_date AS six_month_due_date, sm.payment_amount AS six_month_amount,
        i.down_payment_due_date AS installment_dp_due_date, i.next_due_date AS installment_next_due_date, 
        i.down_payment AS installment_down_payment, i.monthly_payment AS installment_monthly_payment
    FROM estate_reservations AS er
    LEFT JOIN customers AS c ON er.reservee_id = c.id
    LEFT JOIN estate_cash_sales AS cs ON er.id = cs.reservation_id AND cs.payment_status = 'Pending'
    LEFT JOIN estate_cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id
    LEFT JOIN estate_six_months AS sm ON er.id = sm.reservation_id AND sm.payment_status = 'Pending'
    LEFT JOIN estate_six_months_due_dates AS smdd ON sm.id = smdd.six_months_id
    LEFT JOIN estate_installments AS i ON er.id = i.reservation_id AND i.payment_status = 'Ongoing'
    WHERE er.reservation_status = 'Confirmed'
        AND (
            DATEDIFF(csdd.due_date, CURDATE()) = 3 OR
            DATEDIFF(smdd.due_date, CURDATE()) = 3 OR
            DATEDIFF(i.down_payment_due_date, CURDATE()) = 3 OR
            DATEDIFF(i.next_due_date, CURDATE()) = 3
        )
";


// Combine the queries correctly without extra semicolons
$combinedQuery = "($lotQuery) UNION ($estateQuery)";
$result = $conn->query($combinedQuery);

if (!$result) {
    echo "Error: " . $conn->error;
}

if ($result && $result->num_rows > 0) {
    $groupedResults = [];
    while ($row = $result->fetch_assoc()) {
        $groupedResults[$row['email_address']][] = $row;
    }

    foreach ($groupedResults as $emailAddr => $reservations) {
        $message = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); overflow: hidden;'>
            <div style='background-color: #4CAF50; color: white; padding: 15px; text-align: center;'>
                <h2 style='margin: 0;'>Green Haven Memorial Park</h2>
                <p style='margin: 0;'>Payment Due Reminder</p>
            </div>
            <div style='padding: 20px; color: #333;'>
                <p>Dear Customer,</p>
                <p>We would like to remind you that the following payment(s) are due in <strong>3 days</strong>:</p>
                <table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>
                    <thead>
                        <tr style='background-color: #f2f2f2;'>
                            <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Reservation Type</th>
                            <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Reservation ID</th>
                            <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Due Date Type</th>
                            <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Due Date</th>
                            <th style='padding: 10px; border: 1px solid #ddd; text-align: left;'>Payment Amount</th>
                        </tr>
                    </thead>
                    <tbody style='font-size: 14px;'>";

        foreach ($reservations as $reservation) {
            $assetType = Formatter::determineIdType($reservation['asset_id']);

            $assetId = ($assetType == "lot")
                ? Formatter::formatLotId($reservation['asset_id'])
                : Formatter::formatEstateId($reservation['asset_id']);

            $customerId = $reservation['reservee_id'];
            $link = "my_lots_and_estates";

            if (!empty($reservation['cash_sale_due_date'])) {
                $cashSaleDueDate = date("F j, Y", strtotime($reservation['cash_sale_due_date']));
                $cashSaleAmount = number_format($reservation['cash_sale_amount'], 2);

                $message .= "
                            <tr>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$reservation['reservation_type']}</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$assetId}</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>Cash Sale Due Date</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$cashSaleDueDate}</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>₱{$cashSaleAmount}</td>
                            </tr>";

                $notifMessage = "Your {$reservation['reservation_type']} with ID {$assetId} has a Cash Sale payment of ₱{$cashSaleAmount} due on {$cashSaleDueDate}.";
                $insertQuery = "
                            INSERT INTO notifications (customer_id, message, link, is_read, created_at)
                            VALUES ('{$customerId}', '{$notifMessage}', '{$link}', 0, NOW())";
                $conn->query($insertQuery);
            }

            if (!empty($reservation['installment_next_due_date'])) {
                $installmentNextDueDate = date("F j, Y", strtotime($reservation['installment_next_due_date']));
                $installmentMonthlyPayment = number_format($reservation['installment_monthly_payment'], 2);

                $message .= "
                            <tr>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$reservation['reservation_type']}</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$assetId}</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>Installment Next Due Date</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>{$installmentNextDueDate}</td>
                                <td style='padding: 8px; border: 1px solid #ddd;'>₱{$installmentMonthlyPayment}</td>
                            </tr>";

                $notifMessage = "Your {$reservation['reservation_type']} with ID {$assetId} has an Installment Monthly Payment of ₱{$installmentMonthlyPayment} due on {$installmentNextDueDate}.";
                $insertQuery = "
                            INSERT INTO notifications (customer_id, message, link, is_read, created_at)
                            VALUES ('{$customerId}', '{$notifMessage}', '{$link}', 0, NOW())";
                $conn->query($insertQuery);
            }
        }

        $message .= "
                    </tbody>
                </table>
                <p style='margin-top: 20px;'>Please make your payment on or before the due date to avoid any penalties or disruptions to your reservation.</p>
                <p>Thank you for choosing Green Haven Memorial Park.</p>
            </div>
            <div style='background-color: #f4f4f4; color: #777; text-align: center; padding: 10px; font-size: 12px;'>
                &copy; " . date('Y') . " Green Haven Memorial Park. All rights reserved.
            </div>
        </div>";

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 4;
            $mail->Host = 'smtp.gmail.com';       // Update SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ejjose94@gmail.com';   // Update email
            $mail->Password = 'dzftvwdftttloqat';            // Update password
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            $mail->setFrom('ejjose94@gmail.com', 'Green Haven Memorial Park');
            $mail->addAddress($emailAddr);

            $mail->isHTML(true);
            $mail->Subject = 'Payment Due Reminder';
            $mail->Body = $message;

            $mail->send();
            echo "Email sent successfully to $emailAddr.<br>";
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$mail->ErrorInfo}<br>";
        }
    }
} else {
    echo "No due dates to notify.<br>";
}

$conn->close();
