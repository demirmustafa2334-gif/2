<?php
/**
 * İletişim Formu İşleyicisi
 * Yerel Tanıtım - Özel PHP Scripti
 */

require_once 'config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'İzin verilmeyen method']);
    exit;
}

try {
    // Form verilerini al ve doğrula
    $name = sanitize_input($_POST['name'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $phone = sanitize_input($_POST['phone'] ?? '');
    $from_district = sanitize_input($_POST['from_district'] ?? '');
    $to_district = sanitize_input($_POST['to_district'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');
    
    // Temel doğrulama
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Lütfen zorunlu alanları doldurun.'
        ]);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Geçerli bir e-posta adresi girin.'
        ]);
        exit;
    }
    
    // İletişim mesajı oluştur
    $contactMessage = new ContactMessage();
    $messageData = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'from_district' => $from_district,
        'to_district' => $to_district,
        'message' => $message
    ];
    
    $messageId = $contactMessage->createMessage($messageData);
    
    if ($messageId) {
        // Bildirim e-postası gönder
        $contactMessage->sendNotificationEmail($messageData);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Mesaj gönderilirken bir hata oluştu. Lütfen tekrar deneyin.'
        ]);
    }
    
} catch (Exception $e) {
    error_log('İletişim formu hatası: ' . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Bir hata oluştu. Lütfen tekrar deneyin.'
    ]);
}
?>