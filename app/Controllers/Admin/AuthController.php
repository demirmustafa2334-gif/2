<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Security;
use App\Core\DB;
use PDO;

final class AuthController extends Controller
{
    public function login(Request $request, array $params = []): Response
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf = $request->getPost('csrf');
            if (!Security::validateCsrf(is_string($csrf) ? $csrf : null)) {
                return Response::html('Invalid CSRF token', 400);
            }
            $username = (string)$request->getPost('username');
            $password = (string)$request->getPost('password');
            $pdo = DB::pdo();
            if ($pdo) {
                $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1');
                $stmt->execute([$username]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row && password_verify($password, $row['password_hash'])) {
                    $_SESSION['admin_id'] = (int)$row['id'];
                    return Response::redirect('/admin');
                }
            }
            return $this->render('admin/auth/login', ['error' => 'Geçersiz kullanıcı adı veya şifre.']);
        }
        return $this->render('admin/auth/login', [
            'csrf' => Security::ensureCsrfToken(),
        ], ['title' => 'Yönetici Girişi']);
    }

    public function logout(Request $request, array $params = []): Response
    {
        unset($_SESSION['admin_id']);
        return Response::redirect('/admin/login');
    }
}
