<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\CashSalesModel;
use App\Core\View;

class CashSalesController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $cashSalesModel = new CashSalesModel();
        $cashSalesTable = $cashSalesModel->getCashSales();
        $reservationsTable = $cashSalesModel->getReservations();

        $data = [
            "pageTitle" => "Cash Sales",
            "usesDataTables" => true,
            "cashSalesTable" => $cashSalesTable,
            "reservationsTable" => $reservationsTable,
            "view" => "cash-sales/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations

        ];

        View::render("templates/layout", $data);
    }

    public function setPayment()
    {
        $cashSalesModel = new CashSalesModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get asset ID
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);

            // Handle file upload
            if (isset($_FILES["receipt"]) && $_FILES["receipt"]["error"] === UPLOAD_ERR_OK) {
                // Define upload directory
                $uploadDir = $_SERVER["DOCUMENT_ROOT"] . BASE_URL . "/uploads/receipts/";

                // Get file details
                $fileTmpPath = $_FILES["receipt"]["tmp_name"];
                $fileName = $_FILES["receipt"]["name"];
                $fileSize = $_FILES["receipt"]["size"];
                $fileType = $_FILES["receipt"]["type"];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Check file extension (optional: allow only specific file types like .jpg, .png, .pdf)
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
                if (!in_array($fileExtension, $allowedExtensions)) {
                    echo "Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed.";
                    return;
                }

                // Generate a unique file name to prevent overwriting
                $newFileName = uniqid() . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;

                // Move the file to the designated directory
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // File successfully uploaded, now save the file name in the database
                    $fileNameInDb = $newFileName;
                } else {
                    echo "There was an error uploading the file.";
                    return;
                }
            } else {
                // If no file is uploaded, set a default value or handle accordingly
                $fileNameInDb = null; // Or handle as needed
            }

            // Process payment based on asset type
            switch ($assetType) {
                case "lot":
                    $cashSalesModel->setPayment($assetId, $fileNameInDb);  // Pass the file name to the model
                    $cashSalesModel->setLotReservation($assetId);
                    $reserveeId = $cashSalesModel->getReserveeId($assetId)["reservee_id"];
                    $cashSalesModel->setLotOwnership($assetId, $reserveeId);
                    break;
                case "estate":
                    $cashSalesModel->setPaymentEstate($assetId, $fileNameInDb);  // Pass the file name to the model
                    $cashSalesModel->setEstateReservation($assetId);
                    $reserveeId = $cashSalesModel->getReserveeIdEstate($assetId)["reservee_id"];
                    $cashSalesModel->setEstateOwnership($assetId, $reserveeId);
                    break;
            }

            // Redirect back
            $this->redirectBack();
        }
    }
}
