<?php
/**
 * Review Model
 * Istanbul Moving Company - Custom PHP Script
 */

class ReviewModel {
    private $conn;
    private $table_name = "reviews";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getApprovedReviews($limit = null) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_approved = 1 ORDER BY created_at DESC";
        if ($limit) {
            $query .= " LIMIT " . (int)$limit;
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllReviews() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getReviewById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createReview($data) {
        $query = "INSERT INTO " . $this->table_name . " (customer_name, customer_email, rating, review_text) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['customer_name'],
            $data['customer_email'],
            $data['rating'],
            $data['review_text']
        ]);
    }

    public function updateReview($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET customer_name = ?, customer_email = ?, rating = ?, review_text = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['customer_name'],
            $data['customer_email'],
            $data['rating'],
            $data['review_text'],
            $id
        ]);
    }

    public function deleteReview($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function approveReview($id) {
        $query = "UPDATE " . $this->table_name . " SET is_approved = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function getAverageRating() {
        $query = "SELECT AVG(rating) as average_rating, COUNT(*) as total_reviews FROM " . $this->table_name . " WHERE is_approved = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>