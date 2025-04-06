<!-- Mark as Done Modal -->
<div class="modal fade" id="confirmDoneModal" tabindex="-1" aria-labelledby="confirmDoneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="confirmDoneModalLabel">Confirm Completion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to mark this reservation as done?
                <input type="hidden" id="selectedEventId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="markAsDoneSubmit">Yes</button>
            </div>
        </div>
    </div>
</div>