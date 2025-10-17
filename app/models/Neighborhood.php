<?php
require_once __DIR__ . '/Model.php';

class Neighborhood extends Model {
    protected $table = 'neighborhoods';
    
    public function getActive() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY name ASC");
        return $stmt->fetchAll();
    }
    
    public function getBySlug($slug) {
        return $this->findBy('slug', $slug);
    }
    
    public function getByDistrict($districtId) {
        return $this->findAllBy('district_id', $districtId, 'name ASC');
    }
    
    public function getWithDistrict($slug) {
        $stmt = $this->db->prepare("
            SELECT n.*, d.name as district_name, d.slug as district_slug 
            FROM {$this->table} n 
            JOIN districts d ON n.district_id = d.id 
            WHERE n.slug = ?
        ");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
}
