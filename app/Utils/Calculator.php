<?php

namespace App\Utils;

class Calculator
{
    public function getTotalPurchasePrice($originalPrice, $vat, $memorialCareFee)
    {
        // $totalPurchasePrice = ($originalPrice + $memorialCareFee) * (1 + $vat);
        $vat = $originalPrice * $vat;
        $totalPurchasePrice = $originalPrice + $vat + $memorialCareFee;
        return $totalPurchasePrice;
    }

    public function getDiscount($originalPrice, $discountRate)
    {
        $discount = $originalPrice * $discountRate;  // Calculate the discount
        $discountedPrice = $originalPrice - $discount;  // Subtract the discount from the original price
        return $discountedPrice;
    }

    public function getDownPayment($totalAmount, $downPaymentRate)
    {
        $downPayment = $totalAmount * $downPaymentRate;
        return $downPayment;
    }

    public function getBalance($totalAmount, $downPayment)
    {
        $balance = $totalAmount - $downPayment;
        return $balance;
    }

    public function getFinalBalance($monthlyPayment, $termYears)
    {
        return $monthlyPayment * ($termYears * 12);
    }

    public function getSixMonthsAmortization($balance) {
        return $balance / 6;
    }

    public function getMonthlyAmortization($balance, $interestRate, $duration)
    {
        if ($duration > 0) {
            $months = $duration * 12;  // Convert years to months
        } else {
            // Handle invalid duration or return an error
            return 0;
        }

        $monthlyInterestRate = $interestRate / 12;  // Convert annual interest rate to monthly rate

        if ($monthlyInterestRate > 0) {
            // Calculate the monthly payment using the amortization formula
            $monthlyPayment = ($balance * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months)) / (pow(1 + $monthlyInterestRate, $months) - 1);
        } else {
            // If there's no interest, just divide the balance by the months
            $monthlyPayment = $balance / $months;
        }

        return round($monthlyPayment, 2);  // Round the result to 2 decimal places
    }

    // public function getMonthlyAmortization($balance, $interestRate, $duration) {
    //     if ($duration > 0) {
    //         $months = $duration * 12;  // Convert years to months
    //     } else {
    //         // Handle invalid duration or return an error
    //         return 0;
    //     }

    //     $monthlyInterestRate = $interestRate / 12;  // Convert annual interest rate to monthly rate

    //     if ($monthlyInterestRate > 0) {
    //         // Calculate the monthly payment using the amortization formula
    //         $monthlyPayment = ($balance * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months)) / (pow(1 + $monthlyInterestRate, $months) - 1);
    //     } else {
    //         // If there's no interest, just divide the balance by the months
    //         $monthlyPayment = $balance / $months;
    //     }

    //     return round($monthlyPayment, 2);  // Round the result to 2 decimal places
    // }

}
