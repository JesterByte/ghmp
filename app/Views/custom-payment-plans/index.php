<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

?>

<div class="row mb-3">
    <div class="d-flex justify-content-between">
        <div class="btn-group">
            <a href="#" class="btn btn-primary active" aria-current="page">Lot</a>
            <a href="#" class="btn btn-primary">Estate</a>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-custom-payment-plan-modal">+ Custom Plan</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Created At</th>
                <th class="text-center">Plan Name</th>
                <th class="text-center">Phase</th>
                <th class="text-center">Lot Type</th>
                <th class="text-center">Down Payment</th>
                <th class="text-center">Monthly Payment</th>
                <th class="text-center">Interest Rate</th>
                <th class="text-center"><i class="bi bi-hand-index-thumb-fill"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php

            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-custom-plan.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    // autofocusModal("add-lot-reservation-modal", "lot");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>
