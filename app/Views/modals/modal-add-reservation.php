<!-- Update Add Reservation Modal -->
<div class="modal fade" id="add-reservation-modal" tabindex="-1" aria-labelledby="add-reservation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-reservation-modal-label">Add New Reservation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="add-reservation" method="post" class="needs-validation" novalidate>     
                <div class="form-floating mb-3">
                    <select class="form-select" id="lot" name="lot" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <?php 
                            for ($i = 0; $i < count($formattedAvailableLots["available_lot"]); $i++) {
                                echo "<option value='{$formattedAvailableLots["lot_id"][$i]}'>{$formattedAvailableLots["available_lot"][$i]}</option>";
                            }
                        ?>
                    </select>
                    <label for="lot">Available Lots</label>          
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="customer" name="customer" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <?php 
                            for ($i = 0; $i < count($formattedCustomers["customer_id"]); $i++) {
                                echo "<option value='{$formattedCustomers["customer_id"][$i]}'>{$formattedCustomers["customer"][$i]}</option>";
                            }
                        ?>
                    </select>
                    <label for="customer">Customers</label>          
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="lot-type" name="lot-type" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Supreme">Supreme</option>
                        <option value="Special">Special</option>
                        <option value="Standard">Standard</option>
                    </select>
                    <label for="lot-type">Lot Type</label>          
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="payment-option" name="payment-option" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Cash Sale">Cash Sale</option>
                        <option value="6 Months">6 Months</option>
                        <option value="Installment: 1 year">Installment: 1 year</option>
                        <option value="Installment: 2 years">Installment: 2 years</option>
                        <option value="Installment: 3 years">Installment: 3 years</option>
                        <option value="Installment: 4 years">Installment: 4 years</option>
                        <option value="Installment: 5 years">Installment: 5 years</option>
                    </select>
                    <label for="payment-option">Payment Option</label>          
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="add-reservation-submit">Add</button>
            </form>
        </div>
        </div>
    </div>
</div>