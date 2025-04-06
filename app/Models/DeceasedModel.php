<?php

namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;

class DeceasedModel extends Model
{
    public function setDeceased($data)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO deceased (customer_id, full_name, first_name, middle_name, last_name, suffix, obituary, birth_date, death_date, burial_date, location) 
                VALUES (:customer_id, :full_name, :first_name, :middle_name, :last_name, :suffix, :obituary, :birth_date, :death_date, :burial_date, :location)");

            // Bind values safely
            $stmt->bindValue(":customer_id", $data["customer_id"], PDO::PARAM_INT);
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

    public function getDeceasedTable()
    {
        try {
            $stmt = $this->db->query("SELECT 
                c.first_name AS customer_first_name,
                c.middle_name AS customer_middle_name,
                c.last_name AS customer_last_name,
                c.suffix_name AS customer_suffix,

                d.full_name,
                d.birth_date,
                d.death_date,
                d.burial_date,
                d.obituary,
                d.location,
                
                l.latitude_start AS lot_lat_start,
                l.longitude_start AS lot_lng_start,
                l.latitude_end AS lot_lat_end,
                l.longitude_end AS lot_lng_end,
                e.latitude_start AS estate_lat_start,
                e.longitude_start AS estate_lng_start,
                e.latitude_end AS estate_lat_end,
                e.longitude_end AS estate_lng_end
                FROM deceased AS d
                INNER JOIN customers AS c ON d.customer_id = c.id
                LEFT JOIN lots AS l ON d.location = l.lot_id
                LEFT JOIN estates AS e ON d.location = e.estate_id
                ORDER BY d.death_date DESC");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            return false;
        }
    }
}
