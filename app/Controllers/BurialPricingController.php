<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\BurialPricingModel;
use App\Utils\Calculator;
use App\Utils\Formatter;
use App\Core\View;

class BurialPricingController extends BaseController
{
    public function indexLot()
    {
        $this->checkSession();

        $burialPricingModel = new BurialPricingModel();
        $burialPricingTable = $burialPricingModel->getLotPricingData();
        $lotStandardPrice = $burialPricingModel->getPrice("Lot", "Full Body")["price"];
        $lotCremationPrice = $burialPricingModel->getPrice("Lot", "Columbarium")["price"];
        $lotBoneTransferPrice = $burialPricingModel->getPrice("Lot", "Bone Transfer")["price"];

        $data = [
            "pageTitle" => "Burial Pricing List",
            "category" => "Lot",
            "standardPrice" => $lotStandardPrice,
            "cremationPrice" => $lotCremationPrice,
            "boneTransferPrice" => $lotBoneTransferPrice,
            "usesDataTables" => true,
            "burialPricingTable" => $burialPricingTable,
            "view" => "burial-pricing/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function indexEstate()
    {
        $this->checkSession();

        $burialPricingModel = new BurialPricingModel();
        $burialPricingTable = $burialPricingModel->getEstatePricingData();

        $estateMausoleumPrice = $burialPricingModel->getPrice("Estate", "Mausoleum")["price"];
        $estateBoneTransferPrice = $burialPricingModel->getPrice("Estate", "Bone Transfer")["price"];

        $data = [
            "pageTitle" => "Burial Pricing List",
            "category" => "Estate",
            "mausoleumPrice" => $estateMausoleumPrice,
            "boneTransferPrice" => $estateBoneTransferPrice,
            "usesDataTables" => true,
            "burialPricingTable" => $burialPricingTable,
            "view" => "burial-pricing/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function updatePrice()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $category = $_POST["category"];
            $burialType = $_POST["burial-type"];
            $newPrice = $_POST["new-price"];

            $burialPricingModel = new BurialPricingModel();
            $success = $burialPricingModel->updatePrice($category, $burialType, $newPrice);

            $category = strtolower($category);
            if ($success) {
                $this->redirect(BASE_URL . "/burial-pricing-$category", '<i class="bi bi-check-lg text-success"></i>', "Burial price has been updated successfully", "Operation Successful");
            } else {
                $this->redirect(BASE_URL . "/burial-pricing-$category", '<i class="bi bi-x-lg text-danger"></i>', "Price has not been updated", "Operation Failed");
            }
        }
    }
}
