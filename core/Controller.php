<?php
/**
 * Base Controller
 */

class Controller {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    protected function view($view, $data = []) {
        extract($data);
        
        $viewFile = __DIR__ . '/../app/views/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View not found: {$view}");
        }
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit;
    }

    protected function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function input($key, $default = null) {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function sanitize($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    protected function generateSlug($text) {
        // Turkish character conversion
        $turkish = ['ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'ç', 'Ç'];
        $english = ['s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c'];
        $text = str_replace($turkish, $english, $text);
        
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        
        return $text;
    }

    protected function uploadFile($file, $directory = 'uploads') {
        $config = require __DIR__ . '/../config/app.php';
        
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($extension, $config['allowed_extensions'])) {
            return false;
        }

        if ($file['size'] > $config['upload_max_size']) {
            return false;
        }

        $filename = uniqid() . '.' . $extension;
        $uploadPath = __DIR__ . "/../public/{$directory}/" . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return "/{$directory}/" . $filename;
        }

        return false;
    }
}
