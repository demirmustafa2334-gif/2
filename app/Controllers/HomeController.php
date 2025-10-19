<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Models\City;

final class HomeController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        $cities = City::all();
        return $this->render('home/index', ['cities'=>$cities], [
            'title' => 'yereltanitim.com | Türkiye Şehirleri ve İlçeleri',
            'description' => 'Türkiye şehir ve ilçeleri için turistik yerler, yerel lezzetler ve kültür. yereltanitim.com ile keşfedin.',
        ]);
    }
}
