<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Formatter;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>
<div class="row">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-plus"></i> Add new payment</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Lot</th>
                <th>Payer</th>
                <th>Payment Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($cashSalesTable as $cashSalesRow) {
                    if (!empty($cashSalesTable)) {
                        $lotId = Formatter::formatLotId($cashSalesRow["lot_id"]);
                        $payer = Formatter::formatFullName($cashSalesRow["first_name"], $cashSalesRow["middle_name"], $cashSalesRow["last_name"], $cashSalesRow["suffix_name"]);
                        $paymentAmount = Formatter::formatCurrency($cashSalesRow["payment_amount"]);

                        TableHelper::startRow();
                        TableHelper::cell($lotId);
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

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>