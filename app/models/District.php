<?php
/**
 * District Model
 */

class District {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($activeOnly = false) {
        $sql = "SELECT * FROM districts";
        if ($activeOnly) {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " ORDER BY sort_order, name";
        
        return $this->db->fetchAll($sql);
    }

    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM districts WHERE id = ?", [$id]);
    }

    public function getBySlug($slug) {
        return $this->db->fetchOne("SELECT * FROM districts WHERE slug = ? AND is_active = 1", [$slug]);
    }

    public function create($data) {
        return $this->db->insert('districts', $data);
    }

    public function update($id, $data) {
        return $this->db->update('districts', $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->delete('districts', 'id = ?', [$id]);
    }

    public function getWithNeighborhoods() {
        $districts = $this->getAll(true);
        $neighborhoodModel = new Neighborhood();
        
        foreach ($districts as &$district) {
            $district['neighborhoods'] = $neighborhoodModel->getByDistrict($district['id']);
        }
        
        return $districts;
    }

    public function count() {
        $result = $this->db->fetchOne("SELECT COUNT(*) as count FROM districts");
        return $result['count'];
    }
}
