<!-- Reservation Settings Modal -->
<div class="modal fade" id="reservationSettingsModal" tabindex="-1" aria-labelledby="reservationSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationSettingsModalLabel">Reservation Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" novalidate action="<?= BASE_URL ?>/<?= strtolower($reservationSettings["category"]) ?>-reservations/update-settings" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Overdue Reservations</label>
                        <select class="form-select" name="overdue_days_limit" required>
                            <option <?= $reservationSettings["overdue_days_limit"] === "3" ? "selected" : "" ?> value="3">Cancel after 3 days</option>
                            <option <?= $reservationSettings["overdue_days_limit"] === "5" ? "selected" : "" ?> value="5">Cancel after 5 days</option>
                            <option <?= $reservationSettings["overdue_days_limit"] === "7" ? "selected" : "" ?> value="7">Cancel after 7 days</option>
                            <option <?= $reservationSettings["overdue_days_limit"] === "0" ? "selected" : "" ?> value="0">Don't cancel automatically</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Expiry Notifications</label>
                        <select class="form-select" name="notification_days" required>
                            <option <?= $reservationSettings["notification_days"] === "1" ? "selected" : "" ?> value="1">1 day before expiry</option>
                            <option <?= $reservationSettings["notification_days"] === "3" ? "selected" : "" ?> value="3">3 days before expiry</option>
                            <option <?= $reservationSettings["notification_days"] === "5" ? "selected" : "" ?> value="5">5 days before expiry</option>
                            <option <?= $reservationSettings["notification_days"] === "0" ? "selected" : "" ?> value="0">Don't send notifications</option>
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="enableReminders" name="enable_reminders" <?= $reservationSettings["enable_reminders"] === 1 ? "checked" : "" ?>>
                        <label class="form-check-label" for="enableReminders">
                            Send payment reminders via email
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_settings" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>