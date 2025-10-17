<?php
require_once 'core/Model.php';

class District extends Model {
    protected $table = 'districts';
    
    public function getActiveDistricts() {
        return $this->findAll(['status' => 'active'], 'name ASC');
    }
    
    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ? AND status = 'active'");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    public function getDistrictsWithNeighborhoods() {
        $sql = "SELECT d.*, 
                GROUP_CONCAT(n.name ORDER BY n.name SEPARATOR ', ') as neighborhoods
                FROM districts d 
                LEFT JOIN neighborhoods n ON d.id = n.district_id AND n.status = 'active'
                WHERE d.status = 'active'
                GROUP BY d.id 
                ORDER BY d.name";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getNearbyDistricts($districtId, $limit = 5) {
        $sql = "SELECT * FROM districts 
                WHERE id != ? AND status = 'active' 
                ORDER BY name 
                LIMIT ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$districtId, $limit]);
        return $stmt->fetchAll();
    }
}
?>