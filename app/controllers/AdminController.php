<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/AdminUser.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Neighborhood.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/Price.php';
require_once __DIR__ . '/../models/BlogPost.php';
require_once __DIR__ . '/../models/ContactMessage.php';
require_once __DIR__ . '/../models/Setting.php';

class AdminController extends Controller {
    
    public function __construct() {
        parent::__construct();
        session_start();
    }
    
    protected function checkAuth() {
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            $this->redirect('/admin/login');
        }
    }
    
    public function login() {
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
            $this->redirect('/admin/dashboard');
        }
        
        if ($this->isPost()) {
            $username = $this->sanitize($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            
            $adminModel = new AdminUser();
            $user = $adminModel->authenticate($username, $password);
            
            if ($user) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                $this->redirect('/admin/dashboard');
            } else {
                $error = 'Kullanıcı adı veya şifre hatalı';
            }
        }
        
        $this->view('admin/login', ['error' => $error ?? null]);
    }
    
    public function logout() {
        session_start();
        session_destroy();
        $this->redirect('/admin/login');
    }
    
    public function dashboard() {
        $this->checkAuth();
        
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $serviceModel = new Service();
        $reviewModel = new Review();
        $contactModel = new ContactMessage();
        
        $stats = [
            'total_districts' => $districtModel->count(),
            'total_neighborhoods' => $neighborhoodModel->count(),
            'total_services' => $serviceModel->count(),
            'pending_reviews' => count($reviewModel->getPending()),
            'unread_messages' => count($contactModel->getUnread())
        ];
        
        $this->view('admin/dashboard', ['stats' => $stats]);
    }
    
    // Districts Management
    public function districts() {
        $this->checkAuth();
        $districtModel = new District();
        $this->view('admin/districts', ['districts' => $districtModel->findAll()]);
    }
    
    public function districtAdd() {
        $this->checkAuth();
        
        if ($this->isPost()) {
            $name = $this->sanitize($_POST['name'] ?? '');
            $slug = $this->generateSlug($_POST['slug'] ?? $name);
            $meta_title = $this->sanitize($_POST['meta_title'] ?? '');
            $meta_description = $this->sanitize($_POST['meta_description'] ?? '');
            $content = $_POST['content'] ?? '';
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            
            if ($name) {
                $districtModel = new District();
                $districtModel->create([
                    'name' => $name,
                    'slug' => $slug,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'content' => $content,
                    'is_active' => $is_active
                ]);
                
                $this->redirect('/admin/districts');
            }
        }
        
        $this->view('admin/district-form', ['district' => null]);
    }
    
    public function districtEdit($id) {
        $this->checkAuth();
        $districtModel = new District();
        $district = $districtModel->findById($id);
        
        if (!$district) {
            $this->redirect('/admin/districts');
        }
        
        if ($this->isPost()) {
            $name = $this->sanitize($_POST['name'] ?? '');
            $slug = $this->generateSlug($_POST['slug'] ?? $name);
            $meta_title = $this->sanitize($_POST['meta_title'] ?? '');
            $meta_description = $this->sanitize($_POST['meta_description'] ?? '');
            $content = $_POST['content'] ?? '';
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            
            if ($name) {
                $districtModel->update($id, [
                    'name' => $name,
                    'slug' => $slug,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'content' => $content,
                    'is_active' => $is_active
                ]);
                
                $this->redirect('/admin/districts');
            }
        }
        
        $this->view('admin/district-form', ['district' => $district]);
    }
    
    public function districtDelete($id) {
        $this->checkAuth();
        $districtModel = new District();
        $districtModel->delete($id);
        $this->redirect('/admin/districts');
    }
    
    // Neighborhoods Management
    public function neighborhoods() {
        $this->checkAuth();
        $neighborhoodModel = new Neighborhood();
        $districtModel = new District();
        
        $neighborhoods = $this->db->query("
            SELECT n.*, d.name as district_name 
            FROM neighborhoods n 
            LEFT JOIN districts d ON n.district_id = d.id 
            ORDER BY n.id DESC
        ")->fetchAll();
        
        $this->view('admin/neighborhoods', [
            'neighborhoods' => $neighborhoods,
            'districts' => $districtModel->findAll()
        ]);
    }
    
    public function neighborhoodAdd() {
        $this->checkAuth();
        $districtModel = new District();
        
        if ($this->isPost()) {
            $district_id = (int)($_POST['district_id'] ?? 0);
            $name = $this->sanitize($_POST['name'] ?? '');
            $slug = $this->generateSlug($_POST['slug'] ?? $name);
            $meta_title = $this->sanitize($_POST['meta_title'] ?? '');
            $meta_description = $this->sanitize($_POST['meta_description'] ?? '');
            $content = $_POST['content'] ?? '';
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            
            if ($district_id && $name) {
                $neighborhoodModel = new Neighborhood();
                $neighborhoodModel->create([
                    'district_id' => $district_id,
                    'name' => $name,
                    'slug' => $slug,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'content' => $content,
                    'is_active' => $is_active
                ]);
                
                $this->redirect('/admin/neighborhoods');
            }
        }
        
        $this->view('admin/neighborhood-form', [
            'neighborhood' => null,
            'districts' => $districtModel->findAll()
        ]);
    }
    
    public function neighborhoodEdit($id) {
        $this->checkAuth();
        $neighborhoodModel = new Neighborhood();
        $districtModel = new District();
        $neighborhood = $neighborhoodModel->findById($id);
        
        if (!$neighborhood) {
            $this->redirect('/admin/neighborhoods');
        }
        
        if ($this->isPost()) {
            $district_id = (int)($_POST['district_id'] ?? 0);
            $name = $this->sanitize($_POST['name'] ?? '');
            $slug = $this->generateSlug($_POST['slug'] ?? $name);
            $meta_title = $this->sanitize($_POST['meta_title'] ?? '');
            $meta_description = $this->sanitize($_POST['meta_description'] ?? '');
            $content = $_POST['content'] ?? '';
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            
            if ($district_id && $name) {
                $neighborhoodModel->update($id, [
                    'district_id' => $district_id,
                    'name' => $name,
                    'slug' => $slug,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'content' => $content,
                    'is_active' => $is_active
                ]);
                
                $this->redirect('/admin/neighborhoods');
            }
        }
        
        $this->view('admin/neighborhood-form', [
            'neighborhood' => $neighborhood,
            'districts' => $districtModel->findAll()
        ]);
    }
    
    public function neighborhoodDelete($id) {
        $this->checkAuth();
        $neighborhoodModel = new Neighborhood();
        $neighborhoodModel->delete($id);
        $this->redirect('/admin/neighborhoods');
    }
    
    // Services Management
    public function services() {
        $this->checkAuth();
        $serviceModel = new Service();
        $this->view('admin/services', ['services' => $serviceModel->findAll()]);
    }
    
    // Reviews Management
    public function reviews() {
        $this->checkAuth();
        $reviewModel = new Review();
        $this->view('admin/reviews', ['reviews' => $reviewModel->findAll()]);
    }
    
    public function reviewApprove($id) {
        $this->checkAuth();
        $reviewModel = new Review();
        $reviewModel->update($id, ['is_approved' => 1]);
        $this->redirect('/admin/reviews');
    }
    
    public function reviewDelete($id) {
        $this->checkAuth();
        $reviewModel = new Review();
        $reviewModel->delete($id);
        $this->redirect('/admin/reviews');
    }
    
    // Prices Management
    public function prices() {
        $this->checkAuth();
        $priceModel = new Price();
        $this->view('admin/prices', ['prices' => $priceModel->getAllWithDistricts()]);
    }
    
    public function priceAdd() {
        $this->checkAuth();
        $districtModel = new District();
        
        if ($this->isPost()) {
            $from_district_id = (int)($_POST['from_district_id'] ?? 0);
            $to_district_id = (int)($_POST['to_district_id'] ?? 0);
            $base_price = (float)($_POST['base_price'] ?? 0);
            $price_per_km = (float)($_POST['price_per_km'] ?? 0);
            $notes = $this->sanitize($_POST['notes'] ?? '');
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            
            if ($from_district_id && $to_district_id && $base_price) {
                $priceModel = new Price();
                $priceModel->create([
                    'from_district_id' => $from_district_id,
                    'to_district_id' => $to_district_id,
                    'base_price' => $base_price,
                    'price_per_km' => $price_per_km,
                    'notes' => $notes,
                    'is_active' => $is_active
                ]);
                
                $this->redirect('/admin/prices');
            }
        }
        
        $this->view('admin/price-form', [
            'price' => null,
            'districts' => $districtModel->findAll()
        ]);
    }
    
    public function priceEdit($id) {
        $this->checkAuth();
        $priceModel = new Price();
        $districtModel = new District();
        $price = $priceModel->findById($id);
        
        if (!$price) {
            $this->redirect('/admin/prices');
        }
        
        if ($this->isPost()) {
            $from_district_id = (int)($_POST['from_district_id'] ?? 0);
            $to_district_id = (int)($_POST['to_district_id'] ?? 0);
            $base_price = (float)($_POST['base_price'] ?? 0);
            $price_per_km = (float)($_POST['price_per_km'] ?? 0);
            $notes = $this->sanitize($_POST['notes'] ?? '');
            $is_active = isset($_POST['is_active']) ? 1 : 0;
            
            if ($from_district_id && $to_district_id && $base_price) {
                $priceModel->update($id, [
                    'from_district_id' => $from_district_id,
                    'to_district_id' => $to_district_id,
                    'base_price' => $base_price,
                    'price_per_km' => $price_per_km,
                    'notes' => $notes,
                    'is_active' => $is_active
                ]);
                
                $this->redirect('/admin/prices');
            }
        }
        
        $this->view('admin/price-form', [
            'price' => $price,
            'districts' => $districtModel->findAll()
        ]);
    }
    
    public function priceDelete($id) {
        $this->checkAuth();
        $priceModel = new Price();
        $priceModel->delete($id);
        $this->redirect('/admin/prices');
    }
    
    // Contact Messages
    public function messages() {
        $this->checkAuth();
        $contactModel = new ContactMessage();
        $this->view('admin/messages', ['messages' => $contactModel->findAll()]);
    }
    
    public function messageView($id) {
        $this->checkAuth();
        $contactModel = new ContactMessage();
        $message = $contactModel->findById($id);
        
        if ($message) {
            $contactModel->markAsRead($id);
        }
        
        $this->view('admin/message-view', ['message' => $message]);
    }
    
    // Settings
    public function settings() {
        $this->checkAuth();
        $settingModel = new Setting();
        
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                if ($key !== 'submit') {
                    $settingModel->set($key, $this->sanitize($value));
                }
            }
            $message = 'Ayarlar başarıyla kaydedildi.';
        }
        
        $this->view('admin/settings', [
            'settings' => $settingModel->getAll(),
            'message' => $message ?? null
        ]);
    }
}
