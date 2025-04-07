<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class DashboardModel extends Model
{
    public function getAvailableAssets() {
        $sql = "SELECT 
                (SELECT COUNT(*) FROM lots WHERE status = 'Available') as available_lots,
                (SELECT COUNT(*) FROM estates WHERE status = 'Available') as available_estates
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            'total' => $result['available_lots'] + $result['available_estates'],
            'lots' => $result['available_lots'],
            'estates' => $result['available_estates']
        ];
    }

    public function getMonthlyRevenue() {
        $sql = "SELECT 
                COALESCE(SUM(total_amount), 0) as total_revenue,
                COALESCE(previous_month.total, 0) as previous_month_revenue
            FROM (
                -- Current month payments from all sources
                SELECT SUM(payment_amount) as total_amount FROM (
                    -- Cash sales
                    SELECT payment_amount 
                    FROM cash_sales 
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE)
                    
                    UNION ALL
                    
                    -- Estate cash sales
                    SELECT payment_amount 
                    FROM estate_cash_sales 
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE)
                    
                    UNION ALL
                    
                    -- Six months payments
                    SELECT payment_amount 
                    FROM six_months_payments 
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE)
                    
                    UNION ALL
                    
                    -- Estate six months payments
                    SELECT payment_amount 
                    FROM estate_six_months_payments 
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE)
                    
                    UNION ALL
                    
                    -- Installment payments
                    SELECT payment_amount 
                    FROM installment_payments 
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE)
                    
                    UNION ALL
                    
                    -- Estate installment payments
                    SELECT payment_amount 
                    FROM estate_installment_payments 
                    WHERE MONTH(payment_date) = MONTH(CURRENT_DATE)
                    AND YEAR(payment_date) = YEAR(CURRENT_DATE)
                ) current_month_payments
            ) current_month,
            (
                -- Previous month total
                SELECT SUM(payment_amount) as total FROM (
                    SELECT payment_amount FROM cash_sales 
                    WHERE MONTH(payment_date) = MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    AND YEAR(payment_date) = YEAR(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    
                    UNION ALL
                    
                    SELECT payment_amount FROM estate_cash_sales 
                    WHERE MONTH(payment_date) = MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    AND YEAR(payment_date) = YEAR(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    
                    UNION ALL
                    
                    SELECT payment_amount FROM six_months_payments 
                    WHERE MONTH(payment_date) = MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    AND YEAR(payment_date) = YEAR(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    
                    UNION ALL
                    
                    SELECT payment_amount FROM estate_six_months_payments 
                    WHERE MONTH(payment_date) = MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    AND YEAR(payment_date) = YEAR(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    
                    UNION ALL
                    
                    SELECT payment_amount FROM installment_payments 
                    WHERE MONTH(payment_date) = MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    AND YEAR(payment_date) = YEAR(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    
                    UNION ALL
                    
                    SELECT payment_amount FROM estate_installment_payments 
                    WHERE MONTH(payment_date) = MONTH(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                    AND YEAR(payment_date) = YEAR(DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH))
                ) last_month_payments
            ) previous_month
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calculate percentage change
        $currentRevenue = $result['total_revenue'];
        $previousRevenue = $result['previous_month_revenue'];
        $percentageChange = 0;
        $trend = 'neutral'; // Add trend indicator

        if ($previousRevenue > 0) {
            $percentageChange = (($currentRevenue - $previousRevenue) / $previousRevenue) * 100;
            $trend = $percentageChange > 0 ? 'up' : ($percentageChange < 0 ? 'down' : 'neutral');
        }

        return [
            'current' => $currentRevenue,
            'previous' => $previousRevenue,
            'percentage_change' => abs(round($percentageChange, 2)), // Return absolute value
            'trend' => $trend
        ];
    }

    public function getPendingServices() {
        $sql = "SELECT 
                (SELECT COUNT(*) FROM burial_reservations WHERE status = 'Pending') as pending_burials,
                (SELECT COUNT(*) FROM contacts WHERE status = 'unread') as pending_inquiries
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'burials' => $result['pending_burials'],
            'inquiries' => $result['pending_inquiries'],
            'total' => $result['pending_burials'] + $result['pending_inquiries']
        ];
    }

    public function getInterments() {
        $sql = "SELECT 
        (SELECT COUNT(*) FROM deceased) AS total_interments,
        (SELECT COUNT(*) 
         FROM deceased 
         WHERE MONTH(created_at) = MONTH(CURRENT_DATE)
         AND YEAR(created_at) = YEAR(CURRENT_DATE)
        ) AS current_month_interments";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            "total_interments" => $result["total_interments"],
            "current_month_interments" => $result["current_month_interments"]
        ];
    }

    public function getLatestBurialServices() {
        $sql = "SELECT 
            br.*,
            CONCAT(br.first_name, ' ', br.last_name) as full_name,
            DATE_FORMAT(br.date_time, '%Y-%m-%d') as burial_date,
            DATE_FORMAT(br.date_time, '%h:%i %p') as burial_time,
            asset_id as plot_id
        FROM burial_reservations AS br
        WHERE br.status != 'Completed' OR br.status != 'Cancelled'
        ORDER BY date_time ASC
        LIMIT 3";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestInquiries() {
        $sql = "SELECT 
            c.id,
            c.email,
            c.message,
            c.created_at,
            c.status
        FROM contacts AS c
        WHERE c.status = 'unread'
        ORDER BY created_at DESC
        LIMIT 3";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyOverviewData() {
        $sql = "SELECT 
            DATE_FORMAT(payment_date, '%b') as month,
            SUM(payment_amount) as revenue,
            COUNT(*) as services
        FROM (
            SELECT payment_date, payment_amount FROM cash_sales 
            WHERE YEAR(payment_date) = YEAR(CURRENT_DATE)
            
            UNION ALL
            
            SELECT payment_date, payment_amount FROM estate_cash_sales 
            WHERE YEAR(payment_date) = YEAR(CURRENT_DATE)
            
            UNION ALL
            
            SELECT payment_date, payment_amount FROM six_months_payments 
            WHERE YEAR(payment_date) = YEAR(CURRENT_DATE)
            
            UNION ALL
            
            SELECT payment_date, payment_amount FROM estate_six_months_payments 
            WHERE YEAR(payment_date) = YEAR(CURRENT_DATE)
            
            UNION ALL
            
            SELECT payment_date, payment_amount FROM installment_payments 
            WHERE YEAR(payment_date) = YEAR(CURRENT_DATE)
            
            UNION ALL
            
            SELECT payment_date, payment_amount FROM estate_installment_payments 
            WHERE YEAR(payment_date) = YEAR(CURRENT_DATE)
        ) payments
        GROUP BY MONTH(payment_date)
        ORDER BY MONTH(payment_date)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
