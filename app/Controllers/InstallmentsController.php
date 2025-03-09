<?php

namespace App\Controllers;

use App\Models\InstallmentsModel;
use App\Core\View;

class InstallmentsController extends BaseController {
    public function index() {
        $this->checkSession();

        $installmentsModel = new InstallmentsModel();
        $installmentsTable = $installmentsModel->getInstallments();
        $pendingDownPayments = $installmentsModel->getPendingDownPayments();
        $ongoingInstallments = $installmentsModel->getOngoingInstallments();

        $data = [
            "pageTitle" => "Installments",
            "usesDataTables" => true,
            "installmentsTable" => $installmentsTable,
            "pendingDownPayments" => $pendingDownPayments,
            "ongoingInstallments" => $ongoingInstallments,
            "view" => "installments/index"
        ];

        View::render("templates/layout", $data);
    }

    public function setDownPayment() {
        $installmentsModel = new InstallmentsModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);

            switch ($assetType) {
                case "lot":
                    $installmentsModel->setDownPayment($assetId);
                    break;
                case "estate":
                    $installmentsModel->setDownPaymentEstate($assetId);
                    break;
            }

            $this->redirectBack();
        }
    }

    public function setMonthlyPayment() {
        $installmentsModel = new InstallmentsModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $assetId = $_POST["asset-id"];
            $assetType = $this->checkAssetId($assetId);

            switch ($assetType) {
                case "lot":
                    $installmentsModel->setMonthlyPayment($assetId);
                    $installmentsModel->setNextDueDate($assetId);
        
                    $installmentRow = $installmentsModel->getInstallmentByLotId($assetId);
                    $installmentId = $installmentRow["id"];
                    $totalPaid = $installmentsModel->getPaymentAmountSum($installmentId)["total_paid"];
                    $totalAmount = $installmentRow["total_amount"];
        
                    if ($totalPaid >= $totalAmount) {
                        $installmentsModel->setCompleteInstallment($installmentId);
                        $installmentsModel->setLotReservation($assetId);
                        $reserveeId = $installmentsModel->getReserveeId($assetId)["reservee_id"];
                        $installmentsModel->setLotOwnership($assetId, $reserveeId);
                    }
                    break;
                case "estate":
                    $installmentsModel->setMonthlyPaymentEstate($assetId);
                    $installmentsModel->setNextDueDateEstate($assetId);
        
                    $installmentRow = $installmentsModel->getInstallmentByEstateId($assetId);
                    $installmentId = $installmentRow["id"];
                    $totalPaid = $installmentsModel->getPaymentAmountSumEstate($installmentId)["total_paid"];
                    $totalAmount = $installmentRow["total_amount"];
        
                    if ($totalPaid >= $totalAmount) {
                        $installmentsModel->setCompleteInstallmentEstate($installmentId);
                        $installmentsModel->setEstateReservation($assetId);
                        $reserveeId = $installmentsModel->getReserveeIdEstate($assetId)["reservee_id"];
                        $installmentsModel->setEstateOwnership($assetId, $reserveeId);
                    }
                    break;
            }
            $this->redirectBack();
        }
    }

    // public function setPayment() {
    //     $cashSalesModel = new InstallmentsModel();
        
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $lotId = $_POST["lot-id"];

    //         $cashSalesModel->setPayment($lotId);
    //         $cashSalesModel->setLotReservation($lotId);

    //         $this->redirectBack();
    //     }
    // }
}