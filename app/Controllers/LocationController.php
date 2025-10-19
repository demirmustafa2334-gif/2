<?php
namespace App\Controllers;

use Core\Controller;
use Core\SEO;
use App\Models\District;
use App\Models\Neighborhood;

class LocationController extends Controller
{
    public function district(string $slug): void
    {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $district = $districtModel->findBySlug($slug);
        if (!$district) {
            http_response_code(404);
            $this->view->render('errors/404', []);
            return;
        }
        $neighborhoods = $neighborhoodModel->forDistrict((int)$district['id']);

        $meta = SEO::meta([
            'title' => $district['meta_title'] ?: ($district['name'] . ' Evden Eve Nakliyat'),
            'description' => $district['meta_description'] ?: ($district['name'] . ' nakliyat ve ofis taşıma hizmetleri'),
        ]);

        $this->view->render('location/district', compact('meta', 'district', 'neighborhoods'));
    }

    public function neighborhood(string $slug): void
    {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $neighborhood = $neighborhoodModel->findBySlug($slug);
        if (!$neighborhood) {
            http_response_code(404);
            $this->view->render('errors/404', []);
            return;
        }
        $district = $districtModel->all();
        $district = array_values(array_filter($district, fn($d) => (int)$d['id'] === (int)$neighborhood['district_id']))[0] ?? null;

        $meta = SEO::meta([
            'title' => $neighborhood['meta_title'] ?: ($neighborhood['name'] . ' Evden Eve Nakliyat'),
            'description' => $neighborhood['meta_description'] ?: ($neighborhood['name'] . ' nakliyat ve ofis taşıma hizmetleri'),
        ]);

        $this->view->render('location/neighborhood', compact('meta', 'district', 'neighborhood'));
    }
}
