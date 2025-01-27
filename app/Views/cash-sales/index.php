<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Formatter;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

    $formattedReservationsTable = [];

    foreach ($reservationsTable as $reservationRow) {
        $formattedReservationsTable["lot"][] = Formatter::formatLotId($reservationRow["lot_id"]);
        $formattedReservationsTable["lot_id"][] = $reservationRow["lot_id"];
        $formattedReservationsTable["payment_amount"][] = Formatter::formatCurrency($reservationRow["payment_amount"]);
    }
?>
<div class="row">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-cash-sale-payment-modal"><i class="bi bi-plus"></i> Add New Payment</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Payment Date</th>
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
                        $paymentDate = Formatter::formatDateTime($cashSalesRow["updated_at"]);

                        TableHelper::startRow();
                        TableHelper::cell($paymentDate);
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
<?php include_once VIEW_PATH . "/modals/modal-add-cash-sale-payment.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>