<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Formatter;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

    $formattedReservationsTable = [];

    foreach ($reservationsTable as $reservationRow) {
        $formattedReservationsTable["asset"][] = Formatter::formatLotId(lotId: $reservationRow["asset_id"]);
        $formattedReservationsTable["asset_id"][] = $reservationRow["asset_id"];
        $formattedReservationsTable["payment_amount"][] = Formatter::formatCurrency($reservationRow["payment_amount"]);
    }
?>
<div class="row">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-six-months-payment-modal"><i class="bi bi-plus"></i> Add New Payment</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Payment Date</th>
                <th>Asset</th>
                <th>Payer</th>
                <th>Payment Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($sixMonthsTable as $sixMonthsRow) {
                    if (!empty($sixMonthsTable)) {
                        $assetId = Formatter::formatAssetId($sixMonthsRow["asset_id"]);
                        $payer = Formatter::formatFullName($sixMonthsRow["first_name"], $sixMonthsRow["middle_name"], $sixMonthsRow["last_name"], $sixMonthsRow["suffix_name"]);
                        $paymentAmount = Formatter::formatCurrency($sixMonthsRow["payment_amount"]);
                        $paymentDate = Formatter::formatDateTime($sixMonthsRow["updated_at"]);

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
<?php include_once VIEW_PATH . "/modals/modal-add-six-months-payment.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("add-six-months-payment-modal", "lot-id");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>