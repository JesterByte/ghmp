<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\SixMonthsModel;
use App\Core\View;

class SixMonthsController extends BaseController {
    public function index() {
        $this->checkSession();

        $sixMonthsModel = new SixMonthsModel();
        $sixMonthsTable = $sixMonthsModel->getSixMonths();
        $reservationsTable = $sixMonthsModel->getReservations();

        $data = [
            "pageTitle" => "6 Months",
            "usesDataTables" => true,
            "sixMonthsTable" => $sixMonthsTable,
            "reservationsTable" => $reservationsTable,
            "view" => "six-months/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function setPayment() {
        $sixMonthsModel = new SixMonthsModel();
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);

            switch ($assetType) {
                case "lot":
                    $sixMonthsModel->setPayment($assetId);
                    $sixMonthsModel->setLotReservation($assetId);
                    $reserveeId = $sixMonthsModel->getReserveeId($assetId)["reservee_id"];
                    $sixMonthsModel->setLotOwnership($assetId, $reserveeId);
                    break;
                case "estate":
                    $sixMonthsModel->setPaymentEstate($assetId);
                    $sixMonthsModel->setEstateReservation($assetId);
                    $reserveeId = $sixMonthsModel->getReserveeIdEstate($assetId)["reservee_id"];
                    $sixMonthsModel->setEstateOwnership($assetId, $reserveeId);
                    break;
            }
            $this->redirectBack();
        }
    }
}