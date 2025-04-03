<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\PhasePricingModel;
use App\Utils\Calculator;
use App\Utils\Formatter;
use App\Core\View;
use App\Helpers\DisplayHelper;

class PhasePricingController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $phasePricingModel = new PhasePricingModel();
        $phasePricingTable = $phasePricingModel->getPricingData();
        $data = [
            "pageTitle" => "Phase Pricing List",
            "usesDataTables" => true,
            "phasePricingTable" => $phasePricingTable,
            "view" => "phase-pricing/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
        ];

        View::render("templates/layout", $data);
    }

    public function setPrice()
    {
        $phasePricingModel = new PhasePricingModel();
        $rates = $phasePricingModel->getRates();
        $interestRates = [
            "one_year" => $rates["one_year_interest_rate"],
            "two_years" => $rates["two_years_interest_rate"],
            "three_years" => $rates["three_years_interest_rate"],
            "four_years" => $rates["four_years_interest_rate"],
            "five_years" => $rates["five_years_interest_rate"]
        ];

        $calculator = new Calculator();
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update-pricing-submit"])) {
            $phase = $_POST["phase"];
            $lotType = $_POST["lot-type"];
            $newLotPrice = $_POST["new-lot-price"];
            $newTotalPurchasePrice = $calculator->getTotalPurchasePrice($newLotPrice, $rates["vat"], $rates["memorial_care_fee"]);
            $newCashSale = $calculator->getDiscount($newTotalPurchasePrice, $rates["cash_sale_discount"]);
            $newSixMonths = $calculator->getDiscount($newTotalPurchasePrice, $rates["six_months_discount"]);
            $newSixMonthsDownPayment = $calculator->getDownPayment($newSixMonths, $rates["down_payment_rate"]);
            $newSixMonthsBalance = $calculator->getBalance($newSixMonths, $newSixMonthsDownPayment);
            $newSixMonthsMonthlyAmortization = $calculator->getSixMonthsAmortization($newSixMonthsBalance);
            $newDownPayment = $calculator->getDownPayment($newTotalPurchasePrice, $rates["down_payment_rate"]);
            $newBalance = $calculator->getBalance($newTotalPurchasePrice, $newDownPayment);

            $newMonthlyAmortizations = [];
            $year = 1;
            foreach ($interestRates as $term => $interestRate) {
                $newMonthlyAmortizations[$term] = $calculator->getMonthlyAmortization($newBalance, $interestRate, $year);
                $year++;
            }

            $phasePricingModel->updatePrice($phase, $lotType, $newLotPrice, $newTotalPurchasePrice, $newCashSale, $newSixMonths, $newSixMonthsDownPayment, $newSixMonthsBalance, $newSixMonthsMonthlyAmortization, $newDownPayment, $newBalance, $newMonthlyAmortizations);

            // $this->redirectBack();
            $this->redirect(BASE_URL . "/phase-pricing", DisplayHelper::$checkIcon, "Pricing has been updated successfully!", "Operation Successful");
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

            $phasePricingModel = new PhasePricingModel();
            $phasePricingModel->updateRates($vat, $mcf, $discounts, $downPaymentRate, $amortizationRates);

            $phasePricing = $phasePricingModel->getPricingData();

            $calculator = new Calculator();
            // Loop through each lot and recalculate prices
            foreach ($phasePricing as $lot) {
                $phase = $lot["phase"];
                $lotType = $lot["lot_type"];
                $lotPrice = $lot["lot_price"];

                // Recalculate prices using the updated rates
                $totalPurchasePrice = $calculator->getTotalPurchasePrice($lotPrice, $vat, $mcf);
                $cashSale = $calculator->getDiscount($totalPurchasePrice, $discounts["cash_sale"]);
                $sixMonths = $calculator->getDiscount($totalPurchasePrice, $discounts["six_months"]);
                $sixMonthsDownPayment = $calculator->getDownPayment($sixMonths, $downPaymentRate);
                $sixMonthsBalance = $calculator->getBalance($sixMonths, $sixMonthsDownPayment);
                $sixMonthsMonthlyAmortization = $calculator->getSixMonthsAmortization($sixMonthsBalance);
                $downPayment = $calculator->getDownPayment($totalPurchasePrice, $downPaymentRate);
                $balance = $calculator->getBalance($totalPurchasePrice, $downPayment);

                // Calculate new installment prices for different terms
                $newMonthlyAmortizations = [];
                $year = 1;
                foreach ($amortizationRates as $term => $interestRate) {
                    $newMonthlyAmortizations[$term] = $calculator->getMonthlyAmortization($balance, $interestRate, $year);
                    $year++;
                }

                // Update the database with new prices
                $phasePricingModel->updatePrice(
                    $phase,
                    $lotType,
                    $lotPrice,
                    $totalPurchasePrice,
                    $cashSale,
                    $sixMonths,
                    $sixMonthsDownPayment,
                    $sixMonthsBalance,
                    $sixMonthsMonthlyAmortization,
                    $downPayment,
                    $balance,
                    $newMonthlyAmortizations
                );
            }

            // $this->redirectBack();
            $this->redirect(BASE_URL . "/phase-pricing", DisplayHelper::$checkIcon, "Rates has been updated successfully!", "Operation Successful");
        }
    }
}
