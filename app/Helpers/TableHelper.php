<?php

namespace App\Helpers;

class TableHelper {
    public static function startRow() {
        echo "<tr>";
    }

    public static function endRow() {
        echo "</tr>";
    }

    public static function cell($data) {
        echo "<td class='text-center'>" . $data . "</td>";
    }
}