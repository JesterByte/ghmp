<?php

namespace App\Controllers;

use App\Models\CustomersModel;
use App\Helpers\DisplayHelper;
use App\Core\View;

class CustomersController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $customersModel = new CustomersModel();
        $customersTable = $customersModel->getCustomers();

        $data = [
            "pageTitle" => "Customers",
            "usesDataTables" => false,
            "customersTable" => $customersTable,
            "view" => "customers/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function customerAction()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->checkSession();

            $customerId = $_POST["customer_id"];
            $action = $_POST["action"];

            $customersModel = new CustomersModel();
            $status = $action === "activate" ? "Active" : "Deactivated";
            $customersModel->setCustomerStatus($customerId, $status);

            $this->redirect(BASE_URL . "/customers", DisplayHelper::$checkIcon, "Customer account status has been changed successfully!", "Operation Successful");
        }
    }

    public function fetchBeneficiaries($customerId)
    {
        // $this->checkSession();

        $customersModel = new CustomersModel();
        $beneficiaries = $customersModel->getBeneficiariesByCustomerId($customerId);

        header("Content-Type: application/json");

        if ($beneficiaries) {
            echo json_encode(["beneficiaries" => $beneficiaries]);
        } else {
            echo json_encode(["beneficiaries" => []]);
        }

        exit;
    }
}
