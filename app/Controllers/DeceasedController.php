<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\DeceasedModel;
use App\Models\UserModel;
use App\Core\View;

class DeceasedController extends BaseController {
    public function index() {
        $this->checkSession();

        $deceasedModel = new DeceasedModel();
        $deceasedTable = $deceasedModel->getDeceasedTable();

        $data = [
            "pageTitle" => "Deceased",
            "usesDataTables" => true,
            "deceasedTable" => $deceasedTable,
            "view" => "deceased/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }
}