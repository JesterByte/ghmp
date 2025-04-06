<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\EstatePricingModel;
use App\Utils\Calculator;
use App\Utils\Formatter;
use App\Core\View;
use App\Helpers\DisplayHelper;

class EstatePricingController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $estatePricingModel = new EstatePricingModel();
        $estatePricingTable = $estatePricingModel->getPricingData();

        $data = [
            "pageTitle" => "Estate Pricing List",
            "usesDataTables" => true,
            "estatePricingTable" => $estatePricingTable,
            "view" => "estate-pricing/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function setPrice()
    {
        $estatePricingModel = new EstatePricingModel();
        $rates = $estatePricingModel->getRates();
        $interestRates = [
            "one_year" => $rates["one_year_interest_rate"],
            "two_years" => $rates["two_years_interest_rate"],
            "three_years" => $rates["three_years_interest_rate"],
            "four_years" => $rates["four_years_interest_rate"],
            "five_years" => $rates["five_years_interest_rate"]
        ];

        $calculator = new Calculator();
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update-pricing-submit"])) {
            $estate = $_POST["estate"];
            $newEstatePrice = $_POST["new-estate-price"];
            $newTotalPurchasePrice = $calculator->getTotalPurchasePrice($newEstatePrice, $rates["vat"], $rates["memorial_care_fee"]);
            $newCashSale = $calculator->getDiscount($newTotalPurchasePrice, $rates["cash_sale_discount"]);
            $newSixMonths = $calculator->getDiscount($newTotalPurchasePrice, $rates["six_months_discount"]);
            $newSixMonthsDownPayment = $calculator->getDownPayment($newSixMonths, $rates["down_payment_rate"]);
            $newSixMonthsBalance = $calculator->getBalance($newSixMonths, $newSixMonthsDownPayment);
            $newSixMonthsMonthlyAmortization = $calculator->getSixMonthsAmortization($newSixMonthsBalance);
            $newDownPayment = $calculator->getDownPayment($newTotalPurchasePrice, $rates["down_payment_rate"]) + $rates["memorial_care_fee"];
            $newBalance = $calculator->getBalance($newTotalPurchasePrice, $newDownPayment);

            $newMonthlyAmortizations = [];
            $year = 1;
            foreach ($interestRates as $term => $interestRate) {
                $newMonthlyAmortizations[$term] = $calculator->getMonthlyAmortization($newBalance, $interestRate, $year);
                $year++;
            }

            $estatePricingModel->updatePrice($estate, $newEstatePrice, $newTotalPurchasePrice, $newCashSale, $newSixMonths, $newSixMonthsDownPayment, $newSixMonthsBalance, $newSixMonthsMonthlyAmortization, $newDownPayment, $newBalance, $newMonthlyAmortizations);

            // $this->redirectBack();
            $this->redirect(BASE_URL . "/estate-pricing", DisplayHelper::$checkIcon, "Pricing has been updated successfully!", "Operation Successful");
        }
    }

    public function setRates()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update-rates-submit"])) {
            $vat = Formatter::formatDecimal($_POST["vat"]);
            $mcf = $_POST["mcf"];
            $downPaymentRate = Formatter::formatDecimal($_POST["down-payment-rate"]);
            $discounts = [
                "cash_sale" => Formatter::formatDecimal($_POST["cash-sale-discount"]),
                "six_months" => Formatter::formatDecimal($_POST["six-months-discount"])
            ];

            $amortizationRates = [
                "one_year" => Formatter::formatDecimal($_POST["one-year-interest-rate"]),
                "two_years" => Formatter::formatDecimal($_POST["two-years-interest-rate"]),
                "three_years" => Formatter::formatDecimal($_POST["three-years-interest-rate"]),
                "four_years" => Formatter::formatDecimal($_POST["four-years-interest-rate"]),
                "five_years" => Formatter::formatDecimal($_POST["five-years-interest-rate"])
            ];

            $estatePricingModel = new EstatePricingModel();
            $estatePricingModel->updateRates($vat, $mcf, $discounts, $downPaymentRate, $amortizationRates);

            $pricingData = $estatePricingModel->getPricingData();

            $calculator = new Calculator();
            foreach ($pricingData as $estate) {
                $estate = $estate["estate"];
                $newEstatePrice = $estate["new-estate-price"];
                $newTotalPurchasePrice = $calculator->getTotalPurchasePrice($newEstatePrice, $vat, $mcf);
                $newCashSale = $calculator->getDiscount($newTotalPurchasePrice, $discounts["cash_sale"]);
                $newSixMonths = $calculator->getDiscount($newTotalPurchasePrice, $discounts["six_months"]);
                $newSixMonthsDownPayment = $calculator->getDownPayment($newSixMonths, $downPaymentRate);
                $newSixMonthsBalance = $calculator->getBalance($newSixMonths, $newSixMonthsDownPayment);
                $newSixMonthsMonthlyAmortization = $calculator->getSixMonthsAmortization($newSixMonthsBalance);
                $newDownPayment = $calculator->getDownPayment($newTotalPurchasePrice, $downPaymentRate);
                $newBalance = $calculator->getBalance($newTotalPurchasePrice, $newDownPayment);
    
                $newMonthlyAmortizations = [];
                $year = 1;
                foreach ($amortizationRates as $term => $interestRate) {
                    $newMonthlyAmortizations[$term] = $calculator->getMonthlyAmortization($newBalance, $interestRate, $year);
                    $year++;
                }
    
                $estatePricingModel->updatePrice($estate, $newEstatePrice, $newTotalPurchasePrice, $newCashSale, $newSixMonths, $newSixMonthsDownPayment, $newSixMonthsBalance, $newSixMonthsMonthlyAmortization, $newDownPayment, $newBalance, $newMonthlyAmortizations);
    
            }

            // $this->redirectBack();
            $this->redirect(BASE_URL . "/estate-pricing", DisplayHelper::$checkIcon, "Rates has been updated successfully!", "Operation Successful");
        }
    }
}
