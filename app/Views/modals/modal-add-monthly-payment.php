<!-- Update Add Monthly Payment Modal -->
<div class="modal fade" id="add-monthly-payment-modal" tabindex="-1" aria-labelledby="add-monthly-payment-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-monthly-payment-modal-label">Add New Monthly Payment</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="add-monthly-payment" method="post" class="needs-validation" novalidate>     
                <div class="form-floating">
                    <select class="form-select" id="lot-id" name="lot-id" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <?php
                            if (!empty($formattedOngoingInstallments)) {
                                for ($i = 0; $i < count($formattedOngoingInstallments["lot"]); $i++) {
                                    echo "<option value='{$formattedOngoingInstallments["lot_id"][$i]}'>{$formattedOngoingInstallments["lot"][$i]} ({$formattedOngoingInstallments["monthly_payment"][$i]})</option>";
                                }
                            }
                        ?>
                    </select>
                    <label for="lot-id">Reservation</label>
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