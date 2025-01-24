<?php

namespace App\Utils;

class Formatter {

    /**
     * Format a number as currency.
     *
     * @param float $amount The amount to be formatted.
     * @param string $currencySymbol The currency symbol (default: $).
     * @param int $decimals The number of decimals to show (default: 2).
     * @return string The formatted currency string.
     */
    public static function formatCurrency(float $amount, string $currencySymbol = '₱', int $decimals = 2): string {
        return $currencySymbol . number_format($amount, $decimals);
    }

    /**
     * Format a number with commas for thousands, millions, etc.
     *
     * @param float $number The number to be formatted.
     * @return string The formatted number with commas.
     */
    public static function formatNumber(float $number): string {
        return number_format($number);
    }

    /**
     * Format a decimal number into a percentage.
     *
     * @param float $decimal The decimal value (e.g., 0.10 for 10%).
     * @param int $decimals The number of decimals to show (default: 2).
     * @return string The formatted percentage string.
     */
    public static function formatPercentage(float $decimal, int $decimals = 2): string {
        return number_format($decimal * 100, $decimals) . '%';
    }

    public static function formatPercentageWithoutSymbol(float $decimal, int $decimals = 2): string {
        return number_format($decimal * 100, $decimals);
    }

    public static function formatDecimal(float $percentage, int $decimals = 2): string {
        return number_format($percentage / 100, $decimals);
    }
}
