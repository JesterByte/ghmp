<?php

namespace App\Controllers;

use App\Models\EstatePricingModel;
use App\Utils\Calculator;
use App\Core\View;

class EstatePricingController extends BaseController {
    public function index() {
        $estatePricingModel = new EstatePricingModel();
        $estatePricingTable = $estatePricingModel->getPricingData();
        $data = [
            "pageTitle" => "Estate Pricing List",
            "usesDataTables" => true,
            "estatePricingTable" => $estatePricingTable,
            "view" => "estate-pricing/index"
        ];

        View::render("templates/layout", $data);
    }
}