<!-- Modal for Burial Reservation Confirmation -->
<div class="modal fade" id="burial-reservation-confirmation" tabindex="-1" aria-labelledby="burial-reservation-confirmation-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="burial-reservation-confirmation-label">Burial Reservation Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL . "/burial-reservation-confirmation" ?>" method="post" onsubmit="showSpinner(event)">
                    <p id="burial-reservation-confirmation-text"></p>
                    <input type="hidden" name="burial_reservation_id" id="burial-reservation-id">
                    <input type="hidden" name="action" id="action">
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" id="submit-button" class="btn btn-primary">
                            <span id="button-text">Yes</span>
                            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showSpinner(event) {
        event.preventDefault(); // Prevent immediate submission
        
        const button = document.getElementById("submit-button");
        const buttonText = document.getElementById("button-text");
        const spinner = document.getElementById("spinner");

        button.disabled = true; // Disable button to prevent multiple clicks
        buttonText.classList.add("d-none"); // Hide text
        spinner.classList.remove("d-none"); // Show spinner

        // Submit the form after a short delay (to allow UI update)
        setTimeout(() => event.target.submit(), 500);
    }
</script>
