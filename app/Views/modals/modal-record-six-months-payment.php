<!-- Record 6 Months Payment Modal -->
<div class="modal fade" id="record-six-months-payment-modal" tabindex="-1" aria-labelledby="record-six-months-payment-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="record-six-months-payment-modal-label">Record New 6 Months Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="record-six-months-payment" action="<?= BASE_URL ?>/record-six-months-payment" method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                    <div class="form-floating mb-3">
                        <select class="form-select" id="asset-id" name="asset-id" required>
                            <option selected disabled></option>
                            <?php
                            if (!empty($formattedReservationsTable)) {
                                for ($i = 0; $i < count($formattedReservationsTable["asset"]); $i++) {
                                    echo "<option value='{$formattedReservationsTable["asset_id"][$i]}'>{$formattedReservationsTable["asset"][$i]} ({$formattedReservationsTable["monthly_payment"][$i]})</option>";
                                }
                            }
                            ?>
                        </select>
                        <label for="asset-id">Asset</label>
                    </div>

                    <!-- Reservee Name (Read-Only) -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="reservee-name" name="reservee-name" readonly placeholder="Reservee Name">
                        <label for="reservee-name">Reservee Name</label>
                    </div>

                    <!-- Hidden Input for Reservee ID -->
                    <input type="hidden" id="reservee-id" name="reservee-id">

                    <div class="mb-3">
                        <label for="receipt" class="form-label">Upload Receipt</label>
                        <input type="file" class="form-control" id="receipt" name="receipt" accept="image/*" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="record-six-months-payment" name="record-six-months-payment-submit">Record Payment</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("asset-id").addEventListener("change", function() {
            let assetId = this.value;
            if (assetId) {
                fetch("<?= BASE_URL ?>/six-months/reservee", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            asset_id: assetId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Parsed JSON data:", data);
                        if (data.success) {
                            document.getElementById("reservee-name").value = data.reservee_full_name;
                            document.getElementById("reservee-id").value = data.reservee_id;
                        } else {
                            document.getElementById("reservee-name").value = "Reservee not found";
                            document.getElementById("reservee-id").value = "";
                        }
                    })
                    .catch(error => console.error("Fetch error:", error));
            }
        });
    });
</script>