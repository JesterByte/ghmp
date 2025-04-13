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
$lotQuery = "SELECT lr.id AS reservation_id, lr.lot_id AS asset_id, lr.reservee_id, c.email_address, 'Lot Reservation' AS reservation_type,

        csdd.due_date AS cash_sale_due_date, 
        cs.payment_amount AS cash_sale_amount,

        sm.down_payment_due_date AS six_months_dp_due_date, 
        sm.down_payment AS six_months_down_payment,
        sm.next_due_date AS six_months_next_due_date, 
        sm.monthly_payment AS six_months_monthly_payment,

        i.down_payment_due_date AS installment_dp_due_date, 
        i.down_payment AS installment_down_payment,
        i.next_due_date AS installment_next_due_date, 
        i.monthly_payment AS installment_monthly_payment
    FROM lot_reservations AS lr
    LEFT JOIN customers AS c ON lr.reservee_id = c.id
    LEFT JOIN cash_sales AS cs ON lr.id = cs.reservation_id AND cs.payment_status = 'Pending'
    LEFT JOIN cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id AND DATEDIFF(CURDATE(), csdd.due_date) > 0
    LEFT JOIN six_months AS sm
        ON lr.id = sm.reservation_id
        AND sm.payment_status = 'Ongoing'
        AND sm.down_payment_status = 'Pending'
    LEFT JOIN installments AS i 
        ON lr.id = i.reservation_id 
        AND i.payment_status = 'Ongoing' 
        AND i.down_payment_status = 'Pending'
    WHERE lr.reservation_status = 'Confirmed'
        AND (
            csdd.due_date IS NOT NULL OR 
            sm.down_payment_due_date IS NOT NULL AND DATEDIFF(CURDATE(), sm.down_payment_due_date) > 0 OR
            sm.next_due_date IS NOT NULL AND DATEDIFF(CURDATE(), sm.next_due_date) > 0 OR
            i.down_payment_due_date IS NOT NULL AND DATEDIFF(CURDATE(), i.down_payment_due_date) > 0 OR
            i.next_due_date IS NOT NULL AND DATEDIFF(CURDATE(), i.next_due_date) > 0
        )
";

// Query for estate reservations due dates
$estateQuery = "SELECT er.id AS reservation_id, er.estate_id AS asset_id, er.reservee_id, c.email_address, 'Estate Reservation' AS reservation_type,
        csdd.due_date AS cash_sale_due_date, 
        cs.payment_amount AS cash_sale_amount,

        sm.down_payment_due_date AS six_months_dp_due_date, 
        sm.down_payment AS six_months_down_payment,
        sm.next_due_date AS six_months_next_due_date, 
        sm.monthly_payment AS six_months_monthly_payment
,
        i.down_payment_due_date AS installment_dp_due_date, 
        i.down_payment AS installment_down_payment,
        i.next_due_date AS installment_next_due_date, 
        i.monthly_payment AS installment_monthly_payment
    FROM estate_reservations AS er
    LEFT JOIN customers AS c ON er.reservee_id = c.id
    LEFT JOIN estate_cash_sales AS cs ON er.id = cs.reservation_id AND cs.payment_status = 'Pending'
    LEFT JOIN estate_cash_sale_due_dates AS csdd ON cs.id = csdd.cash_sale_id AND DATEDIFF(CURDATE(), csdd.due_date) > 0
    LEFT JOIN estate_six_months AS sm
        ON er.id = sm.reservation_id
        AND sm.payment_status = 'Ongoing'
        AND sm.down_payment_status = 'Pending'
    LEFT JOIN estate_installments AS i 
        ON er.id = i.reservation_id 
        AND i.payment_status = 'Ongoing' 
        AND i.down_payment_status = 'Pending'
    WHERE er.reservation_status = 'Confirmed'
        AND (
            csdd.due_date IS NOT NULL 
            OR 
            sm.down_payment_due_date IS NOT NULL AND DATEDIFF(CURDATE(), sm.down_payment_due_date) > 0 OR
            sm.next_due_date IS NOT NULL AND DATEDIFF(CURDATE(), sm.next_due_date) > 0 
            OR
            i.down_payment_due_date IS NOT NULL AND DATEDIFF(CURDATE(), i.down_payment_due_date) > 0 
            OR
            i.next_due_date IS NOT NULL AND DATEDIFF(CURDATE(), i.next_due_date) > 0
        )
";

// Combine the queries correctly without extra semicolons
$combinedQuery = "($lotQuery) UNION ($estateQuery)";
$result = $conn->query($combinedQuery);

if (!$result) {
    echo "Error: " . $conn->error;
}

$updateQueries = [
    // Cash sales updates
    "UPDATE lot_reservations lr
    JOIN cash_sales cs ON lr.id = cs.reservation_id
    JOIN cash_sale_due_dates csdd ON cs.id = csdd.cash_sale_id
    SET cs.payment_status = 'Overdue',
        lr.reservation_status = 'Overdue',
        lr.updated_at = NOW()
    WHERE csdd.due_date < CURDATE() 
    AND cs.payment_status = 'Pending'
    AND (lr.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE estate_reservations er
    JOIN estate_cash_sales ecs ON er.id = ecs.reservation_id
    JOIN estate_cash_sale_due_dates ecsdd ON ecs.id = ecsdd.cash_sale_id
    SET ecs.payment_status = 'Overdue',
        er.reservation_status = 'Overdue',
        er.updated_at = NOW()
    WHERE ecsdd.due_date < CURDATE() 
    AND ecs.payment_status = 'Pending'
    AND (er.reservation_status IN ('Confirmed', 'Pending'))",

    // Six months updates
    "UPDATE lot_reservations lr
    JOIN six_months sm ON lr.id = sm.reservation_id
    JOIN six_months_due_dates smdd ON sm.id = smdd.six_months_id
    SET sm.payment_status = 'Overdue',
        lr.reservation_status = 'Overdue',
        lr.updated_at = NOW()
    WHERE smdd.due_date < CURDATE() 
    AND sm.payment_status = 'Pending'
    AND (lr.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE estate_reservations er
    JOIN estate_six_months esm ON er.id = esm.reservation_id
    JOIN estate_six_months_due_dates esmdd ON esm.id = esmdd.six_months_id
    SET esm.payment_status = 'Overdue',
        er.reservation_status = 'Overdue',
        er.updated_at = NOW()
    WHERE esmdd.due_date < CURDATE() 
    AND esm.payment_status = 'Pending'
    AND (er.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE lot_reservations lr
    JOIN six_months sm ON lr.id = sm.reservation_id
    SET sm.down_payment_status = 'Overdue',
        lr.reservation_status = 'Overdue',
        lr.updated_at = NOW()
    WHERE sm.down_payment_due_date < CURDATE() 
    AND sm.down_payment_status = 'Pending'
    AND (lr.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE estate_reservations er
    JOIN estate_six_months esm ON er.id = esm.reservation_id
    SET esm.down_payment_status = 'Overdue',
        er.reservation_status = 'Overdue',
        er.updated_at = NOW()
    WHERE esm.down_payment_due_date < CURDATE() 
    AND esm.down_payment_status = 'Pending'
    AND (er.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE lot_reservations lr
    JOIN six_months sm ON lr.id = sm.reservation_id
    SET sm.payment_status = 'Overdue',
        lr.reservation_status = 'Overdue',
        lr.updated_at = NOW()
    WHERE sm.next_due_date < CURDATE() 
    AND sm.payment_status = 'Ongoing'
    AND (lr.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE estate_reservations er
    JOIN estate_six_months esm ON er.id = esm.reservation_id
    SET esm.payment_status = 'Overdue',
        er.reservation_status = 'Overdue',
        er.updated_at = NOW()
    WHERE esm.next_due_date < CURDATE() 
    AND esm.payment_status = 'Ongoing'
    AND (er.reservation_status IN ('Confirmed', 'Pending'))",

    // Installments updates
    "UPDATE lot_reservations lr
    JOIN installments i ON lr.id = i.reservation_id
    SET i.down_payment_status = 'Overdue',
        lr.reservation_status = 'Overdue',
        lr.updated_at = NOW()
    WHERE i.down_payment_due_date < CURDATE() 
    AND i.down_payment_status = 'Pending'
    AND (lr.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE estate_reservations er
    JOIN estate_installments ei ON er.id = ei.reservation_id
    SET ei.down_payment_status = 'Overdue',
        er.reservation_status = 'Overdue',
        er.updated_at = NOW()
    WHERE ei.down_payment_due_date < CURDATE() 
    AND ei.down_payment_status = 'Pending'
    AND (er.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE lot_reservations lr
    JOIN installments i ON lr.id = i.reservation_id
    SET i.payment_status = 'Overdue',
        lr.reservation_status = 'Overdue',
        lr.updated_at = NOW()
    WHERE i.next_due_date < CURDATE() 
    AND i.payment_status = 'Ongoing'
    AND (lr.reservation_status IN ('Confirmed', 'Pending'))",

    "UPDATE estate_reservations er
    JOIN estate_installments ei ON er.id = ei.reservation_id
    SET ei.payment_status = 'Overdue',
        er.reservation_status = 'Overdue',
        er.updated_at = NOW()
    WHERE ei.next_due_date < CURDATE() 
    AND ei.payment_status = 'Ongoing'
    AND (er.reservation_status IN ('Confirmed', 'Pending'))"
];

foreach ($updateQueries as $query) {
    if (!$conn->query($query)) {
        error_log("Database update failed: " . $conn->error);
    }
}

if ($result && $result->num_rows > 0) {
    $groupedResults = [];
    while ($row = $result->fetch_assoc()) {
        $groupedResults[$row['email_address']][] = $row;
    }

    foreach ($groupedResults as $emailAddr => $reservations) {
        $message = "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; text-align: center;'>
            <div style='background-color: #d9534f; color: white; padding: 15px;'>
                <h2 style='margin: 0;'>Payment Overdue Notice</h2>
            </div>
            <div style='padding: 20px; color: #333; text-align: center;'>
                <p>Dear Customer,</p>
                <p>Your reservation(s) have overdue payments. Kindly settle your dues to avoid penalties or cancellation.</p>
                <table style='width: 100%; border-collapse: collapse; margin: 0 auto;' border='1'>
                    <tr>
                        <th>Reservation Type</th>
                        <th>Reservation ID</th>
                        <th>Due Date Type</th>
                        <th>Due Date</th>
                        <th>Amount Due</th>
                    </tr>";

        foreach ($reservations as $reservation) {
            if (!empty($reservation['cash_sale_due_date'])) {
                $message .= "<tr><td>{$reservation['reservation_type']}</td><td>{$reservation['asset_id']}</td><td>Cash Sale</td><td>{$reservation['cash_sale_due_date']}</td><td>{$reservation['cash_sale_amount']}</td></tr>";
            }
            if (!empty($reservation['six_month_dp_due_date'])) {
                $message .= "<tr><td>{$reservation['reservation_type']}</td><td>{$reservation['asset_id']}</td><td>Six Months</td><td>{$reservation['six_month_due_date']}</td><td>{$reservation['six_month_amount']}</td></tr>";
            }
            if (!empty($reservation['six_months_dp_due_date'])) {
                $message .= "<tr><td>{$reservation['reservation_type']}</td><td>{$reservation['asset_id']}</td><td>6 Months DP</td><td>{$reservation['six_months_dp_due_date']}</td><td>{$reservation['six_months_down_payment']}</td></tr>";
            }
            if (!empty($reservation['six_months_next_due_date'])) {
                $message .= "<tr><td>{$reservation['reservation_type']}</td><td>{$reservation['asset_id']}</td><td>6 Months Next</td><td>{$reservation['six_months_next_due_date']}</td><td>{$reservation['six_months_monthly_payment']}</td></tr>";
            }
            if (!empty($reservation['installment_dp_due_date'])) {
                $message .= "<tr><td>{$reservation['reservation_type']}</td><td>{$reservation['asset_id']}</td><td>Installment DP</td><td>{$reservation['installment_dp_due_date']}</td><td>{$reservation['installment_down_payment']}</td></tr>";
            }
            if (!empty($reservation['installment_next_due_date'])) {
                $message .= "<tr><td>{$reservation['reservation_type']}</td><td>{$reservation['asset_id']}</td><td>Installment Next</td><td>{$reservation['installment_next_due_date']}</td><td>{$reservation['installment_monthly_payment']}</td></tr>";
            }
        }

        $message .= "</table><p>Please make your payment at the earliest convenience.</p></div></div>";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ejjose94@gmail.com';
            $mail->Password = 'dzftvwdftttloqat';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('ejjose94@gmail.com', 'Green Haven Memorial Park');
            $mail->addAddress($emailAddr);
            $mail->isHTML(true);
            $mail->Subject = 'Overdue Payment Notice';
            $mail->Body = $message;
            $mail->send();
            echo "Overdue notice sent to $emailAddr.<br>";
        } catch (Exception $e) {
            echo "Email error: {$mail->ErrorInfo}<br>";
        }
    }
} else {
    echo "No due dates to notify.<br>";
}

$conn->close();
