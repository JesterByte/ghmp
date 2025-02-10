<?php

namespace App\Controllers;

use App\Models\ReservationRequestsModel;
use App\Core\View;

use App\Utils\Encryption;

class ReservationRequestsController extends BaseController {
    public function index() {
        $reservationRequestsModel = new ReservationRequestsModel();
        $reservationRequestsTable = $reservationRequestsModel->getReservationRequests();

        $data = [
            "pageTitle" => "Reservation Requests",
            "usesDataTables" => true,
            "secretKey" => $this->secretKey,
            "reservationRequestsTable" => $reservationRequestsTable,
            "view" => "reservation-requests/index"
        ];

        View::render("templates/layout", $data);
    }

    public function verifyLotType($lotId) {
        $lotId = Encryption::decrypt($lotId, $this->secretKey);

        $reservationRequestsModel = new ReservationRequestsModel();
        $lot = $reservationRequestsModel->getCoordinatesByLotId($lotId);

        $data = [
            "pageTitle" => "Verify Lot Type",
            "usesDataTables" => false,
            "lot" => $lot,
            "view" => "verify-lot-type/index"
        ];

        View::render("templates/layout", $data);
    }

    public function setLotType() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot-id"];
            $lotType = $_POST["lot-type"];

            $reservationRequestsModel = new ReservationRequestsModel();

            $reservationRequestsModel->setLotType($lotId, $lotType);
            $this->redirect(BASE_URL . "/reservation-requests");
        }
    }
}