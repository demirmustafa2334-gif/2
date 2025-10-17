<?php
namespace App\Controllers\Admin;

use Core\Controller;
use Core\Session;
use Core\Database;

class DashboardController extends Controller
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
        $counts = [
            'pages' => (int)$pdo->query('SELECT COUNT(*) FROM pages')->fetchColumn(),
            'districts' => (int)$pdo->query('SELECT COUNT(*) FROM districts')->fetchColumn(),
            'neighborhoods' => (int)$pdo->query('SELECT COUNT(*) FROM neighborhoods')->fetchColumn(),
            'reviews' => (int)$pdo->query("SELECT COUNT(*) FROM reviews WHERE status='pending'")->fetchColumn(),
        ];
        $this->view->render('admin/dashboard', compact('counts'));
    }
}
