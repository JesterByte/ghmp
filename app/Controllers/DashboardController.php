<?php

namespace App\Controllers;

use App\Models\BadgeModel;
use App\Models\DashboardModel;
use App\Models\UserModel;
use App\Models\CustomersModel;
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
        $latestInquiries = $dashboardModel->getLatestInquiries();
        $monthlyData = $dashboardModel->getMonthlyOverviewData();

        $customersModel = new CustomersModel();
        $plotStats = $customersModel->getPlotStatusStatistics();

        $data = [
            "pageTitle" => "Dashboard",
            "usesDataTables" => false,
            "totalAvailableAssets" => $availableAssets["total"],
            "availableLots" => $availableAssets["lots"],
            "availableEstates" => $availableAssets["estates"],
            // Rename this to currentMonthRevenue to avoid conflict
            "currentMonthRevenue" => Formatter::formatCurrency($monthlyRevenue['current'] ?? 0),
            "revenueChange" => $monthlyRevenue['percentage_change'],
            "totalPendingServices" => $pendingServices["total"],
            "pendingBurials" => $pendingServices["burials"],
            "pendingInquiries" => $pendingServices["inquiries"],
            "monthlyRevenueTrend" => $monthlyRevenue['trend'],
            "totalInterments" => $totalInterments['total_interments'],
            "currentMonthInterments" => $totalInterments["current_month_interments"],
            "latestBurials" => $latestBurials,
            "latestInquiries" => $latestInquiries,
            "view" => "dashboard/index",

            "userId" => $_SESSION["user_id"],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries,

            // Rename these to chartData to be more specific
            "chartLabels" => array_column($monthlyData, 'month'),
            "chartRevenue" => array_column($monthlyData, 'revenue'),
            "chartServices" => array_column($monthlyData, 'services'),

            "plotStats" => $plotStats
        ];

        View::render("templates/layout", $data);
    }
}
