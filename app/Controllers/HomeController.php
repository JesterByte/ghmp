<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION["user_id"])) {
            // User is logged in, redirect to dashboard
            $this->redirect(BASE_URL . "/dashboard");
        }

        $pageTitle = "Home";

        require_once VIEW_PATH . "/sign-in/index.php";
    }
}
