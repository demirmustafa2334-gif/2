<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/ContactMessage.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Setting.php';

class ContactController extends Controller {
    
    public function index() {
        $districtModel = new District();
        $settingModel = new Setting();
        
        $data = [
            'title' => 'İletişim | İstanbul Nakliyat',
            'meta_description' => 'Nakliyat hizmetlerimiz hakkında bilgi almak ve fiyat teklifi için bizimle iletişime geçin.',
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('contact', $data);
    }
    
    public function submit() {
        if ($this->isPost()) {
            $name = $this->sanitize($_POST['name'] ?? '');
            $email = $this->sanitize($_POST['email'] ?? '');
            $phone = $this->sanitize($_POST['phone'] ?? '');
            $subject = $this->sanitize($_POST['subject'] ?? '');
            $message = $this->sanitize($_POST['message'] ?? '');
            $from_location = $this->sanitize($_POST['from_location'] ?? '');
            $to_location = $this->sanitize($_POST['to_location'] ?? '');
            
            if ($name && $email && $message) {
                $contactModel = new ContactMessage();
                $contactModel->create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message,
                    'from_location' => $from_location,
                    'to_location' => $to_location
                ]);
                
                // Send email notification (optional)
                $this->sendEmailNotification($name, $email, $phone, $subject, $message);
                
                $this->json(['success' => true, 'message' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.']);
            }
        }
        
        $this->json(['success' => false, 'message' => 'Lütfen tüm zorunlu alanları doldurun.'], 400);
    }
    
    private function sendEmailNotification($name, $email, $phone, $subject, $message) {
        $to = ADMIN_EMAIL;
        $emailSubject = "Yeni İletişim Formu Mesajı: " . $subject;
        $emailMessage = "İsim: {$name}\n";
        $emailMessage .= "E-posta: {$email}\n";
        $emailMessage .= "Telefon: {$phone}\n\n";
        $emailMessage .= "Mesaj:\n{$message}";
        
        $headers = "From: {$email}\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        
        @mail($to, $emailSubject, $emailMessage, $headers);
    }
}
