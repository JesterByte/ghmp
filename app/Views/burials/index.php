<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>

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
            foreach ($burialsTable as $row) {
                if (!empty($burialsTable)) {
                    $assetId = Formatter::formatAssetId($row["asset_id"]);
                    $payer = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $paymentAmount = Formatter::formatCurrency($row["payment_amount"]);
                    $paymentDate = Formatter::formatDate($row["payment_date"]);
                    $receiptUrl = BASE_URL . "/uploads/receipts/" . $row["receipt_path"];

                    if ($row["receipt_path"] === NULL) {
                        $receipt = "Paid via Paymongo";
                    } else {
                        $receipth = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#view-receipt-modal' data-bs-receipt='{$receiptUrl}'><i class='bi bi-eye-fill'></i> View Receipt</button>";
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
<?php include_once VIEW_PATH . "/modals/modal-view-receipt.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>