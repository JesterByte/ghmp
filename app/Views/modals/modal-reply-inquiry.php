<!-- Reply Inquiry Modal -->
<div class="modal fade" id="reply-inquiry-modal" tabindex="-1" aria-labelledby="reply-inquiry-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="reply-inquiry-modal-label">Reply to Inquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="reply-inquiry-form" action="<?= BASE_URL ?>/inquiries/reply" method="POST">
                <input type="hidden" name="inquiry_id" id="inquiryId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="recipient-email" class="form-label">To:</label>
                        <input type="email" class="form-control" id="recipient-email" name="recipient_email" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>
</div>