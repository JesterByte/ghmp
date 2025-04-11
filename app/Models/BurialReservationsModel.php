<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class BurialReservationsModel extends Model
{
    public function getBurialReservationRequests()
    {
        // $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status = :status");
        $stmt = $this->db->prepare("SELECT
        br.id,
        br.asset_id,
        br.reservee_id,
        br.burial_type,
        br.relationship,
        br.first_name AS interred_first_name,
        br.middle_name AS interred_middle_name,
        br.last_name AS interred_last_name,
        br.suffix AS interred_suffix_name,
        br.date_of_birth,
        br.date_of_death,
        br.obituary,
        br.date_time,
        br.created_at,

        c.first_name AS reservee_first_name,
        c.middle_name AS reservee_middle_name,
        c.last_name AS reservee_last_name,
        c.suffix_name AS reservee_suffix_name,

        l.latitude_start AS lot_lat_start,
        l.longitude_start AS lot_lng_start,
        l.latitude_end AS lot_lat_end,
        l.longitude_end AS lot_lng_end,
        e.latitude_start AS estate_lat_start,
        e.longitude_start AS estate_lng_start,
        e.latitude_end AS estate_lat_end,
        e.longitude_end AS estate_lng_end

        FROM burial_reservations AS br
        INNER JOIN customers AS c ON br.reservee_id = c.id
        LEFT JOIN lots AS l ON br.asset_id = l.lot_id
        LEFT JOIN estates AS e ON br.asset_id = e.estate_id
        WHERE br.status = :status");
        $stmt->execute([':status' => 'Pending']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOwnedAssets($status = "Sold")
    {
        $query = "SELECT * FROM (
            SELECT 
                l.lot_id AS asset_id, 
                l.owner_id AS owner_id,
                'lot' AS asset_type,
                c.first_name AS first_name,
                c.middle_name AS middle_name,
                c.last_name AS last_name,
                c.suffix_name AS suffix,
                ROW_NUMBER() OVER (PARTITION BY c.id ORDER BY l.lot_id) as rn
            FROM lots AS l
            INNER JOIN customers AS c ON l.owner_id = c.id
            WHERE l.owner_id IS NOT NULL AND l.status = :lot_status
            
            UNION ALL
            
            SELECT 
                e.estate_id AS asset_id,
                e.owner_id AS owner_id, 
                'estate' AS asset_type,
                c.first_name AS first_name,
                c.middle_name AS middle_name,
                c.last_name AS last_name,
                c.suffix_name AS suffix,
                ROW_NUMBER() OVER (PARTITION BY c.id ORDER BY e.estate_id) as rn
            FROM estates AS e
            INNER JOIN customers AS c ON e.owner_id = c.id
            WHERE e.owner_id IS NOT NULL AND e.status = :estate_status
        ) ranked
        WHERE rn = 1
        ORDER BY owner_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':lot_status', $status);
        $stmt->bindParam(':estate_status', $status);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOwnedAssetsByCustomer($customerId)
    {
        $query = "SELECT 
                    l.lot_id AS asset_id, 
                    'Lot' AS asset_type
                  FROM lots AS l
                  LEFT JOIN burial_reservations AS br ON l.lot_id = br.asset_id
                  WHERE l.owner_id = :lot_customer_id 
                    AND l.status = :lot_status
                    AND (br.asset_id IS NULL OR br.status = 'Cancelled')
        
                  UNION
        
                  SELECT 
                    e.estate_id AS asset_id, 
                    'Estate' AS asset_type
                  FROM estates AS e
                  LEFT JOIN burial_reservations AS br ON e.estate_id = br.asset_id
                  WHERE e.owner_id = :estate_customer_id 
                    AND e.status = :estate_status
                    AND (br.asset_id IS NULL OR br.status = 'Cancelled')";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':lot_customer_id', $customerId, PDO::PARAM_INT);
        $stmt->bindParam(':estate_customer_id', $customerId, PDO::PARAM_INT);

        $status = "Sold";
        $stmt->bindParam(':lot_status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':estate_status', $status, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function setReservation($data)
    {
        $stmt = $this->db->prepare("INSERT INTO burial_reservations 
        (reservee_id, asset_id, burial_type, relationship, first_name, middle_name, last_name, suffix, date_of_birth, date_of_death, obituary, date_time, status, payment_amount, payment_status, receipt_path)
        VALUES (:reservee_id, :asset_id, :burial_type, :relationship, :first_name, :middle_name, :last_name, :suffix, :date_of_birth, :date_of_death, :obituary, :date_time, :status, :payment_amount, :payment_status, :receipt_path)");
        return $stmt->execute([
            ":reservee_id" => $data["reservee_id"],
            ":asset_id" => $data["asset_id"],
            ":burial_type" => $data["burial_type"],
            ":relationship" => $data["relationship"],
            ":first_name" => $data["first_name"],
            ":middle_name" => $data["middle_name"],
            ":last_name" => $data["last_name"],
            ":suffix" => $data["suffix"],
            ":date_of_birth" => $data["date_of_birth"],
            ":date_of_death" => $data["date_of_death"],
            ":obituary" => $data["obituary"],
            ":date_time" => $data["date_time"],
            ":status" => $data["status"],
            ":payment_amount" => $data["payment_amount"],
            ":payment_status" => $data["payment_status"],
            ":receipt_path" => $data["receipt_path"]
        ]);
    }

    public function getBurialTypes($assetType)
    {
        $stmt = $this->db->prepare("SELECT * FROM burial_pricing WHERE category = :category");
        $stmt->bindParam(":category", $assetType, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getEvents() {
    //     $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status = :status");
    //     $stmt->execute([':status' => 'Approved']);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getBurialReservationRequestsBadge()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total_burial_reservation_requests FROM burial_reservations WHERE status = :status");
        $stmt->execute([':status' => 'Pending']);
        return $stmt->fetch(PDO::FETCH_ASSOC)["total_burial_reservation_requests"];
    }

    public function getEvents()
    {
        // $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE status != :status");
        // $stmt->execute([':status' => 'Pending']);

        // $stmt = $this->db->prepare("SELECT * FROM burial_reservations");
        // $stmt->execute();

        $stmt = $this->db->prepare("SELECT  
        br.id,
        br.asset_id, 
        br.burial_type,
        br.relationship,
        br.first_name AS interred_first_name,
        br.middle_name AS interred_middle_name,
        br.last_name AS interred_last_name,
        br.suffix AS interred_suffix_name,
        br.date_of_birth,
        br.date_of_death,
        br.obituary,
        br.date_time,
        br.status,
        br.payment_amount,
        br.payment_status,
        br.receipt_path,
        br.created_at,

        c.first_name AS reservee_first_name,
        c.middle_name AS reservee_middle_name,
        c.last_name AS reservee_last_name,
        c.suffix_name AS reservee_suffix_name
        FROM burial_reservations AS br
        INNER JOIN customers AS c ON br.reservee_id = c.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($assetId, $customerId, $status)
    {
        $stmt = $this->db->prepare("UPDATE burial_reservations SET status = :status WHERE asset_id = :asset_id");
        return $stmt->execute([':asset_id' => $assetId, ':status' => $status]);
    }

    public function updateStatusById($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE burial_reservations SET status = :status WHERE id = :id");
        return $stmt->execute([':id' => $id, ':status' => $status]);
    }

    public function findById($eventId)
    {
        $stmt = $this->db->prepare("SELECT * FROM burial_reservations WHERE id = :id");
        $stmt->execute([':id' => $eventId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findEstate($estateId, $ownerId)
    {
        $stmt = $this->db->prepare("SELECT * FROM estates WHERE estate_id = :estate_id AND owner_id = :owner_id");
        $stmt->execute(["estate_id" => $estateId, "owner_id" => $ownerId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLotOccupancy($lotId, $ownerId)
    {
        $stmt = $this->db->prepare("UPDATE lots SET status = 'Sold and Occupied' WHERE lot_id = :lot_id AND owner_id = :owner_id");
        $stmt->bindParam(':lot_id', $lotId, PDO::PARAM_STR);
        $stmt->bindParam(':owner_id', $ownerId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateEstateOccupancy($estateId, $ownerId)
    {
        $estate = $this->findEstate($estateId, $ownerId);
        if ($estate["status"] === "Sold") {
            $stmt = $this->db->prepare("UPDATE estates SET status = 'Sold and Occupied', occupancy = occupancy + 1 WHERE estate_id = :estate_id AND owner_id = :owner_id");
        } else if ($estate["status"] === "Sold and Occupied") {
            $stmt = $this->db->prepare("UPDATE estates SET occupancy = occupancy + 1 WHERE estate_id = :estate_id AND owner_id = :owner_id");
        }
        $stmt->bindParam(':estate_id', $estateId, PDO::PARAM_STR);
        $stmt->bindParam(':owner_id', $ownerId, PDO::PARAM_INT);


        return $stmt->execute();
    }
}
