<?php
namespace App\Controllers\Admin;

use Core\Controller;
use Core\Session;
use Core\Database;

class LocationController extends Controller
{
    private function ensureAuth(): bool
    {
        Session::start();
        return (bool)Session::get('admin_id');
    }

    public function index(): void
    {
        if (!$this->ensureAuth()) { header('Location: /admin/login'); return; }
        $pdo = Database::getConnection();
        $districts = $pdo->query('SELECT * FROM districts ORDER BY name')->fetchAll();
        $this->view->render('admin/locations/index', compact('districts'));
    }

    public function createDistrict(): void
    {
        if (!$this->ensureAuth()) { header('Location: /admin/login'); return; }
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        if ($name === '' || $slug === '') { http_response_code(422); echo 'Eksik alan'; return; }
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO districts (name, slug) VALUES (?, ?)');
        $stmt->execute([$name, $slug]);
        header('Location: /admin/locations');
    }
}
