<?php
/**
 * District Model
 * Yereltanitim.com - Turkey Tourism Website
 */

class District extends BaseModel {
    protected $table = 'districts';
    
    public function getDistrictWithCity($slug) {
        $query = "SELECT d.*, c.name as city_name, c.slug as city_slug, c.region
                  FROM districts d 
                  JOIN cities c ON d.city_id = c.id 
                  WHERE d.slug = :slug AND d.is_active = 1 AND c.is_active = 1 
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getDistrictsByCity($city_id) {
        return $this->findAll("city_id = {$city_id} AND is_active = 1", 'name ASC');
    }
    
    public function getRelatedDistricts($city_id, $current_id = null, $limit = 6) {
        $excludeClause = $current_id ? "AND id != {$current_id}" : '';
        
        $query = "SELECT * FROM districts 
                  WHERE city_id = :city_id AND is_active = 1 {$excludeClause}
                  ORDER BY name ASC 
                  LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':city_id', $city_id);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function createWithSEO($data) {
        // Get city name for SEO
        $city = new City();
        $cityData = $city->findById($data['city_id']);
        
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['name'] . '-' . $cityData['name']);
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'] . ' (' . $cityData['name'] . ') Rehberi | Yereltanitim.com';
        }
        
        // Generate meta description if not provided
        if (empty($data['meta_description'])) {
            $data['meta_description'] = $cityData['name'] . ' ili ' . $data['name'] . ' ilçesi hakkında detaylı bilgiler. Turistik yerler, yerel lezzetler ve özellikler.';
        }
        
        // Generate meta keywords if not provided
        if (empty($data['meta_keywords'])) {
            $data['meta_keywords'] = $data['name'] . ', ' . $cityData['name'] . ', turizm, gezi rehberi, yerel lezzetler';
        }
        
        return $this->create($data);
    }
    
    public function getDistrictsForSitemap() {
        $query = "SELECT d.slug, d.updated_at, c.slug as city_slug
                  FROM districts d 
                  JOIN cities c ON d.city_id = c.id 
                  WHERE d.is_active = 1 AND c.is_active = 1 
                  ORDER BY c.name ASC, d.name ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getPopularDistricts($limit = 10) {
        $query = "SELECT d.*, c.name as city_name, c.slug as city_slug, COUNT(bp.id) as blog_count 
                  FROM districts d 
                  JOIN cities c ON d.city_id = c.id
                  LEFT JOIN blog_posts bp ON d.id = bp.district_id AND bp.is_published = 1
                  WHERE d.is_active = 1 AND c.is_active = 1
                  GROUP BY d.id 
                  ORDER BY blog_count DESC, d.name ASC 
                  LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function searchDistricts($term) {
        $query = "SELECT d.*, c.name as city_name, c.slug as city_slug
                  FROM districts d 
                  JOIN cities c ON d.city_id = c.id
                  WHERE (d.name LIKE :term OR d.description LIKE :term OR c.name LIKE :term) 
                  AND d.is_active = 1 AND c.is_active = 1 
                  ORDER BY d.name ASC";
        
        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>