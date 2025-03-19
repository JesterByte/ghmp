<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\BurialReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;
use Exception;

class BurialReservationsController extends BaseController {
    public function index() {
        $this->checkSession();

        $burialReservationsModel = new BurialReservationsModel();
        $burialReservationRequests = $burialReservationsModel->getBurialReservationRequestsBadge();

        $data = [
            "pageTitle" => "Burial Reservations",
            "burialReservationRequests" => $burialReservationRequests,
            "view" => "burial-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function getEvents() {
        $burialReservationsModel = new BurialReservationsModel();
        $eventsArray = $burialReservationsModel->getEvents();

        $events = [];
        foreach ($eventsArray as $event) {
            $middleName = !empty($event["middle_name"]) ? " " . $event["middle_name"] . " " : " ";
            $suffix = !empty($event["suffix"]) ? ", " . $event["suffix"] : "";
            $fullName = $event["first_name"] . $middleName . $event["last_name"] . $suffix;

            $events[] = [
                "id" => $event["id"],
                "title" => $fullName,
                "start" => date('c', strtotime($event["date_time"])), // Convert to ISO 8601
                "end" => date('c', strtotime($event["date_time"])),
                "status" => $event["status"]
            ];
        }

        // Debugging: Check if JSON is valid
        $json = json_encode($events);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON Encoding Error: " . json_last_error_msg());
        }

        header('Content-Type: application/json');
        echo $json;        
    }

    public function markDone() {
        header('Content-Type: application/json');
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    
        try {
            $data = json_decode(file_get_contents("php://input"), true);
    
            if (!isset($data["event_id"])) {
                echo json_encode(["success" => false, "message" => "Invalid event ID."]);
                return;
            }
    
            $eventId = $data["event_id"];
    
            $burialReservationsModel = new BurialReservationsModel();
            $reservation = $burialReservationsModel->findById($eventId);
            if (!$reservation) {
                echo json_encode(["success" => false, "message" => "Event not found."]);
                return;
            }
    
            $result = $burialReservationsModel->updateStatusById($eventId, "Completed");

            $assetType = Formatter::determineIdType($reservation["asset_id"]);

            switch ($assetType) {
                case "estate":
                    $burialReservationsModel->updateEstateOccupancy($reservation["asset_id"], $reservation["reservee_id"]);
                    break;
                case "lot":
                    $burialReservationsModel->updateLotOccupancy($reservation["asset_id"], $reservation["reservee_id"]);
                    break;
            }
    
            if ($result) {
                echo json_encode([
                    "success" => true,
                    "message" => "Reservation marked as completed successfully!",
                    "icon" => DisplayHelper::$checkIcon,
                    "title" => "Operation Successful"
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update reservation."]);
            }        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "An error occurred: " . $e->getMessage()]);
        }
    }
    
}