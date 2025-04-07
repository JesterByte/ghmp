<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class CustomersModel extends Model
{
    public function getCustomers()
    {
        $stmt = $this->db->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCustomerById($customerId)
    {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->bindValue(":id", $customerId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setCustomerStatus($customerId, $status)
    {
        $stmt = $this->db->prepare("UPDATE customers SET status = :status WHERE id = :id");
        return $stmt->execute(["status" => $status, "id" => $customerId]);
    }

    public function getBeneficiariesByCustomerId($customerId)
    {
        $stmt = $this->db->prepare("SELECT * FROM beneficiaries WHERE customer_id = :customer_id AND status = 'Inactive'");
        $stmt->execute(["customer_id" => $customerId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlotStatusStatistics()
    {
        $sql = "SELECT 
            (SELECT COUNT(*) FROM lots WHERE status = 'Available') +
            (SELECT COUNT(*) FROM estates WHERE status = 'Available') as available,
            
            (SELECT COUNT(*) FROM lots WHERE status = 'Reserved') +
            (SELECT COUNT(*) FROM estates WHERE status = 'Reserved') as reserved,
            
            (SELECT COUNT(*) FROM lots WHERE status = 'Sold') +
            (SELECT COUNT(*) FROM estates WHERE status = 'Sold') as sold,
            
            (SELECT COUNT(*) FROM lots WHERE status = 'Sold and Occupied') +
            (SELECT COUNT(*) FROM estates WHERE status = 'Sold and Occupied') as occupied,
            
            (SELECT COUNT(*) FROM lots) +
            (SELECT COUNT(*) FROM estates) as total";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
