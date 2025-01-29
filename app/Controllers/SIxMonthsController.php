<?php

namespace App\Controllers;

use App\Models\SixMonthsModel;
use App\Core\View;

class SixMonthsController extends BaseController {
    public function index() {
        $sixMonthsModel = new SixMonthsModel();
        $sixMonthsTable = $sixMonthsModel->getSixMonths();
        $reservationsTable = $sixMonthsModel->getReservations();

        $data = [
            "pageTitle" => "6 Months",
            "usesDataTables" => true,
            "sixMonthsTable" => $sixMonthsTable,
            "reservationsTable" => $reservationsTable,
            "view" => "six-months/index"
        ];

        View::render("templates/layout", $data);
    }

    public function setPayment() {
        $sixMonthsModel = new SixMonthsModel();
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot-id"];

            $sixMonthsModel->setPayment($lotId);
            $sixMonthsModel->setLotReservation($lotId);
            $reserveeId = $sixMonthsModel->getReserveeId($lotId)["reservee_id"];
            $sixMonthsModel->setLotOwnership($lotId, $reserveeId);

            $this->redirectBack();
        }
    }
}