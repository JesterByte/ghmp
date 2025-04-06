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
                    <th class="text-center">Action</th>
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

                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($reservationDate);
                    TableHelper::cell($lotId);
                    TableHelper::cell($reservee);
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
<?php include_once VIEW_PATH . "/modals/modal-add-lot-reservation.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-location.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    let map; // Variable to hold the map instance
    let currentRectangle; // To keep track of the rectangle drawn on the map

    // Clear the map of all layers
    function clearMap() {
        if (currentRectangle) {
            map.removeLayer(currentRectangle); // Remove the existing rectangle
            currentRectangle = null; // Set the reference to null
        }
    }

    // Initialize the map
    function initMap(name, latStart, lngStart, latEnd, lngEnd) {
        // First, clear the previous rectangle
        clearMap();

        // Initialize the map centered around the midpoint
        const centerLat = (latStart + latEnd) / 2;
        const centerLng = (lngStart + lngEnd) / 2;

        // Initialize map only if it hasn't been initialized already
        if (!map) {
            map = L.map('map').setView([centerLat, centerLng], 19); // Set zoom level to 21 for detailed view

            // Add OpenStreetMap tile layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 21
            }).addTo(map);
        } else {
            // If map already initialized, update its center
            map.setView([centerLat, centerLng], 21);
        }

        // Add a rectangle representing the lot area using latStart, lngStart, latEnd, lngEnd
        currentRectangle = L.rectangle([
            [latStart, lngStart], // Bottom-left corner
            [latEnd, lngEnd] // Top-right corner
        ], {
            color: "gray", // Color of the rectangle
            weight: 2,
            fillOpacity: 0.4 // Transparency of the rectangle
        }).addTo(map);

        // Bind a popup to the rectangle with deceased information
        currentRectangle.bindPopup(`
        <b>Lot ID:</b> ${name}`);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const locationLinks = document.querySelectorAll('.location-link');

        locationLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default anchor behavior

                const deceased = event.target.getAttribute('data-name');
                const latStart = parseFloat(event.target.getAttribute('data-lat-start'));
                const lngStart = parseFloat(event.target.getAttribute('data-lng-start'));
                const latEnd = parseFloat(event.target.getAttribute('data-lat-end'));
                const lngEnd = parseFloat(event.target.getAttribute('data-lng-end'));

                // Initialize and show the modal
                const locationModal = new bootstrap.Modal(document.getElementById('location-modal'));
                locationModal.show();

                // Wait for the modal to be fully shown before initializing the map
                locationModal._element.addEventListener('shown.bs.modal', function() {
                    // Reinitialize the map after modal is shown
                    initMap(deceased, latStart, lngStart, latEnd, lngEnd);
                });
            });
        });
    });
</script>


<script>
    autofocusModal("add-lot-reservation-modal", "lot");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>