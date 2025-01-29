<?php

namespace App\Controllers;

use App\Models\FullyPaidsModel;
use App\Core\View;

class FullyPaidsController extends BaseController {
    // public function index() {
    //     $fullyPaidsModel = new FullyPaidsModel();
    //     $fullyPaidsTable = $fullyPaidsModel->getFullyPaids();

    //     $data = [
    //         "pageTitle" => "Fully Paids",
    //         "usesDataTables" => true,
    //         "fullyPaidsTable" => $fullyPaidsTable,
    //         "view" => "fully-paids/index"
    //     ];

    //     View::render("templates/layout", $data);
    // }

    public function indexCashSale() {
        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaidsCashSale();

        $data = [
            "pageTitle" => "Fully Paids",
            "currentTable" => "Cash Sale",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index"
        ];

        View::render("templates/layout", $data);
    }

    public function indexSixMonths() {
        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaidsSixMonths();

        $data = [
            "pageTitle" => "Fully Paids",
            "currentTable" => "6 Months",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index"
        ];

        View::render("templates/layout", $data);
    }

    public function indexInstallment() {
        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaidsInstallment();

        $data = [
            "pageTitle" => "Fully Paids",
            "currentTable" => "Installment",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index"
        ];

        View::render("templates/layout", $data);
    }
}