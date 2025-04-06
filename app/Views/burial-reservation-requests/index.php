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
            <li class="breadcrumb-item"><a href="<?= BASE_URL . "/burial-reservations" ?>">Burial Reservations</a></li>
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
                <th class="text-center">Preferred Burial Date</th>
                <th class="text-center">Location</th>
                <th class="text-center">Interred</th>
                <th class="text-center">Reservee</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($burialReservationRequestsTable as $row) {
                if (!empty($burialReservationRequestsTable)) {
                    $prefferedDate = Formatter::formatDateTime($row["date_time"]);

                    // Get the latitude and longitude for the location
                    $latitudeStart = $row["lot_lat_start"] ?? $row["estate_lat_start"];  // Assume you have latitude data
                    $longitudeStart = $row["lot_lng_start"] ?? $row["estate_lng_start"]; // Assume you have longitude data
                    $latitudeEnd = $row["lot_lat_end"] ?? $row["estate_lat_end"];  // Assume you have latitude data
                    $longitudeEnd = $row["lot_lng_end"] ?? $row["estate_lng_end"]; // Assume you have longitude data

                    $location = '<a href="#" class="location-link" 
                    data-asset-id="' . Formatter::formatAssetId($row["asset_id"]) . '"
                    data-lat-start="' . $latitudeStart . '" 
                    data-lng-start="' . $longitudeStart . '" 
                    data-lat-end="' . $latitudeEnd . '" 
                    data-lng-end="' . $longitudeEnd . '">' . Formatter::formatAssetId($row["asset_id"]) . '</a>';

                    $interredMiddleName = !empty($row["interred_middle_name"]) ? " " . $row["interred_middle_name"] . " " : " ";
                    $interredSuffixName = !empty($row["interred_suffix_name"]) ? ", " . $row["interred_suffix_name"] : "";
                    $interred = $row["interred_first_name"] . $interredMiddleName . $row["interred_last_name"] . $interredSuffixName;

                    $reserveeMiddleName = !empty($row["reservee_middle_name"]) ? " " . $row["reservee_middle_name"] . " " : " ";
                    $reserveeSuffixName = !empty($row["reservee_suffix_name"]) ? ", " . $row["reservee_suffix_name"] . " " : "";
                    $reservee = $row["reservee_first_name"] . $reserveeMiddleName . $row["reservee_last_name"] . $reserveeSuffixName;

                    $assetId = $row["asset_id"];

                    $birthDate = Formatter::formatDate($row["date_of_birth"]);
                    $deathDate = Formatter::formatDate($row["date_of_death"]);
                    $reservationDate = Formatter::formatDateTime($row["created_at"]);
                    $burialDateTime = Formatter::formatDateTime($row["date_time"]);

                    $action = '<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#eventDetailsModal" 
                            data-bs-interred="' . $interred . '" data-bs-reservee="' . $reservee . '" data-bs-asset-id="' . $row["asset_id"] . '"
                            data-bs-burial-type="' . $row["burial_type"] . '" data-bs-relationship="' . $row["relationship"] . '"
                            data-bs-date-of-birth="' . $birthDate . '" data-bs-date-of-death="' . $deathDate . '"
                            data-bs-obituary="' . $row["obituary"] . '" data-bs-reservation-date="' . $reservationDate . '" data-bs-burial-date-time="' . $burialDateTime . '">
                            <i class="bi bi-eye-fill"></i> View Details</button>                        
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#burial-reservation-confirmation" data-bs-burial-reservation-id="' . $row["id"] . '" data-bs-action="approve"><i class="bi bi-check"></i> Approve</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#burial-reservation-confirmation" data-bs-burial-reservation-id="' . $row["id"] . '" data-bs-action="cancel"><i class="bi bi-x"></i> Cancel</button>
                        </div>';

                    TableHelper::startRow();
                    TableHelper::cell($row["date_time"]);
                    TableHelper::cell($prefferedDate);
                    TableHelper::cell($location);
                    TableHelper::cell($interred);
                    TableHelper::cell($reservee);
                    TableHelper::cell($action);
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-burial-reservation-confirmation.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-request-details.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-location.php" ?>

<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>
<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

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
            color: "red", // Color of the rectangle
            weight: 2,
            fillOpacity: 0.4 // Transparency of the rectangle
        }).addTo(map);

        currentRectangle.bindPopup(`
        <b>Asset ID:</b> ${name}`);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const locationLinks = document.querySelectorAll('.location-link');

        locationLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default anchor behavior

                const assetId = event.target.getAttribute('data-asset-id');
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
                    initMap(assetId, latStart, lngStart, latEnd, lngEnd);
                });
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var eventDetailsModal = document.getElementById("eventDetailsModal");
        eventDetailsModal.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget;
            document.getElementById("interredName").textContent = button.getAttribute("data-bs-interred");
            document.getElementById("interredBirthDate").textContent = button.getAttribute("data-bs-date-of-birth");
            document.getElementById("interredDeathDate").textContent = button.getAttribute("data-bs-date-of-death");
            document.getElementById("interredObituary").textContent = button.getAttribute("data-bs-obituary");
            document.getElementById("burialDateTime").textContent = button.getAttribute("data-bs-obituary");
            document.getElementById("reservedBy").textContent = button.getAttribute("data-bs-reservee");
            document.getElementById("relationship").textContent = button.getAttribute("data-bs-relationship");
            document.getElementById("reservationDate").textContent = button.getAttribute("data-bs-reservation-date");
            document.getElementById("burialType").textContent = button.getAttribute("data-bs-burial-type");
            document.getElementById("burialDateTime").textContent = button.getAttribute("data-bs-burial-date-time");
            document.getElementById("assetId").textContent = button.getAttribute("data-bs-asset-id");
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var burialModal = document.getElementById("burial-reservation-confirmation");

        burialModal.addEventListener("show.bs.modal", function(event) {
            var button = event.relatedTarget;
            var burialReservationId = button.getAttribute("data-bs-burial-reservation-id");
            var action = button.getAttribute("data-bs-action");

            var burialReservationConfirmationText = document.getElementById("burial-reservation-confirmation-text");
            burialReservationConfirmationText.textContent = "Are you sure you want to " + action + " this reservation?";

            var inputBurialReservationId = document.getElementById("burial-reservation-id");
            inputBurialReservationId.value = burialReservationId;

            var inputAction = document.getElementById("action");
            inputAction.value = action;
        });
    });
</script>