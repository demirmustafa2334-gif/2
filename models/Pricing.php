<?php
require_once 'core/Model.php';

class Pricing extends Model {
    protected $table = 'pricing_routes';
    
    public function getPrice($fromDistrictId, $toDistrictId, $fromNeighborhoodId = null, $toNeighborhoodId = null) {
        // First try to find exact match with neighborhoods
        if ($fromNeighborhoodId && $toNeighborhoodId) {
            $sql = "SELECT * FROM pricing_routes 
                    WHERE from_neighborhood_id = ? AND to_neighborhood_id = ? 
                    AND status = 'active'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$fromNeighborhoodId, $toNeighborhoodId]);
            $result = $stmt->fetch();
            
            if ($result) {
                return $result;
            }
        }
        
        // Try district to neighborhood
        if ($fromDistrictId && $toNeighborhoodId) {
            $sql = "SELECT * FROM pricing_routes 
                    WHERE from_district_id = ? AND to_neighborhood_id = ? 
                    AND status = 'active'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$fromDistrictId, $toNeighborhoodId]);
            $result = $stmt->fetch();
            
            if ($result) {
                return $result;
            }
        }
        
        // Try neighborhood to district
        if ($fromNeighborhoodId && $toDistrictId) {
            $sql = "SELECT * FROM pricing_routes 
                    WHERE from_neighborhood_id = ? AND to_district_id = ? 
                    AND status = 'active'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$fromNeighborhoodId, $toDistrictId]);
            $result = $stmt->fetch();
            
            if ($result) {
                return $result;
            }
        }
        
        // Fall back to district to district
        $sql = "SELECT * FROM pricing_routes 
                WHERE from_district_id = ? AND to_district_id = ? 
                AND status = 'active'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$fromDistrictId, $toDistrictId]);
        return $stmt->fetch();
    }
    
    public function calculatePrice($fromDistrictId, $toDistrictId, $fromNeighborhoodId = null, $toNeighborhoodId = null, $distance = 0) {
        $pricing = $this->getPrice($fromDistrictId, $toDistrictId, $fromNeighborhoodId, $toNeighborhoodId);
        
        if (!$pricing) {
            return null;
        }
        
        $totalPrice = $pricing['base_price'] + ($distance * $pricing['price_per_km']);
        
        // Apply minimum price if needed
        if ($totalPrice < $pricing['minimum_price']) {
            $totalPrice = $pricing['minimum_price'];
        }
        
        return round($totalPrice, 2);
    }
    
    public function getAllRoutes() {
        $sql = "SELECT pr.*, 
                fd.name as from_district_name, 
                td.name as to_district_name,
                fn.name as from_neighborhood_name,
                tn.name as to_neighborhood_name
                FROM pricing_routes pr
                LEFT JOIN districts fd ON pr.from_district_id = fd.id
                LEFT JOIN districts td ON pr.to_district_id = td.id
                LEFT JOIN neighborhoods fn ON pr.from_neighborhood_id = fn.id
                LEFT JOIN neighborhoods tn ON pr.to_neighborhood_id = tn.id
                WHERE pr.status = 'active'
                ORDER BY fd.name, td.name";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>