<?php
/**
 * Blog Model
 * Istanbul Moving Company - Custom PHP Script
 */

class BlogModel {
    private $conn;
    private $table_name = "blog_posts";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPostBySlug($slug) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE slug = ? AND is_published = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    public function getPostById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getPublishedPosts($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_published = 1 ORDER BY published_at DESC LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll();
    }

    public function getAllPosts() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecentPosts($limit = 5) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_published = 1 ORDER BY published_at DESC LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function getTotalPublishedPosts() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE is_published = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }

    public function createPost($data) {
        $query = "INSERT INTO " . $this->table_name . " (title, slug, content, excerpt, featured_image, meta_title, meta_description, meta_keywords, is_published, published_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['excerpt'],
            $data['featured_image'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords'],
            $data['is_published'],
            $data['is_published'] ? date('Y-m-d H:i:s') : null
        ]);
    }

    public function updatePost($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET title = ?, slug = ?, content = ?, excerpt = ?, featured_image = ?, meta_title = ?, meta_description = ?, meta_keywords = ?, is_published = ?, published_at = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['excerpt'],
            $data['featured_image'],
            $data['meta_title'],
            $data['meta_description'],
            $data['meta_keywords'],
            $data['is_published'],
            $data['is_published'] ? date('Y-m-d H:i:s') : null,
            $id
        ]);
    }

    public function deletePost($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function togglePublished($id) {
        $query = "UPDATE " . $this->table_name . " SET is_published = NOT is_published, published_at = CASE WHEN is_published = 0 THEN NOW() ELSE published_at END WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>