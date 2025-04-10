<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\SixMonthsModel;
use App\Core\View;
use App\Helpers\DisplayHelper;

class SixMonthsController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $sixMonthsModel = new SixMonthsModel();
        $sixMonthsTable = $sixMonthsModel->getSixMonthsPayments();
        $reservationsTable = $sixMonthsModel->getReservations();

        $data = [
            "pageTitle" => "6 Months",
            "usesDataTables" => true,
            "sixMonthsTable" => $sixMonthsTable,
            "reservationsTable" => $reservationsTable,
            "view" => "six-months/index",
            "currentTable" => "Installments",

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

        $sixMonthsModel = new SixMonthsModel();
        $sixMonthsTable = $sixMonthsModel->getSixMonthsDownPayments();
        $reservationsTable = $sixMonthsModel->getReservations();

        $data = [
            "pageTitle" => "6 Months",
            "currentTable" => "Down Payments",
            "usesDataTables" => true,
            "sixMonthsTable" => $sixMonthsTable,
            "reservationsTable" => $reservationsTable,
            "view" => "six-months/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function setPayment()
    {
        $sixMonthsModel = new SixMonthsModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);
            $receiptPath = null;

            // Handle receipt upload
            if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] === UPLOAD_ERR_OK) {
                $allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
                $fileType = $_FILES["receipt"]["type"];

                if (in_array($fileType, $allowedTypes)) {
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] . BASE_URL . "/uploads/receipts/";
                    $fileName = time() . "_" . basename($_FILES["receipt"]["name"]);
                    $targetPath = $uploadDir . $fileName;

                    if (!move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetPath)) {
                        $this->redirect(BASE_URL . "/six-months", DisplayHelper::$xIcon, "Failed to record new 6 months payment.", "Operation Failed");
                    }
                }
            }

            switch ($assetType) {
                case "lot":
                    $assetTable = "lots";
                    $reservationTable = "lot_reservations";
                    $sixMonthsTable = "six_months";
                    $sixMonthsPaymentsTable = $sixMonthsTable . "_payments";
                    $assetIdKey = "lot_id";
                    break;
                case "estate":
                    $assetTable = "estates";
                    $reservationTable = "estate_reservations";
                    $sixMonthsTable = "estate_six_months";
                    $sixMonthsPaymentsTable = $sixMonthsTable . "_payments";
                    $assetIdKey = "estate_id";
                    break;
            }

            $reserveeId = $sixMonthsModel->getReserveeId($reservationTable, $assetIdKey, $assetId);
            $reservationId = $sixMonthsModel->getReservationId($reservationTable, $assetIdKey, $assetId, $reserveeId);
            $sixMonthsId = $sixMonthsModel->getSixMonthsId($sixMonthsTable, $reservationId);
            $monthlyPayment = $sixMonthsModel->getSixMonthsMonthlyPayment($sixMonthsTable, $sixMonthsId);

            $data = [
                "six_months_id" => $sixMonthsId,
                "six_months_table" => $sixMonthsTable,
                "payments_table" => $sixMonthsPaymentsTable,
                "payment_amount" => $monthlyPayment,
                "receipt_path" => $fileName,
                "next_due_date" => date("Y-m-d", strtotime("+1 month")),
                "payment_status" => "Paid"
            ];

            $sixMonthsModel->setPayment($data);
            $sixMonthsModel->setNextDueDate($data);

            $totalPaid = $sixMonthsModel->getTotalPaid($sixMonthsId, $sixMonthsPaymentsTable);
            $payableAmount = $sixMonthsModel->getPayableAmount($reservationId, $sixMonthsTable);

            if ($payableAmount === $totalPaid) {
                $sixMonthsModel->completeInstallment($sixMonthsTable, $reservationId, "Completed");
                $sixMonthsModel->completeReservation($reservationTable, $reservationId, "Completed");
                $sixMonthsModel->setAssetOwnership($assetTable, $assetIdKey, $reserveeId, $assetId, "Sold");

                $this->redirect(BASE_URL . "/six-months", DisplayHelper::$checkIcon, "The reservation for $assetId has been completed.", "Operation Successful");
            }

            $this->redirect(BASE_URL . "/six-months", DisplayHelper::$checkIcon, "New monthly payment has been recorded.", "Operation Successful");
        }
    }

    public function fetchReservee()
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data["asset_id"])) {
            $assetId = $data["asset_id"];
            $sixMonthsModel = new SixMonthsModel();
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
                    $reserveeId = $sixMonthsModel->getReserveeId($table, $assetIdKey, $assetId);
                    $reservee = $sixMonthsModel->getReserveeName($reserveeId);
                    break;
                case "estate":
                    $reserveeId = $sixMonthsModel->getReserveeId($table, $assetIdKey, $assetId);
                    $reservee = $sixMonthsModel->getReserveeName($reserveeId);
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
}
