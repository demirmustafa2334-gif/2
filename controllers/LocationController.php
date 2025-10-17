<?php
require_once 'core/Controller.php';
require_once 'models/District.php';
require_once 'models/Neighborhood.php';
require_once 'models/Pricing.php';
require_once 'models/Review.php';

class LocationController extends Controller {
    
    public function district($slug) {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $pricingModel = new Pricing();
        $reviewModel = new Review();
        
        $district = $districtModel->findBySlug($slug);
        
        if (!$district) {
            http_response_code(404);
            include 'views/errors/404.php';
            return;
        }
        
        // Get neighborhoods in this district
        $neighborhoods = $neighborhoodModel->getByDistrict($district['id']);
        
        // Get nearby districts
        $nearbyDistricts = $districtModel->getNearbyDistricts($district['id'], 5);
        
        // Get recent reviews
        $reviews = $reviewModel->getApprovedReviews(6);
        
        // Get all districts for footer
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        // Set meta data
        $metaTitle = $district['meta_title'] ?: $district['name'] . ' Evden Eve Nakliyat | Profesyonel Taşımacılık';
        $metaDescription = $district['meta_description'] ?: $district['name'] . ' ilçesinde güvenilir evden eve nakliyat hizmeti. Uzman ekibimizle hızlı ve güvenli taşınma.';
        $metaKeywords = $district['meta_keywords'] ?: strtolower($district['name']) . ' nakliyat, ' . strtolower($district['name']) . ' evden eve nakliyat, taşımacılık';
        
        $this->setMetaData($metaTitle, $metaDescription, $metaKeywords);
        
        $this->view('location/district', [
            'district' => $district,
            'neighborhoods' => $neighborhoods,
            'nearby_districts' => $nearbyDistricts,
            'reviews' => $reviews,
            'all_districts' => $allDistricts
        ]);
    }
    
    public function neighborhood($districtSlug, $neighborhoodSlug) {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $pricingModel = new Pricing();
        $reviewModel = new Review();
        
        // First get the district
        $district = $districtModel->findBySlug($districtSlug);
        if (!$district) {
            http_response_code(404);
            include 'views/errors/404.php';
            return;
        }
        
        // Then get the neighborhood
        $neighborhood = $neighborhoodModel->findBySlug($neighborhoodSlug, $district['id']);
        if (!$neighborhood) {
            http_response_code(404);
            include 'views/errors/404.php';
            return;
        }
        
        // Get nearby neighborhoods
        $nearbyNeighborhoods = $neighborhoodModel->getNearbyNeighborhoods($neighborhood['id'], $district['id'], 5);
        
        // Get recent reviews
        $reviews = $reviewModel->getApprovedReviews(6);
        
        // Get all districts for footer
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        // Set meta data
        $metaTitle = $neighborhood['meta_title'] ?: $neighborhood['name'] . ' Evden Eve Nakliyat | ' . $district['name'] . ' Taşımacılık';
        $metaDescription = $neighborhood['meta_description'] ?: $district['name'] . ' ' . $neighborhood['name'] . ' semtinde güvenilir evden eve nakliyat hizmeti. Profesyonel taşımacılık çözümleri.';
        $metaKeywords = $neighborhood['meta_keywords'] ?: strtolower($neighborhood['name']) . ' nakliyat, ' . strtolower($district['name']) . ' ' . strtolower($neighborhood['name']) . ' nakliyat, evden eve nakliyat';
        
        $this->setMetaData($metaTitle, $metaDescription, $metaKeywords);
        
        $this->view('location/neighborhood', [
            'district' => $district,
            'neighborhood' => $neighborhood,
            'nearby_neighborhoods' => $nearbyNeighborhoods,
            'reviews' => $reviews,
            'all_districts' => $allDistricts
        ]);
    }
}
?>