<?php
/**
 * Admin Controller
 */

class AdminController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function login() {
        if (Session::isLoggedIn()) {
            $this->redirect('/admin/dashboard');
        }

        if ($this->isPost()) {
            $username = $this->sanitize($this->input('username'));
            $password = $this->input('password');

            $user = $this->db->fetchOne("SELECT * FROM admin_users WHERE username = ?", [$username]);

            if ($user && password_verify($password, $user['password'])) {
                Session::set('admin_user_id', $user['id']);
                Session::set('admin_username', $user['username']);
                Session::flash('success', 'Başarıyla giriş yaptınız!');
                $this->redirect('/admin/dashboard');
            } else {
                Session::flash('error', 'Kullanıcı adı veya şifre hatalı!');
            }
        }

        $this->view('admin/login');
    }

    public function logout() {
        Session::destroy();
        $this->redirect('/admin/login');
    }

    public function dashboard() {
        Session::requireLogin();

        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $reviewModel = new Review();
        $blogModel = new BlogPost();

        $data = [
            'totalDistricts' => $districtModel->count(),
            'totalNeighborhoods' => $neighborhoodModel->count(),
            'totalReviews' => $reviewModel->count(),
            'totalBlogPosts' => $blogModel->count(),
            'recentReviews' => $reviewModel->getAll(false)
        ];

        $this->view('admin/dashboard', $data);
    }

    // Districts Management
    public function districts() {
        Session::requireLogin();
        
        $districtModel = new District();
        $data['districts'] = $districtModel->getAll();
        
        $this->view('admin/districts/index', $data);
    }

    public function districtCreate() {
        Session::requireLogin();

        if ($this->isPost()) {
            $data = [
                'name' => $this->sanitize($this->input('name')),
                'slug' => $this->generateSlug($this->input('slug') ?: $this->input('name')),
                'description' => $this->input('description'),
                'content' => $this->input('content'),
                'meta_title' => $this->sanitize($this->input('meta_title')),
                'meta_description' => $this->sanitize($this->input('meta_description')),
                'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                'is_active' => $this->input('is_active', 1),
                'sort_order' => $this->input('sort_order', 0)
            ];

            $districtModel = new District();
            $districtModel->create($data);
            
            Session::flash('success', 'İlçe başarıyla eklendi!');
            $this->redirect('/admin/districts');
        }

        $this->view('admin/districts/create');
    }

    public function districtEdit($id) {
        Session::requireLogin();

        $districtModel = new District();
        $district = $districtModel->getById($id);

        if (!$district) {
            Session::flash('error', 'İlçe bulunamadı!');
            $this->redirect('/admin/districts');
        }

        if ($this->isPost()) {
            $data = [
                'name' => $this->sanitize($this->input('name')),
                'slug' => $this->generateSlug($this->input('slug') ?: $this->input('name')),
                'description' => $this->input('description'),
                'content' => $this->input('content'),
                'meta_title' => $this->sanitize($this->input('meta_title')),
                'meta_description' => $this->sanitize($this->input('meta_description')),
                'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                'is_active' => $this->input('is_active', 0),
                'sort_order' => $this->input('sort_order', 0)
            ];

            $districtModel->update($id, $data);
            
            Session::flash('success', 'İlçe başarıyla güncellendi!');
            $this->redirect('/admin/districts');
        }

        $this->view('admin/districts/edit', ['district' => $district]);
    }

    public function districtDelete($id) {
        Session::requireLogin();

        $districtModel = new District();
        $districtModel->delete($id);
        
        Session::flash('success', 'İlçe başarıyla silindi!');
        $this->redirect('/admin/districts');
    }

    // Neighborhoods Management
    public function neighborhoods() {
        Session::requireLogin();
        
        $neighborhoodModel = new Neighborhood();
        $data['neighborhoods'] = $neighborhoodModel->getAll();
        
        $this->view('admin/neighborhoods/index', $data);
    }

    public function neighborhoodCreate() {
        Session::requireLogin();

        $districtModel = new District();
        $data['districts'] = $districtModel->getAll(true);

        if ($this->isPost()) {
            $postData = [
                'district_id' => $this->input('district_id'),
                'name' => $this->sanitize($this->input('name')),
                'slug' => $this->generateSlug($this->input('slug') ?: $this->input('name')),
                'description' => $this->input('description'),
                'content' => $this->input('content'),
                'meta_title' => $this->sanitize($this->input('meta_title')),
                'meta_description' => $this->sanitize($this->input('meta_description')),
                'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                'is_active' => $this->input('is_active', 1),
                'sort_order' => $this->input('sort_order', 0)
            ];

            $neighborhoodModel = new Neighborhood();
            $neighborhoodModel->create($postData);
            
            Session::flash('success', 'Semt başarıyla eklendi!');
            $this->redirect('/admin/neighborhoods');
        }

        $this->view('admin/neighborhoods/create', $data);
    }

    public function neighborhoodEdit($id) {
        Session::requireLogin();

        $neighborhoodModel = new Neighborhood();
        $neighborhood = $neighborhoodModel->getById($id);

        if (!$neighborhood) {
            Session::flash('error', 'Semt bulunamadı!');
            $this->redirect('/admin/neighborhoods');
        }

        $districtModel = new District();
        $data['districts'] = $districtModel->getAll(true);
        $data['neighborhood'] = $neighborhood;

        if ($this->isPost()) {
            $postData = [
                'district_id' => $this->input('district_id'),
                'name' => $this->sanitize($this->input('name')),
                'slug' => $this->generateSlug($this->input('slug') ?: $this->input('name')),
                'description' => $this->input('description'),
                'content' => $this->input('content'),
                'meta_title' => $this->sanitize($this->input('meta_title')),
                'meta_description' => $this->sanitize($this->input('meta_description')),
                'meta_keywords' => $this->sanitize($this->input('meta_keywords')),
                'is_active' => $this->input('is_active', 0),
                'sort_order' => $this->input('sort_order', 0)
            ];

            $neighborhoodModel->update($id, $postData);
            
            Session::flash('success', 'Semt başarıyla güncellendi!');
            $this->redirect('/admin/neighborhoods');
        }

        $this->view('admin/neighborhoods/edit', $data);
    }

    public function neighborhoodDelete($id) {
        Session::requireLogin();

        $neighborhoodModel = new Neighborhood();
        $neighborhoodModel->delete($id);
        
        Session::flash('success', 'Semt başarıyla silindi!');
        $this->redirect('/admin/neighborhoods');
    }

    // Prices Management
    public function prices() {
        Session::requireLogin();
        
        $priceModel = new Price();
        $data['prices'] = $priceModel->getAll();
        
        $this->view('admin/prices/index', $data);
    }

    public function priceCreate() {
        Session::requireLogin();

        $districtModel = new District();
        $data['districts'] = $districtModel->getAll(true);

        if ($this->isPost()) {
            $postData = [
                'from_district_id' => $this->input('from_district_id'),
                'to_district_id' => $this->input('to_district_id'),
                'base_price' => $this->input('base_price'),
                'description' => $this->input('description'),
                'is_active' => $this->input('is_active', 1)
            ];

            $priceModel = new Price();
            $priceModel->create($postData);
            
            Session::flash('success', 'Fiyat başarıyla eklendi!');
            $this->redirect('/admin/prices');
        }

        $this->view('admin/prices/create', $data);
    }

    public function priceEdit($id) {
        Session::requireLogin();

        $priceModel = new Price();
        $price = $priceModel->getById($id);

        if (!$price) {
            Session::flash('error', 'Fiyat bulunamadı!');
            $this->redirect('/admin/prices');
        }

        $districtModel = new District();
        $data['districts'] = $districtModel->getAll(true);
        $data['price'] = $price;

        if ($this->isPost()) {
            $postData = [
                'from_district_id' => $this->input('from_district_id'),
                'to_district_id' => $this->input('to_district_id'),
                'base_price' => $this->input('base_price'),
                'description' => $this->input('description'),
                'is_active' => $this->input('is_active', 0)
            ];

            $priceModel->update($id, $postData);
            
            Session::flash('success', 'Fiyat başarıyla güncellendi!');
            $this->redirect('/admin/prices');
        }

        $this->view('admin/prices/edit', $data);
    }

    public function priceDelete($id) {
        Session::requireLogin();

        $priceModel = new Price();
        $priceModel->delete($id);
        
        Session::flash('success', 'Fiyat başarıyla silindi!');
        $this->redirect('/admin/prices');
    }

    // Reviews Management
    public function reviews() {
        Session::requireLogin();
        
        $reviewModel = new Review();
        $data['reviews'] = $reviewModel->getAll();
        
        $this->view('admin/reviews/index', $data);
    }

    public function reviewApprove($id) {
        Session::requireLogin();

        $reviewModel = new Review();
        $reviewModel->approve($id);
        
        Session::flash('success', 'Yorum onaylandı!');
        $this->redirect('/admin/reviews');
    }

    public function reviewDelete($id) {
        Session::requireLogin();

        $reviewModel = new Review();
        $reviewModel->delete($id);
        
        Session::flash('success', 'Yorum silindi!');
        $this->redirect('/admin/reviews');
    }

    // Settings
    public function settings() {
        Session::requireLogin();

        if ($this->isPost()) {
            $settings = $this->input('settings', []);
            
            foreach ($settings as $key => $value) {
                setSetting($key, $value);
            }
            
            Session::flash('success', 'Ayarlar başarıyla kaydedildi!');
            $this->redirect('/admin/settings');
        }

        $this->view('admin/settings');
    }
}
