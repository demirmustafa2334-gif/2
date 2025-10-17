<?php
require_once __DIR__ . '/Model.php';

class District extends Model {
    protected $table = 'districts';
    
    public function getActive() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY name ASC");
        return $stmt->fetchAll();
    }
    
    public function getBySlug($slug) {
        return $this->findBy('slug', $slug);
    }
    
    public function getWithNeighborhoods($districtId) {
        $district = $this->findById($districtId);
        if ($district) {
            $stmt = $this->db->prepare("SELECT * FROM neighborhoods WHERE district_id = ? AND is_active = 1 ORDER BY name ASC");
            $stmt->execute([$districtId]);
            $district['neighborhoods'] = $stmt->fetchAll();
        }
        return $district;
    }
    
    public function getAllWithNeighborhoods() {
        $districts = $this->getActive();
        foreach ($districts as &$district) {
            $stmt = $this->db->prepare("SELECT * FROM neighborhoods WHERE district_id = ? AND is_active = 1 ORDER BY name ASC");
            $stmt->execute([$district['id']]);
            $district['neighborhoods'] = $stmt->fetchAll();
        }
        return $districts;
    }
}
