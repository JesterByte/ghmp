<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class InquiriesModel extends Model {
    public function getInquiries() {
        $stmt = $this->db->prepare("SELECT * FROM contacts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readInquiry($inquiryId) {
        $stmt = $this->db->prepare("UPDATE contacts SET status = :status WHERE id = :id");
        return $stmt->execute([
            ":status" => "read",
            ":id" => $inquiryId
        ]);
    }
}