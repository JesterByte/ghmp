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
        <a href="<?= BASE_URL . "/lot-reservation-requests" ?>" role="button" class="btn btn-info position-relative"><i class="bi bi-list"></i> Requests
            <?php if ($lotReservationRequests != 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $lotReservationRequests ?>
                    <span class="visually-hidden">unread messages</span>
                </span>
            <?php endif; ?>
        </a>
    </div>
</div>

<div class="row my-3">
    <div class="col">
        <div class="btn-group">
            <a href="lot-reservations-cash-sale" class="btn btn-outline-primary d-flex align-items-center <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "aria-current='page'") ?>>Cash Sale</a>
            <a href="lot-reservations-six-months" class="btn btn-outline-primary d-flex align-items-center <?= DisplayHelper::isActivePage($currentTable, "6 Months", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "6 Months", "aria-current='page'") ?>>6 Months</a>
            <a href="lot-reservations-installment" class="btn btn-outline-primary d-flex align-items-center <?= DisplayHelper::isActivePage($currentTable, "Installment", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Installment", "aria-current='page'") ?>>Installment</a>
        </div>
    </div>
</div>

<div class="row my-3 ">
    <div class="col d-flex justify-content-between">
        <div class="btn-group">
            <a href="lot-reservations-overdue" class="btn btn-outline-warning <?= DisplayHelper::isActivePage($currentTable, "Overdue", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Overdue", "aria-current='page'") ?>><i class="bi bi-clock<?= DisplayHelper::isActivePage($currentTable, "Overdue", "-fill") ?>"></i> Overdue</a>
            <a href="lot-reservations-cancelled" class="btn btn-outline-danger <?= DisplayHelper::isActivePage($currentTable, "Cancelled", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cancelled", "aria-current='page'") ?>><i class="bi bi-trash<?= DisplayHelper::isActivePage($currentTable, "Cancelled", "-fill") ?>"></i> Cancelled</a>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-lot-reservation-modal">+ New Reservation</button>
    </div>

</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Created At</th>
                <th class="text-center">Reservation Date</th>
                <th class="text-center">Lot</th>
                <th class="text-center">Reservee</th>
                <?php if ($currentTable == "Cancelled"): ?>
                    <th class="text-center">Cancelled On</th>
                <?php else: ?>
                    <th class="text-center"><i class="bi bi-hand-index-thumb-fill"></i></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lotReservationsTable as $row) {
                
                if (!empty($lotReservationsTable)) {

                    $lotId = Formatter::formatAssetId($row["lot_id"]);
                    $reservee = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $reservationDate = Formatter::formatDateTime($row["created_at"]);

                    switch ($currentTable) {
                        case "Overdue":
                            $action = '<button type="button" class="btn-cancel btn btn-danger" data-bs-toggle="modal" data-bs-target="#lot-reservation-cancellation" data-bs-lot-id="' . $row["lot_id"] . '" data-bs-reservee-id="' . $row["reservee_id"] . '"><i class="bi bi-x"></i> Cancel Reservation</button>';
                            break;
                        default:
                            $action = "";
                            break;
                    }

                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($reservationDate);
                    TableHelper::cell($lotId);
                    TableHelper::cell($reservee);
                    if ($currentTable == "Cancelled") {
                        $cancelledOn = Formatter::formatDateTime($row["updated_at"]);
                        TableHelper::cell($cancelledOn);
                    } else {
                        TableHelper::cell($action);
                    }
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-lot-reservation.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-location.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-reservation-settings.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-cancel-lot-reservation.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("add-lot-reservation-modal", "lot");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cancelButtons = document.querySelectorAll(".btn-cancel");

        cancelButtons.forEach(button => {
            button.addEventListener("click", function() {
                const lotId = document.getElementById("lot-id");
                const reserveeId = document.getElementById("reservee-id");

                lotId.value = this.getAttribute("data-bs-lot-id");
                reserveeId.value = this.getAttribute("data-bs-reservee-id");

            });
        });
    });
</script>