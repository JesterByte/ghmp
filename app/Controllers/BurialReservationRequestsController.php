<?php

namespace App\Controllers;

use App\Helpers\EmailHelper;
use App\Models\BadgeModel;
use App\Models\BurialReservationsModel;
use App\Models\CustomerNotificationModel;
use App\Models\CustomersModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;
use App\Helpers\DisplayHelper;

class BurialReservationRequestsController extends BaseController
{
    public function index()
    {
        $burialReservationsModel = new BurialReservationsModel();
        $burialReservationRequestsTable = $burialReservationsModel->getBurialReservationRequests();

        $data = [
            "pageTitle" => "Burial Reservation Requests",
            "usesDataTables" => true,
            "burialReservationRequestsTable" => $burialReservationRequestsTable,
            "view" => "burial-reservation-requests/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function submitBurialReservationConfirmation()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $burialReservationId = $_POST["burial_reservation_id"];
            $status = $_POST["action"] == "approve" ? "Approved" : "Cancelled";

            $burialReservationsModel = new BurialReservationsModel();
            $burialReservationsModel->updateStatusById($burialReservationId, $status);

            $burialReservation = $burialReservationsModel->findById($burialReservationId);

            switch ($status) {
                case "Approved":
                    $toastIcon = DisplayHelper::$checkIcon;
                    $message = "Burial reservation has been approved.";
                    $notificationMessage = "The administrator has approved your burial reservation for {$burialReservation["asset_id"]}.";
                    $emailSubject = "Your Burial Reservation Has Been Approved";
                    break;
                case "Cancelled":
                    $toastIcon = DisplayHelper::$warningIcon;
                    $message = "Burial reservation has been cancelled.";
                    $notificationMessage = "The administrator has cancelled your burial reservation for {$burialReservation["asset_id"]}.";
                    $emailSubject = "Your Burial Reservation Has Been Cancelled";
                    break;
            }

            // Get customer info
            $customerId = $burialReservation["reservee_id"];

            $customerNotificationModel = new CustomerNotificationModel();
            $customerNotificationModel->setNotification($customerId, $notificationMessage, "my_memorial_services");

            $customerModel = new CustomersModel();
            $customer = $customerModel->getCustomerById($customerId);
            $customerEmail = $customer["email_address"];
            $customerName = $customer["first_name"];

            // Inline HTML Email Body
            $emailBody = '
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                    <h2 style="color: #333; text-align: center;">Burial Reservation Status</h2>
                    <p>Dear <strong>' . htmlspecialchars($customerName) . '</strong>,</p>
                    <p>Your burial reservation for ' . $burialReservation["asset_id"] . ' has been <strong style="color: ' . ($status === "Approved" ? "#28a745" : "#dc3545") . ';">' . $status . '</strong>.</p>
                    <p>Thank you for using our services. If you have any questions, feel free to contact us.</p>
                    <hr style="border: 0; height: 1px; background: #ddd;">
                    <p style="text-align: center; font-size: 12px; color: #777;">This is an automated email. Please do not reply.</p>
                </div>
            ';

            // Send Email
            $emailHelper = new EmailHelper();
            $emailHelper->sendEmail($customerEmail, $emailSubject, $emailBody, true);

            $this->redirect(BASE_URL . "/burial-reservation-requests", $toastIcon, $message, "Operation Successful");
        }
    }
}
