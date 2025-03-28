<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\UserModel;
use App\Core\View;

class DashboardController extends BaseController {
    // public function index() {
    //     session_start();
    //     if (!isset($_SESSION["user_id"])) {
    //         header("Location: " . BASE_URL . "/sign-in");
    //         exit();
    //     }

    //     $userModel = new UserModel();
    //     $user = $userModel->getUserById($_SESSION["user_id"]);

    //     if (!$user) {
    //         session_destroy();
    //         header("Location: " . BASE_URL . "/sign-in");
    //         exit();
    //     }

    //     $pageTitle = "Dashboard";
    //     ob_start();
    //     $content = ob_get_clean();

    //     include_once VIEW_PATH . "/templates/layout.php";
    // }

    public function index() {
        $this->checkSession();

        $data = [
            "pageTitle" => "Dashboard",
            "usesDataTables" => false,
            "phasePricingTable" => [],
            "view" => "dashboard/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations
        ];

        View::render("templates/layout", $data);
    }
}