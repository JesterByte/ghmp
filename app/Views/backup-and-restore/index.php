<?php 
    use App\Utils\Formatter;
?>
<!-- Automated Backup Section -->
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Automated Backup</h4>
                <p class="card-text text-center">Set up an automated backup for your database. (e.g., daily at midnight).</p>
                <div class="text-center">
                    <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#automated-backup-modal">
                        Setup Automated Backup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Manual Backup Section -->
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Manual Backup</h4>
                <p class="card-text text-center">Click below to initiate a manual backup of the database now.</p>
                
                <!-- <form method="post" action="your_backup_script.php">
                    <button type="submit" class="btn btn-primary btn-lg" name="backup">Backup Now</button>
                </form> -->
                <div class="text-center">
                    <a href="backup-database" role="button" class="btn btn-primary btn-lg">Backup Now</a>
                </div>
                <!-- <button type="submit" class="btn btn-primary btn-lg" name="backup">Backup Now</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Restore Section -->
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Restore Database</h4>
                <p class="card-text text-center">Select a backup file to restore your database.</p>
                
                <!-- <form class="text-center" method="post" action="your_restore_script.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="file" class="form-control" name="restore_file" accept=".sql" required>
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg" name="restore">Restore Backup</button>
                </form> -->
                <form class="text-center needs-validation" novalidate action="restore-database" method="POST">
                    <label for="backup-file">Select Backup File:</label>
                    <select name="backup-file" class="form-select" required>
                        <option value="">-- Select Backup --</option>
                        <?php
                            foreach ($backupFiles as $file): ?>
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

<?php include_once VIEW_PATH . "/modals/modal-backup-time.php" ?>
<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>
