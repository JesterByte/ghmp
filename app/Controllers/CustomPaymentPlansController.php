<?php

namespace App\Controllers;

use App\Models\CustomersModel;
use App\Helpers\DisplayHelper;
use App\Core\View;

class CustomPaymentPlansController extends BaseController
{
    public function index()
    {
        $this->checkSession();


        $data = [
            "pageTitle" => "Custom Payment Plans",
            "usesDataTables" => false,
            "customPaymentPlansTable" => [],
            "view" => "custom-payment-plans/index",

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
