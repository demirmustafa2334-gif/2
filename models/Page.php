<?php
require_once 'core/Model.php';

class Page extends Model {
    protected $table = 'pages';
    
    public function getActivePages() {
        return $this->findAll(['status' => 'active'], 'title ASC');
    }
    
    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE slug = ? AND status = 'active'");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }
    
    public function getHomePage() {
        return $this->findBySlug('home');
    }
    
    public function getServicesPage() {
        return $this->findBySlug('services');
    }
    
    public function getContactPage() {
        return $this->findBySlug('contact');
    }
}
?>