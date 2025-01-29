<?php

namespace App\Controllers;

use App\Models\BackupAndRestoreModel;
use App\Core\View;

class BackupAndRestoreController extends BaseController {
    public function index() {
        // $cashSalesModel = new CashSalesModel();
        // $cashSalesTable = $cashSalesModel->getCashSales();
        // $reservationsTable = $cashSalesModel->getReservations();

        $data = [
            "pageTitle" => "Backup & Restore",
            "usesDataTables" => false,
            "view" => "backup-and-restore/index"
        ];

        View::render("templates/layout", $data);
    }

    public function backupDatabase() {
        $backupAndRestoreModel = new BackupAndRestoreModel();
        
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $backupAndRestoreModel->backupDatabase();
            $this->redirectBack();
        }
    }
}