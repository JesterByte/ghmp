<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\EstateReservationRequestsModel;
use App\Core\View;
use App\Helpers\DisplayHelper;

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
            "view" => "estate-reservation-requests/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function submitEstateReservationConfirmation()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $estateId = $_POST["estate_id"];
            $reserveeId = $_POST["reservee_id"];
            $status = $_POST["action"] == "approve" ? "Confirmed" : "Cancelled";

            $estateReservationRequestsModel = new EstateReservationRequestsModel();
            $estateReservationRequestsModel->setEstateReservationStatus($estateId, $reserveeId, $status);

            switch ($status) {
                case "Confirmed":
                    $message = "The estate reservation has been approved successfully!";
                    break;
                case "Cancelled":
                    $message = "The estate reservation has been cancelled successfully!";
                    break;
            }
           
            // $this->redirect(BASE_URL . "/estate-reservation-requests");
            $this->redirect(BASE_URL . "/estate-reservation-requests", DisplayHelper::$checkIcon, $message, "Operation Successful");
        }
    }
}
