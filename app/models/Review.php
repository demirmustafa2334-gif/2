<?php
require_once __DIR__ . '/Model.php';

class Review extends Model {
    protected $table = 'reviews';
    
    public function getApproved($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE is_approved = 1 ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    public function getFeatured() {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE is_approved = 1 AND is_featured = 1 ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    public function getAverageRating() {
        $stmt = $this->db->query("SELECT AVG(rating) as avg_rating FROM {$this->table} WHERE is_approved = 1");
        $result = $stmt->fetch();
        return round($result['avg_rating'], 1);
    }
    
    public function getPending() {
        return $this->findAllBy('is_approved', 0, 'created_at DESC');
    }
}
