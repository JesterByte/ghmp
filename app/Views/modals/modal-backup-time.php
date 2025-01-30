<!-- Modal for automated backup -->
<div class="modal fade" id="automated-backup-modal" tabindex="-1" aria-labelledby="automated-backup-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="automated-backup-modal-label">Automated Backup Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="update-backup-time" method="post">
                    <div class="mb-3">
                        <label for="backup-time" class="form-label">Backup Time</label>
                        <input type="time" class="form-control" id="backup-time" name="backup-time" value="<?= $backupSettings["backup_time"] ?>" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>