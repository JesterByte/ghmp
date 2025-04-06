<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\CustomerNotificationModel;
use App\Models\LotReservationRequestsModel;
use App\Core\View;

use App\Utils\Encryption;
use App\Helpers\DisplayHelper;
use App\Models\LotReservationsModel;
use App\Models\CustomersModel;
use App\Helpers\EmailHelper;

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

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function verifyLotType($lotId, $reserveeId)
    {
        $lotId = Encryption::decrypt($lotId, $this->secretKey);
        $reserveeId = Encryption::decrypt($reserveeId, $this->secretKey);

        $lotReservationRequestsModel = new LotReservationRequestsModel();
        $lot = $lotReservationRequestsModel->getCoordinatesByLotId($lotId);

        $data = [
            "pageTitle" => "Verify Lot Type",
            "usesDataTables" => false,
            "lot" => $lot,
            "reserveeId" => $reserveeId,
            "view" => "verify-lot-type/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function setLotType()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot-id"];
            $reserveeId = $_POST["reservee-id"];
            $lotType = $_POST["lot-type"];

            $lotReservationRequestsModel = new LotReservationRequestsModel();
            $lotReservationRequestsModel->setLotType($lotId, $lotType);

            // Send Notification
            $customerNotificationModel = new CustomerNotificationModel();
            $notificationMessage = "Your lot reservation for Lot #$lotId ($lotType) has been approved by the administrator.";
            $customerNotificationModel->setNotification($reserveeId, $notificationMessage, "my_lots_and_estates");

            // Send Email
            $customerModel = new CustomersModel();
            $customer = $customerModel->getCustomerById($reserveeId);
            $customerEmail = $customer["email_address"];
            $customerName = $customer["first_name"];

            $emailSubject = "Your Lot Reservation Has Been Approved";
            $emailBody = '
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                    <h2 style="color: #333; text-align: center;">Lot Reservation Approved</h2>
                    <p>Dear <strong>' . htmlspecialchars($customerName) . '</strong>,</p>
                    <p>Your reservation for <strong>Lot #' . htmlspecialchars($lotId) . ' (' . htmlspecialchars($lotType) . ')</strong> has been <strong style="color: #28a745;">Approved</strong>.</p>
                    <p>Lot Type: <strong>' . htmlspecialchars($lotType) . '</strong></p>
                    <p>Thank you for choosing our service. If you have any questions, feel free to contact us.</p>
                    <hr style="border: 0; height: 1px; background: #ddd;">
                    <p style="text-align: center; font-size: 12px; color: #777;">This is an automated email. Please do not reply.</p>
                </div>
            ';

            $emailHelper = new EmailHelper();
            $emailHelper->sendEmail($customerEmail, $emailSubject, $emailBody, true);

            // Redirect with success message
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

            // $lotReservationsModel = new LotReservationsModel();
            // $lotReservationsModel->cancelLotReservation($lotId, $reserveeId);

            // Send Notification
            $customerNotificationModel = new CustomerNotificationModel();
            $notificationMessage = "Your lot reservation for Lot #$lotId has been cancelled by the administrator.";
            $customerNotificationModel->setNotification($reserveeId, $notificationMessage, "my_lots_and_estates");

            // Send Email
            $customerModel = new CustomersModel();
            $customer = $customerModel->getCustomerById($reserveeId);
            $customerEmail = $customer["email_address"];
            $customerName = $customer["first_name"];

            $emailSubject = "Your Lot Reservation Has Been Cancelled";
            $emailBody = '
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                    <h2 style="color: #333; text-align: center;">Lot Reservation Cancelled</h2>
                    <p>Dear <strong>' . htmlspecialchars($customerName) . '</strong>,</p>
                    <p>Unfortunately, your reservation for Lot #<strong>' . htmlspecialchars($lotId) . '</strong> has been <strong style="color: #dc3545;">Cancelled</strong>.</p>
                    <p>If you have any concerns, please contact our support team.</p>
                    <hr style="border: 0; height: 1px; background: #ddd;">
                    <p style="text-align: center; font-size: 12px; color: #777;">This is an automated email. Please do not reply.</p>
                </div>
            ';

            $emailHelper = new EmailHelper();
            $emailHelper->sendEmail($customerEmail, $emailSubject, $emailBody, true);

            // Redirect with success message
            $this->redirect(BASE_URL . "/lot-reservation-requests", DisplayHelper::$checkIcon, "The lot reservation has been cancelled.", "Operation Successful");
        }
    }
}
