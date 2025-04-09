<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CollectionReportModel extends Model
{
    public function getCollections($startDate = null, $endDate = null)
    {
        $conditions = [];
        $params = [];

        if ($startDate) {
            $conditions[] = "payment_date >= ?";
            $params[] = $startDate;
        }
        if ($endDate) {
            $conditions[] = "payment_date <= ?";
            $params[] = $endDate;
        }

        $whereClause = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

        $sql = "SELECT * FROM (
            -- Cash Sales - Lots
            SELECT 
                CONCAT('CS', id) as id,
                payment_date,
                payment_amount,
                'Cash' as payment_type,
                'Lot' as sale_type
            FROM cash_sales
            
            UNION ALL
            
            -- Cash Sales - Estate
            SELECT 
                CONCAT('ECS', id) as id,
                payment_date,
                payment_amount,
                'Cash' as payment_type,
                'Estate' as sale_type
            FROM estate_cash_sales
            
            UNION ALL
            
            -- 6 Months - Lots
            SELECT 
                CONCAT('6M', id) as id,
                payment_date,
                payment_amount,
                'Six Months' as payment_type,
                'Lot' as sale_type
            FROM six_months_payments
            
            UNION ALL
            
            -- 6 Months - Estate
            SELECT 
                CONCAT('E6M', id) as id,
                payment_date,
                payment_amount,
                'Six Months' as payment_type,
                'Estate' as sale_type
            FROM estate_six_months_payments
            
            UNION ALL
            
            -- Installment - Lots
            SELECT 
                CONCAT('INS', id) as id,
                payment_date,
                payment_amount,
                'Installment' as payment_type,
                'Lot' as sale_type
            FROM installment_payments
            
            UNION ALL
            
            -- Installment - Estate
            SELECT 
                CONCAT('EINS', id) as id,
                payment_date,
                payment_amount,
                'Installment' as payment_type,
                'Estate' as sale_type
            FROM estate_installment_payments
            
        ) combined_sales
        {$whereClause}
        ORDER BY payment_date DESC";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $i => $param) {
            $stmt->bindValue($i + 1, $param);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}