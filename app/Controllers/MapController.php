<?php

namespace App\Controllers;

use App\Models\MapModel;
use App\Models\BadgeModel;
use App\Core\View;

class MapController extends BaseController {
    public function index() {
        $this->checkSession();

        $data = [
            "pageTitle" => "Map",
            "usesDataTables" => false,
            "map" => [],
            "view" => "map/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }
    public function fetchLots() {
        $mapModel = new MapModel();
        $lots = $mapModel->getLots();

        header("Content-Type: application/json");
        echo json_encode($lots);
    }
}