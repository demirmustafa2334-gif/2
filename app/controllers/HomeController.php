<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Setting.php';

class HomeController extends Controller {
    
    public function index() {
        $serviceModel = new Service();
        $reviewModel = new Review();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $data = [
            'title' => 'İstanbul Evden Eve Nakliyat | Güvenilir Taşımacılık Hizmetleri',
            'meta_description' => 'İstanbul genelinde profesyonel evden eve nakliyat hizmetleri. Uygun fiyatlar, sigortalı taşıma ve deneyimli ekip.',
            'services' => $serviceModel->getFeatured(4),
            'reviews' => $reviewModel->getFeatured(),
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('home', $data);
    }
}
