<!-- Update Add Estate Reservation Modal -->
<div class="modal fade" id="add-estate-reservation-modal" tabindex="-1" aria-labelledby="add-estate-reservation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="add-estate-reservation-modal-label">Add New Estate Reservation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="add-reservation-estate" method="post" class="needs-validation" novalidate>     
                <div class="form-floating mb-3">
                    <select class="form-select" id="estate" name="estate" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <?php 
                            for ($i = 0; $i < count($formattedAvailableEstates["available_estate"]); $i++) {
                                echo "<option value='{$formattedAvailableEstates["estate_id"][$i]}'>{$formattedAvailableEstates["available_estate"][$i]}</option>";
                            }
                        ?>
                    </select>
                    <label for="estate">Available Estate</label>          
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
                    <select class="form-select" id="payment-option" name="payment-option" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Cash Sale">Cash Sale</option>
                        <option value="6 Months">6 Months</option>
                        <option value="Installment: 1 Year">Installment: 1 Year</option>
                        <option value="Installment: 2 Years">Installment: 2 Years</option>
                        <option value="Installment: 3 Years">Installment: 3 Years</option>
                        <option value="Installment: 4 Years">Installment: 4 Years</option>
                        <option value="Installment: 5 Years">Installment: 5 Years</option>
                    </select>
                    <label for="payment-option">Payment Option</label>          
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="add-estate-reservation-submit">Add</button>
            </form>
        </div>
        </div>
    </div>
</div>