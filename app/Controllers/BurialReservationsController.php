<?php

namespace App\Controllers;

use App\Models\BurialReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;

class BurialReservationsController extends BaseController {
    public function index() {

        $data = [
            "pageTitle" => "Burial Reservations",
            "view" => "burial-reservations/index"
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
                "title" => $fullName,
                "start" => date('c', strtotime($event["date_time"])), // Convert to ISO 8601
                "end" => date('c', strtotime($event["date_time"]))
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
}