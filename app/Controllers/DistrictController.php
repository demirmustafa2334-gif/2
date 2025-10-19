<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Models\District; use App\Models\City;

final class DistrictController extends Controller
{
    public function show(Request $r, array $params=[]): Response
    {
        $citySlug = $params['citySlug'] ?? ''; $districtSlug = $params['districtSlug'] ?? '';
        $city = City::findBySlug($citySlug); if(!$city) return Response::html('<div class="container py-5"><h1>Şehir bulunamadı</h1></div>',404);
        $district = District::findBySlug($districtSlug); if(!$district || (int)$district['city_id'] !== (int)$city['id']) return Response::html('<div class="container py-5"><h1>İlçe bulunamadı</h1></div>',404);
        $siblings = District::byCityId((int)$city['id']);
        return $this->render('district/show', compact('city','district','siblings'), [
            'title' => $district['name'].' | '+$city['name'].' | yereltanitim.com',
            'description' => $city['name'].' / '.$district['name'].' için yerel lezzetler ve turistik noktalar.',
        ]);
    }
}
