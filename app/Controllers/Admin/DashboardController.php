<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\DB;
use PDO;

final class DashboardController extends Controller
{
    public function index(Request $request, array $params = []): Response
    {
        if (empty($_SESSION['admin_id'])) {
            return Response::redirect('/admin/login');
        }
        $pdo = DB::pdo();
        $stats = [
            'districts' => 0,
            'neighborhoods' => 0,
            'reviews' => 0,
        ];
        if ($pdo) {
            $stats['districts'] = (int)($pdo->query('SELECT COUNT(*) FROM districts')->fetchColumn() ?: 0);
            $stats['neighborhoods'] = (int)($pdo->query('SELECT COUNT(*) FROM neighborhoods')->fetchColumn() ?: 0);
            $stats['reviews'] = (int)($pdo->query('SELECT COUNT(*) FROM reviews')->fetchColumn() ?: 0);
        }
        return $this->render('admin/dashboard/index', ['stats' => $stats], ['title' => 'Yönetim Paneli']);
    }
}
