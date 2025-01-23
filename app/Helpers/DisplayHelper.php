<?php

namespace App\Helpers;

class DisplayHelper {
    public static function isActivePage($pageTitle, $currentPage, $displayIfTrue, $displayIfFalse = "") {
        echo $pageTitle == $currentPage ? $displayIfTrue : $displayIfFalse;
    }
    
    public static function isPageInList($pageTitle, $pageList, $displayIfTrue, $displayIfFalse = "") {
        echo in_array($pageTitle, $pageList) ? $displayIfTrue : $displayIfFalse;
    }
}