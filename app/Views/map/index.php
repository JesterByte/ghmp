<?php

use App\Utils\Formatter;
use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
?>

<?php if ($currentPage === "Map"): ?>
    <link rel="stylesheet" href="<?= BASE_URL . "/css/leaflet.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "/css/map.css" ?>">

    <div class="d-flex justify-content-end my-3">
        <a role="button" href="<?= BASE_URL ?>/map-lots-list" class="btn btn-primary"><i class="bi bi-table"></i> List View</a>
    </div>

    <div id="map" class="rounded shadow d-flex justify-content-center align-items-center">
        <!-- Loading placeholder -->
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="<?= BASE_URL . "/js/jquery.js" ?>"></script>
    <script src="<?= BASE_URL . "/js/leaflet.js" ?>"></script>
    <script src="<?= BASE_URL . "/js/GhmpMap.js" ?>"></script>

    <script>
        const map = new GhmpMap("map", "fetch-lots");
    </script>
<?php elseif ($currentPage === "Lots List" || $currentPage === "Estates List"): ?>

    <?php
    $snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
    $timeStamp = DateHelper::getTimestamp();
    $fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
    ?>

    <div class="d-flex justify-content-end my-3">
        <a role="button" href="<?= BASE_URL ?>/map" class="btn btn-primary"><i class="bi bi-map-fill"></i> Map View</a>
    </div>

    <?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
    <div class="table-responsive-sm shadow">
        <table class="table table-striped table-hover table-bordered" id="table">
            <thead>
                <tr>
                    <?php
                    if ($currentPage === "Lots List") {
                        echo '<th class="text-center">Lot Code</th>';
                        echo '<th class="text-center">Lot Type</th>';
                        echo '<th class="text-center">Action</th>';
                    } else if ($currentPage === "Estates List") {
                        echo '<th class="text-center">Estate Code</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $table = isset($lotsList) ? $lotsList : $estatesList;
                foreach ($table as $row) {
                    if (!empty($table)) {
                        $assetCode = isset($row["lot_id"]) ? $row["lot_id"] : $row["estate_id"];
                        $lotType = isset($row["lot_type"]) ? $row["lot_type"] : "";
                        $action = '<button type="button" class="update-lot-type-btn btn btn-warning" data-bs-toggle="modal" data-bs-target="#update-lot-type" data-bs-lot-id="' . $row["lot_id"] . '">Update Lot Type</button>';

                        TableHelper::startRow();
                        TableHelper::cell($assetCode);
                        if ($currentPage === "Lots List") {
                            TableHelper::cell($lotType);
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
    <?php include_once VIEW_PATH . "/modals/modal-update-lot-type.php" ?>

    <script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
    <script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

    <script>
        autofocusModal("update-lot-type", "lot-type");
    </script>

    <script>
        document.addEventListener("click", function(event) {
            const button = event.target.closest(".update-lot-type-btn");
            if (button) {
                const lotId = button.getAttribute("data-bs-lot-id");
                const lotIdHidden = document.getElementById("lot-id");
                if (lotIdHidden) {
                    lotIdHidden.value = lotId;
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = new DataTable("#table");

            // Example: capture current page before form submits
            const form = document.getElementById("update-lot-type-form"); // Replace with your form's ID
            form.addEventListener("submit", function() {
                const pageInput = document.getElementById("datatable-page");
                const currentPage = table.page.info().page + 1; // DataTables uses 0-based index
                pageInput.value = currentPage;
            });
        });
    </script>

    <script>
        const pageParam = new URLSearchParams(window.location.search).get("page");
        if (pageParam && !isNaN(pageParam)) {
            const table = $('#table').DataTable();
            table.page(parseInt(pageParam) - 1).draw('page');
        }
    </script>
<?php endif; ?>