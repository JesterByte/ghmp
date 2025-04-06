<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\BurialReservationsModel;
use App\Models\DeceasedModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Models\CustomersModel;
use Exception;
use Random\BrokenRandomEngineError;
use App\Helpers\EmailHelper;
use App\Models\CustomerNotificationModel;

class BurialReservationsController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $burialReservationsModel = new BurialReservationsModel();
        $burialReservationRequests = $burialReservationsModel->getBurialReservationRequestsBadge();
        $ownedAssets = $burialReservationsModel->getOwnedAssets("Sold");

        $formattedOwners = [];
        foreach ($ownedAssets as $row) {
            $middleName = !empty($row["middle_name"]) ? " " . $row["middle_name"] . " " : " ";
            $suffix = !empty($row["suffix_name"]) ? ", " . $row["suffix_name"] : "";
            $row["customer"] = $row["first_name"] . $middleName . $row["last_name"] . $suffix;

            $formattedOwners[] = $row;
        }

        $data = [
            "pageTitle" => "Burial Reservations",
            "burialReservationRequests" => $burialReservationRequests,
            "view" => "burial-reservations/index",
            "formattedOwners" => $formattedOwners,

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function getAssets($customerId)
    {
        $burialReservationsModel = new BurialReservationsModel();
        $assets = $burialReservationsModel->getOwnedAssetsByCustomer($customerId);

        // Return the assets or an empty array if no assets are found
        echo json_encode($assets ?: []); // If $assets is empty, an empty array is returned
    }


    public function getBurialTypes($assetType)
    {
        $burialTypes = [];
        $burialReservationsModel = new BurialReservationsModel();

        $burialTypes = $burialReservationsModel->getBurialTypes($assetType);

        header('Content-Type: application/json');
        echo json_encode($burialTypes);
    }

    public function setReservation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate form data (simplified here)
            if (
                empty($_POST['customer']) ||
                empty($_POST['relationship']) ||
                empty($_POST['first_name']) ||
                empty($_POST['last_name']) ||
                empty($_POST['date_of_birth']) ||
                empty($_POST['date_of_death']) ||
                empty($_POST['obituary']) ||
                empty($_POST['burial_type']) ||
                empty($_POST['datetime']) ||
                empty($_POST['burial_price']) ||
                empty($_FILES["receipt"]) ||
                empty($_POST['asset'])
            ) {
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$xIcon, "Please fill in all required fields.", "Validation Error");
                return;
            }

            // Handle "Other" relationship field
            if ($_POST["relationship"] === "Other") {
                $_POST["relationship"] = ucwords(trim($_POST["other_relationship"]));
            }

            // Prepare form data with trimmed and formatted values
            $reservationData = [
                'reservee_id'    => trim($_POST['customer']),
                'asset_id'       => $_POST["asset"],
                'burial_type'    => trim($_POST['burial_type']),
                'relationship'   => ucwords(trim($_POST['relationship'])),
                'first_name'     => ucwords(trim($_POST['first_name'])),
                'middle_name'    => isset($_POST['middle_name']) ? ucwords(trim($_POST['middle_name'])) : "",
                'last_name'      => ucwords(trim($_POST['last_name'])),
                'suffix'         => isset($_POST['suffix']) ? trim($_POST['suffix']) : "",
                'date_of_birth'  => trim($_POST['date_of_birth']),
                'date_of_death'  => trim($_POST['date_of_death']),
                'obituary'       => ucfirst(trim($_POST['obituary'])),
                'date_time'      => trim($_POST['datetime']),
                'status'         => "Approved",
                'payment_amount' => trim($_POST['burial_price']),
                'payment_status' => "Paid"
            ];

            // Handle file upload for receipt
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/ghmp/public/uploads/receipts/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName  = $_FILES['receipt']['name'];
            $fileTmp   = $_FILES['receipt']['tmp_name'];
            $fileSize  = $_FILES['receipt']['size'];
            $fileError = $_FILES['receipt']['error'];

            // Check for upload errors
            if ($fileError !== UPLOAD_ERR_OK) {
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$xIcon, "Error uploading file.", "Upload Error");
                return;
            }

            // Validate file size and type (max size 5MB)
            $allowedTypes = ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            if (!in_array($fileExt, $allowedTypes)) {
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$xIcon, "Invalid file type. Please upload a valid receipt format (PNG, JPG, etc.).", "Upload Error");
                return;
            }

            if ($fileSize > 5000000) { // 5MB max size
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$xIcon, "File size exceeds 5MB. Please upload a smaller file.", "Upload Error");
                return;
            }

            // Move file to the uploads directory
            $filename = "receipt_" . uniqid() . "." . $fileExt;
            $destination = $uploadDir . $filename;

            if (!move_uploaded_file($fileTmp, $destination)) {
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$xIcon, "Failed to move the uploaded file.", "Upload Error");
                return;
            }

            // Store only the filename in the database
            $reservationData['receipt_path'] = $filename;

            $burialReservationsModel = new BurialReservationsModel();
            // Insert reservation data into the database
            $result = $burialReservationsModel->setReservation($reservationData);

            if ($result) {
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$checkIcon, "Burial reservation added successfully.", "Operation Successful");
            } else {
                $this->redirect(BASE_URL . "/burial-reservations", DisplayHelper::$xIcon, "Failed to add reservation.", "Operation Failed");
            }
        }
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
                    "payment_status" => $event["payment_status"],
                    "asset_id" => $assetId,
                    "receipt_path" => $event["receipt_path"]
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

            $deceasedMiddleName = !empty($reservation["middle_name"]) ? " " . $reservation["middle_name"] . " " : " ";
            $deceasedSuffix = !empty($reservation["suffix"]) ? ", " . $reservation["suffix"] : "";
            $deceasedFullName = $reservation["first_name"] . $deceasedMiddleName . $reservation["last_name"] . $deceasedSuffix;

            $deceasedModel = new DeceasedModel();
            $newDeceased = [
                "customer_id" => $reservation["reservee_id"],
                "full_name" => $deceasedFullName,
                "first_name" => $reservation["first_name"],
                "middle_name" => $reservation["middle_name"],
                "last_name" => $reservation["last_name"],
                "suffix" => $reservation["suffix"],
                "obituary" => $reservation["obituary"],
                "birth_date" => $reservation["date_of_birth"],
                "death_date" => $reservation["date_of_death"],
                "burial_date" => $reservation["date_time"],
                "location" => $reservation["asset_id"]
            ];
            $isInserted = $deceasedModel->setDeceased($newDeceased);

            if ($result && $isInserted) {
                $customerNotificationModel = new CustomerNotificationModel();
                $customerNotificationModel->setNotification(
                    $reservation["reservee_id"],
                    "The administrator has marked your burial reservation for {$deceasedFullName} as completed.",
                    "my_memorial_services"
                );

                $customerModel = new CustomersModel();
                $customer = $customerModel->getCustomerById($reservation["reservee_id"]);
                $customerEmail = $customer["email_address"];

                $emailBody = '
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                        <h2 style="color: #333; text-align: center;">Burial Reservation Completed</h2>
                        <p>Dear <strong>' . htmlspecialchars($customer["first_name"]) . '</strong>,</p>

                        <p>We would like to inform you that the burial reservation for 
                        <strong style="color: #1d3557;">' . htmlspecialchars($deceasedFullName) . '</strong> 
                        has been <strong style="color: #28a745;">successfully completed</strong>.</p>

                        <p>We offer our deepest condolences during this time and hope our services have been of help and comfort to you.</p>

                        <p>If you have any questions or need assistance, please feel free to reach out to us.</p>

                        <hr style="border: 0; height: 1px; background: #ddd; margin: 30px 0;">

                        <p style="text-align: center; font-size: 12px; color: #777;">
                            This is an automated message. Please do not reply directly to this email.<br>
                            &copy; ' . date("Y") . ' Green Haven Memorial Park. All rights reserved.
                        </p>
                    </div>
                ';


                // Send notification to the customer
                $emailHelper = new EmailHelper();
                $emailHelper->sendEmail(
                    $customerEmail,
                    "Burial Reservation Completed",
                    $emailBody
                );

                echo json_encode([
                    "success" => true,
                    "message" => "Reservation marked as completed successfully!",
                    "icon" => DisplayHelper::$checkIcon,
                    "title" => "Operation Successful"
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update reservation.", "debug" => print_r($newDeceased, true)]);
            }
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "An error occurred: " . $e->getMessage()]);
        }
    }
}
