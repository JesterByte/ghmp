<?php

namespace App\Controllers;

use App\Models\BackupAndRestoreModel;
use App\Core\View;

class BackupAndRestoreController extends BaseController {
    public function index() {

        $backupDirectory = __DIR__ . "/../../storage/backups/";
        $backupFiles = [];
    
        if (is_dir($backupDirectory)) {
            $files = scandir($backupDirectory);
            foreach ($files as $file) {
                if ($file === "temp_backup.sql") {
                    continue;
                }

                if (pathinfo($file, PATHINFO_EXTENSION) === "sql") {
                    $backupFiles[] = $file;
                }
            }
        }

        $data = [
            "pageTitle" => "Backup & Restore",
            "usesDataTables" => false,
            "backupFiles" => $backupFiles,
            "view" => "backup-and-restore/index"
        ];

        View::render("templates/layout", $data);
    }

    public function backupDatabase() {
        $backupAndRestoreModel = new BackupAndRestoreModel();
        
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $backupAndRestoreModel->backupDatabase();
            // $_SESSION["message"] = "Database backup successful!";
            // $this->redirectBack();
            $this->redirect(BASE_URL . "/backup-and-restore", '<i class="bi bi-check-lg text-success"></i>', "Database backup successful!", 'Operation Successful');
        }
    }

    public function restoreDatabase() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["backup-file"])) {
            $backupFile = $_POST["backup-file"];
            $backupPath = __DIR__ . "/../../storage/backups/" . $backupFile;
            $tempBackupPath = __DIR__ . "/../../storage/backups/temp_backup.sql"; // Temporary backup
    
            if (!file_exists($backupPath)) {
                $_SESSION["flash_message"] = "Backup file not found!";
                $this->redirectBack();
                return;
            }
    
            $backupAndRestoreModel = new BackupAndRestoreModel();
    
            // Step 1: Save a temporary backup before restoring
            $backupAndRestoreModel->backupDatabase($tempBackupPath);
    
            // Step 2: Restore the selected backup
            $result = $backupAndRestoreModel->restoreDatabase($backupPath);
    
            if ($result) {
                $icon = '<i class="bi bi-check-lg text-success"></i>';
                $message = "Database restored successfully!";
                $link = "undo-restore";
                $linkText = "Undo changes";
                $title = "Operation Successful";
                // $_SESSION["undo_available"] = true; // Enable Undo button
            } else {
                $icon = '<i class="bi bi-x-lg text-danger"></i>';
                $message = "Failed to restore database!";
                $link = "";
                $linkText = "";
                $title = "Operation Failed";
            }
            
            $this->redirect(BASE_URL . "/backup-and-restore", $icon, $message, $title, $link, $linkText);
        }
    }

    public function undoRestore() {
        $tempBackupPath = __DIR__ . "/../../storage/backups/temp_backup.sql";
        
        if (!file_exists($tempBackupPath)) {
            $_SESSION["flash_message"] = "No undo available!";
            $this->redirectBack();
            return;
        }
    
        $backupAndRestoreModel = new BackupAndRestoreModel();
        $result = $backupAndRestoreModel->restoreDatabase($tempBackupPath);
    
        if ($result) {
            $icon = '<i class="bi bi-check-lg text-success"></i>';
            $message = "Undo successful! Database restored to previous state.";
            $title = "Operation Successful";
            // unset($_SESSION["undo_available"]); // Remove undo option
            unlink($tempBackupPath); // Delete temp backup after undo
        } else {
            $icon = '<i class="bi bi-x-lg text-danger"></i>';
            $message = "Undo failed!";
            $title = "Operation Failed";
        }
    
        $this->redirect(BASE_URL . "/backup-and-restore", $icon, $message, $title);
    }
}