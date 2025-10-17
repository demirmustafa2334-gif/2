<?php
/**
 * Admin Panel - Main Controller
 * Istanbul Moving Company - Custom PHP Script
 */

require_once '../config/config.php';

// Check if user is logged in
if (!is_admin_logged_in()) {
    if (isset($_POST['login'])) {
        $username = sanitize_input($_POST['username']);
        $password = $_POST['password'];
        
        $database = new Database();
        $db = $database->getConnection();
        
        $stmt = $db->prepare("SELECT id, username, password FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION[ADMIN_SESSION_KEY] = true;
            $_SESSION['admin_user_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            redirect('/admin/');
        } else {
            $error = 'Kullanıcı adı veya şifre hatalı.';
        }
    }
    include 'login.php';
    exit;
}

// Get action parameter
$action = isset($_GET['action']) ? sanitize_input($_GET['action']) : 'dashboard';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Include models
require_once '../models/PageModel.php';
require_once '../models/DistrictModel.php';
require_once '../models/NeighborhoodModel.php';
require_once '../models/ReviewModel.php';
require_once '../models/BlogModel.php';
require_once '../models/PricingModel.php';

// Initialize models
$pageModel = new PageModel($db);
$districtModel = new DistrictModel($db);
$neighborhoodModel = new NeighborhoodModel($db);
$reviewModel = new ReviewModel($db);
$blogModel = new BlogModel($db);
$pricingModel = new PricingModel($db);

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    redirect('/admin/');
}

// Route handling
switch ($action) {
    case 'dashboard':
        $stats = [
            'total_districts' => count($districtModel->getAllDistricts()),
            'total_neighborhoods' => count($neighborhoodModel->getAllActiveNeighborhoods()),
            'total_reviews' => count($reviewModel->getAllReviews()),
            'pending_reviews' => count(array_filter($reviewModel->getAllReviews(), function($r) { return !$r['is_approved']; })),
            'total_posts' => count($blogModel->getAllPosts()),
            'published_posts' => count(array_filter($blogModel->getAllPosts(), function($p) { return $p['is_published']; }))
        ];
        include 'dashboard.php';
        break;
        
    case 'districts':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['create_district'])) {
                $data = [
                    'name' => sanitize_input($_POST['name']),
                    'slug' => generate_slug($_POST['name']),
                    'description' => sanitize_input($_POST['description']),
                    'meta_title' => sanitize_input($_POST['meta_title']),
                    'meta_description' => sanitize_input($_POST['meta_description']),
                    'meta_keywords' => sanitize_input($_POST['meta_keywords'])
                ];
                if ($districtModel->createDistrict($data)) {
                    $success = 'İlçe başarıyla oluşturuldu.';
                } else {
                    $error = 'İlçe oluşturulurken bir hata oluştu.';
                }
            } elseif (isset($_POST['update_district'])) {
                $id = (int)$_POST['district_id'];
                $data = [
                    'name' => sanitize_input($_POST['name']),
                    'slug' => generate_slug($_POST['name']),
                    'description' => sanitize_input($_POST['description']),
                    'meta_title' => sanitize_input($_POST['meta_title']),
                    'meta_description' => sanitize_input($_POST['meta_description']),
                    'meta_keywords' => sanitize_input($_POST['meta_keywords'])
                ];
                if ($districtModel->updateDistrict($id, $data)) {
                    $success = 'İlçe başarıyla güncellendi.';
                } else {
                    $error = 'İlçe güncellenirken bir hata oluştu.';
                }
            }
        }
        
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if ($districtModel->deleteDistrict($id)) {
                $success = 'İlçe başarıyla silindi.';
            } else {
                $error = 'İlçe silinirken bir hata oluştu.';
            }
        }
        
        if (isset($_GET['toggle'])) {
            $id = (int)$_GET['toggle'];
            $districtModel->toggleActive($id);
            redirect('/admin/?action=districts');
        }
        
        $districts = $districtModel->getAllDistricts();
        include 'districts.php';
        break;
        
    case 'neighborhoods':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['create_neighborhood'])) {
                $data = [
                    'district_id' => (int)$_POST['district_id'],
                    'name' => sanitize_input($_POST['name']),
                    'slug' => generate_slug($_POST['name']),
                    'description' => sanitize_input($_POST['description']),
                    'meta_title' => sanitize_input($_POST['meta_title']),
                    'meta_description' => sanitize_input($_POST['meta_description']),
                    'meta_keywords' => sanitize_input($_POST['meta_keywords'])
                ];
                if ($neighborhoodModel->createNeighborhood($data)) {
                    $success = 'Semt başarıyla oluşturuldu.';
                } else {
                    $error = 'Semt oluşturulurken bir hata oluştu.';
                }
            } elseif (isset($_POST['update_neighborhood'])) {
                $id = (int)$_POST['neighborhood_id'];
                $data = [
                    'district_id' => (int)$_POST['district_id'],
                    'name' => sanitize_input($_POST['name']),
                    'slug' => generate_slug($_POST['name']),
                    'description' => sanitize_input($_POST['description']),
                    'meta_title' => sanitize_input($_POST['meta_title']),
                    'meta_description' => sanitize_input($_POST['meta_description']),
                    'meta_keywords' => sanitize_input($_POST['meta_keywords'])
                ];
                if ($neighborhoodModel->updateNeighborhood($id, $data)) {
                    $success = 'Semt başarıyla güncellendi.';
                } else {
                    $error = 'Semt güncellenirken bir hata oluştu.';
                }
            }
        }
        
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if ($neighborhoodModel->deleteNeighborhood($id)) {
                $success = 'Semt başarıyla silindi.';
            } else {
                $error = 'Semt silinirken bir hata oluştu.';
            }
        }
        
        if (isset($_GET['toggle'])) {
            $id = (int)$_GET['toggle'];
            $neighborhoodModel->toggleActive($id);
            redirect('/admin/?action=neighborhoods');
        }
        
        $neighborhoods = $neighborhoodModel->getAllActiveNeighborhoods();
        $districts = $districtModel->getAllDistricts();
        include 'neighborhoods.php';
        break;
        
    case 'reviews':
        if (isset($_GET['approve'])) {
            $id = (int)$_GET['approve'];
            if ($reviewModel->approveReview($id)) {
                $success = 'Yorum onaylandı.';
            } else {
                $error = 'Yorum onaylanırken bir hata oluştu.';
            }
        }
        
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if ($reviewModel->deleteReview($id)) {
                $success = 'Yorum silindi.';
            } else {
                $error = 'Yorum silinirken bir hata oluştu.';
            }
        }
        
        $reviews = $reviewModel->getAllReviews();
        include 'reviews.php';
        break;
        
    case 'blog':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['create_post'])) {
                $data = [
                    'title' => sanitize_input($_POST['title']),
                    'slug' => generate_slug($_POST['title']),
                    'content' => $_POST['content'],
                    'excerpt' => sanitize_input($_POST['excerpt']),
                    'featured_image' => sanitize_input($_POST['featured_image']),
                    'meta_title' => sanitize_input($_POST['meta_title']),
                    'meta_description' => sanitize_input($_POST['meta_description']),
                    'meta_keywords' => sanitize_input($_POST['meta_keywords']),
                    'is_published' => isset($_POST['is_published']) ? 1 : 0
                ];
                if ($blogModel->createPost($data)) {
                    $success = 'Yazı başarıyla oluşturuldu.';
                } else {
                    $error = 'Yazı oluşturulurken bir hata oluştu.';
                }
            } elseif (isset($_POST['update_post'])) {
                $id = (int)$_POST['post_id'];
                $data = [
                    'title' => sanitize_input($_POST['title']),
                    'slug' => generate_slug($_POST['title']),
                    'content' => $_POST['content'],
                    'excerpt' => sanitize_input($_POST['excerpt']),
                    'featured_image' => sanitize_input($_POST['featured_image']),
                    'meta_title' => sanitize_input($_POST['meta_title']),
                    'meta_description' => sanitize_input($_POST['meta_description']),
                    'meta_keywords' => sanitize_input($_POST['meta_keywords']),
                    'is_published' => isset($_POST['is_published']) ? 1 : 0
                ];
                if ($blogModel->updatePost($id, $data)) {
                    $success = 'Yazı başarıyla güncellendi.';
                } else {
                    $error = 'Yazı güncellenirken bir hata oluştu.';
                }
            }
        }
        
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if ($blogModel->deletePost($id)) {
                $success = 'Yazı silindi.';
            } else {
                $error = 'Yazı silinirken bir hata oluştu.';
            }
        }
        
        if (isset($_GET['toggle'])) {
            $id = (int)$_GET['toggle'];
            $blogModel->togglePublished($id);
            redirect('/admin/?action=blog');
        }
        
        $posts = $blogModel->getAllPosts();
        include 'blog.php';
        break;
        
    case 'pricing':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['create_route'])) {
                $data = [
                    'from_district_id' => (int)$_POST['from_district_id'],
                    'from_neighborhood_id' => !empty($_POST['from_neighborhood_id']) ? (int)$_POST['from_neighborhood_id'] : null,
                    'to_district_id' => (int)$_POST['to_district_id'],
                    'to_neighborhood_id' => !empty($_POST['to_neighborhood_id']) ? (int)$_POST['to_neighborhood_id'] : null,
                    'base_price' => (float)$_POST['base_price'],
                    'price_per_km' => (float)$_POST['price_per_km'],
                    'estimated_distance_km' => (float)$_POST['estimated_distance_km']
                ];
                if ($pricingModel->createPricingRoute($data)) {
                    $success = 'Fiyat rotası başarıyla oluşturuldu.';
                } else {
                    $error = 'Fiyat rotası oluşturulurken bir hata oluştu.';
                }
            } elseif (isset($_POST['update_route'])) {
                $id = (int)$_POST['route_id'];
                $data = [
                    'from_district_id' => (int)$_POST['from_district_id'],
                    'from_neighborhood_id' => !empty($_POST['from_neighborhood_id']) ? (int)$_POST['from_neighborhood_id'] : null,
                    'to_district_id' => (int)$_POST['to_district_id'],
                    'to_neighborhood_id' => !empty($_POST['to_neighborhood_id']) ? (int)$_POST['to_neighborhood_id'] : null,
                    'base_price' => (float)$_POST['base_price'],
                    'price_per_km' => (float)$_POST['price_per_km'],
                    'estimated_distance_km' => (float)$_POST['estimated_distance_km']
                ];
                if ($pricingModel->updatePricingRoute($id, $data)) {
                    $success = 'Fiyat rotası başarıyla güncellendi.';
                } else {
                    $error = 'Fiyat rotası güncellenirken bir hata oluştu.';
                }
            }
        }
        
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            if ($pricingModel->deletePricingRoute($id)) {
                $success = 'Fiyat rotası silindi.';
            } else {
                $error = 'Fiyat rotası silinirken bir hata oluştu.';
            }
        }
        
        if (isset($_GET['toggle'])) {
            $id = (int)$_GET['toggle'];
            $pricingModel->toggleActive($id);
            redirect('/admin/?action=pricing');
        }
        
        $pricingRoutes = $pricingModel->getAllPricingRoutes();
        $districts = $districtModel->getAllDistricts();
        $neighborhoods = $neighborhoodModel->getAllActiveNeighborhoods();
        include 'pricing.php';
        break;
        
    case 'settings':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                if ($key !== 'csrf_token') {
                    set_setting($key, sanitize_input($value));
                }
            }
            $success = 'Ayarlar başarıyla güncellendi.';
        }
        
        $settings = [];
        $stmt = $db->prepare("SELECT setting_key, setting_value FROM site_settings");
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $result) {
            $settings[$result['setting_key']] = $result['setting_value'];
        }
        include 'settings.php';
        break;
        
    default:
        include 'dashboard.php';
        break;
}

// Include admin footer
include 'includes/footer.php';
?>