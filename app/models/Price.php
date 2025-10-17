<?php
/**
 * Price Model
 */

class Price {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $sql = "SELECT p.*, 
                d1.name as from_district_name, 
                d2.name as to_district_name
                FROM prices p
                LEFT JOIN districts d1 ON p.from_district_id = d1.id
                LEFT JOIN districts d2 ON p.to_district_id = d2.id
                WHERE p.is_active = 1
                ORDER BY d1.name, d2.name";
        
        return $this->db->fetchAll($sql);
    }

    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM prices WHERE id = ?", [$id]);
    }

    public function getPrice($fromDistrictId, $toDistrictId) {
        $sql = "SELECT * FROM prices 
                WHERE from_district_id = ? AND to_district_id = ? AND is_active = 1";
        return $this->db->fetchOne($sql, [$fromDistrictId, $toDistrictId]);
    }

    public function create($data) {
        return $this->db->insert('prices', $data);
    }

    public function update($id, $data) {
        return $this->db->update('prices', $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->delete('prices', 'id = ?', [$id]);
    }

    public function calculatePrice($fromDistrictId, $toDistrictId) {
        $price = $this->getPrice($fromDistrictId, $toDistrictId);
        
        if ($price) {
            return $price['base_price'];
        }
        
        // Default price if route not found
        return 1000.00;
    }
}
