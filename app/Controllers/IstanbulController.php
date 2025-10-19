<?php
namespace App\Controllers;

use Core\Controller;
use Core\SEO;
use App\Models\District;
use App\Models\Neighborhood;

class IstanbulController extends Controller
{
    public function index(): void
    {
        $districts = (new District())->all();
        $neighborhoodsByDistrict = [];
        $nModel = new Neighborhood();
        foreach ($districts as $d) {
            $neighborhoodsByDistrict[$d['slug']] = $nModel->forDistrict((int)$d['id']);
        }
        $meta = SEO::meta([
            'title' => 'İstanbul İlçeler ve Semtler | Evden Eve Nakliyat',
            'description' => 'İstanbul’daki tüm ilçeler ve semtler için SEO uyumlu nakliyat sayfaları.',
        ]);
        $this->view->render('istanbul/index', compact('meta', 'districts', 'neighborhoodsByDistrict'));
    }
}
