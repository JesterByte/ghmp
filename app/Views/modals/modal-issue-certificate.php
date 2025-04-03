<!-- Issue Certificate Modal -->
<div class="modal fade" id="issueCertificateModal" tabindex="-1" aria-labelledby="issueCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="issueCertificateModalLabel">Certification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="issueCertificateForm" action="<?= BASE_URL ?>/issue-certificate" method="post">
                    <div class="form-floating">
                        <input type="file" name="certificate" id="certificate" class="form-control" accept=".pdf,.doc,.docx" required>
                        <label for="certificate">Certificate (PDF, DOC, DOCX)</label>
                    </div>
                    <input type="hidden" name="asset_id" id="assetId">
                    <input type="hidden" name="reservation_id" id="reservationId">
                    <input type="hidden" name="payment_option" id="paymentOption">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary" form="issueCertificateForm">Yes</button>
            </div>
        </div>
    </div>
</div>