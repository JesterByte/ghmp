<!-- Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="eventDetailsModalLabel">Burial Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Interred Information</h6>
                        <p><strong>Name:</strong> <span id="interredName" class="text-wrap"></span></p>
                        <p><strong>Birth Date:</strong> <span id="interredBirthDate"></span></p>
                        <p><strong>Death Date:</strong> <span id="interredDeathDate"></span></p>
                        <p><strong>Obituary:</strong> <span id="interredObituary" class="text-break"></span></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Reservation Information</h6>
                        <p><strong>Reserved By:</strong> <span id="reservedBy"></span></p>
                        <p><strong>Relationship:</strong> <span id="relationship"></span></p>
                        <p><strong>Reservation Date:</strong> <span id="reservationDate"></span></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6>Burial Details</h6>
                        <p><strong>Burial Type:</strong> <span id="burialType"></span></p>
                        <p><strong>Burial Date & Time:</strong> <span id="burialDateTime"></span></p>
                        <p><strong>Asset ID:</strong> <span id="assetId" class="text-break"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>