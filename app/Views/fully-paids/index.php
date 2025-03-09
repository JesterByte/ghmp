<?php 
    use App\Helpers\DisplayHelper;
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Formatter;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

?>
<div class="row">
    <div class="col">
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <a href="fully-paids-cash-sale" class="btn btn-primary <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "aria-current='page'") ?>>Cash Sale</a>
                <a href="fully-paids-six-months" class="btn btn-primary <?= DisplayHelper::isActivePage($currentTable, "6 Months", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "6 Months", "aria-current='page'") ?>>6 Months</a>
                <a href="fully-paids-installment" class="btn btn-primary <?= DisplayHelper::isActivePage($currentTable, "Installment", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Installment", "aria-current='page'") ?>>Installment</a>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th class="text-center">Completed On</th>
                <th class="text-center">Asset</th>
                <th class="text-center">Reservee</th>
                <th class="text-center">Payment Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($fullyPaidsTable as $fullyPaidsRow) {
                    if (!empty($fullyPaidsTable)) {
                        $assetId = Formatter::formatAssetId($fullyPaidsRow["asset_id"]);
                        $reservee = Formatter::formatFullName($fullyPaidsRow["first_name"], $fullyPaidsRow["middle_name"], $fullyPaidsRow["last_name"], $fullyPaidsRow["suffix_name"]);

                        if ($currentTable == "Installment") {
                            $paymentAmount = Formatter::formatCurrency($fullyPaidsRow["down_payment"] + $fullyPaidsRow["total_amount"]);
                        } else {
                            $paymentAmount = Formatter::formatCurrency($fullyPaidsRow["payment_amount"]);
                        }
                        $completedOn = Formatter::formatDateTime($fullyPaidsRow["updated_at"]);

                        TableHelper::startRow();
                        TableHelper::cell($completedOn);
                        TableHelper::cell($assetId);
                        TableHelper::cell($reservee);
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

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>