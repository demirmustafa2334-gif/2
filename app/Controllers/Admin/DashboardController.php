<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Core\DB;

final class DashboardController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        $pdo = DB::pdo();
        $stats=[
            'cities'=>(int)($pdo?->query('SELECT COUNT(*) FROM cities')->fetchColumn()?:0),
            'districts'=>(int)($pdo?->query('SELECT COUNT(*) FROM districts')->fetchColumn()?:0),
            'posts'=>(int)($pdo?->query('SELECT COUNT(*) FROM posts')->fetchColumn()?:0),
            'messages'=>(int)($pdo?->query('SELECT COUNT(*) FROM contact_messages WHERE seen=0')->fetchColumn()?:0),
        ];
        return $this->render('admin/dashboard/index', compact('stats'), ['title'=>'Yönetim Paneli']);
    }
}
