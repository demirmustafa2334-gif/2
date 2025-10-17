<?php
/**
 * Neighborhood Model
 * Istanbul Moving Company - Custom PHP Script
 */

class NeighborhoodModel {
    private $conn;
    private $table_name = "neighborhoods";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getNeighborhoodBySlug($slug) {
        $query = "SELECT n.*, d.name as district_name FROM " . $this->table_name . " n 
                  LEFT JOIN districts d ON n.district_id = d.id 
                  WHERE n.slug = ? AND n.is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function getNeighborhoodById($id) {
        $query = "SELECT n.*, d.name as district_name FROM " . $this->table_name . " n 
                  LEFT JOIN districts d ON n.district_id = d.id 
                  WHERE n.id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getNeighborhoodsByDistrict($district_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE district_id = ? AND is_active = 1 ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$district_id]);
        return $stmt->fetchAll();
    }

    public function getAllActiveNeighborhoods() {
        $query = "SELECT n.*, d.name as district_name FROM " . $this->table_name . " n 
                  LEFT JOIN districts d ON n.district_id = d.id 
                  WHERE n.is_active = 1 ORDER BY d.name ASC, n.name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNearbyNeighborhoods($neighborhood_id, $limit = 5) {
        $query = "SELECT n.*, d.name as district_name FROM " . $this->table_name . " n 
                  LEFT JOIN districts d ON n.district_id = d.id 
                  WHERE n.id != ? AND n.is_active = 1 ORDER BY RAND() LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$neighborhood_id, $limit]);
        return $stmt->fetchAll();
    }

    public function createNeighborhood($data) {
        $query = "INSERT INTO " . $this->table_name . " (district_id, name, slug, description, meta_title, meta_description, meta_keywords) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['district_id'],
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords']
        ]);
    }

    public function updateNeighborhood($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET district_id = ?, name = ?, slug = ?, description = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['district_id'],
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords'],
            $id
        ]);
    }

    public function deleteNeighborhood($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function toggleActive($id) {
        $query = "UPDATE " . $this->table_name . " SET is_active = NOT is_active WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>