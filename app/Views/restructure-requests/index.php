<?php

use App\Helpers\TableHelper;
use App\Helpers\DateHelper;
use App\Helpers\DisplayHelper;
use App\Utils\Formatter;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>

<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>
<div class="table-responsive-sm shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th>Created At</th>
                <th class="text-center">Request Date</th>
                <th class="text-center">Asset</th>
                <th class="text-center">Customer</th>
                <th class="text-center">Payment Option</th>
                <th class="text-center"><i class="bi bi-hand-index-thumb-fill"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($requests as $row) {
                if (!empty($requests)) {
                    $assetId = isset($row["lot_id"]) ? $row["lot_id"] : $row["estate_id"];
                    $formatteddAssetId = Formatter::formatAssetId($assetId);
                    $customer = Formatter::formatFullName($row["first_name"], $row["middle_name"], $row["last_name"], $row["suffix_name"]);
                    $requestDate = Formatter::formatDateTime($row["created_at"]);
                    $paymentOption = isset($row["lot_payment_option"]) ? $row["lot_payment_option"] : $row["estate_payment_option"];

                    switch ($row["status"]) {
                        case "Pending":
                            $action = '
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-success btn-sm restructure-action-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#restructure-request-confirmation"
                                        data-request-id="' . $row["id"] . '"
                                        data-asset-id="' . $assetId . '"
                                        data-customer-id="' . $row["customer_id"] . '"
                                        data-reservation-id="' . $row["reservation_id"] . '"
                                        data-payment-option="' . $paymentOption . '"
                                        data-action="approve"
                                        data-cancel-reason-required="false"
                                        title="Approve Request">
                                        <i class="bi bi-check-circle-fill"></i> Approve
                                    </button>
                    
                                    <button class="btn btn-danger btn-sm restructure-action-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#restructure-request-confirmation"
                                        data-request-id="' . $row["id"] . '"
                                        data-asset-id="' . $assetId . '"
                                        data-customer-id="' . $row["customer_id"] . '"
                                        data-reservation-id="' . $row["reservation_id"] . '"
                                        data-payment-option="' . $paymentOption . '"
                                        data-action="cancel"
                                        data-cancel-reason-required="true"
                                        title="Cancel Request">
                                        <i class="bi bi-x-circle-fill"></i> Cancel
                                    </button>
                                </div>
                            ';
                            break;

                        case "Approved":
                            $action = '<span class="badge bg-success w-100">Approved</span>';
                            break;

                        case "Cancelled":
                            $action = '<span class="badge bg-danger w-100">Cancelled</span>';
                            break;

                        default:
                            $action = '';
                            break;
                    }

                    TableHelper::startRow();
                    TableHelper::cell($row["created_at"]);
                    TableHelper::cell($requestDate);
                    TableHelper::cell($formatteddAssetId);
                    TableHelper::cell($customer);
                    TableHelper::cell($paymentOption);
                    TableHelper::cell($action);
                    TableHelper::endRow();
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-restructure-confirmation.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    createDataTable("#table", "<?= $fileName ?>");

    let currentBalance = 0;

    const discountInput = document.getElementById("discount");
    const finalAmountBox = document.getElementById("final-amount-box");
    const finalAmountDisplay = document.getElementById("final-amount");

    // Real-time discount calculator with 2 decimal precision
    discountInput.addEventListener("input", function() {
        const discountPercent = parseFloat(this.value);
        if (!isNaN(discountPercent) && currentBalance > 0) {
            const discountValue = (discountPercent / 100) * currentBalance;
            const finalAmount = currentBalance - discountValue;

            // Round to 2 decimal places
            const roundedAmount = Math.round(finalAmount * 100) / 100;

            document.getElementById("discounted-price").value = roundedAmount;

            finalAmountDisplay.textContent = `₱${roundedAmount.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })}`;
            finalAmountBox.style.display = "block";
        } else {
            finalAmountBox.style.display = "none";
        }
    });

    // Handle restructure modal field population
    document.querySelectorAll(".restructure-action-btn").forEach(button => {
        button.addEventListener("click", async function() {
            const requestId = this.dataset.requestId;
            const assetId = this.dataset.assetId;
            const customerId = this.dataset.customerId;
            const reservationId = this.dataset.reservationId;
            const paymentOption = this.dataset.paymentOption;
            const action = this.dataset.action;
            const cancelReasonRequired = this.dataset.cancelReasonRequired === "true";

            document.getElementById("request-id").value = requestId;
            document.getElementById("asset-id").value = assetId;
            document.getElementById("customer-id").value = customerId;
            document.getElementById("reservation-id").value = reservationId;
            document.getElementById("payment-option").value = paymentOption;
            document.getElementById("action").value = action;

            const confirmationText = document.getElementById("restructure-request-confirmation-text");
            const reasonGroup = document.getElementById("cancel-reason-group");
            const discountGroup = document.getElementById("discount-group");
            const balanceBox = document.getElementById("remaining-balance-box");
            const balanceDisplay = document.getElementById("remaining-balance");

            if (action === "approve") {
                confirmationText.textContent = "Are you sure you want to approve this restructure request?";
                discountGroup.style.display = "block";
                reasonGroup.style.display = "none";
                document.getElementById("cancel-reason").required = false;

                try {
                    const response = await fetch(`<?= BASE_URL ?>/restructure-requests/get-remaining-balance?reservation_id=${reservationId}&asset_id=${assetId}&payment_option=${paymentOption}`);
                    const data = await response.json();

                    if (data.success) {
                        currentBalance = parseFloat(data.remaining_balance);

                        balanceDisplay.textContent = `₱${currentBalance.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                        })}`;
                        balanceBox.style.display = "block";

                        // Trigger initial calculation
                        const discountVal = parseFloat(discountInput.value);
                        if (!isNaN(discountVal)) {
                            discountInput.dispatchEvent(new Event("input"));
                        }

                    } else {
                        balanceDisplay.textContent = "Unavailable";
                        balanceBox.style.display = "block";
                        finalAmountBox.style.display = "none";
                    }
                } catch (error) {
                    balanceDisplay.textContent = "Error fetching balance";
                    balanceBox.style.display = "block";
                    finalAmountBox.style.display = "none";
                    console.error("Error fetching remaining balance:", error);
                }
            } else {
                confirmationText.textContent = "Are you sure you want to cancel this restructure request?";
                reasonGroup.style.display = cancelReasonRequired ? "block" : "none";
                document.getElementById("cancel-reason").required = cancelReasonRequired;

                discountGroup.style.display = "none";
                balanceBox.style.display = "none";
                finalAmountBox.style.display = "none";
            }
        });
    });
</script>

<script>
    const restructureForm = document.querySelector("#restructure-request-confirmation form");
    let allowFinalSubmit = false;

    restructureForm.addEventListener("submit", function(e) {
        if (!allowFinalSubmit) {
            e.preventDefault(); // Prevent immediate submission
            document.getElementById("second-confirm-trigger").click(); // Trigger second modal
        }
    });

    // Final confirmation button
    document.getElementById("confirm-final-submit").addEventListener("click", function() {
        allowFinalSubmit = true;
        restructureForm.submit();
    });
</script>