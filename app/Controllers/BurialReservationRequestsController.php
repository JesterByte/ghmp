<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\BurialReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;

class BurialReservationRequestsController extends BaseController {
    public function index() {
        $burialReservationsModel = new BurialReservationsModel();
        $burialReservationRequestsTable = $burialReservationsModel->getBurialReservationRequests();

        $data = [
            "pageTitle" => "Burial Reservation Requests",
            "usesDataTables" => true,
            "burialReservationRequestsTable" => $burialReservationRequestsTable,
            "view" => "burial-reservation-requests/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function submitBurialReservationConfirmation() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset_id"];
            $status = $_POST["action"] == "approve" ? "Approved" : "Cancelled";

            $burialReservationsModel = new BurialReservationsModel();
            $burialReservationsModel->updateStatus($assetId, $status);
            // $this->redirect(BASE_URL . "/burial-reservation-requests");
            $this->redirect(BASE_URL . "/burial-reservation-requests", DisplayHelper::$checkIcon, "Burial reservation has been aprroved.", "Operation Successful");

        }
    }
}