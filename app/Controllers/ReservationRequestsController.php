<?php

namespace App\Controllers;

use App\Models\ReservationRequestsModel;
use App\Core\View;

class ReservationRequestsController extends BaseController {
    public function index() {
        $reservationRequestsModel = new ReservationRequestsModel();
        $reservationRequestsTable = $reservationRequestsModel->getReservationRequests();

        $data = [
            "pageTitle" => "Reservation Requests",
            "usesDataTables" => true,
            "reservationRequestsTable" => $reservationRequestsTable,
            "view" => "reservation-requests/index"
        ];

        View::render("templates/layout", $data);
    }
}