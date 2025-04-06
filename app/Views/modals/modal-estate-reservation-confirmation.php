<!-- Modal for Estate Reservation Confirmation -->
<div class="modal fade" id="estate-reservation-confirmation" tabindex="-1" aria-labelledby="estate-reservation-confirmation-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="estate-reservation-confirmation-label">Estate Reservation Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL . "/estate-reservation-confirmation" ?>" method="post">
                    <p id="estate-reservation-confirmation-text"></p>
                    <input type="hidden" name="estate_id" id="estate-id">
                    <input type="hidden" name="reservee_id" id="reservee-id">
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