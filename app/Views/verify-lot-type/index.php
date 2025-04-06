<?php

use App\Utils\Formatter;

$latStart = (float) $lot["latitude_start"];
$latEnd = (float) $lot["latitude_end"];
$longStart = (float) $lot["longitude_start"];
$longEnd = (float) $lot["longitude_end"];
$lotId = $lot["lot_id"];

$lotIdComponents = Formatter::extractComponents($lot["lot_id"]);
$phaseNumber = $lotIdComponents["phase"];
$lawnLetter = $lotIdComponents["lawn"];
$rowNumber = $lotIdComponents["row"];
$lotNumber = $lotIdComponents["lot"];
?>

<link rel="stylesheet" href="<?= BASE_URL . "/css/leaflet.css" ?>">
<link rel="stylesheet" href="<?= BASE_URL . "/css/map.css" ?>">

<div class="container-fluid">
    <div class="row">
        <!-- Map Column -->
        <div class="col-md-8">
            <div id="map" class="rounded shadow d-flex justify-content-center align-items-center" style="height: 500px;">
                <!-- Loading placeholder -->
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <!-- Form Column -->
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Instruction Text -->
                    <p class="card-text">
                        Please verify the distance of the lot to the road and select the appropriate lot type.
                        Ensure that the lot is accurately assessed before making a selection.
                    </p>

                    <form id="lotTypeForm" class="" action="<?= BASE_URL . "/verify-lot-type-submit" ?>" method="post">
                        <div class="mb-3">
                            <input type="hidden" name="lot-id" value="<?= $lotId ?>">
                            <input type="hidden" name="reservee-id" value="<?= $reserveeId ?>">
                            <label for="lotType" class="form-label">Lot Type</label>
                            <select id="lotType" name="lot-type" class="form-select" required>
                                <option value="" disabled selected>Select Lot Type</option>
                                <option value="Supreme">Supreme</option>
                                <option value="Special">Special</option>
                                <option value="Standard">Standard</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" id="reviewButton" class="btn btn-primary">Submit</button>
                            <a href="<?= BASE_URL . "/lot-reservation-requests" ?>" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Choice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please review your selection:</p>
                <p><strong>Lot Type:</strong> <span id="reviewLotType"></span></p>
                <!-- Warning Message -->
                <div class="alert alert-warning mt-3">
                    <strong>Warning:</strong> Once you submit the lot type, it cannot be changed later due to the complex structure of the process. Please ensure your selection is accurate.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmSubmit" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("lotTypeForm");
        const reviewButton = document.getElementById("reviewButton");
        const confirmSubmitButton = document.getElementById("confirmSubmit");
        const reviewLotType = document.getElementById("reviewLotType");

        // Show the confirmation modal when "Submit" is clicked
        reviewButton.addEventListener("click", function() {
            const selectedLotType = document.getElementById("lotType").value;

            if (!selectedLotType) {
                alert("Please select a lot type.");
                return;
            }

            // Update the modal content with the selected lot type
            reviewLotType.textContent = selectedLotType;

            // Show the confirmation modal
            const confirmationModal = new bootstrap.Modal(document.getElementById("confirmationModal"));
            confirmationModal.show();
        });

        // Submit the form when "Confirm" is clicked in the modal
        confirmSubmitButton.addEventListener("click", function() {
            form.submit();
        });
    });
</script>

<script>
    // Initialize the map
    var map = L.map("map").setView([14.871318, 120.976566], 21); // Default view, will be updated

    // Add the OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 21
    }).addTo(map);

    const lotWidth = 0.000009;
    const lotHeight = 0.000018;

    const color = "green";

    // Calculate the center of the rectangle
    const latCenter = (<?= $latStart ?> + <?= $latEnd ?>) / 2;
    const longCenter = (<?= $longStart ?> + <?= $longEnd ?>) / 2;

    // Set the map view to the center of the rectangle
    map.setView([latCenter, longCenter], 19);

    // Create a rectangle for the lot
    const rectangle = L.rectangle(
        [
            [<?= $latStart ?>, <?= $longStart ?>],
            [<?= $latEnd ?>, <?= $longEnd ?>]
        ], {
            color: color,
            weight: 1,
            fillOpacity: 0.5
        }
    ).addTo(map);

    // Add a popup to the rectangle
    rectangle.bindPopup(`
    <b>Phase:</b> <?= $phaseNumber ?><br>
    <b>Lawn:</b> <?= $lawnLetter ?><br>
    <b>Row:</b> <?= $rowNumber ?><br>
    <b>Lot:</b> <?= $lotNumber ?>
    `);
</script>