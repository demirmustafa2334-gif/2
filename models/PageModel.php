<?php
/**
 * Page Model
 * Istanbul Moving Company - Custom PHP Script
 */

class PageModel {
    private $conn;
    private $table_name = "pages";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPageBySlug($slug) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE slug = ? AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function getPageById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllPages() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createPage($data) {
        $query = "INSERT INTO " . $this->table_name . " (title, slug, content, meta_title, meta_description, meta_keywords, page_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords'],
            $data['page_type']
        ]);
    }

    public function updatePage($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET title = ?, slug = ?, content = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, page_type = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords'],
            $data['page_type'],
            $id
        ]);
    }

    public function deletePage($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>