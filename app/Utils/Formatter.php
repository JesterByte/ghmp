<?php

namespace App\Utils;

use DateTime;

class Formatter
{

    /**
     * Format a number as currency.
     *
     * @param float $amount The amount to be formatted.
     * @param string $currencySymbol The currency symbol (default: $).
     * @param int $decimals The number of decimals to show (default: 2).
     * @return string The formatted currency string.
     */
    public static function formatCurrency(float $amount, string $currencySymbol = '₱', int $decimals = 2): string
    {
        return $currencySymbol . number_format($amount, $decimals);
    }

    /**
     * Format a number with commas for thousands, millions, etc.
     *
     * @param float $number The number to be formatted.
     * @return string The formatted number with commas.
     */
    public static function formatNumber(float $number): string
    {
        return number_format($number);
    }

    /**
     * Format a decimal number into a percentage.
     *
     * @param float $decimal The decimal value (e.g., 0.10 for 10%).
     * @param int $decimals The number of decimals to show (default: 2).
     * @return string The formatted percentage string.
     */
    public static function formatPercentage(float $decimal, int $decimals = 2): string
    {
        return number_format($decimal * 100, $decimals) . '%';
    }

    public static function formatPercentageWithoutSymbol(float $decimal, int $decimals = 2): string
    {
        return number_format($decimal * 100, $decimals);
    }

    public static function formatDecimal(float $percentage, int $decimals = 2): string
    {
        return number_format($percentage / 100, $decimals);
    }

    public static function extractComponents(string $lotIdentifier): array
    {
        // Regular expression to match the components
        $pattern = '/^(\d+)([A-Za-z])(\d+)-(\d+)$/';

        // Match the pattern
        if (preg_match($pattern, $lotIdentifier, $matches)) {
            return [
                'phase' => $matches[1], // Phase Number
                'lawn' => $matches[2],  // Lawn Letter
                'row' => $matches[3],   // Row Number
                'lot' => $matches[4],   // Lot Number
            ];
        }

        // Return an empty array if the format is invalid
        return [
            'phase' => null,
            'lawn' => null,
            'row' => null,
            'lot' => null,
        ];
    }

    // Function to convert a string to lowercase snake_case (only spaces to underscores)
    public static function convertToSnakeCase($string)
    {
        // Replace spaces with underscores and convert to lowercase
        return strtolower(str_replace(' ', '_', $string));
    }

    public static function formatFullName($firstName, $middleName, $lastName, $suffix)
    {
        $middleName = !empty($middlename) ? ' ' . $middlename . ', ' : ' ';
        $suffix = !empty($suffix) ? ', ' . $suffix : '';

        $fullName = $firstName . $middleName . $lastName . $suffix;

        return $fullName;
    }

    public static function formatAssetId($assetId)
    {
        // Regular expression to match the components of the lot ID
        $lotIdPattern = '/^(\d)([A-Z])(\d+)-(\d+)$/';
        $estateIdPattern = '/E-([A-C])(\d+)/';

        if (preg_match($lotIdPattern, $assetId, $matches)) {
            // Extracted components
            $phase = $matches[1];
            $lawn = $matches[2];
            $row = $matches[3];
            $lot = $matches[4];

            // Return the formatted string
            return "Phase $phase Lawn $lawn Row $row Lot $lot";
        } else if (preg_match($estateIdPattern, $assetId, $matches)) {
            return "Estate {$matches[1]} - {$matches[2]}";
        }
    }

    public static function formatLotId($lotId)
    {
        // Regular expression to match the components of the lot ID
        $pattern = '/^(\d)([A-Z])(\d+)-(\d+)$/';

        if (preg_match($pattern, $lotId, $matches)) {
            // Extracted components
            $phase = $matches[1];
            $lawn = $matches[2];
            $row = $matches[3];
            $lot = $matches[4];

            // Return the formatted string
            return "Phase $phase Lawn $lawn Row $row Lot $lot";
        } else {
            // Return a fallback for invalid lot IDs
            // return "Invalid Lot ID";
            return $lotId;
        }
    }

    public static function extractPhase($lotId)
    {
        // Regular expression to match the components of the lot ID
        $pattern = '/^(\d)([A-Z])(\d+)-(\d+)$/';

        if (preg_match($pattern, $lotId, $matches)) {
            // Extracted components
            $phase = $matches[1];

            // Return the formatted string
            return $phase;
        } else {
            // Return a fallback for invalid lot IDs
            // return "Invalid Lot ID";
            return $lotId;
        }
    }

    public static function formatEstateId($estateId)
    {
        if (preg_match('/E-([A-C])(\d+)/', $estateId, $matches)) {
            return "Estate {$matches[1]} - {$matches[2]}";
        }
        return $estateId; // Return as is if format is incorrect
    }

    public static function extractEstateType($estateId)
    {
        if (preg_match('/E-([A-C])(\d+)/', $estateId, $matches)) {
            return $matches[1];
        }
        return $estateId; // Return as is if format is incorrect
    }

    public static function formatDateTime($dateTime)
    {
        return date("F j, Y h:i A", strtotime($dateTime));
    }

    public static function formatDate($date)
    {
        return date("F j, Y", strtotime($date));
    }

    // Format file name for database restore
    public static function formatDatabaseVersion($filename)
    {
        // Regular expression to extract date and time parts from the filename
        preg_match('/(\d{4}-\d{2}-\d{2})_(\d{2}-\d{2}-\d{2})-(am|pm)/', $filename, $matches);

        if ($matches) {
            // Extract date and time from matches
            $date = $matches[1]; // 2025-01-29
            $time = $matches[2]; // 06-54-49
            $am_pm = $matches[3]; // am or pm

            // Combine date and time into a single datetime string
            $datetime_str = $date . ' ' . str_replace('-', ':', $time) . ' ' . $am_pm;

            // Convert it into a DateTime object
            $datetime = DateTime::createFromFormat("Y-m-d h:i:s a", $datetime_str);

            return $datetime->format("F j, Y, g:i A");
        } else {
            echo "Invalid filename format.";
        }
    }

    public static function determineIdType($id)
    {
        // Check for Lot ID format
        if (preg_match('/^(\d)([A-Z])(\d+)-(\d+)$/', $id)) {
            return 'lot';
        }
        // Check for Estate ID format
        if (preg_match('/^E-([A-C])(\d+)$/', $id)) {
            return 'estate';
        }
        // Return null if neither format matches
        return null;
    }
}
