<?php
class Controller {
    protected $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = "views/{$view}.php";
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View {$view} not found");
        }
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
    
    protected function input($key, $default = null) {
        return $_REQUEST[$key] ?? $default;
    }
    
    protected function sanitize($input) {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    protected function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    protected function generateSlug($text) {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        return trim($text, '-');
    }
    
    protected function setMetaData($title = null, $description = null, $keywords = null) {
        $this->metaTitle = $title ?: DEFAULT_META_TITLE;
        $this->metaDescription = $description ?: DEFAULT_META_DESCRIPTION;
        $this->metaKeywords = $keywords ?: DEFAULT_META_KEYWORDS;
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            $this->redirect('/admin');
        }
    }
}
?>