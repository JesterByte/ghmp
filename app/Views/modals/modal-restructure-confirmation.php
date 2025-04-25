<!-- Modal for Restructure Request Confirmation -->
<div class="modal fade" id="restructure-request-confirmation" tabindex="-1" aria-labelledby="restructure-request-confirmation-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="restructure-request-confirmation-label">Restructure Request Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="<?= BASE_URL . "/restructure-request-confirmation" ?>" method="post">
                    <p id="restructure-request-confirmation-text"></p>
                    <input type="hidden" name="request_id" id="request-id">
                    <input type="hidden" name="asset_id" id="asset-id">
                    <input type="hidden" name="customer_id" id="customer-id">
                    <input type="hidden" name="reservation_id" id="reservation-id">
                    <input type="hidden" name="payment_option" id="payment-option">
                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="discounted_price" id="discounted-price">

                    <!-- Hidden trigger button -->
                    <button type="button" id="second-confirm-trigger" class="d-none" data-bs-toggle="modal" data-bs-target="#second-confirmation-modal"></button>


                    <div class="form-floating mb-3" id="cancel-reason-group">
                        <input type="text" name="cancel_reason" id="cancel-reason" class="form-control" placeholder="Reason" required>
                        <label for="cancel-reason">Reason</label>
                    </div>

                    <!-- Remaining Balance Display -->
                    <div class="alert alert-info" id="remaining-balance-box" style="display: none;">
                        Remaining Balance: <strong><span id="remaining-balance">₱0.00</span></strong>
                    </div>

                    <!-- New Discount Input (Initially Hidden) -->
                    <div class="form-floating mb-3" id="discount-group" style="display: none;">
                        <input type="number" name="discount" id="discount" class="form-control" placeholder="Discount" min="0" step="0.01" required>
                        <label for="discount">Discount (%)</label>
                    </div>

                    <!-- Final Amount After Discount -->
                    <div class="alert alert-success" id="final-amount-box" style="display: none;">
                        Final Amount After Discount: <strong><span id="final-amount">₱0.00</span></strong>
                    </div>


                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Second Confirmation Modal -->
<div class="modal fade" id="second-confirmation-modal" tabindex="-1" aria-labelledby="second-confirmation-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-warning">
                <h5 class="modal-title" id="second-confirmation-label">Final Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you absolutely sure you want to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" id="confirm-final-submit" class="btn btn-primary">Yes, continue</button>
            </div>
        </div>
    </div>
</div>