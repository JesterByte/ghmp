<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class BackupAndRestoreModel extends Model {
    public function backupDatabase($tempBackupPath = null) {
        $config = require __DIR__ . "/../../config/database.php";

        $dbHost = $config["host"];
        $dbUser = $config["username"]; // Change if needed
        $dbPass = $config["password"]; // Change if needed
        $dbName = $config["dbname"]; 

        if ($tempBackupPath != null) {
            $backupFile = STORAGE_PATH . '/backups/temp_backup.sql';;
        } else {
            $backupFile = STORAGE_PATH . '/backups/ghmp_db_backup_' . date('Y-m-d_h-i-s-a') . '.sql';
        }
        // $backupFile = STORAGE_PATH . '/backups/ghmp_db_backup_' . date('Y-m-d_h-i-s-a') . '.sql';

        // Ensure backups folder exists
        if (!file_exists('backups')) {
            mkdir('backups', 0777, true);
        }

        // Corrected command (without hanging issue)
        $command = "C:/xampp/mysql/bin/mysqldump -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";
        // $command = "mysqldump -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";
        
        exec($command . " 2>&1", $output, $returnVar);

        if ($returnVar === 0) {
            return "Database backup successful: $backupFile";
        } else {
            return "Database backup failed: " . implode("\n", $output);
        }
    }

    public function automatedBackupDatabase() {
        $config = require __DIR__ . "/../../config/database.php";

        $dbHost = $config["host"];
        $dbUser = $config["username"]; // Change if needed
        $dbPass = $config["password"]; // Change if needed
        $dbName = $config["dbname"]; 

        $backupFile = STORAGE_PATH . '/backups/ghmp_db_backup_' . date('Y-m-d_h-i-s-a') . '.sql';

        // Ensure backups folder exists
        if (!file_exists('backups')) {
            mkdir('backups', 0777, true);
        }

        // Corrected command (without hanging issue)
        $command = "C:/xampp/mysql/bin/mysqldump -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";
        // $command = "mysqldump -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";
        
        exec($command . " 2>&1", $output, $returnVar);
    }

    public function restoreDatabase($backupFile) {
        // Read the SQL file
        $sql = file_get_contents($backupFile);
        
        if (!$sql) {
            return false;
        }

        // Disable foreign key checks to prevent constraint issues
        $this->db->query("SET FOREIGN_KEY_CHECKS = 0;");

        // Split and execute SQL statements
        $queries = explode(";", $sql);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                if (!$this->db->query($query)) {
                    return false;
                }
            }
        }

        // Enable foreign key checks
        $this->db->query("SET FOREIGN_KEY_CHECKS = 1;");

        // $this->db->close();
        return true;
    }

    public function setBackupTime($backupTime) {    
        $stmt = $this->db->prepare("UPDATE backup_settings SET backup_time = :backup_time");
        $stmt->bindParam(":backup_time", $backupTime);
        return $stmt->execute();
    }
    
    public function getBackupTime() {
        $stmt = $this->db->query("SELECT backup_time FROM backup_settings LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}