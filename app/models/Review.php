<?php
/**
 * Review Model
 */

class Review {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($approvedOnly = false) {
        $sql = "SELECT * FROM reviews";
        if ($approvedOnly) {
            $sql .= " WHERE is_approved = 1";
        }
        $sql .= " ORDER BY created_at DESC";
        
        return $this->db->fetchAll($sql);
    }

    public function getFeatured($limit = 6) {
        $sql = "SELECT * FROM reviews 
                WHERE is_approved = 1 AND is_featured = 1 
                ORDER BY created_at DESC 
                LIMIT ?";
        return $this->db->fetchAll($sql, [$limit]);
    }

    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM reviews WHERE id = ?", [$id]);
    }

    public function create($data) {
        return $this->db->insert('reviews', $data);
    }

    public function update($id, $data) {
        return $this->db->update('reviews', $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->delete('reviews', 'id = ?', [$id]);
    }

    public function approve($id) {
        return $this->update($id, ['is_approved' => 1]);
    }

    public function count() {
        $result = $this->db->fetchOne("SELECT COUNT(*) as count FROM reviews WHERE is_approved = 1");
        return $result['count'];
    }

    public function getAverageRating() {
        $result = $this->db->fetchOne("SELECT AVG(rating) as avg_rating FROM reviews WHERE is_approved = 1");
        return round($result['avg_rating'] ?? 5, 1);
    }
}
