<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\BurialReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;
use Exception;
use Random\BrokenRandomEngineError;

class BurialReservationsController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $burialReservationsModel = new BurialReservationsModel();
        $burialReservationRequests = $burialReservationsModel->getBurialReservationRequestsBadge();

        $data = [
            "pageTitle" => "Burial Reservations",
            "burialReservationRequests" => $burialReservationRequests,
            "view" => "burial-reservations/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function getEvents()
    {
        // Instantiate the BurialReservationsModel
        $burialReservationsModel = new BurialReservationsModel();

        // Fetch events from the model
        $eventsArray = $burialReservationsModel->getEvents();

        // Initialize an empty array to hold formatted events
        $events = [];

        // Loop through each event and format it for FullCalendar
        foreach ($eventsArray as $event) {
            // Format the full name of the deceased
            $middleName = !empty($event["interred_middle_name"]) ? " " . $event["interred_middle_name"] . " " : " ";
            $suffix = !empty($event["interred_suffix_name"]) ? ", " . $event["interred_suffix_name"] : "";
            $fullName = $event["interred_first_name"] . $middleName . $event["interred_last_name"] . $suffix;

            $reserveeMiddleName = !empty($event["reservee_middle_name"]) ? " " . $event["reservee_middle_name"] . " " : " ";
            $reserveeSuffixName = !empty($event["reservee_suffix_name"]) ? ", " . $event["reservee_suffix_name"] . " " : " ";
            $reservee = $event["reservee_first_name"] . $reserveeMiddleName . $event["reservee_last_name"] . $reserveeSuffixName;

            $assetType = Formatter::determineIdType($event["asset_id"]);

            switch ($assetType) {
                case "lot":
                    $assetId = Formatter::formatLotId($event["asset_id"]);
                    break;
                case "estate":
                    $assetId = Formatter::formatEstateId($event["asset_id"]);
                    break;
            }

            // Add the formatted event to the events array
            $events[] = [
                "id" => $event["id"], // Event ID
                "title" => $fullName, // Full name of the deceased
                "start" => date('c', strtotime($event["date_time"])), // Start date/time in ISO 8601 format
                "end" => date('c', strtotime($event["date_time"])), // End date/time in ISO 8601 format
                "status" => $event["status"], // Event status (e.g., Pending, Completed)
                "extendedProps" => [ // Additional event properties
                    "interred_name" => $fullName,
                    "interred_birth_date" => Formatter::formatDate($event["date_of_birth"]),
                    "interred_death_date" => Formatter::formatDate($event["date_of_death"]),
                    "reserved_by" => $reservee,
                    "relationship" => $event["relationship"],
                    "reservation_date" => Formatter::formatDateTime($event["created_at"]),
                    "burial_type" => $event["burial_type"],
                    "burial_date_time" => Formatter::formatDateTime($event["date_time"]),
                    "asset_id" => $assetId
                ]
            ];
        }

        // Debugging: Check if JSON is valid
        $json = json_encode($events);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON Encoding Error: " . json_last_error_msg());
        }

        // Set the response header to JSON
        header('Content-Type: application/json');

        // Output the JSON response
        echo $json;
    }


    // public function getEvents() {
    //     $burialReservationsModel = new BurialReservationsModel();
    //     $eventsArray = $burialReservationsModel->getEvents();

    //     $events = [];
    //     foreach ($eventsArray as $event) {
    //         $middleName = !empty($event["middle_name"]) ? " " . $event["middle_name"] . " " : " ";
    //         $suffix = !empty($event["suffix"]) ? ", " . $event["suffix"] : "";
    //         $fullName = $event["first_name"] . $middleName . $event["last_name"] . $suffix;

    //         $events[] = [
    //             "id" => $event["id"],
    //             "title" => $fullName,
    //             "start" => date('c', strtotime($event["date_time"])), // Convert to ISO 8601
    //             "end" => date('c', strtotime($event["date_time"])),
    //             "status" => $event["status"]
    //         ];
    //     }

    //     // Debugging: Check if JSON is valid
    //     $json = json_encode($events);
    //     if (json_last_error() !== JSON_ERROR_NONE) {
    //         die("JSON Encoding Error: " . json_last_error_msg());
    //     }

    //     header('Content-Type: application/json');
    //     echo $json;        
    // }

    public function markDone()
    {
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
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "An error occurred: " . $e->getMessage()]);
        }
    }
}
