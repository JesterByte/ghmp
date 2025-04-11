<?php

namespace App\Controllers;

use App\Helpers\EmailHelper;
use App\Models\BadgeModel;
use App\Models\CustomersModel;
use App\Models\LotReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Models\CustomerNotificationModel;
use App\Models\ReservationSettingsModel;

class LotReservationsController extends BaseController
{
    protected $reservationSettingsModel;
    protected $reservationSettings;

    public function __construct()
    {
        parent::__construct();

        $this->reservationSettingsModel = new ReservationSettingsModel();
        $this->reservationSettings = $this->reservationSettingsModel->getSettings("Lot");
    }

    public function indexCashSale()
    {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getCashSaleLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cash Sale",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexSixMonths()
    {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getSixMonthsLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "6 Months",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexInstallments()
    {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getInstallmentLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Installment",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexCancelled()
    {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getCancelledLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cancelled",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexOverdue()
    {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getOverdueLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Overdue",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function fetchPhasePricing()
    {
        // Disable PHP warnings/notices that can corrupt JSON output
        error_reporting(0);
        header('Content-Type: application/json');
        // Read JSON request
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["phase"], $data["lotType"], $data["paymentOption"])) {
            $phase = "Phase " . $data["phase"];
            $lotType = $data["lotType"];
            $paymentOption = $data["paymentOption"];

            // Fetch price from database
            $lotReservationsModel = new LotReservationsModel();

            // Map payment option to database column name
            if ($paymentOption === "Cash Sale") {
                $paymentOptionKey = "cash_sale";
                $price = $lotReservationsModel->getCashSalePricing($phase, $lotType, $paymentOptionKey);
            } elseif ($paymentOption === "6 Months") {
                $downPaymentKey = "six_months_down_payment";
                $monthlyPaymentKey = "six_months_monthly_amortization";

                $downPayment = $lotReservationsModel->getDownPayment($phase, $lotType, $downPaymentKey);
                $monthlyPayment = $lotReservationsModel->getMonthlyPayment($phase, $lotType, $monthlyPaymentKey);
            } elseif (strpos($paymentOption, "Installment") !== false) {
                $year = Formatter::extractInstallmentYears($paymentOption);

                switch ($year) {
                    case 1:
                        $key = "_one_year";
                        break;
                    case 2:
                        $key = "_two_years";
                        break;
                    case 3:
                        $key = "_three_years";
                        break;
                    case 4:
                        $key = "_four_years";
                        break;
                    case 5:
                        $key = "_five_years";
                        break;
                }

                $downPaymentKey = "down_payment";
                $monthlyPaymentKey = "monthly_amortization$key";
                $downPayment = $lotReservationsModel->getDownPayment($phase, $lotType, $downPaymentKey);
                $monthlyPayment = $lotReservationsModel->getMonthlyPayment($phase, $lotType, $monthlyPaymentKey);
            } else {
                echo json_encode(["success" => false, "message" => "Invalid payment option"]);
                return;
            }


            if ($paymentOption !== "Cash Sale") {
                echo json_encode([
                    "success" => true,
                    "price" => $downPayment,
                    "monthly_payment" => $monthlyPayment
                ]);
            } else {
                echo json_encode([
                    "success" => true,
                    "price" => $price,
                ]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request"]);
        }
    }


    public function setReservation()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotReservationsModel = new LotReservationsModel();
            $lotId = $_POST['lot'];
            $reserveeId = $_POST['customer'];
            $phase = Formatter::extractPhase($_POST['lot']);
            $lotType = $_POST['lot-type'];
            $paymentOption = $_POST['payment-option'];

            // Handle file upload
            if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
                // Get file info
                $fileTmpPath = $_FILES['receipt']['tmp_name'];
                $fileName = $_FILES['receipt']['name'];
                $fileSize = $_FILES['receipt']['size'];
                $fileType = $_FILES['receipt']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Validate file extension (only accept images)
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    // Generate a unique name for the file to avoid conflicts
                    $newFileName = uniqid() . '.' . $fileExtension;

                    // Set the upload directory
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] .  BASE_URL . '/uploads/receipts/'; // Adjust BASE_URL if necessary
                    $uploadFilePath = $uploadDir . $newFileName;

                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                        // File upload successful, store the file name in the database
                        $receiptFileName = $newFileName;
                    } else {
                        // Handle file move error
                        $receiptFileName = null;
                    }
                } else {
                    // Invalid file type
                    $receiptFileName = null;
                }
            } else {
                // No file uploaded or there was an error
                $receiptFileName = null;
            }

            $pricing = $lotReservationsModel->getPricing("Phase " . $phase, $lotType);

            $customersModel = new CustomersModel();
            $customer = $customersModel->getCustomerById($reserveeId);
            $middleName = !empty($customer["middle_name"]) ? " " . $customer["middle_name"] . " " : " ";
            $suffix = !empty($customer["suffix_name"]) ? ", " . $customer["suffix_name"] : "";
            $customerFullName = $customer["first_name"] . $middleName . $customer["last_name"] . $suffix;

            $reservationId = $lotReservationsModel->setReservation($lotId, $reserveeId, $lotType, $paymentOption);
            $calculator = new Calculator();
            $downPaymentDueDate = $this->setDownPaymentDueDate();

            $customerNotificationModel = new CustomerNotificationModel();
            $emailHelper = new EmailHelper();
            switch ($paymentOption) {
                case "Cash Sale":
                    $paymentAmount = $pricing['cash_sale'];
                    $cashSaleId = $lotReservationsModel->setCashSalePayment($lotId, $reservationId, $paymentAmount, $receiptFileName);
                    $lotReservationsModel->setCashSaleDueDate($lotId, $cashSaleId);
                    $lotReservationsModel->completeReservation($reservationId);
                    $lotReservationsModel->setLotOwner($lotId, $reservationId);

                    $customerNotificationModel->setNotification($reserveeId, "Congratulations! You have successfully owned Lot #$lotId through Cash Sale.", "my_lots_and_estates");

                    $emailSubject = "Congratulations on Your Lot Ownership!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #28a745; text-align: center;">Cash Sale Confirmation</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We are delighted to inform you that you have successfully owned <strong>Lot #' . htmlspecialchars($lotId) . '</strong> through <strong>Cash Sale</strong>.</p>
                        <p>Thank you for your trust in our services. We’re honored to be part of this meaningful step.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);

                    break;
                case "6 Months":
                    $data = [
                        "lot_id" => $lotId,
                        "reservation_id" => $reservationId,
                        "down_payment" => $pricing["six_months_down_payment"],
                        "down_payment_status" => "Paid",
                        "down_payment_date" => date("Y-m-d"),
                        "down_payment_due_date" => date("Y-m-d", strtotime("+7 days")),
                        "down_receipt_path" => $receiptFileName,
                        "next_due_date" => date("Y-m-d", strtotime("+1 month")),
                        "total_amount" => $pricing['six_months_balance'],
                        "monthly_payment" => $pricing["six_months_monthly_amortization"],
                        "payment_status" => "Ongoing"
                    ];
                    $lotReservationsModel->setSixMonthsPayment($data);

                    $message = "Your reservation for Lot #$lotId is now active under the $paymentOption plan. We have received your down payment.";
                    $customerNotificationModel->setNotification($reserveeId, $message, "my_lots_and_estates");

                    $emailSubject = "Your Down Payment Has Been Received – Reservation Activated!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 24px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #007bff; text-align: center;">Reservation Successfully Activated</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We’re pleased to let you know that we’ve successfully received your <strong>down payment</strong> for <strong>Lot #' . htmlspecialchars($lotId) . '</strong>.</p>
                        <p>Your reservation is now <strong>active</strong> under our <strong>' . htmlspecialchars($paymentOption) . '</strong> payment plan.</p>
                        <p>You’ll receive regular updates regarding your upcoming payments and schedule.</p>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);


                    // $sixMonthsId = $lotReservationsModel->setSixMonthsPayment($data);
                    // $lotReservationsModel->setSixMonthsDueDate($lotId, $sixMonthsId);
                    break;
                case "Installment: 1 Year":
                    $termYears = 1;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_one_year"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_one_year"];

                    $data = [
                        "lot_id" => $lotId,
                        "reservation_id" => $reservationId,
                        "term_years" => $termYears,
                        "down_payment" => $downPayment,
                        "down_payment_status" => "Paid",
                        "down_payment_date" => date("Y-m-d"),
                        "down_payment_due_date" => $downPaymentDueDate,
                        "down_receipt_path" => $receiptFileName,
                        "next_due_date" => date("Y-m-d", strtotime("+1 months")),
                        "total_amount" => $totalAmount,
                        "monthly_payment" => $paymentAmount,
                        "interest_rate" => $pricing["one_year_interest_rate"],
                        "payment_status" => "Ongoing"
                    ];

                    $lotReservationsModel->setInstallmentPayment($data);

                    $message = "Your reservation for Lot #$lotId is now active under the $paymentOption plan. We have received your down payment.";
                    $customerNotificationModel->setNotification($reserveeId, $message, "my_lots_and_estates");

                    $emailSubject = "Your Down Payment Has Been Received – Reservation Activated!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 24px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #007bff; text-align: center;">Reservation Successfully Activated</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We’re pleased to let you know that we’ve successfully received your <strong>down payment</strong> for <strong>Lot #' . htmlspecialchars($lotId) . '</strong>.</p>
                        <p>Your reservation is now <strong>active</strong> under our <strong>' . htmlspecialchars($paymentOption) . '</strong> payment plan.</p>
                        <p>You’ll receive regular updates regarding your upcoming payments and schedule.</p>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);

                    break;
                case "Installment: 2 Years":
                    $termYears = 2;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_two_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_two_years"];

                    $data = [
                        "lot_id" => $lotId,
                        "reservation_id" => $reservationId,
                        "term_years" => $termYears,
                        "down_payment" => $downPayment,
                        "down_payment_status" => "Paid",
                        "down_payment_date" => date("Y-m-d"),
                        "down_payment_due_date" => $downPaymentDueDate,
                        "down_receipt_path" => $receiptFileName,
                        "next_due_date" => date("Y-m-d", strtotime("+1 months")),
                        "total_amount" => $totalAmount,
                        "monthly_payment" => $paymentAmount,
                        "interest_rate" => $pricing["two_years_interest_rate"],
                        "payment_status" => "Ongoing"
                    ];

                    $lotReservationsModel->setInstallmentPayment($data);

                    $message = "Your reservation for Lot #$lotId is now active under the $paymentOption plan. We have received your down payment.";
                    $customerNotificationModel->setNotification($reserveeId, $message, "my_lots_and_estates");

                    $emailSubject = "Your Down Payment Has Been Received – Reservation Activated!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 24px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #007bff; text-align: center;">Reservation Successfully Activated</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We’re pleased to let you know that we’ve successfully received your <strong>down payment</strong> for <strong>Lot #' . htmlspecialchars($lotId) . '</strong>.</p>
                        <p>Your reservation is now <strong>active</strong> under our <strong>' . htmlspecialchars($paymentOption) . '</strong> payment plan.</p>
                        <p>You’ll receive regular updates regarding your upcoming payments and schedule.</p>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);

                    break;
                case "Installment: 3 Years":
                    $termYears = 3;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_three_years"];

                    $data = [
                        "lot_id" => $lotId,
                        "reservation_id" => $reservationId,
                        "term_years" => $termYears,
                        "down_payment" => $downPayment,
                        "down_payment_status" => "Paid",
                        "down_payment_date" => date("Y-m-d"),
                        "down_payment_due_date" => $downPaymentDueDate,
                        "down_receipt_path" => $receiptFileName,
                        "next_due_date" => date("Y-m-d", strtotime("+1 months")),
                        "total_amount" => $totalAmount,
                        "monthly_payment" => $paymentAmount,
                        "interest_rate" => $pricing["three_years_interest_rate"],
                        "payment_status" => "Ongoing"
                    ];

                    $lotReservationsModel->setInstallmentPayment($data);

                    $message = "Your reservation for Lot #$lotId is now active under the $paymentOption plan. We have received your down payment.";
                    $customerNotificationModel->setNotification($reserveeId, $message, "my_lots_and_estates");

                    $emailSubject = "Your Down Payment Has Been Received – Reservation Activated!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 24px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #007bff; text-align: center;">Reservation Successfully Activated</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We’re pleased to let you know that we’ve successfully received your <strong>down payment</strong> for <strong>Lot #' . htmlspecialchars($lotId) . '</strong>.</p>
                        <p>Your reservation is now <strong>active</strong> under our <strong>' . htmlspecialchars($paymentOption) . '</strong> payment plan.</p>
                        <p>You’ll receive regular updates regarding your upcoming payments and schedule.</p>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);

                    break;
                case "Installment: 4 Years":
                    $termYears = 4;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_four_years"];

                    $data = [
                        "lot_id" => $lotId,
                        "reservation_id" => $reservationId,
                        "term_years" => $termYears,
                        "down_payment" => $downPayment,
                        "down_payment_status" => "Paid",
                        "down_payment_date" => date("Y-m-d"),
                        "down_payment_due_date" => $downPaymentDueDate,
                        "down_receipt_path" => $receiptFileName,
                        "next_due_date" => date("Y-m-d", strtotime("+1 months")),
                        "total_amount" => $totalAmount,
                        "monthly_payment" => $paymentAmount,
                        "interest_rate" => $pricing["four_years_interest_rate"],
                        "payment_status" => "Ongoing"
                    ];

                    $lotReservationsModel->setInstallmentPayment($data);

                    $message = "Your reservation for Lot #$lotId is now active under the $paymentOption plan. We have received your down payment.";
                    $customerNotificationModel->setNotification($reserveeId, $message, "my_lots_and_estates");

                    $emailSubject = "Your Down Payment Has Been Received &ndash; Reservation Activated!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 24px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #007bff; text-align: center;">Reservation Successfully Activated</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We’re pleased to let you know that we’ve successfully received your <strong>down payment</strong> for <strong>Lot #' . htmlspecialchars($lotId) . '</strong>.</p>
                        <p>Your reservation is now <strong>active</strong> under our <strong>' . htmlspecialchars($paymentOption) . '</strong> payment plan.</p>
                        <p>You’ll receive regular updates regarding your upcoming payments and schedule.</p>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);

                    break;
                case "Installment: 5 Years":
                    $termYears = 5;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_five_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_five_years"];

                    $data = [
                        "lot_id" => $lotId,
                        "reservation_id" => $reservationId,
                        "term_years" => $termYears,
                        "down_payment" => $downPayment,
                        "down_payment_status" => "Paid",
                        "down_payment_date" => date("Y-m-d"),
                        "down_payment_due_date" => $downPaymentDueDate,
                        "down_receipt_path" => $receiptFileName,
                        "next_due_date" => date("Y-m-d", strtotime("+1 months")),
                        "total_amount" => $totalAmount,
                        "monthly_payment" => $paymentAmount,
                        "interest_rate" => $pricing["five_years_interest_rate"],
                        "payment_status" => "Ongoing"
                    ];

                    $lotReservationsModel->setInstallmentPayment($data);

                    $message = "Your reservation for Lot #$lotId is now active under the $paymentOption plan. We have received your down payment.";
                    $customerNotificationModel->setNotification($reserveeId, $message, "my_lots_and_estates");

                    $emailSubject = "Your Down Payment Has Been Received – Reservation Activated!";
                    $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 24px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #007bff; text-align: center;">Reservation Successfully Activated</h2>
                        <p>Dear <strong>' . htmlspecialchars($customerFullName) . '</strong>,</p>
                        <p>We’re pleased to let you know that we’ve successfully received your <strong>down payment</strong> for <strong>Lot #' . htmlspecialchars($lotId) . '</strong>.</p>
                        <p>Your reservation is now <strong>active</strong> under our <strong>' . htmlspecialchars($paymentOption) . '</strong> payment plan.</p>
                        <p>You’ll receive regular updates regarding your upcoming payments and schedule.</p>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                        <hr style="border: none; height: 1px; background-color: #ccc; margin: 20px 0;">
                        <p style="font-size: 12px; color: #666; text-align: center;">This is an automated message. Please do not reply.</p>
                    </div>';
                    $emailHelper->sendEmail($customer["email_address"], $emailSubject, $emailBody, true);

                    break;
            }

            if ($paymentOption === "Cash Sale") {
                $message = "$customerFullName has successfully owned $lotId through $paymentOption";
            } else {
                $lotReservationsModel->setLotStatus($lotId);
                $message = "The lot reservation has been added.";
            }

            $this->redirect(BASE_URL . "/lot-reservations", DisplayHelper::$checkIcon, $message, "Operation Successful");
        }
    }

    public function setDownPaymentDueDate()
    {
        return date("Y-m-d", strtotime("+30 days"));
    }

    public function updateSettings()
    {
        if (!isset($_POST['update_settings'])) {
            $this->redirect(
                BASE_URL . "/lot-reservations",
                DisplayHelper::$xIcon,
                "Invalid form submission",
                "Operation Failed"
            );
            return;
        }

        // Validate required fields
        $requiredFields = ['overdue_days_limit', 'notification_days'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                $this->redirect(
                    BASE_URL . "/lot-reservations",
                    DisplayHelper::$xIcon,
                    "Missing required field: {$field}",
                    "Operation Failed"
                );
                return;
            }
        }

        // Validate overdue_days_limit
        if (!in_array($_POST['overdue_days_limit'], ['0', '3', '5', '7'])) {
            $this->redirect(
                BASE_URL . "/lot-reservations",
                DisplayHelper::$xIcon,
                "Invalid overdue days limit value",
                "Operation Failed"
            );
            return;
        }

        // Validate notification_days
        if (!in_array($_POST['notification_days'], ['0', '1', '3', '5'])) {
            $this->redirect(
                BASE_URL . "/lot-reservations",
                DisplayHelper::$xIcon,
                "Invalid notification days value",
                "Operation Failed"
            );
            return;
        }

        $settings = [
            'overdue_days_limit' => $_POST['overdue_days_limit'],
            'notification_days' => $_POST['notification_days'],
            'enable_reminders' => isset($_POST['enable_reminders']) ? 1 : 0
        ];

        if ($this->reservationSettingsModel->updateSettings('Lot', $settings)) {
            // Update the controller's settings cache
            $this->reservationSettings = $this->reservationSettingsModel->getSettings("Lot");

            $this->redirect(
                BASE_URL . "/lot-reservations",
                DisplayHelper::$checkIcon,
                "Reservation settings updated successfully",
                "Operation Successful"
            );
        } else {
            $this->redirect(
                BASE_URL . "/lot-reservations",
                DisplayHelper::$xIcon,
                "Failed to update settings",
                "Operation Failed"
            );
        }
    }
}
