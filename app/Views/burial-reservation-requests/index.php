<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Utils\Encryption;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>
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

                    $location = Formatter::formatAssetId($row["asset_id"]);

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
                            data-bs-interred="' . $interred . '" data-bs-reservee="' . $reservee . '" data-bs-asset-id="' . $location . '"
                            data-bs-burial-type="' . $row["burial_type"] . '" data-bs-relationship="' . $row["relationship"] . '"
                            data-bs-date-of-birth="' . $birthDate . '" data-bs-date-of-death="' . $deathDate . '"
                            data-bs-obituary="' . $row["obituary"] . '" data-bs-reservation-date="' . $reservationDate . '" data-bs-burial-date-time="' . $burialDateTime . '">
                            <i class="bi bi-eye-fill"></i> View Details</button>                        
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#burial-reservation-confirmation" data-bs-asset-id="' . $assetId . '" data-bs-action="approve"><i class="bi bi-check"></i> Approve</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#burial-reservation-confirmation" data-bs-asset-id="' . $assetId . '" data-bs-action="cancel"><i class="bi bi-x"></i> Cancel</button>
                        </div>';

                    TableHelper::startRow();
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

<!-- Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailsModalLabel">Burial Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Interred Information</h6>
                        <p><strong>Name:</strong> <span id="interredName"></span></p>
                        <p><strong>Birth Date:</strong> <span id="interredBirthDate"></span></p>
                        <p><strong>Death Date:</strong> <span id="interredDeathDate"></span></p>
                        <p><strong>Obituary:</strong> <span id="interredObituary"></span></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Reservation Information</h6>
                        <p><strong>Reserved By:</strong> <span id="reservedBy"></span></p>
                        <p><strong>Relationship:</strong> <span id="relationship"></span></p>
                        <p><strong>Reservation Date:</strong> <span id="reservationDate"></span></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6>Burial Details</h6>
                        <p><strong>Burial Type:</strong> <span id="burialType"></span></p>
                        <p><strong>Burial Date & Time:</strong> <span id="burialDateTime"></span></p>
                        <p><strong>Asset ID:</strong> <span id="assetId"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
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
            var assetId = button.getAttribute("data-bs-asset-id");
            var action = button.getAttribute("data-bs-action");

            var burialReservationConfirmationText = document.getElementById("burial-reservation-confirmation-text");
            burialReservationConfirmationText.textContent = "Are you sure you want to " + action + " this reservation?";

            var inputAssetId = document.getElementById("asset-id");
            inputAssetId.value = assetId;

            var inputAction = document.getElementById("action");
            inputAction.value = action;
        });
    });
</script>