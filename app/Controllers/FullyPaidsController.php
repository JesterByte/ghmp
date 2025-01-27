<?php

namespace App\Controllers;

use App\Models\FullyPaidsModel;
use App\Core\View;

class FullyPaidsController extends BaseController {
    public function index() {
        $fullyPaidsModel = new FullyPaidsModel();
        $fullyPaidsTable = $fullyPaidsModel->getFullyPaids();

        $data = [
            "pageTitle" => "Fully Paids",
            "usesDataTables" => true,
            "fullyPaidsTable" => $fullyPaidsTable,
            "view" => "fully-paids/index"
        ];

        View::render("templates/layout", $data);
    }
}