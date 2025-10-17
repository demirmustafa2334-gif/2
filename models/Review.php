<?php
/**
 * Review Model
 * Istanbul Moving Company - Custom PHP Script
 */

class Review extends BaseModel {
    protected $table = 'reviews';
    
    public function getApprovedReviews($limit = null) {
        $limitClause = $limit ? "LIMIT {$limit}" : '';
        return $this->findAll('is_approved = 1', 'created_at DESC', $limitClause);
    }
    
    public function getFeaturedReviews($limit = 6) {
        return $this->findAll('is_approved = 1 AND is_featured = 1', 'created_at DESC', $limit);
    }
    
    public function getPendingReviews() {
        return $this->findAll('is_approved = 0', 'created_at DESC');
    }
    
    public function approveReview($id) {
        return $this->update($id, ['is_approved' => 1]);
    }
    
    public function toggleFeatured($id) {
        $review = $this->findById($id);
        if ($review) {
            $newStatus = $review['is_featured'] ? 0 : 1;
            return $this->update($id, ['is_featured' => $newStatus]);
        }
        return false;
    }
    
    public function getAverageRating() {
        $query = "SELECT AVG(rating) as avg_rating, COUNT(*) as total_reviews 
                  FROM reviews WHERE is_approved = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getRatingDistribution() {
        $query = "SELECT rating, COUNT(*) as count 
                  FROM reviews 
                  WHERE is_approved = 1 
                  GROUP BY rating 
                  ORDER BY rating DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>