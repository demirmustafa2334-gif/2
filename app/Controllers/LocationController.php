<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Location;

final class LocationController extends Controller
{
    /** /istanbul/{slug} -> district or neighborhood */
    public function show(Request $request, array $params = []): Response
    {
        $slug = $params['locationSlug'] ?? '';
        if ($slug === '') {
            return Response::redirect('/');
        }
        $district = Location::findDistrictBySlug($slug);
        if ($district) {
            return $this->render('location/show', [
                'location' => [
                    'name' => $district['name'],
                    'slug' => $district['slug'],
                    'type' => 'İlçe',
                ],
            ], [
                'title' => ($district['meta_title'] ?: ($district['name'] . ' Evden Eve Nakliyat')),
                'description' => $district['meta_description'] ?: ($district['name'] . ' ilçesinde profesyonel taşımacılık hizmetleri.'),
            ]);
        }
        $neighborhood = Location::findNeighborhoodBySlug($slug);
        if ($neighborhood) {
            return $this->render('location/show', [
                'location' => [
                    'name' => $neighborhood['name'],
                    'slug' => $neighborhood['slug'],
                    'type' => 'Semt',
                ],
            ], [
                'title' => ($neighborhood['meta_title'] ?: ($neighborhood['name'] . ' Evden Eve Nakliyat')),
                'description' => $neighborhood['meta_description'] ?: ($neighborhood['name'] . ' semtinde profesyonel taşımacılık hizmetleri.'),
            ]);
        }
        return Response::html('<div class="container py-5"><h1 class="h3">Lokasyon bulunamadı</h1></div>', 404);
    }
}
