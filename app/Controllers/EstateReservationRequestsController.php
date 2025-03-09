<?php

namespace App\Controllers;

use App\Models\EstateReservationRequestsModel;
use App\Core\View;

use App\Utils\Encryption;

class EstateReservationRequestsController extends BaseController
{
    public function index()
    {
        $reservationRequestsModel = new EstateReservationRequestsModel();
        $estateReservationRequestsTable = $reservationRequestsModel->getEstateReservationRequests();

        $data = [
            "pageTitle" => "Estate Reservation Requests",
            "usesDataTables" => true,
            "secretKey" => $this->secretKey,
            "estateReservationRequestsTable" => $estateReservationRequestsTable,
            "view" => "estate-reservation-requests/index"
        ];

        View::render("templates/layout", $data);
    }

    public function submitBurialReservationConfirmation()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $estateId = $_POST["estate_id"];
            $reserveeId = $_POST["reservee_id"];
            $status = $_POST["action"] == "approve" ? "Confirmed" : "Cancelled";

            $estateReservationRequestsModel = new EstateReservationRequestsModel();
            $estateReservationRequestsModel->setEstateReservationStatus($estateId, $reserveeId, $status);
            $this->redirect(BASE_URL . "/estate-reservation-requests");
        }
    }
}
