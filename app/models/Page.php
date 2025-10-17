<?php
/**
 * Page Model
 */

class Page {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll($activeOnly = false) {
        $sql = "SELECT * FROM pages";
        if ($activeOnly) {
            $sql .= " WHERE is_active = 1";
        }
        $sql .= " ORDER BY sort_order, title";
        
        return $this->db->fetchAll($sql);
    }

    public function getById($id) {
        return $this->db->fetchOne("SELECT * FROM pages WHERE id = ?", [$id]);
    }

    public function getBySlug($slug) {
        return $this->db->fetchOne("SELECT * FROM pages WHERE slug = ? AND is_active = 1", [$slug]);
    }

    public function create($data) {
        return $this->db->insert('pages', $data);
    }

    public function update($id, $data) {
        return $this->db->update('pages', $data, 'id = ?', [$id]);
    }

    public function delete($id) {
        return $this->db->delete('pages', 'id = ?', [$id]);
    }
}
