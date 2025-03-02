<?php

use App\Helpers\DisplayHelper;
use App\Helpers\TableHelper;
use App\Utils\Formatter;
use App\Helpers\DateHelper;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

$firstRow = reset($burialPricingTable);
?>
<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>

<div class="d-flex justify-content-between">
    <div class="btn-group">
        <a href="<?= BASE_URL . "/burial-pricing-lot" ?>" class="btn btn-primary <?= DisplayHelper::isActivePage($category, "Lot", "active") ?>" <?= DisplayHelper::isActivePage($category, "Lot", 'aria-current="page"') ?>>Lot</a>
        <a href="<?= BASE_URL . "/burial-pricing-estate" ?>" class="btn btn-primary <?= DisplayHelper::isActivePage($category, "Estate", "active") ?>" <?= DisplayHelper::isActivePage($category, "Estate", 'aria-current="page"') ?>>Estate</a>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pricing-update-burial-modal"><i class="bi bi-tag-fill"></i> Update Pricing</button>
</div>

<div class="row">
    <div class="col d-flex justify-content-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pricing-update-phase-modal"><i class="bi bi-tag-fill"></i> Update Pricing</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rates-update-phase-modal"><i class="bi bi-percent"></i> Update Rates</button> -->
        </div>
    </div>
</div>

<div class="table-responsive shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Burial Type</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($burialPricingTable as $row) {
                $row["price"] = Formatter::formatCurrency($row["price"]);
                TableHelper::startRow();
                TableHelper::cell($row["category"]);
                TableHelper::cell($row["burial_type"]);
                TableHelper::cell($row["price"]);
                TableHelper::endRow();
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-update-burial-pricing.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("pricing-update-burial-modal", "burial-type");
    // autofocusModal("rates-update-phase-modal", "vat");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>", true);
</script>