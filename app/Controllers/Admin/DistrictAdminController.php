<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Core\Security; use App\Models\District; use App\Models\City;

final class DistrictAdminController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        $cities = City::all();
        $districts = District::allWithCity();
        return $this->render('admin/districts/index', compact('cities','districts') + ['csrf'=>Security::csrfToken()], ['title'=>'İlçeler']);
    }
    public function store(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        if (!Security::validateCsrf((string)$r->getPost('csrf'))) return Response::html('Geçersiz CSRF',400);
        $cityId=(int)$r->getPost('city_id'); $name=(string)$r->getPost('name'); $slug=(string)$r->getPost('slug');
        District::create($cityId,$name,$slug);
        return Response::redirect('/admin/ilceler');
    }
}
