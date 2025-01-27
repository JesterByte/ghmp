<?php

namespace App\Controllers;

use App\Models\LotReservationsModel;
use App\Utils\Formatter;
use App\Core\View;

class LotReservationsController extends BaseController {
    public function index() {
        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "view" => "lot-reservations/index"
        ];

        View::render("templates/layout", $data);
    }

    public function setReservation() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotReservationsModel = new LotReservationsModel();
            $lotId = $_POST['lot'];
            $reserveeId = $_POST['customer'];
            $phase = $_POST['phase'];
            $lotType = $_POST['lot-type'];
            $paymentOption = $_POST['payment-option'];
            
            $pricing = $lotReservationsModel->getPricing($phase, $lotType);
            $paymentAmount = $pricing['cash_sale'];

            $lotReservationsModel->setReservation($lotId, $reserveeId, $lotType, $paymentOption);
            $lotReservationsModel->setCashSalePayment($lotId, $paymentAmount);
    
            $this->redirectBack();    
        }
    }


}