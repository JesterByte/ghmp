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

    .legend-item {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 5px;
        border-radius: 4px;
        color: white;
        font-weight: bold;
    }

    .legend-item.pending {
        background-color: #ffc107;
        /* Yellow for pending */
    }

    .legend-item.paid {
        background-color: #008000;
        /* Green for paid */
    }

    .legend-item.completed {
        background-color: #6c757d;
        /* Gray for completed */
    }

    .legend-item.cancelled {
        background-color: red;
        /* Gray for completed */
    }

    .legend-item.active {
        background-color: #0d6efd;
        /* Blue for active */
    }
</style>
<div class="text-end">
    <a href="<?= BASE_URL . "/burial-reservation-requests" ?>" class="btn btn-primary position-relative" role="button"><i class="bi bi-list"></i> Requests
        <?php if ($burialReservationRequests != 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $burialReservationRequests ?>
                <span class="visually-hidden">unread messages</span>
            </span>
        <?php endif; ?>
    </a>
</div>

<!-- Legend -->
<div id="calendar-legend" class="my-3 text-center">
    <strong>Legend:</strong>
    <span class="legend-item pending">Pending</span>
    <span class="legend-item active border-primary">Approved</span>
    <span class="legend-item paid border-primary">Paid</span>
    <span class="legend-item completed">Completed</span>
    <span class="legend-item cancelled">Cancelled</span>
</div>

<div class="row">
    <div class="col-lg-12">
        <div id="calendar" class="rounded shadow"></div>
    </div>
</div>


<?php include_once VIEW_PATH . "/modals/modal-mark-as-done.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-burial-details.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>
<script src="<?= BASE_URL . "/js/fullcalendar.js" ?>"></script>
<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script> -->

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
                }

                var eventDetailsModal = new bootstrap.Modal(document.getElementById("eventDetailsModal"));
                eventDetailsModal.show();
            }
        });

        calendar.render();

        // Handle the "Confirm" button click inside the modal
        document.getElementById("markAsDoneSubmit").addEventListener("click", function() {
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
                        showToast("<i class='bi bi-check-lg text-success'></i>", "Burial marked as done successfully.", "Success");

                        // Find event and update status
                        var event = calendar.getEventById(eventId);
                        if (event) {
                            event.remove(); // Remove old event
                            calendar.refetchEvents(); // Refresh events
                        }

                        // Hide the confirmation modal
                        var confirmModal = bootstrap.Modal.getInstance(document.getElementById("confirmDoneModal"));
                        confirmModal.hide();

                        // Hide the details modal
                        var eventDetailsModal = bootstrap.Modal.getInstance(document.getElementById("eventDetailsModal"));
                        eventDetailsModal.hide();
                    } else {
                        showToast("<i class='bi bi-x-lg'></i>", data.message, "Operation Failed");
                    }
                })
                .catch(error => {
                    console.error("Error marking event as done:", error);
                    showToast("<i class='bi bi-x-lg'></i>", "An unexpected error occurred.", "Operation Failed");
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