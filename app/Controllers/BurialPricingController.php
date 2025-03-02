<?php

namespace App\Controllers;

use App\Models\BurialPricingModel;
use App\Utils\Calculator;
use App\Utils\Formatter;
use App\Core\View;

class BurialPricingController extends BaseController
{
    // public function index() {

    //     $burialPricingModel = new BurialPricingModel();
    //     $burialPricingTable = $burialPricingModel->getPricingData();
    //     $data = [
    //         "pageTitle" => "Burial Pricing List",
    //         "usesDataTables" => true,
    //         "burialPricingTable" => $burialPricingTable,
    //         "view" => "burial-pricing/index"
    //     ];

    //     View::render("templates/layout", $data);
    // }

    public function indexLot()
    {
        $burialPricingModel = new BurialPricingModel();
        $burialPricingTable = $burialPricingModel->getLotPricingData();
        $lotStandardPrice = $burialPricingModel->getPrice("Lot", "Standard")["price"];
        $lotCremationPrice = $burialPricingModel->getPrice("Lot", "Cremation")["price"];
        $lotBoneTransferPrice = $burialPricingModel->getPrice("Lot", "Bone Transfer")["price"];

        $data = [
            "pageTitle" => "Burial Pricing List",
            "category" => "Lot",
            "standardPrice" => $lotStandardPrice,
            "cremationPrice" => $lotCremationPrice,
            "boneTransferPrice" => $lotBoneTransferPrice,
            "usesDataTables" => true,
            "burialPricingTable" => $burialPricingTable,
            "view" => "burial-pricing/index"
        ];

        View::render("templates/layout", $data);
    }

    public function indexEstate()
    {
        $burialPricingModel = new BurialPricingModel();
        $burialPricingTable = $burialPricingModel->getEstatePricingData();

        $estateStandardPrice = $burialPricingModel->getPrice("Estate", "Standard")["price"];
        $estateMausoleumPrice = $burialPricingModel->getPrice("Estate", "Mausoleum")["price"];
        $estateBoneTransferPrice = $burialPricingModel->getPrice("Estate", "Bone Transfer")["price"];

        $data = [
            "pageTitle" => "Burial Pricing List",
            "category" => "Estate",
            "standardPrice" => $estateStandardPrice,
            "mausoleumPrice" => $estateMausoleumPrice,
            "boneTransferPrice" => $estateBoneTransferPrice,
            "usesDataTables" => true,
            "burialPricingTable" => $burialPricingTable,
            "view" => "burial-pricing/index"
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
