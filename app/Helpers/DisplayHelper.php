<?php

namespace App\Helpers;

class DisplayHelper {
    public static $checkIcon = '<i class="bi bi-check-lg text-success"></i>';
    public static $xIcon = '<i class="bi bi-x-lg text-danger"></i>';

    public static function isActivePage($pageTitle, $currentPage, $displayIfTrue, $displayIfFalse = "") {
        echo $pageTitle == $currentPage ? $displayIfTrue : $displayIfFalse;
    }
    
    public static function isPageInList($pageTitle, $pageList, $displayIfTrue, $displayIfFalse = "") {
        echo in_array($pageTitle, $pageList) ? $displayIfTrue : $displayIfFalse;
    }
}