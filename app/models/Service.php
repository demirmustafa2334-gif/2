<?php
require_once __DIR__ . '/Model.php';

class Service extends Model {
    protected $table = 'services';
    
    public function getActive() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY display_order ASC, id DESC");
        return $stmt->fetchAll();
    }
    
    public function getBySlug($slug) {
        return $this->findBy('slug', $slug);
    }
    
    public function getFeatured($limit = 4) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY display_order ASC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
