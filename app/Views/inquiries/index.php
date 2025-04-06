<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Utils\Formatter;
use App\Helpers\DisplayHelper;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";

// $formattedPendingDownPayments = [];
// $formattedOngoingInstallments = [];

// foreach ($pendingDownPayments as $pendingDownPayment) {
//     $formattedPendingDownPayments["asset"][] = Formatter::formatAssetId($pendingDownPayment["asset_id"]);
//     $formattedPendingDownPayments["asset_id"][] = $pendingDownPayment["asset_id"];
//     $formattedPendingDownPayments["down_payment"][] = Formatter::formatCurrency($pendingDownPayment["down_payment"]);
// }

// foreach ($ongoingInstallments as $ongoingInstallment) {
//     $formattedOngoingInstallments["asset"][] = Formatter::formatAssetId($ongoingInstallment["asset_id"]);
//     $formattedOngoingInstallments["asset_id"][] = $ongoingInstallment["asset_id"];
//     $formattedOngoingInstallments["monthly_payment"][] = Formatter::formatCurrency($ongoingInstallment["monthly_payment"]);
// }
?>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Sorter</th>
                <th class="text-center">Inquirer</th>
                <th class="text-center">Email Address</th>
                <th class="text-center">Message</th>
                <th class="text-center">Date Submitted</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($inquiriesTable as $row) {
                if (!empty($inquiriesTable)) {
                    $inquirer = strip_tags($row["name"]);
                    $email = strip_tags($row["email"]);
                    $message = strip_tags($row["message"]);

                    if ($row["status"] === "unread") {
                        $action = "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#reply-inquiry-modal' data-bs-inquiry-id='{$row["id"]}' data-bs-email='{$email}'><i class='bi bi-reply-fill'></i> Reply</button>";
                    } else {
                        $action = '<button type="button" class="btn btn-success" disabled><i class="bi bi-check-circle-fill"></i> Answered</button>';
                    }

                    $dateSubmitted = date("F j, Y", strtotime($row["created_at"]));
                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($inquirer);
                    TableHelper::cell($email);
                    TableHelper::cell($message);
                    TableHelper::cell($dateSubmitted);
                    TableHelper::cell($action);
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-record-monthly-payment.php" ?>
<?php // include_once VIEW_PATH . "/modals/modal-add-down-payment.php" 
?>
<?php include_once VIEW_PATH . "/modals/modal-view-receipt.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-reply-inquiry.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    // autofocusModal("add-down-payment-modal", "asset-id");
    autofocusModal("record-monthly-payment-modal", "asset-id");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>");
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const replyModal = document.getElementById('reply-inquiry-modal');
        const inquiryIdHidden = document.getElementById("inquiryId");
        if (replyModal) {
            replyModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const recipientEmail = button.getAttribute('data-bs-email');
                const inquiryId = button.getAttribute("data-bs-inquiry-id");
                const recipientInput = replyModal.querySelector('#recipient-email');
                recipientInput.value = recipientEmail;
                inquiryIdHidden.value = inquiryId;
            });
        }
    });
</script>