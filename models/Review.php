<?php
require_once 'core/Model.php';

class Review extends Model {
    protected $table = 'reviews';
    
    public function getApprovedReviews($limit = null) {
        $sql = "SELECT * FROM reviews 
                WHERE status = 'approved' 
                ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getAverageRating() {
        $sql = "SELECT AVG(rating) as average_rating, COUNT(*) as total_reviews 
                FROM reviews 
                WHERE status = 'approved'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getReviewsByRating($rating) {
        return $this->findAll(['rating' => $rating, 'status' => 'approved'], 'created_at DESC');
    }
    
    public function getPendingReviews() {
        return $this->findAll(['status' => 'pending'], 'created_at DESC');
    }
    
    public function approve($id) {
        return $this->update($id, ['status' => 'approved']);
    }
    
    public function reject($id) {
        return $this->update($id, ['status' => 'rejected']);
    }
}
?>