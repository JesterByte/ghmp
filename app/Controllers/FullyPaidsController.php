<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\FullyPaidsModel;
use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

class FullyPaidsController extends BaseController
{
    // public function index() {
    //     $fullyPaidsModel = new FullyPaidsModel();
    //     $fullyPaidsTable = $fullyPaidsModel->getFullyPaids();

    //     $data = [
    //         "pageTitle" => "Fully Paids",
    //         "usesDataTables" => true,
    //         "fullyPaidsTable" => $fullyPaidsTable,
    //         "view" => "fully-paids/index"
    //     ];

    //     View::render("templates/layout", $data);
    // }

    public function indexCashSale()
    {
        $this->checkSession();

        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaidsCashSale();

        $data = [
            "pageTitle" => "Fully Paids",
            "currentTable" => "Cash Sale",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexSixMonths()
    {
        $this->checkSession();

        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaidsSixMonths();

        $data = [
            "pageTitle" => "Fully Paids",
            "currentTable" => "6 Months",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexInstallment()
    {
        $this->checkSession();

        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaidsInstallment();

        $data = [
            "pageTitle" => "Fully Paids",
            "currentTable" => "Installment",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
        ];

        View::render("templates/layout", $data);
    }

    public function issueCertificate()
    {
        $fullyPaidsModel = new FullyPaidsModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset_id"] ?? null;

            $assetType = Formatter::determineIdType($assetId);

            switch ($assetType) {
                case "lot":
                    $reservationsTable = "lot_reservations";
                    break;
                case "estate":
                    $reservationsTable = "estate_reservations";
            }

            $reservationId = $_POST["reservation_id"] ?? null;
            $certificatePath = null;

            $paymentOption = $_POST["payment_option"];

            switch ($paymentOption) {
                case "Cash Sale":
                    $destination = "cash-sale";
                    break;
                case "6 Months":
                    $destination = "six-months";
                    break;
                case (strpos($paymentOption, "Installment") !== false):
                    $destination = "installments";
                    break;
            }

            // Validate reservation ID
            if (!$reservationId) {
                $this->redirect(BASE_URL . "/fully-paids-$destination", DisplayHelper::$xIcon, "Invalid reservation ID.", "Operation Failed");
                return;
            }

            // Handle file upload
            if (isset($_FILES["certificate"]) && $_FILES["certificate"]["error"] === UPLOAD_ERR_OK) {
                $allowedTypes = ["application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
                $fileType = $_FILES["certificate"]["type"];

                if (in_array($fileType, $allowedTypes)) {
                    $uploadDir = $_SERVER["DOCUMENT_ROOT"] . BASE_URL . "/uploads/certificates/";
                    $fileName = time() . "_" . basename($_FILES["certificate"]["name"]);
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetPath)) {
                        $certificatePath = $fileName; // Store only the file name
                    } else {
                        $this->redirect(BASE_URL . "/fully-paids-$destination", DisplayHelper::$xIcon, "File upload failed.", "Operation Failed");
                        return;
                    }
                } else {
                    $this->redirect(BASE_URL . "/fully-paids-$destination", DisplayHelper::$xIcon, "Invalid file type. Only PDF and DOC are allowed.", "Operation Failed");
                    return;
                }
            } else {
                $this->redirect(BASE_URL . "/fully-paids-$destination", DisplayHelper::$xIcon, "No file uploaded.", "Operation Failed");
                return;
            }

            // Update database with the certificate file
            $data = [
                "reservations_table" => $reservationsTable,
                "id" => $reservationId,
                "certificate" => $certificatePath,
                "issued_at" => date("Y-m-d H:i:s")
            ];

            if ($fullyPaidsModel->saveCertificate($data)) {
                $this->redirect(BASE_URL . "/fully-paids-$destination", DisplayHelper::$checkIcon, "Certificate has been issued.", "Operation Successful");
            } else {
                $this->redirect(BASE_URL . "/fully-paids-$destination", DisplayHelper::$xIcon, "Database update failed.", "Operation Failed");
            }
        }
    }
}
