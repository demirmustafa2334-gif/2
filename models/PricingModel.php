<?php
/**
 * Pricing Model
 * Istanbul Moving Company - Custom PHP Script
 */

class PricingModel {
    private $conn;
    private $table_name = "pricing_routes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllPricingRoutes() {
        $query = "SELECT pr.*, 
                  fd.name as from_district_name, fn.name as from_neighborhood_name,
                  td.name as to_district_name, tn.name as to_neighborhood_name
                  FROM " . $this->table_name . " pr
                  LEFT JOIN districts fd ON pr.from_district_id = fd.id
                  LEFT JOIN neighborhoods fn ON pr.from_neighborhood_id = fn.id
                  LEFT JOIN districts td ON pr.to_district_id = td.id
                  LEFT JOIN neighborhoods tn ON pr.to_neighborhood_id = tn.id
                  WHERE pr.is_active = 1
                  ORDER BY pr.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPricingRouteById($id) {
        $query = "SELECT pr.*, 
                  fd.name as from_district_name, fn.name as from_neighborhood_name,
                  td.name as to_district_name, tn.name as to_neighborhood_name
                  FROM " . $this->table_name . " pr
                  LEFT JOIN districts fd ON pr.from_district_id = fd.id
                  LEFT JOIN neighborhoods fn ON pr.from_neighborhood_id = fn.id
                  LEFT JOIN districts td ON pr.to_district_id = td.id
                  LEFT JOIN neighborhoods tn ON pr.to_neighborhood_id = tn.id
                  WHERE pr.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function calculatePrice($from_district, $from_neighborhood, $to_district, $to_neighborhood) {
        // First try to find exact match
        $query = "SELECT base_price, price_per_km, estimated_distance_km FROM " . $this->table_name . " 
                  WHERE from_district_id = (SELECT id FROM districts WHERE name = ?) 
                  AND to_district_id = (SELECT id FROM districts WHERE name = ?)
                  AND is_active = 1";
        
        $params = [$from_district, $to_district];
        
        if ($from_neighborhood) {
            $query .= " AND from_neighborhood_id = (SELECT id FROM neighborhoods WHERE name = ?)";
            $params[] = $from_neighborhood;
        } else {
            $query .= " AND from_neighborhood_id IS NULL";
        }
        
        if ($to_neighborhood) {
            $query .= " AND to_neighborhood_id = (SELECT id FROM neighborhoods WHERE name = ?)";
            $params[] = $to_neighborhood;
        } else {
            $query .= " AND to_neighborhood_id IS NULL";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch();
        
        if ($result) {
            return $result['base_price'] + ($result['price_per_km'] * $result['estimated_distance_km']);
        }
        
        // If no exact match, try district-to-district only
        $query = "SELECT base_price, price_per_km, estimated_distance_km FROM " . $this->table_name . " 
                  WHERE from_district_id = (SELECT id FROM districts WHERE name = ?) 
                  AND to_district_id = (SELECT id FROM districts WHERE name = ?)
                  AND from_neighborhood_id IS NULL AND to_neighborhood_id IS NULL
                  AND is_active = 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$from_district, $to_district]);
        $result = $stmt->fetch();
        
        if ($result) {
            return $result['base_price'] + ($result['price_per_km'] * $result['estimated_distance_km']);
        }
        
        // Default pricing if no route found
        return 1500.00; // Base price
    }

    public function createPricingRoute($data) {
        $query = "INSERT INTO " . $this->table_name . " (from_district_id, from_neighborhood_id, to_district_id, to_neighborhood_id, base_price, price_per_km, estimated_distance_km) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['from_district_id'],
            $data['from_neighborhood_id'],
            $data['to_district_id'],
            $data['to_neighborhood_id'],
            $data['base_price'],
            $data['price_per_km'],
            $data['estimated_distance_km']
        ]);
    }

    public function updatePricingRoute($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET from_district_id = ?, from_neighborhood_id = ?, to_district_id = ?, to_neighborhood_id = ?, base_price = ?, price_per_km = ?, estimated_distance_km = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['from_district_id'],
            $data['from_neighborhood_id'],
            $data['to_district_id'],
            $data['to_neighborhood_id'],
            $data['base_price'],
            $data['price_per_km'],
            $data['estimated_distance_km'],
            $id
        ]);
    }

    public function deletePricingRoute($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function toggleActive($id) {
        $query = "UPDATE " . $this->table_name . " SET is_active = NOT is_active WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>