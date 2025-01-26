<?php

namespace App\Controllers;

use App\Models\LotReservationsModel;
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

    
}