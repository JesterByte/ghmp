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
                    <!-- <h5 class="card-title">Verify Lot Type</h5> -->
                    <form class="" action="<?= BASE_URL . "/verify-lot-type-submit" ?>" method="post">
                        <div class="mb-3">
                            <input type="hidden" name="lot-id" value="<?= $lotId ?>">
                            <label for="lotType" class="form-label">Lot Type</label>
                            <select id="lotType" name="lot-type" class="form-select" required>
                                <option value="" disabled selected>Select Lot Type</option>
                                <option value="Supreme">Supreme</option>
                                <option value="Special">Special</option>
                                <option value="Standard">Standard</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= BASE_URL . "/reservation-requests" ?>" class="btn btn-danger">Cancel</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
<script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>

<script>
    // Initialize the map
    var map = L.map("map").setView([14.871318, 120.976566], 18); // Default zoom level 13

    // Add the OpenStreetMap tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 20
    }).addTo(map);

    const lotWidth = 0.000009;
    const lotHeight = 0.000018;

    const color = "green";

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