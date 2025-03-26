<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CustomersModel extends Model
{
    public function getCustomers() {
        $stmt = $this->db->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setCustomerStatus($customerId, $status) {
        $stmt = $this->db->prepare("UPDATE customers SET status = :status WHERE id = :id");
        return $stmt->execute(["status" => $status, "id" => $customerId]);
    }
}
