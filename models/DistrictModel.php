<?php
/**
 * District Model
 * Istanbul Moving Company - Custom PHP Script
 */

class DistrictModel {
    private $conn;
    private $table_name = "districts";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDistrictBySlug($slug) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE slug = ? AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function getDistrictById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getActiveDistricts() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_active = 1 ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllDistricts() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNearbyDistricts($district_id, $limit = 5) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id != ? AND is_active = 1 ORDER BY RAND() LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$district_id, $limit]);
        return $stmt->fetchAll();
    }

    public function createDistrict($data) {
        $query = "INSERT INTO " . $this->table_name . " (name, slug, description, meta_title, meta_description, meta_keywords) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords']
        ]);
    }

    public function updateDistrict($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, slug = ?, description = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['description'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords'],
            $id
        ]);
    }

    public function deleteDistrict($id) {
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