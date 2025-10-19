<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Core\Security; use App\Models\City;

final class CityAdminController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        $cities = City::all();
        return $this->render('admin/cities/index', ['cities'=>$cities,'csrf'=>Security::csrfToken()], ['title'=>'Şehirler']);
    }
    public function store(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        if (!Security::validateCsrf((string)$r->getPost('csrf'))) return Response::html('Geçersiz CSRF',400);
        $name=(string)$r->getPost('name'); $slug=(string)$r->getPost('slug');
        City::create($name,$slug);
        return Response::redirect('/admin/sehirler');
    }
}
