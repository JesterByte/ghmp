<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Helpers\DisplayHelper;
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
<div class="row mb-1">
    <div class="col d-flex justify-content-end">
        <a href="<?= BASE_URL . "/lot-reservation-requests" ?>" role="button" class="btn btn-primary position-relative"><i class="bi bi-list"></i> Reservation Requests
            <?php if ($lotReservationRequests != 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $lotReservationRequests ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            <?php endif; ?>
        </a>
    </div>
</div>
<div class="row">
    <div class="col d-flex justify-content-between">
        <div class="btn-group">
            <a href="lot-reservations-cash-sale" class="btn btn-primary <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "aria-current='page'") ?>>Cash Sale</a>
            <a href="lot-reservations-six-months" class="btn btn-primary <?= DisplayHelper::isActivePage($currentTable, "6 Months", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "6 Months", "aria-current='page'") ?>>6 Months</a>
            <a href="lot-reservations-installment" class="btn btn-primary <?= DisplayHelper::isActivePage($currentTable, "Installment", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Installment", "aria-current='page'") ?>>Installment</a>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-lot-reservation-modal"><i class="bi bi-plus"></i> Add New Reservation</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th class="text-center">Reservation Date</th>
                <th class="text-center">Lot</th>
                <th class="text-center">Reservee</th>
                <th class="text-center">Lot Type</th>
                <!-- <th class="text-center">Payment Option</th> -->
                <th class="text-center">Reservation Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lotReservationsTable as $lotReservationsRow) {
                if (!empty($lotReservationsTable)) {
                    $lotId = Formatter::formatLotId($lotReservationsRow["lot_id"]);
                    $reservee = Formatter::formatFullName($lotReservationsRow["first_name"], $lotReservationsRow["middle_name"], $lotReservationsRow["last_name"], $lotReservationsRow["suffix_name"]);
                    $reservationDate = Formatter::formatDateTime($lotReservationsRow["created_at"]);

                    TableHelper::startRow();
                    TableHelper::cell($reservationDate);
                    TableHelper::cell($lotId);
                    TableHelper::cell($reservee);
                    TableHelper::cell($lotReservationsRow["lot_type"]);
                    TableHelper::cell($lotReservationsRow["reservation_status"]);
                    // TableHelper::cell($lotReservationsRow["payment_status"]);
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
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("add-lot-reservation-modal", "lot");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>