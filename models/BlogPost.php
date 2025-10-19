<?php
/**
 * Blog Post Model
 * Yereltanitim.com - Turkey Tourism Website
 */

class BlogPost extends BaseModel {
    protected $table = 'blog_posts';
    
    public function getPublishedPosts($limit = null) {
        $limitClause = $limit ? "LIMIT {$limit}" : '';
        return $this->findAll('is_published = 1', 'created_at DESC', $limitClause);
    }
    
    public function getFeaturedPosts($limit = 5) {
        return $this->findAll('is_published = 1 AND is_featured = 1', 'created_at DESC', $limit);
    }
    
    public function getPostWithDetails($slug) {
        $query = "SELECT bp.*, 
                         c.name as city_name, c.slug as city_slug,
                         d.name as district_name, d.slug as district_slug,
                         au.username as author_name
                  FROM blog_posts bp
                  LEFT JOIN cities c ON bp.city_id = c.id
                  LEFT JOIN districts d ON bp.district_id = d.id
                  LEFT JOIN admin_users au ON bp.author_id = au.id
                  WHERE bp.slug = :slug AND bp.is_published = 1
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getPostsByCity($city_id, $limit = null, $exclude_id = null) {
        $excludeClause = $exclude_id ? "AND id != {$exclude_id}" : '';
        $limitClause = $limit ? "LIMIT {$limit}" : '';
        
        return $this->findAll("city_id = {$city_id} AND is_published = 1 {$excludeClause}", 'created_at DESC', $limitClause);
    }
    
    public function getPostsByDistrict($district_id, $limit = null, $exclude_id = null) {
        $excludeClause = $exclude_id ? "AND id != {$exclude_id}" : '';
        $limitClause = $limit ? "LIMIT {$limit}" : '';
        
        return $this->findAll("district_id = {$district_id} AND is_published = 1 {$excludeClause}", 'created_at DESC', $limitClause);
    }
    
    public function getRelatedPosts($city_id, $district_id = null, $current_id = null, $limit = 3) {
        $conditions = ["is_published = 1"];
        
        if ($current_id) {
            $conditions[] = "id != {$current_id}";
        }
        
        if ($district_id) {
            $conditions[] = "(district_id = {$district_id} OR city_id = {$city_id})";
        } else {
            $conditions[] = "city_id = {$city_id}";
        }
        
        $whereClause = implode(' AND ', $conditions);
        
        return $this->findAll($whereClause, 'created_at DESC', $limit);
    }
    
    public function createWithSEO($data) {
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['title']);
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['title'] . ' | Yereltanitim.com';
        }
        
        // Generate excerpt if not provided
        if (empty($data['excerpt'])) {
            $data['excerpt'] = truncate_text(strip_tags($data['content']), 160);
        }
        
        return $this->create($data);
    }
    
    public function incrementViewCount($id) {
        $query = "UPDATE blog_posts SET view_count = view_count + 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    public function getPostsForSitemap() {
        $query = "SELECT slug, updated_at FROM blog_posts WHERE is_published = 1 ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function searchPosts($term) {
        $query = "SELECT bp.*, c.name as city_name, d.name as district_name
                  FROM blog_posts bp
                  LEFT JOIN cities c ON bp.city_id = c.id
                  LEFT JOIN districts d ON bp.district_id = d.id
                  WHERE (bp.title LIKE :term OR bp.content LIKE :term OR bp.excerpt LIKE :term OR bp.tags LIKE :term) 
                  AND bp.is_published = 1 
                  ORDER BY bp.created_at DESC";
        
        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getPopularPosts($limit = 10) {
        return $this->findAll('is_published = 1', 'view_count DESC', $limit);
    }
    
    public function getRecentPosts($limit = 5) {
        return $this->findAll('is_published = 1', 'created_at DESC', $limit);
    }
}
?>