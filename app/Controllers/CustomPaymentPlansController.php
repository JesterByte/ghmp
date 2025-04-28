<?php

namespace App\Controllers;

use App\Models\CustomersModel;
use App\Helpers\DisplayHelper;
use App\Core\View;
use App\Models\CustomPaymentPlansModel;

class CustomPaymentPlansController extends BaseController
{
    public function indexLot()
    {
        $this->checkSession();


        $data = [
            "pageTitle" => "Custom Payment Plans",
            "currentPage" => "Lot",
            "usesDataTables" => false,
            "customPaymentPlansTable" => [],
            "view" => "custom-payment-plans/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexEstate()
    {
        $this->checkSession();


        $data = [
            "pageTitle" => "Custom Payment Plans",
            "currentPage" => "Estate",
            "usesDataTables" => false,
            "customPaymentPlansTable" => [],
            "view" => "custom-payment-plans/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function getPhasePrice()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $phase = $data['phase'] ?? '';
            $lotType = $data['lot_type'] ?? '';

            $customPaymentPlansModel = new CustomPaymentPlansModel();

            $data = [
                "phase" => $phase,
                "lot_type" => $lotType
            ];

            $totalPurchasePrice = $customPaymentPlansModel->getPhasePricing($data)["total_purchase_price"];

            header("Content-Type: application/json");
            echo json_encode([
                "price" => $totalPurchasePrice ?? null
            ]);
            exit;
        }

        header('HTTP/1.1 400 Bad Request');
        exit;
    }

    public function getEstatePrice()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $estate = $data['estate'] ?? '';

            $customPaymentPlansModel = new CustomPaymentPlansModel();

            $data = [
                "estate" => $estate
            ];

            $totalPurchasePrice = $customPaymentPlansModel->getEstatePricing($data)["total_purchase_price"];

            header("Content-Type: application/json");
            echo json_encode([
                "price" => $totalPurchasePrice ?? null
            ]);
            exit;
        }

        header('HTTP/1.1 400 Bad Request');
        exit;
    }
}
