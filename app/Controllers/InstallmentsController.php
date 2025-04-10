<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\InstallmentsModel;
use App\Core\View;
use App\Helpers\DisplayHelper;

class InstallmentsController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $installmentsModel = new InstallmentsModel();
        $installmentsTable = $installmentsModel->getInstallments();
        $downPayments = $installmentsModel->getDownPayments();
        $pendingDownPayments = $installmentsModel->getPendingDownPayments();
        $ongoingInstallments = $installmentsModel->getOngoingInstallments();

        $data = [
            "pageTitle" => "Installments",
            "currentTable" => "Installments",
            "usesDataTables" => true,
            "installmentsTable" => $installmentsTable,
            "pendingDownPayments" => $pendingDownPayments,
            "ongoingInstallments" => $ongoingInstallments,
            "view" => "installments/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexDownPayments()
    {
        $this->checkSession();

        $installmentsModel = new InstallmentsModel();
        $downPaymentsTable = $installmentsModel->getDownPayments();
        $pendingDownPayments = $installmentsModel->getPendingDownPayments();
        $ongoingInstallments = $installmentsModel->getOngoingInstallments();

        $data = [
            "pageTitle" => "Down Payments",
            "currentTable" => "Down Payments",
            "usesDataTables" => true,
            "downPaymentsTable" => $downPaymentsTable,
            "pendingDownPayments" => $pendingDownPayments,
            "ongoingInstallments" => $ongoingInstallments,
            "view" => "installments/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function fetchReservee()
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["asset_id"])) {
            $assetId = $data["asset_id"];
            $installmentsModel = new InstallmentsModel();
            $assetType = $this->checkAssetId($assetId);

            switch ($assetType) {
                case "lot":
                    $table = "lot_reservations";
                    $assetIdKey = "lot_id";
                    break;
                case "estate":
                    $table = "estate_reservations";
                    $assetIdKey = "estate_id";
                    break;
            }

            switch ($assetType) {
                case "lot":
                    $reserveeId = $installmentsModel->getReserveeId($table, $assetIdKey, $assetId);
                    $reservee = $installmentsModel->getReserveeName($reserveeId);
                    break;
                case "estate":
                    $reserveeId = $installmentsModel->getReserveeId($table, $assetIdKey, $assetId);
                    $reservee = $installmentsModel->getReserveeName($reserveeId);
                    break;
                default:
                    echo json_encode(["success" => false, "message" => "Invalid asset"]);
                    return;
            }

            if ($reservee) {
                $middleName = !empty($reserve["middle_name"]) ? " " . $reservee["middle_name"] . " " : " ";
                $suffix = !empty($reservee["suffix_name"]) ? ", " . $reservee["suffix_name"] : "";
                $reserveeFullName = $reservee["first_name"] . $middleName . $reservee["last_name"] . $suffix;

                echo json_encode([
                    "success" => true,
                    "reservee_id" => $reserveeId,
                    "reservee_full_name" => $reserveeFullName
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "No reservee found"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request"]);
        }
    }

    public function setPayment()
    {
        $installmentsModel = new InstallmentsModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);
            $receiptPath = null;

            // Handle receipt upload
            if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] === UPLOAD_ERR_OK) {
                $allowedTypes = ["image/jpeg", "image/png"];
                $fileType = $_FILES["receipt"]["type"];

                if (in_array($fileType, $allowedTypes)) {
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] . BASE_URL . "/uploads/receipts/";
                    $fileName = time() . "_" . basename($_FILES["receipt"]["name"]);
                    $targetPath = $uploadDir . $fileName;

                    if (!move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetPath)) {
                        $this->redirect(BASE_URL . "/six-months", DisplayHelper::$xIcon, "Failed to record new installment payment.", "Operation Failed");
                    }
                }
            }

            switch ($assetType) {
                case "lot":
                    $assetTable = "lots";
                    $reservationTable = "lot_reservations";
                    $installmentsTable = "installments";
                    $installmentPaymentsTable = "installment_payments";
                    $assetIdKey = "lot_id";
                    break;
                case "estate":
                    $assetTable = "estates";
                    $reservationTable = "estate_reservations";
                    $installmentsTable = "estate_installments";
                    $installmentPaymentsTable = "estate_installment_payments";
                    $assetIdKey = "estate_id";
                    break;
            }

            $reserveeId = $installmentsModel->getReserveeId($reservationTable, $assetIdKey, $assetId);
            $reservationId = $installmentsModel->getReservationId($reservationTable, $assetIdKey, $assetId, $reserveeId);
            $installmentId = $installmentsModel->getInstallmentId($reservationId);
            $monthlyPayment = $installmentsModel->getInstallmentMonthlyPayment($installmentsTable, $installmentId);

            $data = [
                "installment_id" => $installmentId,
                "installments_table" => $installmentsTable,
                "table" => $installmentPaymentsTable,
                "payment_amount" => $monthlyPayment,
                "receipt_path" => $fileName,
                "next_due_date" => date("Y-m-d", strtotime("+1 month")),
                "payment_status" => "Paid"
            ];

            $installmentsModel->setPayment($data);
            $installmentsModel->setNextDueDate($data);

            $paymentCount = $installmentsModel->getPaymentCount($installmentPaymentsTable, $installmentId);
            $termYears = $installmentsModel->getTermYears($installmentsTable, $reservationId);

            $lastPayment = (($termYears * 12) - $paymentCount) === 0 ? true : false;

            if ($lastPayment) {
                $installmentsModel->completeInstallment($installmentsTable, $reservationId, "Completed");
                $installmentsModel->completeReservation($reservationTable, $reservationId, "Completed");
                $installmentsModel->setAssetOwnership($assetTable, $assetIdKey, $reserveeId, $assetId, "Sold");

                $this->redirect(BASE_URL . "/installments", DisplayHelper::$checkIcon, "The reservation for $assetId has been completed.", "Operation Successful");
                exit;
            }

            $this->redirect(BASE_URL . "/installments", DisplayHelper::$checkIcon, "New monthly payment has been recorded.", "Operation Successful");
        }
    }


    // public function setDownPayment()
    // {
    //     $installmentsModel = new InstallmentsModel();

    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $assetId = $_POST["asset-id"];
    //         $assetType = $this->checkAssetId($assetId);

    //         switch ($assetType) {
    //             case "lot":
    //                 $installmentsModel->setDownPayment($assetId);
    //                 break;
    //             case "estate":
    //                 $installmentsModel->setDownPaymentEstate($assetId);
    //                 break;
    //         }

    //         $this->redirectBack();
    //     }
    // }

    // public function setMonthlyPayment()
    // {
    //     $installmentsModel = new InstallmentsModel();

    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $assetId = $_POST["asset-id"];
    //         $assetType = $this->checkAssetId($assetId);

    //         switch ($assetType) {
    //             case "lot":
    //                 $installmentsModel->setMonthlyPayment($assetId);
    //                 $installmentsModel->setNextDueDate($assetId);

    //                 $installmentRow = $installmentsModel->getInstallmentByLotId($assetId);
    //                 $installmentId = $installmentRow["id"];
    //                 $totalPaid = $installmentsModel->getPaymentAmountSum($installmentId)["total_paid"];
    //                 $totalAmount = $installmentRow["total_amount"];

    //                 if ($totalPaid >= $totalAmount) {
    //                     $installmentsModel->setCompleteInstallment($installmentId);
    //                     $installmentsModel->setLotReservation($assetId);
    //                     $reserveeId = $installmentsModel->getReserveeId($assetId)["reservee_id"];
    //                     $installmentsModel->setLotOwnership($assetId, $reserveeId);
    //                 }
    //                 break;
    //             case "estate":
    //                 $installmentsModel->setMonthlyPaymentEstate($assetId);
    //                 $installmentsModel->setNextDueDateEstate($assetId);

    //                 $installmentRow = $installmentsModel->getInstallmentByEstateId($assetId);
    //                 $installmentId = $installmentRow["id"];
    //                 $totalPaid = $installmentsModel->getPaymentAmountSumEstate($installmentId)["total_paid"];
    //                 $totalAmount = $installmentRow["total_amount"];

    //                 if ($totalPaid >= $totalAmount) {
    //                     $installmentsModel->setCompleteInstallmentEstate($installmentId);
    //                     $installmentsModel->setEstateReservation($assetId);
    //                     $reserveeId = $installmentsModel->getReserveeIdEstate($assetId)["reservee_id"];
    //                     $installmentsModel->setEstateOwnership($assetId, $reserveeId);
    //                 }
    //                 break;
    //         }
    //         $this->redirectBack();
    //     }
    // }

    // public function setPayment() {
    //     $cashSalesModel = new InstallmentsModel();

    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $lotId = $_POST["lot-id"];

    //         $cashSalesModel->setPayment($lotId);
    //         $cashSalesModel->setLotReservation($lotId);

    //         $this->redirectBack();
    //     }
    // }
}
