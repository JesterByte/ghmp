<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\CustomersModel;
use App\Models\LotReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;

class LotReservationsController extends BaseController
{
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
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
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
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
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
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
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
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
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
            "view" => "lot-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
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
            switch ($paymentOption) {
                case "Cash Sale":
                    $paymentAmount = $pricing['cash_sale'];
                    $cashSaleId = $lotReservationsModel->setCashSalePayment($lotId, $reservationId, $paymentAmount, $receiptFileName);
                    $lotReservationsModel->setCashSaleDueDate($lotId, $cashSaleId);
                    $lotReservationsModel->completeReservation($reservationId);
                    $lotReservationsModel->setLotOwner($lotId, $reservationId);
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
}
