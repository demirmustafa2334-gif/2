<?php
/**
 * BlogPost Model
 */

class BlogPost {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($publishedOnly = false, $limit = null, $offset = 0) {
        $sql = "SELECT * FROM blog_posts";
        if ($publishedOnly) {
            $sql .= " WHERE is_published = 1";
        }
        $sql .= " ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT ? OFFSET ?";
            return $this->db->fetchAll($sql, [$limit, $offset]);
        }
        
        return $this->db->fetchAll($sql);
    }

    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM blog_posts WHERE id = ?", [$id]);
    }

    public function getBySlug($slug) {
        return $this->db->fetchOne("SELECT * FROM blog_posts WHERE slug = ? AND is_published = 1", [$slug]);
    }

    public function getRecent($limit = 5) {
        return $this->getAll(true, $limit);
    }

    public function create($data) {
        return $this->db->insert('blog_posts', $data);
    }

    public function update($id, $data) {
        return $this->db->update('blog_posts', $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->delete('blog_posts', 'id = ?', [$id]);
    }

    public function incrementViews($id) {
        $this->db->query("UPDATE blog_posts SET views = views + 1 WHERE id = ?", [$id]);
    }

    public function count($publishedOnly = true) {
        $sql = "SELECT COUNT(*) as count FROM blog_posts";
        if ($publishedOnly) {
            $sql .= " WHERE is_published = 1";
        }
        $result = $this->db->fetchOne($sql);
        return $result['count'];
    }
}
