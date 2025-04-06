<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\EstateReservationRequestsModel;
use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Helpers\EmailHelper;
use App\Models\CustomersModel;
use App\Models\CustomerNotificationModel;

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
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
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
            $customerModel = new CustomersModel();
            $customerNotificationModel = new CustomerNotificationModel();
            $emailHelper = new EmailHelper();

            // Get customer details
            $customer = $customerModel->getCustomerById($reserveeId);
            $customerEmail = $customer["email_address"];
            $customerName = $customer["first_name"];

            switch ($status) {
                case "Confirmed":
                    $estateReservationRequestsModel->approveEstateReservation($estateId, $reserveeId);
                    $message = "The estate reservation has been approved successfully!";
                    $notificationMessage = "Your estate reservation for Estate #$estateId has been approved.";
                    $emailSubject = "Estate Reservation Approved";
                    $emailBody = '
                        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                            <h2 style="color: #333; text-align: center;">Estate Reservation Approved</h2>
                            <p>Dear <strong>' . htmlspecialchars($customerName) . '</strong>,</p>
                            <p>Your reservation for <strong>Estate #' . htmlspecialchars($estateId) . '</strong> has been <strong style="color: #28a745;">Approved</strong>.</p>
                            <p>Thank you for choosing our service. If you have any questions, feel free to contact us.</p>
                            <hr style="border: 0; height: 1px; background: #ddd;">
                            <p style="text-align: center; font-size: 12px; color: #777;">This is an automated email. Please do not reply.</p>
                        </div>
                    ';
                    break;

                case "Cancelled":
                    $estateReservationRequestsModel->cancelEstateReservation($estateId, $reserveeId);
                    $estateReservationRequestsModel->setEstateStatus($estateId, "Available");
                    $message = "The estate reservation has been cancelled successfully!";
                    $notificationMessage = "Your estate reservation for Estate #$estateId has been cancelled.";
                    $emailSubject = "Estate Reservation Cancelled";
                    $emailBody = '
                        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                            <h2 style="color: #333; text-align: center;">Estate Reservation Cancelled</h2>
                            <p>Dear <strong>' . htmlspecialchars($customerName) . '</strong>,</p>
                            <p>We regret to inform you that your reservation for <strong>Estate #' . htmlspecialchars($estateId) . '</strong> has been <strong style="color: #dc3545;">Cancelled</strong>.</p>
                            <p>If you believe this is a mistake or have any concerns, please contact us.</p>
                            <hr style="border: 0; height: 1px; background: #ddd;">
                            <p style="text-align: center; font-size: 12px; color: #777;">This is an automated email. Please do not reply.</p>
                        </div>
                    ';
                    break;
            }

            // Send Notification
            $customerNotificationModel->setNotification($reserveeId, $notificationMessage, "my_lots_and_estates");

            // Send Email
            $emailHelper->sendEmail($customerEmail, $emailSubject, $emailBody, true);

            // Redirect with success message
            $this->redirect(BASE_URL . "/estate-reservation-requests", DisplayHelper::$checkIcon, $message, "Operation Successful");
        }
    }
}
