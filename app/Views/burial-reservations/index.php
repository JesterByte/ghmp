<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css" rel="stylesheet"> -->

<style>
    #calendar {
        max-width: 60%;
        /* max-width: 1100px; */
        margin: 0 auto;
        padding: 20px;
    }

    .fc-event[status="Completed"] {
        background-color: gray !important;
        pointer-events: none;
        /* Disable click events */
        opacity: 0.6;
    }
</style>
<div class="text-end">
    <a href="<?= BASE_URL . "/burial-reservation-requests" ?>" class="btn btn-primary position-relative" role="button"><i class="bi bi-list"></i> Reservation Requests
        <?php if ($burialReservationRequests != 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $burialReservationRequests ?>
                <span class="visually-hidden">unread messages</span>
            </span>
        <?php endif; ?>
    </a>
</div>
<div id="calendar" class="rounded shadow"></div>

<?php include_once VIEW_PATH . "/modals/modal-mark-as-done.php" ?>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
<script src="<?= BASE_URL . "/js/modal-autofocus.js" ?>"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     fetch("<?= BASE_URL . "/burial-reservations/get-events" ?>")
    //         .then(response => response.json())
    //         .then(data => console.log("Events:", data))
    //         .catch(error => console.error("Error fetching events:", error));

    //     var calendarEl = document.getElementById('calendar');
    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         initialView: 'dayGridMonth',
    //         headerToolbar: {
    //             left: 'prev,next today',
    //             center: 'title',
    //             right: 'dayGridMonth,timeGridWeek,timeGridDay'
    //         },
    //         events: "<?= BASE_URL . "/burial-reservations/get-events" ?>",
    //         eventClick: function(info) {
    //             alert("Reservation for " + info.event.title);
    //         },
    //         loading: function(isLoading) {
    //             console.log("Loading status:", isLoading);
    //         },
    //     });
    //     calendar.render();
    // });

    // document.addEventListener('DOMContentLoaded', function() {
    //     var calendarEl = document.getElementById('calendar');
    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         initialView: 'dayGridMonth',
    //         headerToolbar: {
    //             left: 'prev,next today',
    //             center: 'title',
    //             right: 'dayGridMonth,timeGridWeek,timeGridDay'
    //         },
    //         events: "<?= BASE_URL . "/burial-reservations/get-events" ?>",

    //         eventDidMount: function(info) {
    //             // Check if event is "Completed" and apply styles
    //             if (info.event.extendedProps.status === "Completed") {
    //                 info.el.style.backgroundColor = "gray";
    //                 info.el.style.pointerEvents = "none"; // Disable click events
    //                 info.el.style.opacity = "0.6"; // Make it slightly transparent
    //             }
    //         },

    //         eventClick: function(info) {
    //             if (confirm("Mark this reservation as done?")) {
    //                 fetch("<?= BASE_URL . "/burial-reservations/mark-done" ?>", {
    //                         method: "POST",
    //                         headers: {
    //                             "Content-Type": "application/json"
    //                         },
    //                         body: JSON.stringify({
    //                             event_id: info.event.id
    //                         })
    //                     })
    //                     .then((response) => response.json())
    //                     .then((data) => {
    //                         if (data.success) {
    //                             showToast(data.icon, data.message, data.title);
    //                             info.event.remove(); // Remove from calendar
    //                         } else {
    //                             showToast("<i>bi bi-x-lg</i>", data.message, "Operation Failed");
    //                         }
    //                     })
    //                     .catch((error) => {
    //                         console.error("Error updating event:", error);
    //                         showToast("<i>bi bi-x-lg</i>", "An unexpected error occurred.", "Operation Failed");
    //                     });
    //             }
    //         }
    //     });
    //     calendar.render();
    // });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: "<?= BASE_URL . "/burial-reservations/get-events" ?>",

            // eventDidMount: function(info) {
            //     if (info.event.extendedProps.status === "Completed") {
            //         info.el.style.backgroundColor = "gray";
            //         info.el.style.pointerEvents = "none";
            //         info.el.style.opacity = "0.6";
            //     }
            // },

            eventClick: function(info) {
                if (info.event.extendedProps.status === "Completed") {
                    showToast("<i class='bi bi-exclamation-lg text-warning'></i>", "This reservation is already completed", "Reservation Completed");
                    return;
                }

                // Store event ID in hidden input inside modal
                document.getElementById("selectedEventId").value = info.event.id;

                // Show the modal
                var confirmModal = new bootstrap.Modal(document.getElementById("confirmDoneModal"));
                confirmModal.show();
            }
        });

        calendar.render();

        // Handle the "Confirm" button click inside the modal
        document.getElementById("confirmMarkDone").addEventListener("click", function() {
            var eventId = document.getElementById("selectedEventId").value;

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
                        showToast(data.icon, data.message, data.title);

                        // Find and remove event from calendar
                        var event = calendar.getEventById(eventId);
                        if (event) event.remove();

                        // Hide the modal
                        var confirmModal = bootstrap.Modal.getInstance(document.getElementById("confirmDoneModal"));
                        confirmModal.hide();
                    } else {
                        showToast("<i class='bi bi-x-lg'></i>", data.message, "Operation Failed");
                    }
                })
                .catch(error => {
                    console.error("Error updating event:", error);
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