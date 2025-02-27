<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Encryption;
    use App\Utils\Formatter;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>
<div class="d-flex justify-content-end">
    <!-- <a href="<?= BASE_URL . "/lot-reservations" ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a> -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASE_URL . "/lot-reservations" ?>">Lot Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reservation Requests</li>
        </ol>
    </nav>
</div>

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
                        <a role="button" href="verify-lot-type/'. Encryption::encrypt($reservationRequestsRow["lot_id"], $secretKey).'" class="btn btn-success"><i class="bi bi-check"></i> Verify Lot Type</a>
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