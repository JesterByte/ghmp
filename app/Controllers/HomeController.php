<?php
namespace App\Controllers;

class HomeController extends BaseController {
    public function index() {

        $pageTitle = "Home";

        require_once VIEW_PATH . "/sign-in/index.php";
    }
}