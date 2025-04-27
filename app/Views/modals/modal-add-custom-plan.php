<!-- Add Custom Payment Plan Modal -->
<div class="modal fade" id="add-custom-payment-plan-modal" tabindex="-1" aria-labelledby="add-custom-payment-plan-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="add-custom-payment-plan-modal-label">Add Custom Payment Plan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add-custom-payment-plan" id="add-custom-payment-plan-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                        <select name="phase" required id="phase" class="form-select">
                            <option value="Phase 1">1</option>
                            <option value="Phase 2">2</option>
                            <option value="Phase 3">3</option>
                            <option value="Phase 4">4</option>
                        </select>
                        <label for="phase">Phase</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="lot_type" required id="lot-type" class="form-select">
                            <option value="Supreme">Supreme</option>
                            <option value="Special">Special</option>
                            <option value="Standard">Standard</option>
                        </select>
                        <label for="lot-type">Lot Type</label>
                    </div>

                    <label for="new-lot-price" class="form-label">Total Purchase Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" id="new-lot-price" name="new-lot-price" aria-label="Amount (to the nearest peso)" placeholder="0.00" required>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="term" required placeholder="Term (Years)" id="term" class="form-control">
                        <label for="term">Term (Years)</label>
                    </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="add-custom-payment-plan-form" name="add-custom-payment-plan-submit">Add Payment</button>
            </div>
        </div>
    </div>
</div>