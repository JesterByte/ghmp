<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Utils\Encryption;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" integrity="sha512-Zcn6bjR/8RZbLEpLIeOwNtzREBAJnUKESxces60Mpoj+2okopSAcSUIUOseddDm0cxnGQzxIR7vJgsLZbdLE3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= BASE_URL . "/css/map.css" ?>">

<div class="d-flex justify-content-end">
    <!-- <a href="<?= BASE_URL . "/lot-reservations" ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a> -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= BASE_URL . "/lot-reservations" ?>">Lot Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Requests</li>
        </ol>
    </nav>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Sorter</th>
                <th class="text-center">Request Date</th>
                <th class="text-center">Lot</th>
                <th class="text-center">Reservee</th>
                <th class="text-center">Lot Type</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($reservationRequestsTable as $row) {
                if (!empty($reservationRequestsTable)) {
                    // Get the latitude and longitude for the location
                    $latitudeStart = $row["lot_lat_start"];  // Assume you have latitude data
                    $longitudeStart = $row["lot_lng_start"]; // Assume you have longitude data
                    $latitudeEnd = $row["lot_lat_end"];  // Assume you have latitude data
                    $longitudeEnd = $row["lot_lng_end"]; // Assume you have longitude data


                    $formattedLotId = '<a href="#" class="location-link" 
                    data-lot-id="' . Formatter::formatLotId($row["lot_id"]) . '"
                    data-lat-start="' . $latitudeStart . '" 
                    data-lng-start="' . $longitudeStart . '" 
                    data-lat-end="' . $latitudeEnd . '" 
                    data-lng-end="' . $longitudeEnd . '">' . Formatter::formatLotId($row["lot_id"]) . '</a>';
                    $lotId = $row["lot_id"];
                    $reservee = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $reserveeId = $row["reservee_id"];
                    $requestDate = Formatter::formatDateTime($row["created_at"]);

                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($requestDate);
                    TableHelper::cell($formattedLotId);
                    TableHelper::cell($reservee);
                    TableHelper::cell($row["lot_type"]);
                    TableHelper::cell('<div class="btn-group" role="group" aria-label="Basic example">
                        <a role="button" href="verify-lot-type/' . Encryption::encrypt($row["lot_id"], $secretKey) . '/' . Encryption::encrypt($reserveeId, $secretKey) . '" class="btn btn-success">
                        <i class="bi bi-check"></i>
                        Verify Lot Type
                        </a>
                        
                        <button type="button" class="cancel-btn btn btn-danger"
                        data-bs-lot-id="' . $lotId . '"
                        data-bs-reservee-id="' . $reserveeId . '"
                        data-bs-toggle="modal"
                        data-bs-target="#lot-reservation-cancellation">
                        <i class="bi bi-x"></i> 
                        Decline
                        </button>
                        </div>');
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-cancel-lot-reservation.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-location.php" ?>

<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>
<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

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
    function initMap(lotId, latStart, lngStart, latEnd, lngEnd) {
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
            color: "green", // Color of the rectangle
            weight: 2,
            fillOpacity: 0.4 // Transparency of the rectangle
        }).addTo(map);

        // Bind a popup to the rectangle with deceased information
        currentRectangle.bindPopup(`
        <b>Lot ID:</b> ${lotId}`);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const locationLinks = document.querySelectorAll('.location-link');

        locationLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default anchor behavior

                const lotId = event.target.getAttribute('data-lot-id');
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
                    initMap(lotId, latStart, lngStart, latEnd, lngEnd);
                });
            });
        });
    });
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cancelModal = document.getElementById("lot-reservation-cancellation");
        const lotIdHidden = document.getElementById("lot-id");
        const reserveeIdHidden = document.getElementById("reservee-id");

        cancelModal.addEventListener("show.bs.modal", function(event) {
            const button = event.relatedTarget;

            const lotId = button.getAttribute("data-bs-lot-id");
            const reserveeId = button.getAttribute("data-bs-reservee-id");

            lotIdHidden.value = lotId;
            reserveeIdHidden.value = reserveeId;
        });
    });
</script>