<!-- View Receipt Modal -->
<div class="modal fade" id="view-receipt-modal" tabindex="-1" aria-labelledby="view-receipt-modal-label" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="view-receipt-modal-label">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Image will be loaded here -->
                <img id="receipt-image" src="" alt="Receipt Image" class="rounded img-fluid" />
            </div>
        </div>
    </div>
</div>

<script>
    // Add event listener for when the modal is shown
    document.addEventListener('DOMContentLoaded', function() {
        const receiptModal = document.getElementById('view-receipt-modal');
        receiptModal.addEventListener('show.bs.modal', function(event) {
            // Get the button that triggered the modal
            const button = event.relatedTarget;
            // Extract the receipt URL from the data attribute
            const receiptUrl = button.getAttribute('data-bs-receipt');
            // Set the src attribute of the image in the modal
            const receiptImage = document.getElementById('receipt-image');
            receiptImage.src = receiptUrl;
        });
    });
</script>