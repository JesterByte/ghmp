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
    <a href="<?= BASE_URL . "/burial-reservation-requests" ?>" class="btn btn-primary" role="button"><i class="bi bi-list"></i> Reservation Requests</a>
</div>
<div id="calendar" class="rounded shadow"></div>

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
            eventClick: function(info) {
                if (info.event.extendedProps.status === "Completed") {
                    info.el.setAttribute("status", "Completed");
                    alert("This reservation is already completed.");
                    return;
                }

                if (confirm("Mark this reservation as done?")) {
                    fetch("<?= BASE_URL . "/burial-reservations/mark-done" ?>", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                event_id: info.event.id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Reservation marked as done!");
                                info.event.remove(); // Remove from the calendar
                            } else {
                                alert("Failed to update reservation.");
                            }
                        })
                        .catch(error => console.error("Error updating event:", error));
                }
            }
        });
        calendar.render();
    });
</script>