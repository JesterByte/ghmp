<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\CashSalesModel;
use App\Core\View;

class CashSalesController extends BaseController {
    public function index() {
        $this->checkSession();

        $cashSalesModel = new CashSalesModel();
        $cashSalesTable = $cashSalesModel->getCashSales();
        $reservationsTable = $cashSalesModel->getReservations();

        $data = [
            "pageTitle" => "Cash Sales",
            "usesDataTables" => true,
            "cashSalesTable" => $cashSalesTable,
            "reservationsTable" => $reservationsTable,
            "view" => "cash-sales/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function setPayment() {
        $cashSalesModel = new CashSalesModel();
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);

            switch ($assetType) {
                case "lot":
                    $cashSalesModel->setPayment($assetId);
                    $cashSalesModel->setLotReservation($assetId);
                    $reserveeId = $cashSalesModel->getReserveeId($assetId)["reservee_id"];
                    $cashSalesModel->setLotOwnership($assetId, $reserveeId);        
                    break;
                case "estate":
                    $cashSalesModel->setPaymentEstate($assetId);
                    $cashSalesModel->setEstateReservation($assetId);
                    $reserveeId = $cashSalesModel->getReserveeIdEstate($assetId)["reservee_id"];
                    $cashSalesModel->setEstateOwnership($assetId, $reserveeId);        
                    break;
            }

            $this->redirectBack();
        }
    }
}