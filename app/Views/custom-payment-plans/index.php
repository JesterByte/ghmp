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
            <a href="<?= BASE_URL . "/custom-payment-plans-lot" ?>" class="btn btn-primary <?= $currentPage === "Lot" ? "active" : "" ?>" <?= $currentPage === "Lot" ? 'aria-current="page"' : "" ?>>Lot</a>
            <a href="<?= BASE_URL . "/custom-payment-plans-estate" ?>" class="btn btn-primary <?= $currentPage === "Estate" ? "active" : "" ?>" <?= $currentPage === "Estate" ? 'aria-current="page"' : "" ?>>Estate</a>
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
                <?php if ($currentPage === "Lot"): ?>
                <th class="text-center">Phase</th>
                <th class="text-center">Lot Type</th>
                <?php elseif ($currentPage === "Estate"): ?>
                <th class="text-center">Estate</th>
                <?php endif; ?>
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
    <?php if ($currentPage === "Lot"): ?>
    autofocusModal("add-custom-payment-plan-modal", "phase");
    <?php elseif ($currentPage === "Estate"): ?>
    autofocusModal("add-custom-payment-plan-modal", "estate");
    <?php endif; ?>
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>
