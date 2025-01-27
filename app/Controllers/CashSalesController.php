<?php

namespace App\Controllers;

use App\Models\CashSalesModel;
use App\Core\View;

class CashSalesController extends BaseController {
    public function index() {
        $cashSalesModel = new CashSalesModel();
        $cashSalesTable = $cashSalesModel->getCashSales();
        $reservationsTable = $cashSalesModel->getReservations();

        $data = [
            "pageTitle" => "Cash Sales",
            "usesDataTables" => true,
            "cashSalesTable" => $cashSalesTable,
            "reservationsTable" => $reservationsTable,
            "view" => "cash-sales/index"
        ];

        View::render("templates/layout", $data);
    }

    public function setPayment() {
        $cashSalesModel = new CashSalesModel();
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lotId = $_POST["lot-id"];

            $cashSalesModel->setPayment($lotId);
            $cashSalesModel->setLotReservation($lotId);

            $this->redirectBack();
        }
    }
}