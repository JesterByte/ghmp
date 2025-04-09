<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\CollectionReportModel;
use Exception;

class CollectionReportController extends BaseController
{
    public function index()
    {
        $this->checkSession();
        
        $data = [
            "pageTitle" => "Collection Report",
            "usesDataTables" => true,
            "view" => "collection-report/index",
            // Add common data from BaseController
            "userId" => $_SESSION["user_id"],
            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function getCollections()
    {
        try {
            $startDate = $_GET['start_date'] ?? null;
            $endDate = $_GET['end_date'] ?? null;
            
            $model = new CollectionReportModel();
            $collections = $model->getCollections($startDate, $endDate);

            $response = [
                'draw' => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
                'data' => $collections,
                'recordsTotal' => count($collections),
                'recordsFiltered' => count($collections)
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        }
    }
}