<?php

use App\Helpers\DisplayHelper;
use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

?>
<div class="row my-3">
    <div class="col">
        <div class="d-flex justify-content-end">
            <div class="btn-group">
                <a href="fully-paids-cash-sale" class="btn btn-outline-primary <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Cash Sale", "aria-current='page'") ?>>Cash Sale</a>
                <a href="fully-paids-six-months" class="btn btn-outline-primary <?= DisplayHelper::isActivePage($currentTable, "6 Months", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "6 Months", "aria-current='page'") ?>>6 Months</a>
                <a href="fully-paids-installment" class="btn btn-outline-primary <?= DisplayHelper::isActivePage($currentTable, "Installment", "active") ?>" <?= DisplayHelper::isActivePage($currentTable, "Installment", "aria-current='page'") ?>>Installment</a>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Sorter</th>
                <th class="text-center">Completed On</th>
                <th class="text-center">Asset</th>
                <th class="text-center">Reservee</th>
                <th class="text-center">Payment Amount</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($fullyPaidsTable as $row) {
                if (!empty($fullyPaidsTable)) {
                    $assetId = Formatter::formatAssetId($row["asset_id"]);
                    $reservee = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);

                    if ($currentTable == "Installment") {
                        $paymentAmount = Formatter::formatCurrency($row["down_payment"] + $row["payment_amount"]);
                    } else {
                        $paymentAmount = Formatter::formatCurrency($row["payment_amount"]);
                    }
                    $completedOn = Formatter::formatDateTime($row["updated_at"]);

                    if ($row["certificate"] === NULL && $row["issued_at"] === NULL) {
                        $action = '<button type="button" class="issue-certificate-btn btn btn-success" data-bs-asset-id="' . $row["asset_id"] . '" data-bs-reservation-id="' . $row["id"] . '" data-bs-toggle="modal" data-bs-target="#issueCertificateModal">
                                          <i class="bi bi-file-earmark-fill"></i> Issue Certificate
                                       </button>';
                    } else {
                        // Show "View Certificate" button
                        $action = '<button type="button" class="view-certificate-btn btn btn-info" data-bs-toggle="modal" data-bs-target="#viewCertificateModal" 
                                        data-bs-file="' . BASE_URL . '/uploads/certificates/' . $row["certificate"] . '">
                                        <i class="bi bi-eye-fill"></i> View Certificate
                                      </button>
                                      <a href="' . BASE_URL . '/uploads/certificates/' . $row["certificate"] . '" class="btn btn-outline-secondary" download>
                                        <i class="bi bi-download"></i> Download
                                      </a>';
                    }


                    TableHelper::startRow();
                    TableHelper::cell($row["updated_at"]);
                    TableHelper::cell($completedOn);
                    TableHelper::cell($assetId);
                    TableHelper::cell($reservee);
                    TableHelper::cell($paymentAmount);
                    TableHelper::cell($action);
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-issue-certificate.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-view-certificate.php" ?>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const issueCertificateButtons = document.querySelectorAll(".issue-certificate-btn");
        const assetIdHidden = document.getElementById("assetId");
        const reservationIdHidden = document.getElementById("reservationId");
        const paymentOptionHidden = document.getElementById("paymentOption");

        issueCertificateButtons.forEach(button => {
            button.addEventListener("click", function() {
                const assetId = this.getAttribute("data-bs-asset-id");
                const reservationId = this.getAttribute("data-bs-reservation-id");

                assetIdHidden.value = assetId;
                reservationIdHidden.value = reservationId;
                paymentOptionHidden.value = "<?= $currentTable ?>";
            });
        });
    });
</script>