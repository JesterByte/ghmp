<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
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
                <th>Completed On</th>
                <th>Lot</th>
                <th>Reservee</th>
                <th>Payment Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($fullyPaidsTable as $fullyPaidsRow) {
                    if (!empty($fullyPaidsTable)) {
                        $lotId = Formatter::formatLotId($fullyPaidsRow["lot_id"]);
                        $reservee = Formatter::formatFullName($fullyPaidsRow["first_name"], $fullyPaidsRow["middle_name"], $fullyPaidsRow["last_name"], $fullyPaidsRow["suffix_name"]);
                        $paymentAmount = Formatter::formatCurrency($fullyPaidsRow["payment_amount"]);
                        $completedOn = Formatter::formatDateTime($fullyPaidsRow["updated_at"]);

                        TableHelper::startRow();
                        TableHelper::cell($completedOn);
                        TableHelper::cell($lotId);
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