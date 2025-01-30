<?php
date_default_timezone_set("Asia/Manila");

$host = "localhost";
$username = "root";
$password = "";
$db = "ghmp_db";

$dbConnection = mysqli_connect("localhost", "root", "", "ghmp_db");

$getBackupTime = mysqli_prepare($dbConnection, "SELECT backup_time FROM backup_settings");
mysqli_stmt_execute($getBackupTime);
$getBackupTimeResult = mysqli_stmt_get_result($getBackupTime);
$backupTime = mysqli_fetch_assoc($getBackupTimeResult)["backup_time"];
$backupTime = date("H:i", strtotime($backupTime));

$currentTime = date("H:i");

$backupTimeTimestamp = strtotime($backupTime);
$currentTimeTimestamp = strtotime($currentTime);

if ($currentTimeTimestamp >= $backupTimeTimestamp && $currentTimeTimestamp <= $backupTimeTimestamp + 1 * 60) {
    $dbHost = $host;
    $dbUser = $username; // Change if needed
    $dbPass = $password; // Change if needed
    $dbName = $db; 
    
    $backupFile = 'C:/xampp/htdocs/ghmp/storage/backups/ghmp_db_backup_' . date('Y-m-d_h-i-s-a') . '.sql';
    
    // Corrected command (without hanging issue)
    $command = "C:/xampp/mysql/bin/mysqldump -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";
    
    exec($command . " 2>&1", $output, $returnVar);
}

