<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Setting.php';

class ServiceController extends Controller {
    
    public function index() {
        $serviceModel = new Service();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $data = [
            'title' => 'Hizmetlerimiz | İstanbul Nakliyat',
            'meta_description' => 'İstanbul genelinde evden eve nakliyat, ofis taşımacılığı, parça eşya taşıma ve asansörlü nakliyat hizmetleri.',
            'services' => $serviceModel->getActive(),
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('services', $data);
    }
    
    public function detail($slug) {
        $serviceModel = new Service();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $service = $serviceModel->getBySlug($slug);
        
        if (!$service || !$service['is_active']) {
            $this->redirect('/');
        }
        
        $data = [
            'title' => $service['meta_title'] ?: $service['title'],
            'meta_description' => $service['meta_description'] ?: $service['short_description'],
            'service' => $service,
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('service-detail', $data);
    }
}
