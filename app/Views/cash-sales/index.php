<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

$formattedReservationsTable = [];

foreach ($reservationsTable as $reservationRow) {
    $formattedReservationsTable["asset"][] = Formatter::formatLotId($reservationRow["asset_id"]);
    $formattedReservationsTable["asset_id"][] = $reservationRow["asset_id"];
    $formattedReservationsTable["payment_amount"][] = Formatter::formatCurrency($reservationRow["payment_amount"]);
}
?>
<!-- <div class="row my-3">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-cash-sale-payment-modal"><i class="bi bi-plus"></i> New Payment</button>
    </div>
</div> -->

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
            foreach ($cashSalesTable as $row) {
                if (!empty($cashSalesTable)) {
                    $lotId = Formatter::formatAssetId($row["asset_id"]);
                    $payer = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $paymentAmount = Formatter::formatCurrency($row["payment_amount"]);
                    $paymentDate = Formatter::formatDate($row["payment_date"]);
                    $receipt = BASE_URL . "/uploads/receipts/" . $row["receipt_path"];

                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($paymentDate);
                    TableHelper::cell($lotId);
                    TableHelper::cell($payer);
                    TableHelper::cell($paymentAmount);
                    // Add the "View Receipt" button with the receipt URL as a data attribute
                    TableHelper::cell("<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#view-receipt-modal' data-bs-receipt='{$receipt}'><i class='bi bi-eye-fill'></i> View Receipt</button>");
                    TableHelper::endRow();
                }
            }
            ?>

        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-cash-sale-payment.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-receipt.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("add-cash-sale-payment-modal", "lot-id");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

