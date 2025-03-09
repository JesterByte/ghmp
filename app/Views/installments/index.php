<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Formatter;

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
<div class="row">
    <div class="col d-flex justify-content-end">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-down-payment-modal"><i class="bi bi-plus"></i> Add Down Payment</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-monthly-payment-modal"><i class="bi bi-plus"></i> Add Monthly Payment</button>
        </div>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th class="text-center">Payment Date</th>
                <th class="text-center">Asset</th>
                <th class="text-center">Payer</th>
                <th class="text-center">Payment Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($installmentsTable as $installmentsRow) {
                    if (!empty($installmentsTable)) {
                        $assetId = Formatter::formatAssetId($installmentsRow["asset_id"]);
                        $payer = Formatter::formatFullName($installmentsRow["first_name"], $installmentsRow["middle_name"], $installmentsRow["last_name"], $installmentsRow["suffix_name"]);
                        $paymentAmount = Formatter::formatCurrency($installmentsRow["payment_amount"]);
                        $paymentDate = Formatter::formatDateTime($installmentsRow["payment_date"]);

                        TableHelper::startRow();
                        TableHelper::cell($paymentDate);
                        TableHelper::cell($assetId);
                        TableHelper::cell($payer);
                        TableHelper::cell($paymentAmount);
                        TableHelper::cell('');
                        TableHelper::endRow();
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-monthly-payment.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-down-payment.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("add-down-payment-modal", "asset-id");
    autofocusModal("add-monthly-payment-modal", "asset-id");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>