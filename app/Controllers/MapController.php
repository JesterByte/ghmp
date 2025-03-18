<?php

namespace App\Controllers;

use App\Models\MapModel;
use App\Models\BadgeModel;
use App\Core\View;

class MapController extends BaseController {
    public function index() {
        $badgeModel = new BadgeModel();
        $pendingBurialReservations = $badgeModel->getPendingBurialReservations();
        $pendingLotReservations = $badgeModel->getPendingLotReservations();
        $pendingEstateReservations = $badgeModel->getPendingEstateReservations();

        $this->checkSession();

        $data = [
            "pageTitle" => "Map",
            "pendingBurialReservations" => $pendingBurialReservations,
            "pendingLotReservations" => $pendingLotReservations,
            "pendingEstateReservations" => $pendingEstateReservations,
            "usesDataTables" => false,
            "map" => [],
            "view" => "map/index"
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