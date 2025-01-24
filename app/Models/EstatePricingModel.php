<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class EstatePricingModel extends Model {
    public function getPricingData() {
        $stmt = $this->db->prepare("SELECT * FROM estate_pricing");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRates() {
        $stmt = $this->db->prepare("SELECT vat, memorial_care_fee, cash_sale_discount, six_months_discount, down_payment_rate, one_year_interest_rate, two_years_interest_rate, three_years_interest_rate, four_years_interest_rate, five_years_interest_rate FROM estate_pricing LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePrice($estate, $newLotPrice, $newTotalPurchasePrice, $newCashSale, $newSixMonths, $newDownPayment, $newBalance, $newMonthlyAmortizations) {
        $amortizationPlaceholders = "";
        $amortizationBindings = [];
        foreach ($newMonthlyAmortizations as $term => $amortization) {
            $placeholder = ":new_monthly_amortization_{$term}";
            $amortizationPlaceholders .= "monthly_amortization_{$term} = {$placeholder}, ";
            $amortizationBindings[$placeholder] = $amortization;
        }

        $amortizationPlaceholders = rtrim($amortizationPlaceholders, ", ");


        $stmt = $this->db->prepare("UPDATE estate_pricing 
        SET 
            lot_price = :new_lot_price,
            total_purchase_price = :new_total_purchase_price, 
            cash_sale = :new_cash_sale,
            six_months = :new_six_months,
            down_payment = :new_down_payment,
            balance = :new_balance,
            {$amortizationPlaceholders}
        WHERE estate = :estate
        ");
        $stmt->bindParam(":new_lot_price", $newLotPrice, PDO::PARAM_STR);
        $stmt->bindParam(":new_total_purchase_price", $newTotalPurchasePrice, PDO::PARAM_STR);
        $stmt->bindParam(":new_cash_sale", $newCashSale, PDO::PARAM_STR);
        $stmt->bindParam(":new_six_months", $newSixMonths, PDO::PARAM_STR);
        $stmt->bindParam(":new_down_payment", $newDownPayment, PDO::PARAM_STR);
        $stmt->bindParam(":new_balance", $newBalance, PDO::PARAM_STR);
        $stmt->bindParam(":estate", $estate, PDO::PARAM_STR);

        foreach ($amortizationBindings as $placeholder => $amortization) {
            $stmt->bindValue($placeholder, $amortization, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }


    public function updateRates($vat, $mcf, $discounts, $downPaymentRate, $amortizationRates) {
        $discountPlaceholders = "";
        $discountBindings = [];
        foreach ($discounts as $type => $discount) {
            $placeholder = ":{$type}_discount";
            $discountPlaceholders .= "{$type}_discount = {$placeholder}, ";
            $discountBindings[$placeholder] = $discount;
        }
        $discountPlaceholders = rtrim($discountPlaceholders, ", ");

        $amortizationRatePlaceholders = "";
        $amortizationRateBindings = [];
        foreach ($amortizationRates as $term => $amortizationRate) {
            $placeholder = ":{$term}_interest_rate";
            $amortizationRatePlaceholders .= "{$term}_interest_rate = {$placeholder}, ";
            $amortizationRateBindings[$placeholder] = $amortizationRate;
        }
        $amortizationRatePlaceholders = rtrim($amortizationRatePlaceholders, ", ");

        $stmt = $this->db->prepare("UPDATE estate_pricing
        SET
            vat = :vat,
            memorial_care_fee = :mcf,
            {$discountPlaceholders},
            down_payment_rate = :down_payment_rate,
            {$amortizationRatePlaceholders}
        ");
        $stmt->bindParam(":vat", $vat, PDO::PARAM_STR);
        $stmt->bindParam(":mcf", $mcf, PDO::PARAM_STR);
        $stmt->bindParam(":down_payment_rate", $downPaymentRate, PDO::PARAM_STR);

        foreach ($discountBindings as $placeholder => $discount) {
            $stmt->bindValue($placeholder, $discount, PDO::PARAM_STR);
        }

        foreach ($amortizationRateBindings as $placeholder => $amortizationRate) {
            $stmt->bindValue($placeholder, $amortizationRate, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

}