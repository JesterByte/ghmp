<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\LotReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;

class LotReservationsController extends BaseController {
    // public function index() {
    //     $lotReservationsModel = new LotReservationsModel();
    //     $lotReservationsTable = $lotReservationsModel->getLotReservations();
    //     $availableLots = $lotReservationsModel->getAvailableLots();
    //     $customers = $lotReservationsModel->getCustomers();

    //     $data = [
    //         "pageTitle" => "Lot Reservations",
    //         "usesDataTables" => true,
    //         "lotReservationsTable" => $lotReservationsTable,
    //         "availableLots" => $availableLots,
    //         "customers" => $customers,
    //         "view" => "lot-reservations/index"
    //     ];

    //     View::render("templates/layout", $data);
    // }

    public function indexCashSale() {
        $this->checkSession();
    
        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getCashSaleLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cash Sale",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "view" => "lot-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexSixMonths() {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getSixMonthsLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "6 Months",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "view" => "lot-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexInstallments() {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getInstallmentLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Installment",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "view" => "lot-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexCancelled() {
        $this->checkSession();

        $lotReservationsModel = new LotReservationsModel();
        $lotReservationsTable = $lotReservationsModel->getCancelledLotReservations();
        $availableLots = $lotReservationsModel->getAvailableLots();
        $customers = $lotReservationsModel->getCustomers();
        $lotReservationRequests = $lotReservationsModel->getReservationRequestsBadge();

        $data = [
            "pageTitle" => "Lot Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cancelled",
            "lotReservationsTable" => $lotReservationsTable,
            "availableLots" => $availableLots,
            "customers" => $customers,
            "lotReservationRequests" => $lotReservationRequests,
            "view" => "lot-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function setReservation() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotReservationsModel = new LotReservationsModel();
            $lotId = $_POST['lot'];
            $reserveeId = $_POST['customer'];
            $phase = Formatter::extractPhase($_POST['lot']);
            $lotType = $_POST['lot-type'];
            $paymentOption = $_POST['payment-option'];
            
            $pricing = $lotReservationsModel->getPricing("Phase " . $phase, $lotType);

            $lotReservationsModel->setReservation($lotId, $reserveeId, $lotType, $paymentOption);
            $calculator = new Calculator();
            $downPaymentDueDate = $this->setDownPaymentDueDate();
            switch ($paymentOption) {
                case "Cash Sale":
                    $paymentAmount = $pricing['cash_sale'];
                    $lotReservationsModel->setCashSalePayment($lotId, $paymentAmount);
                    $lotReservationsModel->setCashSaleDueDate($lotId);
                    break;
                case "6 Months":
                    $paymentAmount = $pricing['six_months'];
                    $lotReservationsModel->setSixMonthsPayment($lotId, $paymentAmount);
                    $lotReservationsModel->setSixMonthsDueDate($lotId);
                    break;
                case "Installment: 1 Year":
                    $termYears = 1;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_one_year"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_one_year"];
                    $lotReservationsModel->setInstallmentPayment($lotId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["one_year_interest_rate"], "Pending");
                    break;
                case "Installment: 2 Years":
                    $termYears = 2;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_two_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_two_years"];
                    $lotReservationsModel->setInstallmentPayment($lotId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["two_years_interest_rate"], "Pending");
                    break;
                case "Installment: 3 Years":
                    $termYears = 3;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_three_years"];
                    $lotReservationsModel->setInstallmentPayment($lotId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["three_years_interest_rate"], "Pending");
                    break;
                case "Installment: 4 Years":
                    $termYears = 4;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_four_years"];
                    $lotReservationsModel->setInstallmentPayment($lotId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["four_years_interest_rate"], "Pending");
                    break;
                case "Installment: 5 Years":
                    $termYears = 5;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_five_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_five_years"];
                    $lotReservationsModel->setInstallmentPayment($lotId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["five_years_interest_rate"], "Pending");
                    break;
            }
            $lotReservationsModel->setLotStatus($lotId);
    
            $this->redirectBack();    
        }
    }

    public function setDownPaymentDueDate() {
        return date("Y-m-d", strtotime("+30 days"));
    }

}