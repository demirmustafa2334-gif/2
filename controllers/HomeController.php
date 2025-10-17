<?php
require_once 'core/Controller.php';
require_once 'models/District.php';
require_once 'models/Neighborhood.php';
require_once 'models/Review.php';
require_once 'models/BlogPost.php';

class HomeController extends Controller {
    
    public function index() {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $reviewModel = new Review();
        $blogModel = new BlogPost();
        
        // Get featured districts
        $districts = $districtModel->getActiveDistricts();
        $featuredDistricts = array_slice($districts, 0, 6);
        
        // Get recent reviews
        $reviews = $reviewModel->getApprovedReviews(6);
        $averageRating = $reviewModel->getAverageRating();
        
        // Get recent blog posts
        $blogPosts = $blogModel->getRecentPosts(3);
        
        // Get all districts for footer
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        // Set meta data
        $this->setMetaData(
            'İstanbul Evden Eve Nakliyat | Profesyonel Taşımacılık Hizmetleri',
            'İstanbul\'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti. Güvenilir, hızlı ve uygun fiyatlı taşımacılık çözümleri.',
            'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye, taşınma, istanbul taşımacılık'
        );
        
        $this->view('home/index', [
            'featured_districts' => $featuredDistricts,
            'reviews' => $reviews,
            'average_rating' => $averageRating,
            'blog_posts' => $blogPosts,
            'all_districts' => $allDistricts
        ]);
    }
}
?>