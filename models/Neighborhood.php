<?php
/**
 * Neighborhood Model
 * Istanbul Moving Company - Custom PHP Script
 */

class Neighborhood extends BaseModel {
    protected $table = 'neighborhoods';
    
    public function getNeighborhoodWithDistrict($slug) {
        $query = "SELECT n.*, d.name as district_name, d.slug as district_slug
                  FROM neighborhoods n 
                  JOIN districts d ON n.district_id = d.id 
                  WHERE n.slug = :slug AND n.is_active = 1 AND d.is_active = 1 
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getNeighborhoodsByDistrict($district_id) {
        return $this->findAll("district_id = {$district_id} AND is_active = 1", 'name ASC');
    }
    
    public function createWithSEO($data) {
        // Get district name for SEO
        $district = new District();
        $districtData = $district->findById($data['district_id']);
        
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['name'] . '-evden-eve-nakliyat');
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'] . ' Evden Eve Nakliyat | ' . $districtData['name'] . ' Nakliyat';
        }
        
        // Generate meta description if not provided
        if (empty($data['meta_description'])) {
            $data['meta_description'] = $data['name'] . ' mahallesi evden eve nakliyat. ' . $districtData['name'] . '\'ün en güvenilir nakliyat firması. Profesyonel hizmet!';
        }
        
        return $this->create($data);
    }
    
    public function getNeighborhoodsForSitemap() {
        $query = "SELECT n.slug, n.updated_at, d.slug as district_slug
                  FROM neighborhoods n 
                  JOIN districts d ON n.district_id = d.id 
                  WHERE n.is_active = 1 AND d.is_active = 1 
                  ORDER BY d.name ASC, n.name ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getNearbyNeighborhoods($district_id, $current_id = null, $limit = 5) {
        $query = "SELECT * FROM neighborhoods 
                  WHERE district_id = :district_id AND is_active = 1";
        
        if ($current_id) {
            $query .= " AND id != :current_id";
        }
        
        $query .= " ORDER BY name ASC LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':district_id', $district_id);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        
        if ($current_id) {
            $stmt->bindParam(':current_id', $current_id);
        }
        
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>