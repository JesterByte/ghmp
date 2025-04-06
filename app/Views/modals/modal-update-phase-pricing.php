<!-- Update Phase Price Modal -->
<div class="modal fade" id="pricing-update-phase-modal" tabindex="-1" aria-labelledby="pricing-update-phase-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header text-bg-primary">
            <h1 class="modal-title fs-5" id="pricing-update-phase-modal-label">Update Phase Pricing</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="phase-pricing" method="post" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                    <select class="form-select" id="phase" name="phase" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Phase 1">1</option>
                        <option value="Phase 2">2</option>
                        <option value="Phase 3">3</option>
                        <option value="Phase 4">4</option>
                    </select>
                    <label for="phase">Phase</label>                
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
                <label for="new-lot-price" class="form-label">New Lot Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="number" class="form-control" id="new-lot-price" name="new-lot-price" aria-label="Amount (to the nearest peso)" placeholder="0.00" required>
                </div>               
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="update-pricing-submit">Update</button>
            </form>
        </div>
        </div>
    </div>
</div>