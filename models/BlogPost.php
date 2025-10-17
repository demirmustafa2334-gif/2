<?php
/**
 * Blog Post Model
 * Istanbul Moving Company - Custom PHP Script
 */

class BlogPost extends BaseModel {
    protected $table = 'blog_posts';
    
    public function getPublishedPosts($limit = null) {
        $limitClause = $limit ? "LIMIT {$limit}" : '';
        return $this->findAll('is_published = 1', 'created_at DESC', $limitClause);
    }
    
    public function getRecentPosts($limit = 5) {
        return $this->findAll('is_published = 1', 'created_at DESC', $limit);
    }
    
    public function createWithSEO($data) {
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['title']);
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['title'] . ' | ' . get_setting('site_title') . ' Blog';
        }
        
        // Generate excerpt if not provided
        if (empty($data['excerpt'])) {
            $data['excerpt'] = substr(strip_tags($data['content']), 0, 160) . '...';
        }
        
        return $this->create($data);
    }
    
    public function getPostsForSitemap() {
        $query = "SELECT slug, updated_at FROM blog_posts WHERE is_published = 1 ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function searchPosts($term) {
        $query = "SELECT * FROM blog_posts 
                  WHERE (title LIKE :term OR content LIKE :term OR excerpt LIKE :term) 
                  AND is_published = 1 
                  ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>