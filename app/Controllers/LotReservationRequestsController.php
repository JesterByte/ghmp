<?php

namespace App\Controllers;

use App\Models\LotReservationRequestsModel;
use App\Core\View;

use App\Utils\Encryption;
use App\Helpers\DisplayHelper;

class LotReservationRequestsController extends BaseController {
    public function index() {
        $lotReservationRequestsModel = new LotReservationRequestsModel();
        $reservationRequestsTable = $lotReservationRequestsModel->getReservationRequests();

        $data = [
            "pageTitle" => "Lot Reservation Requests",
            "usesDataTables" => true,
            "secretKey" => $this->secretKey,
            "reservationRequestsTable" => $reservationRequestsTable,
            "view" => "lot-reservation-requests/index"
        ];

        View::render("templates/layout", $data);
    }

    public function verifyLotType($lotId) {
        $lotId = Encryption::decrypt($lotId, $this->secretKey);

        $lotReservationRequestsModel = new LotReservationRequestsModel();
        $lot = $lotReservationRequestsModel->getCoordinatesByLotId($lotId);

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

            $lotReservationRequestsModel = new LotReservationRequestsModel();

            $lotReservationRequestsModel->setLotType($lotId, $lotType);
            // $this->redirect(BASE_URL . "/reservation-requests");
            $this->redirect(BASE_URL . "/reservation-requests", DisplayHelper::$checkIcon, "The lot type has been assigned.", "Operation Successful");
        }
    }

    public function cancelLotReservation() {

    }
}