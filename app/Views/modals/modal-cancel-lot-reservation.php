<!-- Modal for Lot Reservation Cancellation -->
<div class="modal fade" id="lot-reservation-cancellation" tabindex="-1" aria-labelledby="lot-reservation-cancellation-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="lot-reservation-cancellation-label">Lot Reservation Cancellation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="<?= BASE_URL . "/lot-reservation-cancellation" ?>" method="post">
                    <p>Are you sure you want to cancel this reservation?</p>
                    <input type="hidden" name="lot_id" id="lot-id">
                    <input type="hidden" name="reservee_id" id="reservee-id">

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>