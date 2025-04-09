<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

$formattedAvailableEstates = [];
if (!empty($availableEstates)) {
    foreach ($availableEstates as $availableEstate) {
        $formattedAvailableEstates["available_estate"][] = Formatter::formatEstateId($availableEstate["estate_id"]);
        $formattedAvailableEstates["estate_id"][] = $availableEstate["estate_id"];
    }
}

$formattedCustomers = [];
if (!empty($customers)) {
    foreach ($customers as $customer) {
        $formattedCustomers["customer"][] = Formatter::formatFullName($customer["first_name"], $customer["middle_name"], $customer["last_name"], $customer["suffix_name"]);
        $formattedCustomers["customer_id"][] = $customer["id"];
    }
}

?>
<div class="row mb-1">
    <div class="col d-flex justify-content-end">
        <a href="<?= BASE_URL . "/estate-reservation-requests" ?>" role="button" class="btn btn-info position-relative"><i class="bi bi-list"></i> Requests
            <?php if ($estateReservationRequests != 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $estateReservationRequests ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            <?php endif; ?>
        </a>
    </div>
</div>

<div class="d-flex justify-content-end">
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#reservationSettingsModal">
            <i class="bi bi-gear"></i>
            Reservation Settings
        </button>
    </div>
</div>

<div class="row my-3">
    <div class="col">
        <div class="btn-group">
            <a href="estate-reservations-cash-sale" class="btn btn-outline-primary d-flex align-items-center <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "aria-current='page'") ?>>Cash Sale</a>
            <a href="estate-reservations-six-months" class="btn btn-outline-primary d-flex align-items-center <?= DisplayHelper::isActivePage($currentTable, "6 Months", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "6 Months", "aria-current='page'") ?>>6 Months</a>
            <a href="estate-reservations-installment" class="btn btn-outline-primary d-flex align-items-center <?= DisplayHelper::isActivePage($currentTable, "Installment", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Installment", "aria-current='page'") ?>>Installment</a>
        </div>
    </div>
</div>

<div class="row my-3">
    <div class="col d-flex justify-content-between">
        <div class="btn-group">
            <a href="estate-reservations-overdue" class="btn btn-outline-warning <?= DisplayHelper::isActivePage($currentTable, "Overdue", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Overdue", "aria-current='page'") ?>><i class="bi bi-clock<?= DisplayHelper::isActivePage($currentTable, "Overdue", "-fill") ?>"></i> Overdue</a>
            <a href="estate-reservations-cancelled" class="btn btn-outline-danger <?= DisplayHelper::isActivePage($currentTable, "Cancelled", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cancelled", "aria-current='page'") ?>><i class="bi bi-trash<?= DisplayHelper::isActivePage($currentTable, "Cancelled", "-fill") ?>"></i> Cancelled</a>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-estate-reservation-modal">+ New Reservation</button>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Created At</th>
                <th class="text-center">Reservation Date</th>
                <th class="text-center">Estate</th>
                <th class="text-center">Reservee</th>
                <!-- <th class="text-center">Payment Option</th> -->
                <?php if ($currentTable == "Cancelled"): ?>
                    <th class="text-center">Cancelled On</th>
                <?php else: ?>
                    <th class="text-center">Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($estateReservationsTable as $row) {
                if (!empty($estateReservationsTable)) {
                    $estateId = Formatter::formatEstateId($row["estate_id"]);
                    $reservee = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $reservationDate = Formatter::formatDateTime($row["created_at"]);

                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($reservationDate);
                    TableHelper::cell($estateId);
                    TableHelper::cell($reservee);
                    // TableHelper::cell($estateReservationsRow["payment_status"]);
                    if ($currentTable == "Cancelled") {
                        $cancelledOn = Formatter::formatDateTime($row["updated_at"]);

                        TableHelper::cell($cancelledOn);
                    } else {
                        TableHelper::cell("");
                    }
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-estate-reservation.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-reservation-settings.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("add-estate-reservation-modal", "estate");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>