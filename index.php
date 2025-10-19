<?php
/**
 * Main Router File
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// Get page parameter
$page = isset($_GET['page']) ? sanitize_input($_GET['page']) : 'home';
$slug = isset($_GET['slug']) ? sanitize_input($_GET['slug']) : '';
$district = isset($_GET['district']) ? sanitize_input($_GET['district']) : '';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Include models
require_once 'models/PageModel.php';
require_once 'models/DistrictModel.php';
require_once 'models/NeighborhoodModel.php';
require_once 'models/ReviewModel.php';
require_once 'models/BlogModel.php';
require_once 'models/PricingModel.php';

// Initialize models
$pageModel = new PageModel($db);
$districtModel = new DistrictModel($db);
$neighborhoodModel = new NeighborhoodModel($db);
$reviewModel = new ReviewModel($db);
$blogModel = new BlogModel($db);
$pricingModel = new PricingModel($db);

// Route handling
switch ($page) {
    case 'home':
        $pageData = $pageModel->getPageBySlug('home');
        $districts = $districtModel->getActiveDistricts();
        $reviews = $reviewModel->getApprovedReviews(6);
        $recentPosts = $blogModel->getRecentPosts(3);
        include 'views/home.php';
        break;
        
    case 'services':
        $pageData = $pageModel->getPageBySlug('services');
        $districts = $districtModel->getActiveDistricts();
        include 'views/services.php';
        break;
        
    case 'pricing':
        $pageData = $pageModel->getPageBySlug('pricing');
        $districts = $districtModel->getActiveDistricts();
        $pricingRoutes = $pricingModel->getAllPricingRoutes();
        include 'views/pricing.php';
        break;
        
    case 'reviews':
        $pageData = $pageModel->getPageBySlug('reviews');
        $reviews = $reviewModel->getApprovedReviews();
        include 'views/reviews.php';
        break;
        
    case 'blog':
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $posts = $blogModel->getPublishedPosts($page, POSTS_PER_PAGE);
        $totalPosts = $blogModel->getTotalPublishedPosts();
        $totalPages = ceil($totalPosts / POSTS_PER_PAGE);
        include 'views/blog.php';
        break;
        
    case 'blog_post':
        $post = $blogModel->getPostBySlug($slug);
        if (!$post) {
            include 'views/404.php';
            exit;
        }
        $recentPosts = $blogModel->getRecentPosts(5);
        include 'views/blog_post.php';
        break;
        
    case 'contact':
        $pageData = $pageModel->getPageBySlug('contact');
        $districts = $districtModel->getActiveDistricts();
        
        // Handle contact form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
            if (!verify_csrf_token($_POST['csrf_token'])) {
                $error = 'Güvenlik hatası. Lütfen tekrar deneyin.';
            } else {
                $name = sanitize_input($_POST['name']);
                $email = sanitize_input($_POST['email']);
                $phone = sanitize_input($_POST['phone']);
                $message = sanitize_input($_POST['message']);
                
                if (empty($name) || empty($email) || empty($message)) {
                    $error = 'Lütfen tüm gerekli alanları doldurun.';
                } else {
                    $stmt = $db->prepare("INSERT INTO contact_submissions (name, email, phone, message) VALUES (?, ?, ?, ?)");
                    if ($stmt->execute([$name, $email, $phone, $message])) {
                        $success = 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.';
                    } else {
                        $error = 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyin.';
                    }
                }
            }
        }
        
        include 'views/contact.php';
        break;
        
    case 'district':
        $district = $districtModel->getDistrictBySlug($slug);
        if (!$district) {
            include 'views/404.php';
            exit;
        }
        $neighborhoods = $neighborhoodModel->getNeighborhoodsByDistrict($district['id']);
        $nearbyDistricts = $districtModel->getNearbyDistricts($district['id']);
        include 'views/district.php';
        break;
        
    case 'neighborhood':
        $neighborhood = $neighborhoodModel->getNeighborhoodBySlug($slug);
        if (!$neighborhood) {
            include 'views/404.php';
            exit;
        }
        $district = $districtModel->getDistrictById($neighborhood['district_id']);
        $nearbyNeighborhoods = $neighborhoodModel->getNearbyNeighborhoods($neighborhood['id']);
        include 'views/neighborhood.php';
        break;
        
    case 'quote':
        $districts = $districtModel->getActiveDistricts();
        $neighborhoods = $neighborhoodModel->getAllActiveNeighborhoods();
        
        // Handle quote form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quote_form'])) {
            if (!verify_csrf_token($_POST['csrf_token'])) {
                $error = 'Güvenlik hatası. Lütfen tekrar deneyin.';
            } else {
                $from_district = sanitize_input($_POST['from_district']);
                $from_neighborhood = sanitize_input($_POST['from_neighborhood']);
                $to_district = sanitize_input($_POST['to_district']);
                $to_neighborhood = sanitize_input($_POST['to_neighborhood']);
                $name = sanitize_input($_POST['name']);
                $email = sanitize_input($_POST['email']);
                $phone = sanitize_input($_POST['phone']);
                $moving_date = sanitize_input($_POST['moving_date']);
                $message = sanitize_input($_POST['message']);
                
                if (empty($from_district) || empty($to_district) || empty($name) || empty($email) || empty($phone)) {
                    $error = 'Lütfen tüm gerekli alanları doldurun.';
                } else {
                    // Calculate estimated price
                    $estimatedPrice = $pricingModel->calculatePrice($from_district, $from_neighborhood, $to_district, $to_neighborhood);
                    
                    // Store quote request
                    $stmt = $db->prepare("INSERT INTO contact_submissions (name, email, phone, message) VALUES (?, ?, ?, ?)");
                    $quoteMessage = "Teklif Talebi:\n";
                    $quoteMessage .= "Nereden: " . $from_district . ($from_neighborhood ? " - " . $from_neighborhood : "") . "\n";
                    $quoteMessage .= "Nereye: " . $to_district . ($to_neighborhood ? " - " . $to_neighborhood : "") . "\n";
                    $quoteMessage .= "Tarih: " . $moving_date . "\n";
                    $quoteMessage .= "Tahmini Fiyat: " . format_price($estimatedPrice) . "\n";
                    $quoteMessage .= "Mesaj: " . $message;
                    
                    if ($stmt->execute([$name, $email, $phone, $quoteMessage])) {
                        $success = 'Teklif talebiniz başarıyla gönderildi. Tahmini fiyat: ' . format_price($estimatedPrice);
                    } else {
                        $error = 'Teklif talebi gönderilirken bir hata oluştu. Lütfen tekrar deneyin.';
                    }
                }
            }
        }
        
        include 'views/quote.php';
        break;
        
    default:
        include 'views/404.php';
        break;
}

// Include common footer
include 'views/includes/footer.php';
?>