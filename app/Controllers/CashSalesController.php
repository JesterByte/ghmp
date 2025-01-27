<?php

namespace App\Controllers;

use App\Models\CashSalesModel;
use App\Core\View;

class CashSalesController extends BaseController {
    public function index() {
        $cashSalesModel = new CashSalesModel();
        $cashSalesTable = $cashSalesModel->getCashSales();

        $data = [
            "pageTitle" => "Cash Sales",
            "usesDataTables" => true,
            "cashSalesTable" => $cashSalesTable,
            "view" => "cash-sales/index"
        ];

        View::render("templates/layout", $data);
    }
}