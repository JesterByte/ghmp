<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class BackupAndRestoreModel extends Model {
    public function backupDatabase() {
    $config = require __DIR__ . "/../../config/database.php";

    $dbHost = $config["host"];
    $dbUser = $config["username"]; // Change if needed
    $dbPass = $config["password"]; // Change if needed
    $dbName = $config["dbname"]; 
    $backupFile = STORAGE_PATH . '/backups/ghmp_db_backup_' . date('Y-m-d_H-i-s') . '.sql';

    // Ensure backups folder exists
    if (!file_exists('backups')) {
        mkdir('backups', 0777, true);
    }

    // Command to export the database
    $command = "C:\\xampp\\mysql\\bin\\mysqldump -h $dbHost -u $dbUser -p$dbPass $dbName > $backupFile";

    system($command, $output);

    if ($output === 0) {
        echo "<script>alert('Database backup successful: $backupFile')</script>";
    } else {
        echo "<script>alert('Database backup failed.')</script>";
    }
}
}