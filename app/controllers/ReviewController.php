<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Setting.php';

class ReviewController extends Controller {
    
    public function index() {
        $reviewModel = new Review();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $data = [
            'title' => 'Müşteri Yorumları | İstanbul Nakliyat',
            'meta_description' => 'Müşterilerimizin nakliyat hizmetlerimiz hakkındaki görüşleri ve değerlendirmeleri.',
            'reviews' => $reviewModel->getApproved(),
            'average_rating' => $reviewModel->getAverageRating(),
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('reviews', $data);
    }
    
    public function submit() {
        if ($this->isPost()) {
            $name = $this->sanitize($_POST['name'] ?? '');
            $email = $this->sanitize($_POST['email'] ?? '');
            $rating = (int)($_POST['rating'] ?? 0);
            $review_text = $this->sanitize($_POST['review_text'] ?? '');
            $service_type = $this->sanitize($_POST['service_type'] ?? '');
            
            if ($name && $email && $rating >= 1 && $rating <= 5 && $review_text) {
                $reviewModel = new Review();
                $reviewModel->create([
                    'customer_name' => $name,
                    'customer_email' => $email,
                    'rating' => $rating,
                    'review_text' => $review_text,
                    'service_type' => $service_type,
                    'is_approved' => 0 // Pending approval
                ]);
                
                $this->json(['success' => true, 'message' => 'Yorumunuz başarıyla gönderildi. Onaylandıktan sonra yayınlanacaktır.']);
            }
        }
        
        $this->json(['success' => false, 'message' => 'Lütfen tüm alanları doldurun.'], 400);
    }
}
