<?php
require_once 'core/Controller.php';
require_once 'models/Page.php';
require_once 'models/District.php';
require_once 'models/Review.php';
require_once 'models/BlogPost.php';

class PageController extends Controller {
    
    public function services() {
        $districtModel = new District();
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        $this->setMetaData(
            'Nakliyat Hizmetlerimiz | İstanbul Evden Eve Nakliyat',
            'Profesyonel evden eve nakliyat hizmetlerimiz. Ev, ofis, eşya taşıma, ambalajlama ve depolama hizmetleri.',
            'nakliyat hizmetleri, evden eve nakliyat, ofis taşıma, eşya taşıma, ambalajlama'
        );
        
        $this->view('pages/services', [
            'all_districts' => $allDistricts
        ]);
    }
    
    public function pricing() {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $pricingModel = new Pricing();
        
        $districts = $districtModel->getActiveDistricts();
        $neighborhoods = $neighborhoodModel->getActiveNeighborhoods();
        $routes = $pricingModel->getAllRoutes();
        
        $this->setMetaData(
            'Nakliyat Fiyatları | İstanbul Evden Eve Nakliyat',
            'İstanbul içi nakliyat fiyatlarımız. Şeffaf fiyatlandırma, gizli ücret yok. Hemen fiyat alın.',
            'nakliyat fiyatları, istanbul nakliyat fiyat, evden eve nakliyat fiyat'
        );
        
        $this->view('pages/pricing', [
            'districts' => $districts,
            'neighborhoods' => $neighborhoods,
            'routes' => $routes
        ]);
    }
    
    public function reviews() {
        $reviewModel = new Review();
        $districtModel = new District();
        
        $page = $this->input('page', 1);
        $reviews = $reviewModel->paginate($page, 10);
        $averageRating = $reviewModel->getAverageRating();
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        $this->setMetaData(
            'Müşteri Yorumları | İstanbul Evden Eve Nakliyat',
            'Müşterilerimizin nakliyat hizmetimiz hakkındaki yorumları ve deneyimleri. Gerçek müşteri değerlendirmeleri.',
            'nakliyat yorumları, müşteri yorumları, evden eve nakliyat yorum'
        );
        
        $this->view('pages/reviews', [
            'reviews' => $reviews,
            'average_rating' => $averageRating,
            'all_districts' => $allDistricts
        ]);
    }
    
    public function blog() {
        $blogModel = new BlogPost();
        $districtModel = new District();
        
        $page = $this->input('page', 1);
        $posts = $blogModel->paginate($page, 10);
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        $this->setMetaData(
            'Nakliyat Blog | İstanbul Evden Eve Nakliyat',
            'Nakliyat, taşınma ve evden eve nakliyat hakkında güncel bilgiler, ipuçları ve rehberler.',
            'nakliyat blog, taşınma rehberi, evden eve nakliyat ipuçları'
        );
        
        $this->view('pages/blog', [
            'posts' => $posts,
            'all_districts' => $allDistricts
        ]);
    }
    
    public function contact() {
        $districtModel = new District();
        $allDistricts = $districtModel->getDistrictsWithNeighborhoods();
        
        if ($this->isPost()) {
            $name = $this->sanitize($this->input('name'));
            $email = $this->sanitize($this->input('email'));
            $phone = $this->sanitize($this->input('phone'));
            $subject = $this->sanitize($this->input('subject'));
            $message = $this->sanitize($this->input('message'));
            
            if (empty($name) || empty($email) || empty($message)) {
                $error = 'Lütfen tüm zorunlu alanları doldurun';
            } elseif (!$this->validateEmail($email)) {
                $error = 'Geçerli bir e-posta adresi girin';
            } else {
                // Save contact message to database
                $stmt = $this->db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
                if ($stmt->execute([$name, $email, $phone, $subject, $message])) {
                    $success = 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.';
                } else {
                    $error = 'Mesaj gönderilirken hata oluştu. Lütfen tekrar deneyin.';
                }
            }
        }
        
        $this->setMetaData(
            'İletişim | İstanbul Evden Eve Nakliyat',
            'İstanbul evden eve nakliyat hizmetlerimiz için bizimle iletişime geçin. Ücretsiz keşif ve fiyat teklifi.',
            'nakliyat iletişim, evden eve nakliyat telefon, nakliyat adres'
        );
        
        $this->view('pages/contact', [
            'all_districts' => $allDistricts,
            'success' => $success ?? null,
            'error' => $error ?? null
        ]);
    }
}
?>