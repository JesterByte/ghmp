<?php

namespace App\Controllers;

use App\Models\MapModel;
use App\Models\BadgeModel;
use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

class MapController extends BaseController
{
    protected $mapModel;

    public function __construct() {
        parent::__construct();

        $this->mapModel = new MapModel();
    }

    public function index()
    {
        $this->checkSession();

        $data = [
            "pageTitle" => "Map",
            "currentPage" => "Map",
            "usesDataTables" => false,
            "map" => [],
            "view" => "map/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexLotsList() {
        $this->checkSession();

        $lotsList = $this->mapModel->getLotsList();

        $data = [
            "pageTitle" => "Map",
            "currentPage" => "Lots List",
            "usesDataTables" => true,
            "lotsList" => $lotsList,
            "view" => "map/index",

            
            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexEstatesList() {
        $this->checkSession();

        $estatesList = $this->mapModel->getEstatesList();

        $data = [
            "pageTitle" => "Map",
            "currentPage" => "Estates List",
            "usesDataTables" => true,
            "estatesList" => $estatesList,
            "view" => "map/index",
            
            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function updateLotType() {
        $lotId = $_POST["lot_id"];
        $lotType = $_POST["lot_type"];
        $lastPage = $_POST["datatable_page"];

        $this->mapModel->setLotType($lotId, $lotType);

        return $this->redirect(BASE_URL . "/map-lots-list?page={$lastPage}", DisplayHelper::$checkIcon, "Lot type has been changed successfully", "Operation Successful");
    }

    public function fetchLots()
    {
        $lots = $this->mapModel->getLots();

        header("Content-Type: application/json");
        echo json_encode($lots);
    }
}
