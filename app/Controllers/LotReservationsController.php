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
        $lotReservationsModel = new LotReservationsModel();
        $lotId = $_POST['lot'];
        $lotIdComponents = Formatter::extractComponents($lotId);
        $reserveeId = $_POST['customer'];
        $lotType = $_POST['lot-type'];
        $paymentOption = $_POST['payment-option'];

        $lotReservationsModel->setReservation($lotId, $reserveeId, $lotType, $paymentOption);

        $this->redirectBack();
    }


}