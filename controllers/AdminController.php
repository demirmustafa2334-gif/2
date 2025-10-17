<?php
require_once 'core/Controller.php';
require_once 'models/District.php';
require_once 'models/Neighborhood.php';
require_once 'models/Pricing.php';
require_once 'models/Review.php';
require_once 'models/Page.php';
require_once 'models/BlogPost.php';

class AdminController extends Controller {
    
    public function login() {
        if ($this->isPost()) {
            $username = $this->input('username');
            $password = $this->input('password');
            
            if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD)) {
                $_SESSION['admin_logged_in'] = true;
                $this->redirect('/admin/dashboard');
            } else {
                $error = 'Geçersiz kullanıcı adı veya şifre';
            }
        }
        
        $this->view('admin/login', ['error' => $error ?? null]);
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('/admin');
    }
    
    public function dashboard() {
        $this->requireAuth();
        
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $reviewModel = new Review();
        $blogModel = new BlogPost();
        
        $stats = [
            'districts' => $districtModel->count(),
            'neighborhoods' => $neighborhoodModel->count(),
            'reviews' => $reviewModel->count(),
            'pending_reviews' => $reviewModel->count(['status' => 'pending']),
            'blog_posts' => $blogModel->count(),
            'published_posts' => $blogModel->count(['status' => 'published'])
        ];
        
        $recentReviews = $reviewModel->findAll([], 'created_at DESC', 5);
        $recentPosts = $blogModel->findAll([], 'created_at DESC', 5);
        
        $this->view('admin/dashboard', [
            'stats' => $stats,
            'recent_reviews' => $recentReviews,
            'recent_posts' => $recentPosts
        ]);
    }
    
    public function districts() {
        $this->requireAuth();
        
        $districtModel = new District();
        $page = $this->input('page', 1);
        
        if ($this->isPost()) {
            $action = $this->input('action');
            
            if ($action === 'create') {
                $data = [
                    'name' => $this->sanitize($this->input('name')),
                    'slug' => $this->generateSlug($this->input('name')),
                    'description' => $this->sanitize($this->input('description')),
                    'meta_title' => $this->sanitize($this->input('meta_title')),
                    'meta_description' => $this->sanitize($this->input('meta_description')),
                    'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                    'status' => $this->input('status', 'active')
                ];
                
                if ($districtModel->create($data)) {
                    $success = 'İlçe başarıyla eklendi';
                } else {
                    $error = 'İlçe eklenirken hata oluştu';
                }
            } elseif ($action === 'update') {
                $id = $this->input('id');
                $data = [
                    'name' => $this->sanitize($this->input('name')),
                    'slug' => $this->generateSlug($this->input('name')),
                    'description' => $this->sanitize($this->input('description')),
                    'meta_title' => $this->sanitize($this->input('meta_title')),
                    'meta_description' => $this->sanitize($this->input('meta_description')),
                    'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                    'status' => $this->input('status', 'active')
                ];
                
                if ($districtModel->update($id, $data)) {
                    $success = 'İlçe başarıyla güncellendi';
                } else {
                    $error = 'İlçe güncellenirken hata oluştu';
                }
            } elseif ($action === 'delete') {
                $id = $this->input('id');
                if ($districtModel->delete($id)) {
                    $success = 'İlçe başarıyla silindi';
                } else {
                    $error = 'İlçe silinirken hata oluştu';
                }
            }
        }
        
        $districts = $districtModel->paginate($page, 20);
        
        $this->view('admin/districts', [
            'districts' => $districts,
            'success' => $success ?? null,
            'error' => $error ?? null
        ]);
    }
    
    public function neighborhoods() {
        $this->requireAuth();
        
        $neighborhoodModel = new Neighborhood();
        $districtModel = new District();
        $page = $this->input('page', 1);
        
        if ($this->isPost()) {
            $action = $this->input('action');
            
            if ($action === 'create') {
                $data = [
                    'name' => $this->sanitize($this->input('name')),
                    'slug' => $this->generateSlug($this->input('name')),
                    'district_id' => $this->input('district_id'),
                    'description' => $this->sanitize($this->input('description')),
                    'meta_title' => $this->sanitize($this->input('meta_title')),
                    'meta_description' => $this->sanitize($this->input('meta_description')),
                    'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                    'status' => $this->input('status', 'active')
                ];
                
                if ($neighborhoodModel->create($data)) {
                    $success = 'Semt başarıyla eklendi';
                } else {
                    $error = 'Semt eklenirken hata oluştu';
                }
            } elseif ($action === 'update') {
                $id = $this->input('id');
                $data = [
                    'name' => $this->sanitize($this->input('name')),
                    'slug' => $this->generateSlug($this->input('name')),
                    'district_id' => $this->input('district_id'),
                    'description' => $this->sanitize($this->input('description')),
                    'meta_title' => $this->sanitize($this->input('meta_title')),
                    'meta_description' => $this->sanitize($this->input('meta_description')),
                    'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                    'status' => $this->input('status', 'active')
                ];
                
                if ($neighborhoodModel->update($id, $data)) {
                    $success = 'Semt başarıyla güncellendi';
                } else {
                    $error = 'Semt güncellenirken hata oluştu';
                }
            } elseif ($action === 'delete') {
                $id = $this->input('id');
                if ($neighborhoodModel->delete($id)) {
                    $success = 'Semt başarıyla silindi';
                } else {
                    $error = 'Semt silinirken hata oluştu';
                }
            }
        }
        
        $neighborhoods = $neighborhoodModel->paginate($page, 20);
        $districts = $districtModel->getActiveDistricts();
        
        $this->view('admin/neighborhoods', [
            'neighborhoods' => $neighborhoods,
            'districts' => $districts,
            'success' => $success ?? null,
            'error' => $error ?? null
        ]);
    }
    
    public function pricing() {
        $this->requireAuth();
        
        $pricingModel = new Pricing();
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        
        if ($this->isPost()) {
            $action = $this->input('action');
            
            if ($action === 'create') {
                $data = [
                    'from_district_id' => $this->input('from_district_id'),
                    'to_district_id' => $this->input('to_district_id'),
                    'from_neighborhood_id' => $this->input('from_neighborhood_id') ?: null,
                    'to_neighborhood_id' => $this->input('to_neighborhood_id') ?: null,
                    'base_price' => $this->input('base_price'),
                    'price_per_km' => $this->input('price_per_km'),
                    'minimum_price' => $this->input('minimum_price'),
                    'status' => $this->input('status', 'active')
                ];
                
                if ($pricingModel->create($data)) {
                    $success = 'Fiyat rotası başarıyla eklendi';
                } else {
                    $error = 'Fiyat rotası eklenirken hata oluştu';
                }
            } elseif ($action === 'update') {
                $id = $this->input('id');
                $data = [
                    'from_district_id' => $this->input('from_district_id'),
                    'to_district_id' => $this->input('to_district_id'),
                    'from_neighborhood_id' => $this->input('from_neighborhood_id') ?: null,
                    'to_neighborhood_id' => $this->input('to_neighborhood_id') ?: null,
                    'base_price' => $this->input('base_price'),
                    'price_per_km' => $this->input('price_per_km'),
                    'minimum_price' => $this->input('minimum_price'),
                    'status' => $this->input('status', 'active')
                ];
                
                if ($pricingModel->update($id, $data)) {
                    $success = 'Fiyat rotası başarıyla güncellendi';
                } else {
                    $error = 'Fiyat rotası güncellenirken hata oluştu';
                }
            } elseif ($action === 'delete') {
                $id = $this->input('id');
                if ($pricingModel->delete($id)) {
                    $success = 'Fiyat rotası başarıyla silindi';
                } else {
                    $error = 'Fiyat rotası silinirken hata oluştu';
                }
            }
        }
        
        $routes = $pricingModel->getAllRoutes();
        $districts = $districtModel->getActiveDistricts();
        $neighborhoods = $neighborhoodModel->getActiveNeighborhoods();
        
        $this->view('admin/pricing', [
            'routes' => $routes,
            'districts' => $districts,
            'neighborhoods' => $neighborhoods,
            'success' => $success ?? null,
            'error' => $error ?? null
        ]);
    }
    
    public function reviews() {
        $this->requireAuth();
        
        $reviewModel = new Review();
        $page = $this->input('page', 1);
        
        if ($this->isPost()) {
            $action = $this->input('action');
            $id = $this->input('id');
            
            if ($action === 'approve') {
                if ($reviewModel->approve($id)) {
                    $success = 'Yorum onaylandı';
                } else {
                    $error = 'Yorum onaylanırken hata oluştu';
                }
            } elseif ($action === 'reject') {
                if ($reviewModel->reject($id)) {
                    $success = 'Yorum reddedildi';
                } else {
                    $error = 'Yorum reddedilirken hata oluştu';
                }
            } elseif ($action === 'delete') {
                if ($reviewModel->delete($id)) {
                    $success = 'Yorum silindi';
                } else {
                    $error = 'Yorum silinirken hata oluştu';
                }
            }
        }
        
        $reviews = $reviewModel->paginate($page, 20);
        
        $this->view('admin/reviews', [
            'reviews' => $reviews,
            'success' => $success ?? null,
            'error' => $error ?? null
        ]);
    }
    
    public function settings() {
        $this->requireAuth();
        
        if ($this->isPost()) {
            $settings = [
                'site_title' => $this->sanitize($this->input('site_title')),
                'site_description' => $this->sanitize($this->input('site_description')),
                'contact_phone' => $this->sanitize($this->input('contact_phone')),
                'contact_email' => $this->sanitize($this->input('contact_email')),
                'whatsapp_number' => $this->sanitize($this->input('whatsapp_number')),
                'address' => $this->sanitize($this->input('address')),
                'social_facebook' => $this->sanitize($this->input('social_facebook')),
                'social_instagram' => $this->sanitize($this->input('social_instagram')),
                'social_twitter' => $this->sanitize($this->input('social_twitter')),
                'google_maps_api' => $this->sanitize($this->input('google_maps_api')),
                'analytics_code' => $this->input('analytics_code')
            ];
            
            foreach ($settings as $key => $value) {
                $stmt = $this->db->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");
                $stmt->execute([$value, $key]);
            }
            
            $success = 'Ayarlar başarıyla güncellendi';
        }
        
        // Get current settings
        $stmt = $this->db->prepare("SELECT setting_key, setting_value FROM site_settings");
        $stmt->execute();
        $settings = [];
        while ($row = $stmt->fetch()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        
        $this->view('admin/settings', [
            'settings' => $settings,
            'success' => $success ?? null
        ]);
    }
}
?>