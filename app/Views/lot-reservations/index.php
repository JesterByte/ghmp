<?php 
    use App\Helpers\TableHelper;
    use App\Helpers\DateHelper;
    use App\Utils\Formatter;

    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

    $formattedAvailableLots = [];
    foreach ($availableLots as $availableLot) {
        $formattedAvailableLots["available_lot"][] = Formatter::formatLotId($availableLot["lot_id"]);  
        $formattedAvailableLots["lot_id"][] = $availableLot["lot_id"];
    }

    $formattedCustomers = [];
    foreach ($customers as $customer) {
        $formattedCustomers["customer"][] = Formatter::formatFullName($customer["first_name"], $customer["middle_name"], $customer["last_name"], $customer["suffix_name"]);
        $formattedCustomers["customer_id"][] = $customer["id"];
    }
?>
<div class="row">
    <div class="col d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-lot-reservation-modal"><i class="bi bi-plus"></i> Add New Reservation</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Lot</th>
                <th>Reservee</th>
                <th>Lot Type</th>
                <th>Payment Option</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($lotReservationsTable as $lotReservationsRow) {
                    if (!empty($lotReservationsTable)) {
                        $lotId = Formatter::formatLotId($lotReservationsRow["lot_id"]);
                        $reservee = Formatter::formatFullName($lotReservationsRow["first_name"], $lotReservationsRow["middle_name"], $lotReservationsRow["last_name"], $lotReservationsRow["suffix_name"]);

                        TableHelper::startRow();
                        TableHelper::cell($lotId);
                        TableHelper::cell($reservee);
                        TableHelper::cell($lotReservationsRow["lot_type"]);
                        TableHelper::cell($lotReservationsRow["payment_option"]);
                        TableHelper::cell($lotReservationsRow["payment_status"]);
                        TableHelper::cell('');
                        TableHelper::endRow();
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-lot-reservation.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>