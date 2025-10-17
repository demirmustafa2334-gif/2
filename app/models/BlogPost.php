<?php
require_once __DIR__ . '/Model.php';

class BlogPost extends Model {
    protected $table = 'blog_posts';
    
    public function getPublished($limit = null) {
        $sql = "SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY published_at DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
    
    public function getBySlug($slug) {
        $post = $this->findBy('slug', $slug);
        if ($post && $post['is_published']) {
            // Increment view count
            $this->db->prepare("UPDATE {$this->table} SET view_count = view_count + 1 WHERE id = ?")->execute([$post['id']]);
        }
        return $post;
    }
    
    public function getRecent($limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE is_published = 1 ORDER BY published_at DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}
