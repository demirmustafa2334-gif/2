<?php
require_once 'core/Model.php';

class Neighborhood extends Model {
    protected $table = 'neighborhoods';
    
    public function getActiveNeighborhoods() {
        return $this->findAll(['status' => 'active'], 'name ASC');
    }
    
    public function findBySlug($slug, $districtId = null) {
        $sql = "SELECT n.*, d.name as district_name, d.slug as district_slug 
                FROM neighborhoods n 
                JOIN districts d ON n.district_id = d.id 
                WHERE n.slug = ? AND n.status = 'active'";
        
        $params = [$slug];
        
        if ($districtId) {
            $sql .= " AND n.district_id = ?";
            $params[] = $districtId;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    public function getByDistrict($districtId) {
        $sql = "SELECT * FROM neighborhoods 
                WHERE district_id = ? AND status = 'active' 
                ORDER BY name";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$districtId]);
        return $stmt->fetchAll();
    }
    
    public function getNearbyNeighborhoods($neighborhoodId, $districtId, $limit = 5) {
        $sql = "SELECT * FROM neighborhoods 
                WHERE id != ? AND district_id = ? AND status = 'active' 
                ORDER BY name 
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$neighborhoodId, $districtId, $limit]);
        return $stmt->fetchAll();
    }
    
    public function search($query) {
        $sql = "SELECT n.*, d.name as district_name, d.slug as district_slug 
                FROM neighborhoods n 
                JOIN districts d ON n.district_id = d.id 
                WHERE (n.name LIKE ? OR d.name LIKE ?) AND n.status = 'active' 
                ORDER BY n.name";
        
        $searchTerm = "%{$query}%";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
}
?>