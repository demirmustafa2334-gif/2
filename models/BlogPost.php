<?php
require_once 'core/Model.php';

class BlogPost extends Model {
    protected $table = 'blog_posts';
    
    public function getPublishedPosts($limit = null) {
        $sql = "SELECT * FROM blog_posts 
                WHERE status = 'published' 
                ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ? AND status = 'published'");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    public function getRecentPosts($limit = 5) {
        return $this->getPublishedPosts($limit);
    }
    
    public function search($query) {
        $sql = "SELECT * FROM blog_posts 
                WHERE (title LIKE ? OR content LIKE ? OR excerpt LIKE ?) 
                AND status = 'published' 
                ORDER BY created_at DESC";
        
        $searchTerm = "%{$query}%";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
}
?>