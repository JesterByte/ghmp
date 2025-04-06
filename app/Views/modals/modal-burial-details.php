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
                        <h6 class="fw-bold text-body">Interred Information</h6>
                        <p><strong class="text-body">Name:</strong> <span class="text-secondary" id="interredName"></span></p>
                        <p><strong class="text-body">Birth Date:</strong> <span class="text-secondary" id="interredBirthDate"></span></p>
                        <p><strong class="text-body">Death Date:</strong> <span class="text-secondary" id="interredDeathDate"></span></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-body">Reservation Information</h6>
                        <p><strong class="text-body">Reserved By:</strong> <span class="text-secondary" id="reservedBy"></span></p>
                        <p><strong class="text-body">Relationship:</strong> <span class="text-secondary" id="relationship"></span></p>
                        <p><strong class="text-body">Reservation Date:</strong> <span class="text-secondary" id="reservationDate"></span></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6 class="fw-bold text-body">Burial Details</h6>
                        <p><strong class="text-body">Burial Type:</strong> <span class="text-secondary" id="burialType"></span></p>
                        <p><strong class="text-body">Burial Date & Time:</strong> <span class="text-secondary" id="burialDateTime"></span></p>
                        <p><strong class="text-body">Asset ID:</strong> <span class="text-secondary" id="assetId"></span></p>
                    </div>
                </div>

                <!-- Receipt Section -->
                <div class="row mt-3">
                    <div class="col-md-12" id="receiptSection" style="display: none;">
                        <h6 class="fw-bold text-body">Receipt Information</h6>
                        <p><strong class="text-body">Receipt:</strong></p>
                        <div class="receipt-container" style="display: flex; justify-content: center;">
                            <img id="receiptImage" src="" alt="Receipt" class="img-fluid shadow-lg rounded" style="max-width: 100%; max-height: 300px; transition: transform 0.3s ease;" />
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

<!-- Image Lightbox Modal -->
<div class="modal fade" id="imageLightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center p-0">
                <img id="lightboxImage" src="" alt="Enlarged Receipt" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const receiptImage = document.getElementById('receiptImage');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxModal = new bootstrap.Modal(document.getElementById('imageLightboxModal'));

        receiptImage.addEventListener('click', function() {
            lightboxImage.src = this.src;
            lightboxModal.show();
        });
    });
</script>

<style>
    #lightboxImage {
        max-height: 90vh;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease-in-out;
    }


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
        color: var(--text-main);
    }


    .modal-body p {
        color: var(--text-secondary);
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