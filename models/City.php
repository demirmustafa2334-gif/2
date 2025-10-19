<?php
/**
 * City Model
 * Yereltanitim.com - Turkey Tourism Website
 */

class City extends BaseModel {
    protected $table = 'cities';
    
    public function getActiveCities() {
        return $this->findAll('is_active = 1', 'name ASC');
    }
    
    public function getCityWithDistricts($id) {
        $query = "SELECT c.*, 
                         (SELECT COUNT(*) FROM districts d WHERE d.city_id = c.id AND d.is_active = 1) as district_count
                  FROM cities c 
                  WHERE c.id = :id AND c.is_active = 1 
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getDistricts($city_id) {
        $query = "SELECT * FROM districts WHERE city_id = :city_id AND is_active = 1 ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':city_id', $city_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getCitiesByRegion($region = null) {
        if ($region) {
            return $this->findAll("region = '{$region}' AND is_active = 1", 'name ASC');
        }
        
        $query = "SELECT region, COUNT(*) as city_count FROM cities WHERE is_active = 1 GROUP BY region ORDER BY region ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getPopularCities($limit = 10) {
        $query = "SELECT c.*, COUNT(bp.id) as blog_count 
                  FROM cities c 
                  LEFT JOIN blog_posts bp ON c.id = bp.city_id AND bp.is_published = 1
                  WHERE c.is_active = 1 
                  GROUP BY c.id 
                  ORDER BY blog_count DESC, c.population DESC 
                  LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function createWithSEO($data) {
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['name']);
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'] . ' Rehberi | Yereltanitim.com';
        }
        
        // Generate meta description if not provided
        if (empty($data['meta_description'])) {
            $data['meta_description'] = $data['name'] . ' ili hakkında detaylı bilgiler. Turistik yerler, yerel lezzetler ve kültürel özellikler.';
        }
        
        // Generate meta keywords if not provided
        if (empty($data['meta_keywords'])) {
            $data['meta_keywords'] = $data['name'] . ', turizm, gezi rehberi, yerel lezzetler, kültür';
        }
        
        return $this->create($data);
    }
    
    public function getCitiesForSitemap() {
        $query = "SELECT slug, updated_at FROM cities WHERE is_active = 1 ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getRandomCities($limit = 5, $exclude_id = null) {
        $excludeClause = $exclude_id ? "AND id != {$exclude_id}" : '';
        
        $query = "SELECT * FROM cities WHERE is_active = 1 {$excludeClause} ORDER BY RAND() LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function incrementViewCount($id) {
        $query = "UPDATE cities SET view_count = view_count + 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}
?>