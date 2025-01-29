        <!-- Automated Backup Section -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Automated Backup</h4>
                        <p class="card-text text-center">Set up an automated backup for your database. (e.g., daily at midnight).</p>
                        
                        <div class="text-center">
                            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#automatedModal">
                                Set Up Automated Backup
                            </button>
                        </div>
                        
                        <!-- Modal for automated backup -->
                        <div class="modal fade" id="automatedModal" tabindex="-1" aria-labelledby="automatedModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="automatedModalLabel">Automated Backup Settings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="your_automated_backup_script.php" method="post">
                                            <div class="mb-3">
                                                <label for="backupTime" class="form-label">Backup Time (24-hour format)</label>
                                                <input type="time" class="form-control" id="backupTime" name="backup_time" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Settings</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                        <a href="backup-database" role="button" class="btn btn-primary btn-lg">Backup Now</a>
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
                        
                        <form method="post" action="your_restore_script.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="file" class="form-control" name="restore_file" accept=".sql" required>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg" name="restore">Restore Backup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>