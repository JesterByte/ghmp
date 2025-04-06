<?php

use App\Helpers\DisplayHelper;
use App\Helpers\TableHelper;
use App\Utils\Formatter;
use App\Helpers\DateHelper;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" integrity="sha512-Zcn6bjR/8RZbLEpLIeOwNtzREBAJnUKESxces60Mpoj+2okopSAcSUIUOseddDm0cxnGQzxIR7vJgsLZbdLE3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?= BASE_URL . "/css/map.css" ?>">

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>

<div class="table-responsive shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Sorter</th>
                <th class="text-center">Added by (Customer)</th>
                <th class="text-center">Name</th>
                <th class="text-center">Birth Date</th>
                <th class="text-center">Death Date</th>
                <th class="text-center">Burial Date</th>
                <th class="text-center">Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($deceasedTable as $row) {
                $fullName = '<a href="#" class="obituary-btn" data-bs-toggle="modal" data-bs-target="#obituary-modal" data-bs-name="' . $row["full_name"] . '" data-bs-obituary="' . htmlspecialchars($row["obituary"]) . '">' . htmlspecialchars($row["full_name"]) . '</a>';
                $birthDate = Formatter::formatDate($row["birth_date"]);
                $deathDate = Formatter::formatDate($row["death_date"]);
                $burialDate = Formatter::formatDate($row["burial_date"]);

                $middleName = !empty($row["customer_middle_name"]) ? " " . $row["customer_middle_name"] . " " : " ";
                $suffix = !empty($row["customer_suffix"]) ? ", " . $row["customer_suffix"] : "";
                $customer = $row["customer_first_name"] . $middleName . $row["customer_last_name"] . $suffix;

                // Get the latitude and longitude for the location
                $latitudeStart = $row["lot_lat_start"] ?? $row["estate_lat_start"];  // Assume you have latitude data
                $longitudeStart = $row["lot_lng_start"] ?? $row["estate_lng_start"]; // Assume you have longitude data
                $latitudeEnd = $row["lot_lat_end"] ?? $row["estate_lat_end"];  // Assume you have latitude data
                $longitudeEnd = $row["lot_lng_end"] ?? $row["estate_lng_end"]; // Assume you have longitude data

                $location = '<a href="#" class="location-link" 
                                data-name="' . $row["full_name"] . '"
                                data-lat-start="' . $latitudeStart . '" 
                                data-lng-start="' . $longitudeStart . '" 
                                data-lat-end="' . $latitudeEnd . '" 
                                data-lng-end="' . $longitudeEnd . '">' . Formatter::formatAssetId($row["location"]) . '</a>';

                TableHelper::startRow();
                TableHelper::cell($row["burial_date"]);
                TableHelper::cell($customer);
                TableHelper::cell($fullName);
                TableHelper::cell($birthDate);
                TableHelper::cell($deathDate);
                TableHelper::cell($burialDate);
                TableHelper::cell($location);
                TableHelper::endRow();
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-location.php" ?>

<!-- Modal for Viewing Obituary -->
<div class="modal fade" id="obituary-modal" tabindex="-1" aria-labelledby="obituaryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="obituaryModalLabel">Obituary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="obituary-content">
                <!-- Obituary content will be loaded here -->
            </div>
        </div>
    </div>
</div>


<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>
<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const obituaryLinks = document.querySelectorAll('.obituary-btn');

        obituaryLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const obituary = this.getAttribute('data-bs-obituary');
                const deceasedName = this.getAttribute('data-bs-name');
                const contentDiv = document.getElementById('obituary-content');
                const modalTitle = document.getElementById('obituaryModalLabel');

                modalTitle.textContent = `${deceasedName}'s Obituary`;

                // Format the obituary nicely with a blockquote and optional paragraph formatting
                if (obituary && obituary.trim() !== "") {
                    contentDiv.innerHTML = `
                        <blockquote class="blockquote ps-3 border-start border-4 border-primary">
                            <p class="mb-1" style="white-space: pre-line;">${obituary}</p>
                        </blockquote>
                    `;
                } else {
                    contentDiv.innerHTML = `
                        <p class="text-muted fst-italic">No obituary information available.</p>
                    `;
                }
            });
        });
    });
</script>


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
            color: "gray", // Color of the rectangle
            weight: 2,
            fillOpacity: 0.4 // Transparency of the rectangle
        }).addTo(map);

        // Bind a popup to the rectangle with deceased information
        currentRectangle.bindPopup(`
        <b>Deceased:</b> ${name}`);
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