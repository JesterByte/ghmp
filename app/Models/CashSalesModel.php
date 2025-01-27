<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CashSalesModel extends Model {
    public function getCashSales() {
        $stmt = $this->db->prepare("SELECT cs.lot_id, cs.payment_amount, c.first_name, c.middle_name, c.last_name, c.suffix_name
        FROM cash_sales AS cs
        INNER JOIN lot_reservations AS lr ON cs.lot_id = lr.lot_id
        INNER JOIN customers AS c ON lr.reservee_id = c.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}