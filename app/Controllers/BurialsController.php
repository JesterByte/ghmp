<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\BurialsModel;

class BurialsController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $burialsModel = new BurialsModel();
        $burialsTable = $burialsModel->getBurials();

        $data = [
            "pageTitle" => "Burials",
            "usesDataTables" => true,
            "burialsTable" => $burialsTable,
            "view" => "burials/index",

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
