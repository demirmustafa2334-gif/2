<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Core\Security; use App\Core\DB; use PDO;

final class AuthController extends Controller
{
    public function login(Request $r, array $p=[]): Response
    {
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if(!Security::validateCsrf((string)$r->getPost('csrf'))) return Response::html('Geçersiz CSRF',400);
            $u=(string)$r->getPost('username'); $pw=(string)$r->getPost('password'); $pdo=DB::pdo();
            if($pdo){ $st=$pdo->prepare('SELECT id,username,password_hash FROM users WHERE username=?'); $st->execute([$u]); $row=$st->fetch(PDO::FETCH_ASSOC); if($row && password_verify($pw,$row['password_hash'])){ $_SESSION['admin_id']=(int)$row['id']; return Response::redirect('/admin'); } }
            return $this->render('admin/auth/login',['error'=>'Geçersiz bilgi'],['title'=>'Yönetici Girişi']);
        }
        return $this->render('admin/auth/login',['csrf'=>Security::csrfToken()],['title'=>'Yönetici Girişi']);
    }
    public function logout(Request $r, array $p=[]): Response { unset($_SESSION['admin_id']); return Response::redirect('/admin/login'); }
}
