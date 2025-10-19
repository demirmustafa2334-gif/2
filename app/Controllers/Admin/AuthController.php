<?php
namespace App\Controllers\Admin;

use Core\Controller;
use Core\Session;
use Core\CSRF;
use Core\Database;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        $meta = ['title' => 'Admin Giriş'];
        $this->view->render('admin/login', compact('meta'));
    }

    public function login(): void
    {
        if (!isset($_POST['_token']) || !CSRF::verify($_POST['_token'])) {
            http_response_code(422);
            echo 'Geçersiz istek';
            return;
        }
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            Session::start();
            Session::set('admin_id', (int)$user['id']);
            header('Location: /admin');
            return;
        }
        http_response_code(401);
        echo 'Giriş başarısız';
    }

    public function logout(): void
    {
        Session::start();
        Session::remove('admin_id');
        header('Location: /admin/login');
    }
}
