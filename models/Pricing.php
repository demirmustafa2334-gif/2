<?php
/**
 * Pricing Model
 * Istanbul Moving Company - Custom PHP Script
 */

class Pricing extends BaseModel {
    protected $table = 'pricing';
    
    public function getPriceEstimate($from_district_id, $to_district_id) {
        $query = "SELECT p.*, 
                         d1.name as from_district_name,
                         d2.name as to_district_name
                  FROM pricing p
                  JOIN districts d1 ON p.from_district_id = d1.id
                  JOIN districts d2 ON p.to_district_id = d2.id
                  WHERE p.from_district_id = :from_id AND p.to_district_id = :to_id
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':from_id', $from_district_id);
        $stmt->bindParam(':to_id', $to_district_id);
        $stmt->execute();
        
        $result = $stmt->fetch();
        
        // If no specific route price found, return average base price
        if (!$result) {
            $avgQuery = "SELECT AVG(base_price) as avg_price FROM pricing";
            $avgStmt = $this->db->prepare($avgQuery);
            $avgStmt->execute();
            $avgResult = $avgStmt->fetch();
            
            return [
                'base_price' => $avgResult['avg_price'] ?: 500,
                'price_per_km' => 10,
                'estimated' => true
            ];
        }
        
        return $result;
    }
    
    public function getAllPricing() {
        $query = "SELECT p.*, 
                         d1.name as from_district_name,
                         d2.name as to_district_name
                  FROM pricing p
                  JOIN districts d1 ON p.from_district_id = d1.id
                  JOIN districts d2 ON p.to_district_id = d2.id
                  ORDER BY d1.name ASC, d2.name ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function createOrUpdatePrice($from_district_id, $to_district_id, $base_price, $price_per_km = 0) {
        // Check if price already exists
        $existing = $this->getPriceEstimate($from_district_id, $to_district_id);
        
        if ($existing && !isset($existing['estimated'])) {
            // Update existing price
            $query = "UPDATE pricing SET base_price = :base_price, price_per_km = :price_per_km 
                      WHERE from_district_id = :from_id AND to_district_id = :to_id";
            $stmt = $this->db->prepare($query);
        } else {
            // Create new price
            $query = "INSERT INTO pricing (from_district_id, to_district_id, base_price, price_per_km) 
                      VALUES (:from_id, :to_id, :base_price, :price_per_km)";
            $stmt = $this->db->prepare($query);
        }
        
        $stmt->bindParam(':from_id', $from_district_id);
        $stmt->bindParam(':to_id', $to_district_id);
        $stmt->bindParam(':base_price', $base_price);
        $stmt->bindParam(':price_per_km', $price_per_km);
        
        return $stmt->execute();
    }
    
    public function deletePricing($from_district_id, $to_district_id) {
        $query = "DELETE FROM pricing WHERE from_district_id = :from_id AND to_district_id = :to_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':from_id', $from_district_id);
        $stmt->bindParam(':to_id', $to_district_id);
        
        return $stmt->execute();
    }
}
?>