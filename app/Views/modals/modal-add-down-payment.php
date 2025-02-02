<!-- Update Add Down Payment Modal -->
<div class="modal fade" id="add-down-payment-modal" tabindex="-1" aria-labelledby="add-down-payment-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-down-payment-modal-label">Add New Down Payment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="add-down-payment" method="post" class="needs-validation" novalidate>     
                <div class="form-floating">
                    <select class="form-select" id="asset-id" name="asset-id" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <?php
                            if (!empty($formattedPendingDownPayments)) {
                                for ($i = 0; $i < count($formattedPendingDownPayments["asset"]); $i++) {
                                    echo "<option value='{$formattedPendingDownPayments["asset_id"][$i]}'>{$formattedPendingDownPayments["asset"][$i]} ({$formattedPendingDownPayments["down_payment"][$i]})</option>";
                                }
                            }
                        ?>
                    </select>
                    <label for="asset-id">Reservation</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="add-cash-sale-payment-submit">Add Payment</button>
            </form>
        </div>
        </div>
    </div>
</div>