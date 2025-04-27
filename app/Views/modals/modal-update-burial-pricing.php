<!-- Update Burial Price Modal -->
<div class="modal fade" id="pricing-update-burial-modal" tabindex="-1" aria-labelledby="pricing-update-burial-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="pricing-update-burial-modal-label">Update Burial Pricing</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL . "/burial-pricing" ?>" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="category" id="category" value="<?= $category ?>">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="burial-type" name="burial-type" aria-label="Floating label select example" required>
                            <option selected disabled></option>
                            <?php if ($category == "Lot"): ?>
                                <option value="Full Body">Full Body</option>
                                <option value="Cremation">Cremation</option>
                            <?php elseif ($category == "Estate"): ?>
                                <option value="Mausoleum">Mausoleum</option>
                            <?php endif; ?>
                            <option value="Bone Transfer">Bone Transfer</option>
                        </select>
                        <label for="burial-type">Burial Type</label>
                    </div>
                    <label for="new-price" class="form-label">New Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" id="new-price" name="new-price" step="0.01" min="0" aria-label="Amount (to the nearest peso)" placeholder="0.00" required>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const burialType = document.getElementById("burial-type");
        const newPrice = document.getElementById("new-price");

        // Predefined prices from PHP
        const prices = {
            "Full Body": <?= (float) ($standardPrice ?? 0) ?>,
            Cremation: <?= (float) ($cremationPrice ?? 0) ?>,
            Mausoleum: <?= (float) ($mausoleumPrice ?? 0) ?>,
            "Bone Transfer": <?= (float) ($boneTransferPrice ?? 0) ?>
        };

        // Update price when burial type changes
        burialType.addEventListener("change", function() {
            newPrice.value = prices[burialType.value] || 0;
        });

        // Reset price when modal is opened
        document.getElementById("pricing-update-burial-modal").addEventListener("show.bs.modal", function() {
            burialType.value = ""; // Reset selection
            newPrice.value = ""; // Clear input
        });
    });
</script>