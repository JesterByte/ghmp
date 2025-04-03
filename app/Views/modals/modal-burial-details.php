<!-- Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h5 class="modal-title" id="eventDetailsModalLabel">Burial Reservation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Interred Information</h6>
                        <p><strong>Name:</strong> <span id="interredName"></span></p>
                        <p><strong>Birth Date:</strong> <span id="interredBirthDate"></span></p>
                        <p><strong>Death Date:</strong> <span id="interredDeathDate"></span></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Reservation Information</h6>
                        <p><strong>Reserved By:</strong> <span id="reservedBy"></span></p>
                        <p><strong>Relationship:</strong> <span id="relationship"></span></p>
                        <p><strong>Reservation Date:</strong> <span id="reservationDate"></span></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6 class="fw-bold">Burial Details</h6>
                        <p><strong>Burial Type:</strong> <span id="burialType"></span></p>
                        <p><strong>Burial Date & Time:</strong> <span id="burialDateTime"></span></p>
                        <p><strong>Asset ID:</strong> <span id="assetId"></span></p>
                    </div>
                </div>

                <!-- Receipt Section -->
                <div class="row mt-3">
                    <div class="col-md-12" id="receiptSection" style="display: none;">
                        <h6 class="fw-bold">Receipt</h6>
                        <p><strong>Receipt:</strong></p>
                        <div class="receipt-container" style="display: flex; justify-content: center;">
                            <img id="receiptImage" src="" alt="Receipt" class="img-fluid shadow-lg rounded" style="max-width: 100%; max-height: 300px; transition: transform 0.3s ease;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="markAsDoneBtn" class="btn btn-success" style="display: none;" data-bs-toggle="modal" data-bs-target="#confirmDoneModal" data-bs-dismiss="modal">Mark as Done</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Modal Styles */
    .modal-header {
        background-color: #0044cc;
        color: #ffffff;
        border-bottom: 2px solid #0056b3;
    }

    .modal-title {
        font-weight: bold;
        font-size: 1.25rem;
    }

    .modal-body h6 {
        font-size: 1.1rem;
        color: #333;
    }

    .modal-body p {
        font-size: 1rem;
        color: #555;
        line-height: 1.5;
    }

    /* Hover effect for receipt image */
    .receipt-container img:hover {
        transform: scale(1.05);
    }

    /* Modal Footer Buttons */
    .modal-footer .btn-outline-secondary {
        color: #007bff;
        border: 1px solid #007bff;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .modal-footer .btn-outline-secondary:hover {
        background-color: #007bff;
        color: #fff;
    }

    /* Improved shadow for receipt image */
    .shadow-lg {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
</style>
