<!-- Modal for Burial Reservation Confirmation -->
<div class="modal fade" id="burial-reservation-confirmation" tabindex="-1" aria-labelledby="burial-reservation-confirmation-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="burial-reservation-confirmation-label">Burial Reservation Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL . "/burial-reservation-confirmation" ?>" method="post">
                    <p id="burial-reservation-confirmation-text"></p>
                    <input type="hidden" name="burial_reservation_id" id="burial-reservation-id">
                    <input type="hidden" name="action" id="action">
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>