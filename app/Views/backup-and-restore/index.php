<?php 
    use App\Utils\Formatter;
?>
<div class="container">
    <div class="row justify-content-center mt-4 g-4">

        <!-- Automated Backup Section -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title text-center">Automated Backup</h4>
                    <p class="card-text text-center">Set up an automated backup for your database. (e.g., daily at midnight).</p>
                    <div class="mt-auto text-center">
                        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#automated-backup-modal">
                            Setup Automated Backup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Backup Section -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title text-center">Manual Backup</h4>
                    <p class="card-text text-center">Click below to initiate a manual backup of the database now.</p>
                    <div class="mt-auto text-center">
                        <a href="backup-database" role="button" class="btn btn-primary btn-lg">Backup Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Restore Section -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title text-center">Restore Database</h4>
                    <p class="card-text text-center">Select a backup file to restore your database.</p>
                    <form class="text-center needs-validation mt-auto" novalidate action="restore-database" method="POST">
                        <label for="backup-file">Select Backup File:</label>
                        <select name="backup-file" class="form-select" required>
                            <option value="">-- Select Backup --</option>
                            <?php foreach ($backupFiles as $file): ?>
                                <option value="<?= $file ?>"><?= Formatter::formatDatabaseVersion($file) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-danger">Restore Database</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include_once VIEW_PATH . "/modals/modal-backup-time.php" ?>
<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
