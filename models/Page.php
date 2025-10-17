<?php
/**
 * Page Model
 * Istanbul Moving Company - Custom PHP Script
 */

class Page extends BaseModel {
    protected $table = 'pages';
    
    public function getActivePages() {
        return $this->findAll('is_active = 1', 'title ASC');
    }
    
    public function createWithSEO($data) {
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['title']);
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['title'] . ' | ' . get_setting('site_title');
        }
        
        return $this->create($data);
    }
    
    public function getPagesForSitemap() {
        $query = "SELECT slug, updated_at FROM pages WHERE is_active = 1 ORDER BY title ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>