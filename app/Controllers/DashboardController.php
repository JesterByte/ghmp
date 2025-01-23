<?php

namespace App\Controllers;

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

        $data = [
            "pageTitle" => "Dashboard",
            "usesDataTables" => false,
            "phasePricingTable" => [],
            "view" => "dashboard/index"
        ];

        View::render("templates/layout", $data);
    }
}