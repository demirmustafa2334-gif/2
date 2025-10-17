<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Neighborhood.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/Setting.php';

class LocationController extends Controller {
    
    public function district($slug) {
        $districtModel = new District();
        $serviceModel = new Service();
        $settingModel = new Setting();
        
        $district = $districtModel->getBySlug($slug);
        
        if (!$district || !$district['is_active']) {
            $this->redirect('/');
        }
        
        $districtWithNeighborhoods = $districtModel->getWithNeighborhoods($district['id']);
        
        // Get nearby districts for internal linking
        $allDistricts = $districtModel->getActive();
        $nearbyDistricts = array_filter($allDistricts, function($d) use ($district) {
            return $d['id'] != $district['id'];
        });
        $nearbyDistricts = array_slice($nearbyDistricts, 0, 6);
        
        $data = [
            'title' => $district['meta_title'] ?: $district['name'] . ' Evden Eve Nakliyat | İstanbul Nakliyat',
            'meta_description' => $district['meta_description'] ?: $district['name'] . ' ve çevresinde profesyonel evden eve nakliyat hizmetleri.',
            'district' => $districtWithNeighborhoods,
            'neighborhoods' => $districtWithNeighborhoods['neighborhoods'],
            'nearby_districts' => $nearbyDistricts,
            'services' => $serviceModel->getFeatured(4),
            'districts' => $allDistricts,
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('district', $data);
    }
    
    public function neighborhood($slug) {
        $neighborhoodModel = new Neighborhood();
        $districtModel = new District();
        $serviceModel = new Service();
        $settingModel = new Setting();
        
        $neighborhood = $neighborhoodModel->getWithDistrict($slug);
        
        if (!$neighborhood || !$neighborhood['is_active']) {
            $this->redirect('/');
        }
        
        // Get other neighborhoods in same district
        $sameDistrictNeighborhoods = $neighborhoodModel->getByDistrict($neighborhood['district_id']);
        $sameDistrictNeighborhoods = array_filter($sameDistrictNeighborhoods, function($n) use ($neighborhood) {
            return $n['id'] != $neighborhood['id'];
        });
        
        $data = [
            'title' => $neighborhood['meta_title'] ?: $neighborhood['name'] . ' Evden Eve Nakliyat | ' . $neighborhood['district_name'],
            'meta_description' => $neighborhood['meta_description'] ?: $neighborhood['name'] . ' semtinde güvenilir nakliyat hizmetleri.',
            'neighborhood' => $neighborhood,
            'same_district_neighborhoods' => $sameDistrictNeighborhoods,
            'services' => $serviceModel->getFeatured(4),
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('neighborhood', $data);
    }
}
