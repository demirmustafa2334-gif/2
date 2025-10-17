<?php
require_once __DIR__ . '/Model.php';

class Price extends Model {
    protected $table = 'prices';
    
    public function getByRoute($fromId, $toId) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE from_district_id = ? AND to_district_id = ? AND is_active = 1");
        $stmt->execute([$fromId, $toId]);
        return $stmt->fetch();
    }
    
    public function getAllWithDistricts() {
        $stmt = $this->db->query("
            SELECT p.*, 
                   d1.name as from_district_name, 
                   d2.name as to_district_name 
            FROM {$this->table} p 
            JOIN districts d1 ON p.from_district_id = d1.id 
            JOIN districts d2 ON p.to_district_id = d2.id 
            ORDER BY d1.name, d2.name
        ");
        return $stmt->fetchAll();
    }
}
