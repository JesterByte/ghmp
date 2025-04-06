<?php
date_default_timezone_set("Asia/Manila");

// $host = "localhost";
// $username = "root";
// $password = "";
// $db = "ghmp_db";

$host = "localhost";
$username = "u714551035_ghmp";
$password = "P~t5GTVnuaZ";
$db = "u714551035_ghmp_db";

$dbConnection = mysqli_connect($host, $username, $password, $db);

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

    // $backupFile = 'C:/xampp/htdocs/ghmp/storage/backups/ghmp_db_backup_' . date('Y-m-d_h-i-s-a') . '.sql';
    // $command = "C:/xampp/mysql/bin/mysqldump --default-character-set=utf8mb4 -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";

    // Corrected command (without hanging issue)
    $backupFile = __DIR__ . '/../../storage/backups/ghmp_db_backup_' . date('Y-m-d_h-i-s-a') . '.sql';
    $command = "mysqldump --default-character-set=utf8mb4 -h $dbHost -u $dbUser --password=$dbPass $dbName > \"$backupFile\"";


    exec($command . " 2>&1", $output, $returnVar);
}
