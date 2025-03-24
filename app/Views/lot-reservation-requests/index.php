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
                    $formattedLotId = Formatter::formatLotId($row["lot_id"]);
                    $lotId = $row["lot_id"];
                    $reservee = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $reserveeId = $row["reservee_id"];
                    $requestDate = Formatter::formatDateTime($row["created_at"]);

                    TableHelper::startRow();
                    TableHelper::cell($requestDate);
                    TableHelper::cell($formattedLotId);
                    TableHelper::cell($reservee);
                    TableHelper::cell($row["lot_type"]);
                    TableHelper::cell('<div class="btn-group" role="group" aria-label="Basic example">
                        <a role="button" href="verify-lot-type/' . Encryption::encrypt($row["lot_id"], $secretKey) . '" class="btn btn-success">
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

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

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
