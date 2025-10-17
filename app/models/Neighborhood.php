<?php
/**
 * Neighborhood Model
 */

class Neighborhood {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($activeOnly = false) {
        $sql = "SELECT n.*, d.name as district_name 
                FROM neighborhoods n 
                LEFT JOIN districts d ON n.district_id = d.id";
        if ($activeOnly) {
            $sql .= " WHERE n.is_active = 1";
        }
        $sql .= " ORDER BY n.sort_order, n.name";
        
        return $this->db->fetchAll($sql);
    }

    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM neighborhoods WHERE id = ?", [$id]);
    }

    public function getBySlug($slug) {
        $sql = "SELECT n.*, d.name as district_name, d.slug as district_slug 
                FROM neighborhoods n 
                LEFT JOIN districts d ON n.district_id = d.id 
                WHERE n.slug = ? AND n.is_active = 1";
        return $this->db->fetchOne($sql, [$slug]);
    }

    public function getByDistrict($districtId, $activeOnly = true) {
        $sql = "SELECT * FROM neighborhoods WHERE district_id = ?";
        $params = [$districtId];
        
        if ($activeOnly) {
            $sql .= " AND is_active = 1";
        }
        $sql .= " ORDER BY sort_order, name";
        
        return $this->db->fetchAll($sql, $params);
    }

    public function create($data) {
        return $this->db->insert('neighborhoods', $data);
    }

    public function update($id, $data) {
        return $this->db->update('neighborhoods', $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->delete('neighborhoods', 'id = ?', [$id]);
    }

    public function count() {
        $result = $this->db->fetchOne("SELECT COUNT(*) as count FROM neighborhoods");
        return $result['count'];
    }
}
