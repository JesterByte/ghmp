<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\PhasePricingModel;
use App\Models\RestructureRequestsModel;
use App\Utils\Calculator;
use App\Utils\Formatter;
use App\Core\View;
use App\Helpers\DisplayHelper;

class RestructureRequestsController extends BaseController
{
    private $restructureRequestsModel;

    public function __construct()
    {
        parent::__construct();
        $this->restructureRequestsModel = new RestructureRequestsModel();
    }

    public function index()
    {
        $this->checkSession();

        $requests = $this->restructureRequestsModel->getRequests();

        $data = [
            "pageTitle" => "Restructure Requests",
            "view" => "restructure-requests/index",
            "requests" => $requests,

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries

        ];

        View::render("templates/layout", $data);
    }

    public function getRemainingBalance()
    {
        header("Content-Type: application/json");

        $reservationId = $_GET["reservation_id"];

        if (!$reservationId) {
            echo json_encode([
                "success" => true,
                "message" => "Missing reservation ID."
            ]);
        }

        $assetId = $_GET["asset_id"];

        if (!$assetId) {
            echo json_encode([
                "success" => true,
                "message" => "Missing asset ID."
            ]);
        }

        $paymentOption = $_GET["payment_option"];

        if (!$paymentOption) {
            echo json_encode([
                "success" => true,
                "message" => "Missing payment option."
            ]);
        }

        $assetType = Formatter::determineIdType($assetId);

        switch ($assetType) {
            case "lot":
                $prefix = "";
                break;
            case "estate":
                $prefix = "estate_";
                break;
        }

        switch ($paymentOption) {
            case "6 Months":
                $table = $prefix . "six_months";
                $paymentsTable = $prefix . "six_months_payments";
                break;
            default:
                $table = $prefix . "installments";
                $paymentsTable = $prefix . "installment_payments";
                break;
        }

        $result = $this->restructureRequestsModel->getRemainingBalance($table, $paymentsTable, $reservationId);
        $remainingBalance = $result["balance"] - $result["total_paid"];

        if ($result !== null) {
            echo json_encode([
                "success" => true,
                "remaining_balance" => $remainingBalance
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Reservation not found."
            ]);
        }
    }

    public function requestAction() {
        $requestId = $_POST["request_id"];
        $assetId = $_POST["asset_id"];
        $customerId = $_POST["customer_id"];
        $reservationId = $_POST["reservation_id"];
        $paymentOption = $_POST["payment_option"];
        $action = $_POST["action"];
        $status = $action === "approve" ? "Approved" : "Cancelled";
        $reason = isset($_POST["cancel_reason"]) ? strip_tags($_POST["cancel_reason"]) : null;
        $discountedPrice = $_POST["discounted_price"];

        $data = [
            "request_id" => $requestId,
            "discounted_price" => $discountedPrice,
            "status" => $status,
            "reason" => $reason
        ];

        $assetType = Formatter::determineIdType($assetId);

        switch ($assetType) {
            case "lot":
                $prefix = "";
                break;
            case "estate":
                $prefix = "estate_";
                break;
        }

        if ($paymentOption === "6 Months") {
            $table = $prefix . "six_months";
        } else if (str_contains($paymentOption, "Installment")) {
            $table = $prefix . "installments";
        }

        $restructureRequestsModel = new RestructureRequestsModel();
        switch ($action) {
            case "approve":
                $isUpdated = $restructureRequestsModel->setDiscountedPrice($data);

                $data = [
                    "restructure_id" => $requestId,
                    "reservation_id" => $reservationId,
                    "table" => $table
                ];

                $restructureRequestsModel->setRestructureId($data);
                $message = "Restructure request has been approved.";
                break;
            case "cancel":
                $isUpdated = $restructureRequestsModel->cancelRequest($data);
                $message = "Restructure request has been cancelled. Reason: {$reason}";
                break;
        }

        if ($isUpdated) {
            $icon = DisplayHelper::$checkIcon;
            $title = "Operation Successful";
        } else {
            $icon = DisplayHelper::$xIcon;
            $title = "Operation Failed";
        }

        return $this->redirect(BASE_URL . "/restructure-requests", $icon, $message, $title);
    }
}
