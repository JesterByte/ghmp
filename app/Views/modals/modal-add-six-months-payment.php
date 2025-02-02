<!-- Update Add 6 Months Payment Modal -->
<div class="modal fade" id="add-six-months-payment-modal" tabindex="-1" aria-labelledby="add-six-months-payment-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-six-months-payment-modal-label">Add New 6 Months Payment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="add-six-months-payment" method="post" class="needs-validation" novalidate>     
                <div class="form-floating">
                    <select class="form-select" id="asset-id" name="asset-id" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <?php
                            if (!empty($formattedReservationsTable)) {
                                for ($i = 0; $i < count($formattedReservationsTable["asset"]); $i++) {
                                    echo "<option value='{$formattedReservationsTable["asset_id"][$i]}'>{$formattedReservationsTable["asset"][$i]} ({$formattedReservationsTable["payment_amount"][$i]})</option>";
                                }
                            }
                        ?>
                    </select>
                    <label for="asset-id">Reservation</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="add-six-months-payment-submit">Add Payment</button>
            </form>
        </div>
        </div>
    </div>
</div>