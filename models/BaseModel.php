<?php
/**
 * Base Model Class
 * Istanbul Moving Company - Custom PHP Script
 */

class BaseModel {
    protected $db;
    protected $table;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    public function findAll($conditions = '', $orderBy = 'id DESC', $limit = '') {
        $query = "SELECT * FROM {$this->table}";
        
        if (!empty($conditions)) {
            $query .= " WHERE " . $conditions;
        }
        
        if (!empty($orderBy)) {
            $query .= " ORDER BY " . $orderBy;
        }
        
        if (!empty($limit)) {
            $query .= " LIMIT " . $limit;
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function findById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function findBySlug($slug) {
        $query = "SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function create($data) {
        $fields = array_keys($data);
        $placeholders = ':' . implode(', :', $fields);
        
        $query = "INSERT INTO {$this->table} (" . implode(', ', $fields) . ") VALUES (" . $placeholders . ")";
        $stmt = $this->db->prepare($query);
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    public function update($id, $data) {
        $fields = [];
        foreach (array_keys($data) as $field) {
            $fields[] = $field . ' = :' . $field;
        }
        
        $query = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id', $id);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    public function count($conditions = '') {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        
        if (!empty($conditions)) {
            $query .= " WHERE " . $conditions;
        }
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result['total'];
    }
}
?>