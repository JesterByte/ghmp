<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Utils\Formatter;
use App\Helpers\DisplayHelper;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

$formattedPendingDownPayments = [];
$formattedOngoingInstallments = [];

foreach ($pendingDownPayments as $pendingDownPayment) {
    $formattedPendingDownPayments["asset"][] = Formatter::formatAssetId($pendingDownPayment["asset_id"]);
    $formattedPendingDownPayments["asset_id"][] = $pendingDownPayment["asset_id"];
    $formattedPendingDownPayments["down_payment"][] = Formatter::formatCurrency($pendingDownPayment["down_payment"]);
}

foreach ($ongoingInstallments as $ongoingInstallment) {
    $formattedOngoingInstallments["asset"][] = Formatter::formatAssetId($ongoingInstallment["asset_id"]);
    $formattedOngoingInstallments["asset_id"][] = $ongoingInstallment["asset_id"];
    $formattedOngoingInstallments["monthly_payment"][] = Formatter::formatCurrency($ongoingInstallment["monthly_payment"]);
}
?>

<div class="row my-3">
    <div class="col d-flex justify-content-between">
        <div class="btn-group">
            <a href="installments" class="btn btn-outline-primary <?= DisplayHelper::isActivePage($currentTable, "Installments", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Installments", "aria-current='page'") ?>>Installments</a>
            <a href="installments-down-payments" class="btn btn-outline-primary <?= DisplayHelper::isActivePage($currentTable, "Down Payments", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Down Payments", "aria-current='page'") ?>>Down Payments</a>
        </div>
    </div>
</div>

<?php if ($currentTable === "Installments"): ?>
    <div class="row my-3">
        <div class="col d-flex justify-content-end">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#record-monthly-payment-modal"><i class="bi bi-plus"></i> Record Payment</button>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Sorter</th>
                <th class="text-center">Payment Date</th>
                <th class="text-center">Asset</th>
                <th class="text-center">Payer</th>
                <th class="text-center">Payment Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            switch ($currentTable) {
                case "Installments":
                    $table = $installmentsTable;
                    break;
                case "Down Payments":
                    $table = $downPaymentsTable;
                    break;
            }

            foreach ($table as $row) {
                if (!empty($table)) {
                    $assetId = Formatter::formatAssetId($row["asset_id"]);
                    $payer = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $paymentAmount = Formatter::formatCurrency($row["payment_amount"]);
                    $paymentDate = Formatter::formatDateTime($row["payment_date"]);
                    $receiptUrl = BASE_URL . "/uploads/receipts/" . $row["receipt_path"];

                    if (empty($row["receipt_path"]) || $row["receipt_path"] === NULL) {
                        $receipt = "Paid via Paymongo";
                    } else {
                        $receipt = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#view-receipt-modal' data-bs-receipt='{$receiptUrl}'><i class='bi bi-eye-fill'></i> View Receipt</button>";
                    }
                    
                    TableHelper::startRow();
                    TableHelper::cell($row["payment_date"]);
                    TableHelper::cell($paymentDate);
                    TableHelper::cell($assetId);
                    TableHelper::cell($payer);
                    TableHelper::cell($paymentAmount);
                    TableHelper::cell($receipt);
                    
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-record-monthly-payment.php" ?>
<?php // include_once VIEW_PATH . "/modals/modal-add-down-payment.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-receipt.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    // autofocusModal("add-down-payment-modal", "asset-id");
    autofocusModal("record-monthly-payment-modal", "asset-id");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>