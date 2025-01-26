<?php

namespace App\Helpers;

class DateHelper {
    public static function getTimestamp() {
        return date("Ymd_His");
    }
}