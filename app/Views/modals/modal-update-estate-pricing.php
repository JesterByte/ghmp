<!-- Update Estate Price Modal -->
<div class="modal fade" id="pricing-update-estate-modal" tabindex="-1" aria-labelledby="pricing-update-estate-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header text-bg-primary">
            <h1 class="modal-title fs-5" id="pricing-update-estate-modal-label">Update Estate Pricing</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="estate-pricing" method="post" class="needs-validation" novalidate>
                <div class="form-floating mb-3">
                    <select class="form-select" id="estate" name="estate" aria-label="Floating label select example" required>
                        <option selected disabled></option>
                        <option value="Estate A">A</option>
                        <option value="Estate B">B</option>
                        <option value="Estate C">C</option>
                    </select>
                    <label for="estate">Estate</label>                
                </div>
                <label for="new-estate-price" class="form-label">New Estate Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">₱</span>
                    <input type="number" class="form-control" step="0.01" id="new-estate-price" name="new-estate-price" aria-label="Amount (to the nearest peso)" placeholder="0.00" required>
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