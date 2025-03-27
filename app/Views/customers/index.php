<?php

use App\Helpers\DisplayHelper;
use App\Helpers\TableHelper;
use App\Utils\Formatter;
use App\Helpers\DateHelper;

$snakeCasePageTitle = Formatter::convertToSnakeCase($pageTitle);
$timeStamp = DateHelper::getTimestamp();
$fileName = "export_{$snakeCasePageTitle}_{$timeStamp}";
?>
<?php include_once VIEW_PATH . "/templates/dataTables-styles.php" ?>

<div class="table-responsive shadow">
    <table class="table table-striped table-hover table-bordered" id="table">
        <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Email Address</th>
                <th class="text-center">Contact Number</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($customersTable as $row) {
                $middleName = !empty($row["middle_name"]) ? " " . $row["middle_name"] . " " : " ";
                $suffix = !empty($row["suffix"]) ? ", " . $row["suffix"] : "";
                $fullName = $row["first_name"] . $middleName . $row["last_name"] . $suffix;

                switch ($row["status"]) {
                    case "Active":
                        $buttonColor = "btn-danger";
                        $buttonText = "Deactivate";
                        $buttonAction = "deactivate";
                        break;
                    case "Deactivated":
                        $buttonColor = "btn-success";
                        $buttonText = "Activate";
                        $buttonAction = "activate";
                        break;
                    default:
                        $buttonColor = "btn-secondary";
                        $buttonText = "Ownership Transferred";
                        $buttonAction = "n/a";
                        break;
                }

                // $buttonColor = $row["status"] == "Active" ? "btn-danger" : "btn-success";
                // $buttonText = $row["status"] == "Active" ? "Deactivate" : "Activate";
                // $buttonAction = $row["status"] == "Active" ? "deactivate" : "activate";

                if ($row["status"] === "Transferred Ownership") {
                    $action = "";
                } else {
                    $action = '<button type="button" class="customer-action-btn btn ' . $buttonColor . '" data-bs-first-name="' . $row["first_name"] . '" data-bs-customer-id="' . $row["id"] . '" data-bs-action="' . $buttonAction . '" data-bs-toggle="modal" data-bs-target="#customer-action">' . $buttonText . '</button>';
                }

                TableHelper::startRow();
                // TableHelper::cell($fullName);
                TableHelper::cell('<a href="#" class="customer-name-link" data-bs-customer-id="' . $row["id"] . '" data-bs-toggle="modal" data-bs-target="#beneficiaries-modal">' . $fullName . '</a>');
                TableHelper::cell($row["email_address"]);
                TableHelper::cell($row["contact_number"]);
                TableHelper::cell($row["status"]);
                TableHelper::cell($action);
                TableHelper::endRow();
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once VIEW_PATH . "/templates/dataTables-scripts.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-update-burial-pricing.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-customer-action.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-beneficiaries.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>

<script>
    autofocusModal("pricing-update-burial-modal", "burial-type");
    // autofocusModal("rates-update-phase-modal", "vat");
</script>

<script>
    createDataTable("#table", "<?= $fileName ?>", true);
</script>

<script>
    const customerActionButtons = document.querySelectorAll(".customer-action-btn");
    const customerIdHidden = document.getElementById("customer-id");
    const actionHidden = document.getElementById("action");
    const customerActionText = document.getElementById("customer-action-text");

    customerActionButtons.forEach(button => {
        button.addEventListener("click", function() {
            const customerId = this.getAttribute("data-bs-customer-id");
            const firstName = this.getAttribute("data-bs-first-name");
            const action = this.getAttribute("data-bs-action");

            switch (action) {
                case "deactivate":
                    customerActionText.innerHTML = "Are you sure you want to deactivate " + firstName + "'s account?";
                    break;
                case "activate":
                    customerActionText.innerHTML = "Are you sure you want to activate " + firstName + "'s account?";
                    break;
            }

            customerIdHidden.value = customerId;
            actionHidden.value = action;
        });
    });
</script>

<script>
    const customerNameLinks = document.querySelectorAll(".customer-name-link");
    const beneficiariesList = document.getElementById("beneficiaries-list");

    customerNameLinks.forEach(link => {
        link.addEventListener("click", async function() {
            const customerId = this.getAttribute("data-bs-customer-id");

            try {
                const response = await fetch("<?= BASE_URL ?>/fetch-beneficiaries/" + customerId);

                if (!response.ok) {
                    throw new Error("Network response was not ok: " + response.statusText);
                }

                const data = await response.json();
                const beneficiaries = data.beneficiaries;

                beneficiariesList.innerHTML = "";

                if (beneficiaries.length > 0) {
                    beneficiaries.forEach(beneficiary => {
                        const listItem = document.createElement("li");
                        listItem.className = "list-group-item";
                        listItem.textContent = beneficiary.first_name + " " +
                            (beneficiary.middle_name || "") + " " +
                            beneficiary.last_name +
                            (beneficiary.suffix_name ? ", " + beneficiary.suffix_name : "");

                        beneficiariesList.appendChild(listItem);
                    });
                } else {
                    beneficiariesList.innerHTML = '<li class="list-group-item">No beneficiaries found.</li>';
                }
            } catch (error) {
                beneficiariesList.innerHTML = '<li class="list-group-item text-danger">Failed to fetch beneficiaries.</li>';
                console.error("Error fetching beneficiaries:", error);
            }
        });
    });
</script>