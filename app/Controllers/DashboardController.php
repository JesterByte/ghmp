<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\DashboardModel;
use App\Models\UserModel;
use App\Core\View;
use App\Utils\Formatter;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->checkSession();
        $dashboardModel = new DashboardModel();
        
        // Get available assets
        $availableAssets = $dashboardModel->getAvailableAssets();
        
        // Get monthly revenue
        $monthlyRevenue = $dashboardModel->getMonthlyRevenue();
        $pendingServices = $dashboardModel->getPendingServices();
        $totalInterments = $dashboardModel->getInterments();
        $latestBurials = $dashboardModel->getLatestBurialServices();

        $data = [
            "pageTitle" => "Dashboard",
            "usesDataTables" => false,
            "totalAvailableAssets" => $availableAssets["total"],
            "availableLots" => $availableAssets["lots"],
            "availableEstates" => $availableAssets["estates"],
            "monthlyRevenue" => Formatter::formatCurrency($monthlyRevenue['current']),
            "revenueChange" => $monthlyRevenue['percentage_change'],
            "totalPendingServices" => $pendingServices["total"],
            "pendingBurials" => $pendingServices["burials"],
            "pendingInquiries" => $pendingServices["inquiries"],
            "monthlyRevenueTrend" => $monthlyRevenue['trend'],
            "totalInterments" => $totalInterments['total_interments'],
            "currentMonthInterments" => $totalInterments["current_month_interments"],
            "latestBurials" => $latestBurials,
            "view" => "dashboard/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries

        ];

        View::render("templates/layout", $data);
    }
}
