<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\EstateReservationsModel;
use App\Utils\Formatter;
use App\Utils\Calculator;
use App\Core\View;

class EstateReservationsController extends BaseController {
    // public function index() {
    //     $estatetReservationsModel = new EstateReservationsModel();
    //     $lotReservationsTable = $estatetReservationsModel->getLotReservations();
    //     $availableEstates = $estatetReservationsModel->getAvailableEstates();
    //     $customers = $estatetReservationsModel->getCustomers();

    //     $data = [
    //         "pageTitle" => "Estate Reservations",
    //         "usesDataTables" => true,
    //         "lotReservationsTable" => $lotReservationsTable,
    //         "availableEstates" => $availableEstates,
    //         "customers" => $customers,
    //         "view" => "lot-reservations/index"
    //     ];

    //     View::render("templates/layout", $data);
    // }

    public function indexCashSale() {
        $this->checkSession();

        $estatetReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estatetReservationsModel->getCashSaleEstateReservations();
        $availableEstates = $estatetReservationsModel->getAvailableEstates();
        $customers = $estatetReservationsModel->getCustomers();
        $estateReservationRequests = $estatetReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "Cash Sale",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "view" => "estate-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexSixMonths() {
        $this->checkSession();

        $estatetReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estatetReservationsModel->getSixMonthsEstateReservations();
        $availableEstates = $estatetReservationsModel->getAvailableEstates();
        $customers = $estatetReservationsModel->getCustomers();
        $estateReservationRequests = $estatetReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "6 Months",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "view" => "estate-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function indexInstallments() {
        $this->checkSession();

        $estatetReservationsModel = new EstateReservationsModel();
        $estateReservationsTable = $estatetReservationsModel->getInstallmentEstateReservations();
        $availableEstates = $estatetReservationsModel->getAvailableEstates();
        $customers = $estatetReservationsModel->getCustomers();
        $estateReservationRequests = $estatetReservationsModel->getEstateReservationRequestsBadge();

        $data = [
            "pageTitle" => "Estate Reservations",
            "usesDataTables" => true,
            "currentTable" => "Installment",
            "estateReservationsTable" => $estateReservationsTable,
            "availableEstates" => $availableEstates,
            "customers" => $customers,
            "estateReservationRequests" => $estateReservationRequests,
            "view" => "estate-reservations/index",

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations
        ];

        View::render("templates/layout", $data);
    }

    public function setReservation() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $estatetReservationsModel = new EstateReservationsModel();
            $estateId = $_POST['estate'];
            $reserveeId = $_POST['customer'];
            $estateType = Formatter::extractEstateType($_POST['estate']);
            $paymentOption = $_POST['payment-option'];
            
            $pricing = $estatetReservationsModel->getPricing( "Estate " . $estateType);

            $estatetReservationsModel->setReservation($estateId, $reserveeId, $estateType, $paymentOption);
            $calculator = new Calculator();
            $downPaymentDueDate = $this->setDownPaymentDueDate();
            switch ($paymentOption) {
                case "Cash Sale":
                    $paymentAmount = $pricing['cash_sale'];
                    $estatetReservationsModel->setCashSalePayment($estateId, $paymentAmount);
                    $estatetReservationsModel->setCashSaleDueDate($estateId);
                    break;
                case "6 Months":
                    $paymentAmount = $pricing['six_months'];
                    $estatetReservationsModel->setSixMonthsPayment($estateId, $paymentAmount);
                    $estatetReservationsModel->setSixMonthsDueDate($estateId);
                    break;
                case "Installment: 1 Year":
                    $termYears = 1;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_one_year"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_one_year"];
                    $estatetReservationsModel->setInstallmentPayment($estateId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["one_year_interest_rate"], "Pending");
                    break;
                case "Installment: 2 Years":
                    $termYears = 2;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_two_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_two_years"];
                    $estatetReservationsModel->setInstallmentPayment($estateId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["two_years_interest_rate"], "Pending");
                    break;
                case "Installment: 3 Years":
                    $termYears = 3;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_three_years"];
                    $estatetReservationsModel->setInstallmentPayment($estateId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["three_years_interest_rate"], "Pending");
                    break;
                case "Installment: 4 Years":
                    $termYears = 4;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_four_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_four_years"];
                    $estatetReservationsModel->setInstallmentPayment($estateId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["four_years_interest_rate"], "Pending");
                    break;
                case "Installment: 5 Years":
                    $termYears = 5;
                    $downPayment = $pricing["down_payment"];
                    $totalAmount = $calculator->getFinalBalance($pricing["monthly_amortization_five_years"], $termYears);
                    $paymentAmount = $pricing["monthly_amortization_five_years"];
                    $estatetReservationsModel->setInstallmentPayment($estateId, $termYears, $downPayment, "Pending", $downPaymentDueDate, $totalAmount, $paymentAmount, $pricing["five_years_interest_rate"], "Pending");
                    break;
            }
            $estatetReservationsModel->setEstateStatus($estateId);
    
            $this->redirectBack();    
        }
    }

    public function setDownPaymentDueDate() {
        return date("Y-m-d", strtotime("+30 days"));
    }

}