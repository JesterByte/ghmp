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
            <li class="breadcrumb-item"><a href="<?= BASE_URL . "/estate-reservations" ?>">Estate Reservations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Requests</li>
        </ol>
    </nav>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Request Date</th>
                <th>Estate</th>
                <th>Reservee</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($estateReservationRequestsTable as $row) {
                    if (!empty($estateReservationRequestsTable)) {
                        $formattedEstateId = Formatter::formatEstateId($row["estate_id"]);
                        $estateId = $row["estate_id"];
                        $reserveeId = $row["reservee_id"];
                        $reservee = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                        $requestDate = Formatter::formatDateTime($row["created_at"]);

                        $action = '<div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#estate-reservation-confirmation" data-bs-estate-id="' . $estateId . '" data-bs-reservee-id="' . $reserveeId . '" data-bs-action="approve"><i class="bi bi-check"></i> Approve</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#estate-reservation-confirmation" data-bs-estate-id="' . $estateId . '" data-bs-reservee-id="' . $reserveeId . '" data-bs-action="cancel"><i class="bi bi-x"></i> Cancel</button>
                        </div>';

                        TableHelper::startRow();
                        TableHelper::cell($requestDate);
                        TableHelper::cell($formattedEstateId);
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
<?php include_once VIEW_PATH . "/modals/modal-estate-reservation-confirmation.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var burialModal = document.getElementById("estate-reservation-confirmation");

        burialModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;
            var estateId = button.getAttribute("data-bs-estate-id");
            var reserveeId = button.getAttribute("data-bs-reservee-id");
            var action = button.getAttribute("data-bs-action");

            var burialReservationConfirmationText = document.getElementById("estate-reservation-confirmation-text");
            burialReservationConfirmationText.textContent = "Are you sure you want to " + action + " this reservation?";

            var inputEstateId = document.getElementById("estate-id");
            inputEstateId.value = estateId;

            var inputReserveeId = document.getElementById("reservee-id");
            inputReserveeId.value = reserveeId;


            var inputAction = document.getElementById("action");
            inputAction.value = action;
        });
    });
</script>