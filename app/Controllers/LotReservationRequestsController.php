<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\LotReservationRequestsModel;
use App\Core\View;

use App\Utils\Encryption;
use App\Helpers\DisplayHelper;
use App\Models\LotReservationsModel;

class LotReservationRequestsController extends BaseController
{
    public function index()
    {
        $lotReservationRequestsModel = new LotReservationRequestsModel();
        $reservationRequestsTable = $lotReservationRequestsModel->getReservationRequests();

        $data = [
            "pageTitle" => "Lot Reservation Requests",
            "usesDataTables" => true,
            "secretKey" => $this->secretKey,
            "reservationRequestsTable" => $reservationRequestsTable,
            "view" => "lot-reservation-requests/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function verifyLotType($lotId)
    {
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

    public function setLotType()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot-id"];
            $lotType = $_POST["lot-type"];

            $lotReservationRequestsModel = new LotReservationRequestsModel();

            $lotReservationRequestsModel->setLotType($lotId, $lotType);
            // $this->redirect(BASE_URL . "/reservation-requests");
            $this->redirect(BASE_URL . "/lot-reservation-requests", DisplayHelper::$checkIcon, "The lot type has been assigned.", "Operation Successful");
        }
    }

    public function cancelLotReservation()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot_id"];
            $reserveeId = $_POST["reservee_id"];

            $lotReservationRequestsModel = new LotReservationRequestsModel();

            $lotReservationRequestsModel->cancelLotReservation($lotId, $reserveeId);

            $lotReservationsModel = new LotReservationsModel();
            $lotReservationsModel->setLotStatus($lotId, "Available");
            // $this->redirect(BASE_URL . "/reservation-requests");
            $this->redirect(BASE_URL . "/lot-reservation-requests", DisplayHelper::$checkIcon, "The lot reservation has been cancelled.", "Operation Successful");
        }
    }
}
