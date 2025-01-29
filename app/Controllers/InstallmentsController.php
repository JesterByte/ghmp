<?php

namespace App\Controllers;

use App\Models\InstallmentsModel;
use App\Core\View;

class InstallmentsController extends BaseController {
    public function index() {
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
            $lotId = $_POST["lot-id"];

            $installmentsModel->setDownPayment($lotId);
            $this->redirectBack();
        }
    }

    public function setMonthlyPayment() {
        $installmentsModel = new InstallmentsModel();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot-id"];

            $installmentsModel->setMonthlyPayment($lotId);
            $installmentsModel->setNextDueDate($lotId);

            $installmentRow = $installmentsModel->getInstallmentByLotId($lotId);
            $installmentId = $installmentRow["id"];
            $totalPaid = $installmentsModel->getPaymentAmountSum($installmentId)["total_paid"];
            $totalAmount = $installmentRow["total_amount"];

            if ($totalPaid >= $totalAmount) {
                $installmentsModel->setCompleteInstallment($installmentId);
                $installmentsModel->setCompleteLotReservation($lotId);
                $reserveeId = $installmentsModel->getReserveeId($lotId)["reservee_id"];
                $installmentsModel->setLotOwnership($lotId, $reserveeId);
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