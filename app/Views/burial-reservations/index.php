<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css" rel="stylesheet"> -->

<style>
    #calendar {
        max-width: 70%;
        /* max-width: 1100px; */
        margin: 0 auto;
        padding: 20px;
    }

    .fc-event[status="Pending"] {
        background-color: #ffc107 !important;
        /* Yellow color for pending */
        pointer-events: none;
        /* Disable click */
        opacity: 0.6;
        /* Make it look disabled */
    }

    .fc-event[status="Completed"] {
        background-color: gray !important;
        /* Gray color for completed */
        pointer-events: none;
        /* Disable click */
        opacity: 0.6;
        /* Make it look disabled */
    }

    #calendar-legend {
        margin-top: 20px;
        font-size: 14px;
    }

    /* Default Light Mode */
    .legend-box {
        max-width: 250px;
        border: 2px solid currentColor;
        text-align: left;
        color: inherit;
        /* Inherit text color from parent */
        background-color: transparent;
        /* No background */
    }


    /* Legend item (each row) */
    .legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Colored boxes */
    .color-box {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        display: inline-block;
    }

    /* Color styles */
    .color-box.pending {
        background-color: #ffc107;
        /* Yellow */
    }

    .color-box.active {
        background-color: #0d6efd;
        /* Blue */
    }

    .color-box.paid {
        background-color: #008000;
        /* Green */
    }

    .color-box.completed {
        background-color: gray;
        /* Gray */
    }

    .color-box.cancelled {
        background-color: red;
        /* Red */
    }

    @media (max-width: 768px) {
        #calendar-container {
            display: none;
            /* Hide the calendar */
        }

        #mobile-message {
            display: block !important;
            /* Show the message */
        }

        #calendar-legend {
            display: none;
            /* Hide the legend */
        }
    }
</style>

<div class="alert alert-info text-center">
    <i class="bi bi-info-circle-fill"></i> On this page, you can view burial reservations in a calendar format.
    Click on an event to see details, including interred information, reservation details, and payment status.
    Approved and paid burials can be marked as done after the burial date has passed.
</div>

<div class="d-flex justify-content-between my-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-burial-reservation-modal">+ New Reservation</button>
    <a href="<?= BASE_URL . "/burial-reservation-requests" ?>" class="btn btn-info position-relative" role="button"><i class="bi bi-list"></i> Requests
        <?php if ($burialReservationRequests != 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $burialReservationRequests ?>
                <span class="visually-hidden">unread messages</span>
            </span>
        <?php endif; ?>
    </a>
</div>

<div class="d-flex justify-content-end">
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#reservationSettingsModal">
            <i class="bi bi-gear"></i>
            Reservation Settings
        </button>
    </div>
</div>

<div class="row">
    <div class="col-lg-10">
        <div id="calendar-container">
            <div id="calendar" class="rounded shadow"></div>
        </div>
        <div id="mobile-message" class="alert alert-warning text-center d-none">
            The calendar view is not available on mobile devices.
        </div>
    </div>
    <div class="col-lg-2">
        <!-- Legend Box -->
        <div id="calendar-legend" class="legend-box mx-auto my-3 p-3 rounded shadow">
            <h6 class="text-center fw-bold mb-2">Legend</h6>
            <div class="d-flex flex-column align-items-start">
                <div class="legend-item">
                    <span class="color-box pending"></span> Pending
                </div>
                <div class="legend-item">
                    <span class="color-box active"></span> Approved
                </div>
                <div class="legend-item">
                    <span class="color-box paid"></span> Paid
                </div>
                <div class="legend-item">
                    <span class="color-box completed"></span> Completed
                </div>
                <div class="legend-item">
                    <span class="color-box cancelled"></span> Cancelled
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEW_PATH . "/modals/modal-mark-as-done.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-burial-details.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-add-burial-reservation.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-reservation-settings.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>
<script src="<?= BASE_URL . "/js/fullcalendar.js" ?>"></script>
<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script> -->

<script>
    function toggleCalendar() {
        const calendarContainer = document.getElementById("calendar-container");
        const mobileMessage = document.getElementById("mobile-message");

        if (window.innerWidth <= 768) {
            calendarContainer.style.display = "none";
            mobileMessage.style.display = "block";
        } else {
            calendarContainer.style.display = "block";
            mobileMessage.style.display = "none";
        }
    }

    // Run on page load and when resizing
    window.addEventListener("load", toggleCalendar);
    window.addEventListener("resize", toggleCalendar);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: "<?= BASE_URL . "/burial-reservations/get-events" ?>", // Use the getEvents method as the events source
            // Use eventDidMount to style events on load
            eventDidMount: function(info) {
                const status = info.event.extendedProps.status;
                const paymentStatus = info.event.extendedProps.payment_status;

                // Set colors based on event status
                if (status === "Pending") {
                    info.el.style.backgroundColor = "#ffc107"; // Yellow for Pending
                    info.el.style.color = "black";
                    info.el.style.borderColor = "#ffc107"; // Match border color
                    // info.el.style.opacity = "0.6"; // Make it look disabled
                }
                if (status === "Approved") {
                    info.el.style.backgroundColor = "#0d6efd"; // Blue for Approved
                    info.el.style.color = "white";
                    info.el.style.borderColor = "#0d6efd"; // Match border color
                }

                if (status === "Approved" && paymentStatus === "Paid") {
                    info.el.style.backgroundColor = "#008000"; // Blue for Approved
                    info.el.style.color = "white";
                    info.el.style.borderColor = "#008000"; // Match border color
                }

                if (status === "Completed") {
                    info.el.style.backgroundColor = "gray"; // Gray for Completed
                    info.el.style.color = "white";
                    info.el.style.borderColor = "gray"; // Match border color
                    // info.el.style.opacity = "0.6"; // Make it look disabled
                }
                if (status === "Cancelled") {
                    info.el.style.backgroundColor = "red"; // Red for Cancelled
                    info.el.style.color = "white";
                    info.el.style.borderColor = "red"; // Match border color
                    // info.el.style.opacity = "0.6"; // Make it look disabled
                }
            },
            eventClick: function(info) {
                const status = info.event.extendedProps.status;
                const paymentStatus = info.event.extendedProps.payment_status;
                const burialDateTime = new Date(info.event.extendedProps.burial_date_time);
                const now = new Date();

                // Populate modal details
                document.getElementById("eventDetailsModalLabel").textContent = "Burial Reservation Details " + "(" + status + ")";
                document.getElementById("interredName").textContent = info.event.extendedProps.interred_name;
                document.getElementById("interredBirthDate").textContent = info.event.extendedProps.interred_birth_date;
                document.getElementById("interredDeathDate").textContent = info.event.extendedProps.interred_death_date;

                document.getElementById("reservedBy").textContent = info.event.extendedProps.reserved_by;
                document.getElementById("relationship").textContent = info.event.extendedProps.relationship;
                document.getElementById("reservationDate").textContent = info.event.extendedProps.reservation_date;

                document.getElementById("burialType").textContent = info.event.extendedProps.burial_type;
                document.getElementById("burialDateTime").textContent = info.event.extendedProps.burial_date_time;
                document.getElementById("assetId").textContent = info.event.extendedProps.asset_id;

                const receiptPath = info.event.extendedProps.receipt_path;

                // Check if receipt exists and display it
                if (receiptPath) {
                    document.getElementById("receiptSection").style.display = "block"; // Show receipt section
                    document.getElementById("receiptImage").src = "<?= BASE_URL ?>/uploads/receipts/" + receiptPath; // Set receipt image source
                } else {
                    document.getElementById("receiptSection").style.display = "none"; // Hide receipt section
                }

                const markAsDoneBtn = document.getElementById("markAsDoneBtn");

                // Ensure "Mark as Done" button is only shown if:
                // 1. Status is "Approved"
                // 2. Payment status is "Paid"
                // 3. Burial Date is in the past
                if (status === "Approved" && paymentStatus === "Paid" && burialDateTime < now) {
                    markAsDoneBtn.style.display = "block"; // Show button
                    document.getElementById("markAsDoneSubmit").setAttribute("data-event-id", info.event.id); // Store event ID
                } else {
                    markAsDoneBtn.style.display = "none"; // Hide button

                    // Show message if burial date is in the future
                    if (status === "Approved" && burialDateTime > now) {
                        showToast("<i class='bi bi-info-circle-fill text-info'></i>",
                            "You can mark the burial as done only after the burial date has passed.",
                            "Info");
                    }
                }

                var eventDetailsModal = new bootstrap.Modal(document.getElementById("eventDetailsModal"));
                eventDetailsModal.show();
            }

        });

        calendar.render();

        // Handle the "Confirm" button click inside the modal
        document.getElementById("markAsDoneSubmit").addEventListener("click", function() {
            const button = this;
            const spinner = button.querySelector('.spinner-border');
            const buttonText = button.querySelector('.button-text');
            
            // Disable button and show spinner
            button.disabled = true;
            spinner.classList.remove('d-none');
            buttonText.textContent = 'Processing...';
            
            var eventId = this.getAttribute("data-event-id");

            fetch("<?= BASE_URL . "/burial-reservations/mark-done" ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    event_id: eventId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast("<i class='bi bi-check-lg text-success'></i>", 
                        "Burial marked as done successfully.", 
                        "Operation Completed"
                    );

                    // Find event and update status
                    var event = calendar.getEventById(eventId);
                    if (event) {
                        event.remove();
                        calendar.refetchEvents();
                    }

                    // Hide modals
                    var confirmModal = bootstrap.Modal.getInstance(
                        document.getElementById("confirmDoneModal")
                    );
                    confirmModal.hide();

                    var eventDetailsModal = bootstrap.Modal.getInstance(
                        document.getElementById("eventDetailsModal")
                    );
                    eventDetailsModal.hide();
                } else {
                    showToast("<i class='bi bi-x-lg text-danger'></i>", 
                        data.message, 
                        "Operation Failed"
                    );
                }
            })
            .catch(error => {
                console.error("Error marking event as done:", error);
                showToast("<i class='bi bi-x-lg text-danger'></i>", 
                    "An unexpected error occurred.", 
                    "Operation Failed"
                );
            })
            .finally(() => {
                // Re-enable button and hide spinner
                button.disabled = false;
                spinner.classList.add('d-none');
                buttonText.textContent = 'Mark as Done';
            });
        });

    });

    function showToast(htmlIcon, message, title = 'Notification', delay = 5000, link = '') {
        // Create toast container if it doesn't exist
        if (!this.toastContainer) {
            this.toastContainer = document.createElement('div');
            this.toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            document.body.appendChild(this.toastContainer);
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        // Create toast header
        const toastHeader = document.createElement('div');
        toastHeader.className = 'toast-header';
        toastHeader.innerHTML = `
            ${htmlIcon}
            <strong class="me-auto">${title}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        `;

        // Create toast body
        const toastBody = document.createElement('div');
        toastBody.className = 'toast-body';
        if (link) {
            toastBody.innerHTML = `<a href="${link}">${message}</a>.`;
        } else {
            toastBody.textContent = message;
        }

        // Append header and body to toast
        toast.appendChild(toastHeader);
        toast.appendChild(toastBody);

        // Append toast to toast container
        this.toastContainer.appendChild(toast);

        // Initialize and show the toast
        const bootstrapToast = new bootstrap.Toast(toast, {
            delay: delay
        });
        bootstrapToast.show();

        // Remove toast from DOM after it hides
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }
</script>