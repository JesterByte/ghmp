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
                <th>Request Date</th>
                <th>Lot</th>
                <th>Reservee</th>
                <th>Lot Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($reservationRequestsTable as $reservationRequestsRow) {
                    if (!empty($reservationRequestsTable)) {
                        $lotId = Formatter::formatLotId($reservationRequestsRow["lot_id"]);
                        $reservee = Formatter::formatFullName($reservationRequestsRow["first_name"], $reservationRequestsRow["middle_name"], $reservationRequestsRow["last_name"], $reservationRequestsRow["suffix_name"]);
                        $requestDate = Formatter::formatDateTime($reservationRequestsRow["created_at"]);

                        TableHelper::startRow();
                        TableHelper::cell($requestDate);
                        TableHelper::cell($lotId);
                        TableHelper::cell($reservee);
                        TableHelper::cell($reservationRequestsRow["lot_type"]);
                        TableHelper::cell('<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success"><i class="bi bi-check"></i> Verify Lot Type</button>
                        <button type="button" class="btn btn-danger"><i class="bi bi-x"></i> Decline</button>
                        </div>');
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