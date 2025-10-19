<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Models\City; use App\Models\District;

final class CityController extends Controller
{
    public function show(Request $r, array $params=[]): Response
    {
        $slug = $params['citySlug'] ?? '';
        $city = City::findBySlug($slug);
        if(!$city) return Response::html('<div class="container py-5"><h1>Şehir bulunamadı</h1></div>',404);
        $districts = District::byCityId((int)$city['id']);
        return $this->render('city/show', compact('city','districts'), [
            'title' => $city['name'].' | yereltanitim.com',
            'description' => $city['name'].' şehri için turistik yerler, yerel lezzetler ve ilçeler.',
        ]);
    }
}
