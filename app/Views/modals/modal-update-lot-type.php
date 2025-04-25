<!-- Modal for updating lot type -->
<div class="modal fade" id="update-lot-type" tabindex="-1" aria-labelledby="update-lot-type-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="update-lot-type-label">Update Lot Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-lot-type-form" action="<?= BASE_URL ?>/update-lot-type" method="post">
                    <input type="hidden" name="lot_id" id="lot-id">
                    <input type="hidden" name="datatable_page" id="datatable-page">
                    <div class="form-floating mb-3">
                        <select name="lot_type" id="lot-type" class="form-select" required>
                            <option value="Supreme">Supreme</option>
                            <option value="Special">Special</option>
                            <option value="Standard">Standard</option>
                        </select>
                        <label for="lot-type">Lot Type</label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>