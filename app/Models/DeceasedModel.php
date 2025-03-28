<?php

namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class DeceasedModel extends Model {
    public function setDeceased($data) {
        try {
            $stmt = $this->db->prepare("INSERT INTO deceased 
                (full_name, first_name, middle_name, last_name, suffix, obituary, birth_date, death_date, burial_date, location) 
                VALUES (:full_name, :first_name, :middle_name, :last_name, :suffix, :obituary, :birth_date, :death_date, :burial_date, :location)");

            // Bind values safely
            $stmt->bindValue(":full_name", $data["full_name"], PDO::PARAM_STR);
            $stmt->bindValue(":first_name", $data["first_name"], PDO::PARAM_STR);
            $stmt->bindValue(":middle_name", $data["middle_name"], PDO::PARAM_STR);
            $stmt->bindValue(":last_name", $data["last_name"], PDO::PARAM_STR);
            $stmt->bindValue(":suffix", $data["suffix"], PDO::PARAM_STR);
            $stmt->bindValue(":obituary", $data["obituary"], PDO::PARAM_STR);
            $stmt->bindValue(":birth_date", $data["birth_date"], PDO::PARAM_STR);
            $stmt->bindValue(":death_date", $data["death_date"], PDO::PARAM_STR);
            $stmt->bindValue(":burial_date", $data["burial_date"], PDO::PARAM_STR);
            $stmt->bindValue(":location", $data["location"], PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
}
