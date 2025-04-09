<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\CustomersModel;
use App\Models\EstateReservationsModel;
use App\Models\ReservationSettingsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;

class EstateReservationsController extends BaseController
{
    protected $reservationSettingsModel;
    protected $reservationSettings;

    public function __construct() {
        parent::__construct();
        $this->reservationSettingsModel = new ReservationSettingsModel();
        $this->reservationSettings = $this->reservationSettingsModel->getSettings("Estate");
    }

    public function indexCashSale()
    {
        $this->checkSession();

        $estateReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estateReservationsModel->getCashSaleEstateReservations();
        $availableEstates = $estateReservationsModel->getAvailableEstates();
        $customers = $estateReservationsModel->getCustomers();
        $estateReservationRequests = $estateReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cash Sale",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "estate-reservations/index",

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

        $estateReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estateReservationsModel->getSixMonthsEstateReservations();
        $availableEstates = $estateReservationsModel->getAvailableEstates();
        $customers = $estateReservationsModel->getCustomers();
        $estateReservationRequests = $estateReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "6 Months",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "estate-reservations/index",

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

        $estateReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estateReservationsModel->getInstallmentEstateReservations();
        $availableEstates = $estateReservationsModel->getAvailableEstates();
        $customers = $estateReservationsModel->getCustomers();
        $estateReservationRequests = $estateReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "Installment",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "estate-reservations/index",

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

        $estateReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estateReservationsModel->getCancelledEstateReservations();
        $availableEstates = $estateReservationsModel->getAvailableEstates();
        $customers = $estateReservationsModel->getCustomers();
        $estateReservationRequests = $estateReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cancelled",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "estate-reservations/index",

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

        $estateReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estateReservationsModel->getOverdueEstateReservations();
        $availableEstates = $estateReservationsModel->getAvailableEstates();
        $customers = $estateReservationsModel->getCustomers();
        $estateReservationRequests = $estateReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "Overdue",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "reservationSettings" => $this->reservationSettings,
            "view" => "estate-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function fetchEstatePricing()
    {
        $estateReservationsModel = new EstateReservationsModel();
        // Disable PHP warnings/notices that can corrupt JSON output
        error_reporting(0);
        header('Content-Type: application/json');
        // Read JSON request
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data["estateType"], $data["paymentOption"])) {
            $estateType = "Estate " . $data["estateType"];
            $paymentOption = $data["paymentOption"];

            // Map payment option to database column name
            if ($paymentOption === "Cash Sale") {
                $paymentOptionKey = "cash_sale";
                $price = $estateReservationsModel->getCashSalePricing($estateType, $paymentOptionKey);
            } elseif ($paymentOption === "6 Months") {
                $downPaymentKey = "six_months_down_payment";
                $monthlyPaymentKey = "six_months_monthly_amortization";

                $downPayment = $estateReservationsModel->getDownPayment($estateType, $downPaymentKey);
                $monthlyPayment = $estateReservationsModel->getMonthlyPayment($estateType, $monthlyPaymentKey);
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
                $downPayment = $estateReservationsModel->getDownPayment($estateType, $downPaymentKey);
                $monthlyPayment = $estateReservationsModel->getMonthlyPayment($estateType, $monthlyPaymentKey);
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
            $estateReservationsModel = new EstateReservationsModel();
            $estateId = $_POST['estate'];
            $reserveeId = $_POST['customer'];
            $estateType = Formatter::extractEstateType($_POST['estate']);
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

            $pricing = $estateReservationsModel->getPricing("Estate " . $estateType);

            $customersModel = new CustomersModel();
            $customer = $customersModel->getCustomerById($reserveeId);
            $middleName = !empty($customer["middle_name"]) ? " " . $customer["middle_name"] . " " : " ";
            $suffix = !empty($customer["suffix_name"]) ? ", " . $customer["suffix_name"] : "";
            $customerFullName = $customer["first_name"] . $middleName . $customer["last_name"] . $suffix;

            $reservationId = $estateReservationsModel->setReservation($estateId, $reserveeId, $estateType, $paymentOption);
            $calculator = new Calculator();
            $downPaymentDueDate = $this->setDownPaymentDueDate();
            switch ($paymentOption) {
                case "Cash Sale":
                    $paymentAmount = $pricing['cash_sale'];
                    $cashSaleId = $estateReservationsModel->setCashSalePayment($estateId, $reservationId, $paymentAmount, $receiptFileName);
                    $estateReservationsModel->setCashSaleDueDate($estateId, $cashSaleId);
                    $estateReservationsModel->completeReservation($reservationId);
                    $estateReservationsModel->setEstateOwner($estateId, $reserveeId);
                    break;
                case "6 Months":
                    $data = [
                        "estate_id" => $estateId,
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
                    $estateReservationsModel->setSixMonthsPayment($data);
                    break;
                case "Installment: 1 Year":
                    $termYears = 1;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_one_year"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_one_year"];
                    $estateReservationsModel->setInstallmentPayment($estateId, $reservationId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["one_year_interest_rate"], "Pending");
                    break;
                case "Installment: 2 Years":
                    $termYears = 2;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_two_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_two_years"];
                    $estateReservationsModel->setInstallmentPayment($estateId, $reservationId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["two_years_interest_rate"], "Pending");
                    break;
                case "Installment: 3 Years":
                    $termYears = 3;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_three_years"];
                    $estateReservationsModel->setInstallmentPayment($estateId, $reservationId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["three_years_interest_rate"], "Pending");
                    break;
                case "Installment: 4 Years":
                    $termYears = 4;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_four_years"];
                    $estateReservationsModel->setInstallmentPayment($estateId, $reservationId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["four_years_interest_rate"], "Pending");
                    break;
                case "Installment: 5 Years":
                    $termYears = 5;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_five_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_five_years"];
                    $estateReservationsModel->setInstallmentPayment($estateId, $reservationId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["five_years_interest_rate"], "Pending");
                    break;
            }

            if ($paymentOption === "Cash Sale") {
                $message = "$customerFullName has successfully owned $estateId through $paymentOption";
            } else {
                $estateReservationsModel->setEstateStatus($estateId);
                $message = "The estate reservation has been added.";
            }

            $this->redirect(BASE_URL . "/estate-reservations", DisplayHelper::$checkIcon, $message, "Operation Successful");
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
                BASE_URL . "/estate-reservations",
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
                    BASE_URL . "/estate-reservations",
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
                BASE_URL . "/estate-reservations",
                DisplayHelper::$xIcon,
                "Invalid overdue days limit value",
                "Operation Failed"
            );
            return;
        }

        // Validate notification_days
        if (!in_array($_POST['notification_days'], ['0', '1', '3', '5'])) {
            $this->redirect(
                BASE_URL . "/estate-reservations",
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

        if ($this->reservationSettingsModel->updateSettings('Estate', $settings)) {
            // Update the controller's settings cache
            $this->reservationSettings = $this->reservationSettingsModel->getSettings("Estate");

            $this->redirect(
                BASE_URL . "/estate-reservations",
                DisplayHelper::$checkIcon,
                "Reservation settings updated successfully",
                "Operation Successful"
            );
        } else {
            $this->redirect(
                BASE_URL . "/estate-reservations",
                DisplayHelper::$xIcon,
                "Failed to update settings",
                "Operation Failed"
            );
        }
    }
}
