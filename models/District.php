<?php
/**
 * District Model
 * Istanbul Moving Company - Custom PHP Script
 */

class District extends BaseModel {
    protected $table = 'districts';
    
    public function getActiveDistricts() {
        return $this->findAll('is_active = 1', 'name ASC');
    }
    
    public function getDistrictWithNeighborhoods($id) {
        $query = "SELECT d.*, 
                         (SELECT COUNT(*) FROM neighborhoods n WHERE n.district_id = d.id AND n.is_active = 1) as neighborhood_count
                  FROM districts d 
                  WHERE d.id = :id AND d.is_active = 1 
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getNeighborhoods($district_id) {
        $query = "SELECT * FROM neighborhoods WHERE district_id = :district_id AND is_active = 1 ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':district_id', $district_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function createWithSEO($data) {
        // Generate SEO-friendly slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = generate_slug($data['name'] . '-evden-eve-nakliyat');
        }
        
        // Generate meta title if not provided
        if (empty($data['meta_title'])) {
            $data['meta_title'] = $data['name'] . ' Evden Eve Nakliyat | Güvenilir Taşımacılık';
        }
        
        // Generate meta description if not provided
        if (empty($data['meta_description'])) {
            $data['meta_description'] = $data['name'] . ' evden eve nakliyat hizmetleri. Profesyonel ekip, uygun fiyat, güvenli taşımacılık. Hemen teklif alın!';
        }
        
        return $this->create($data);
    }
    
    public function getDistrictsForSitemap() {
        $query = "SELECT slug, updated_at FROM districts WHERE is_active = 1 ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function searchDistricts($term) {
        $query = "SELECT * FROM districts WHERE (name LIKE :term OR slug LIKE :term) AND is_active = 1 ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
?>