<?php
/**
 * Contact Form Handler
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get and validate form data
    $name = sanitize_input($_POST['name'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $phone = sanitize_input($_POST['phone'] ?? '');
    $from_district = sanitize_input($_POST['from_district'] ?? '');
    $to_district = sanitize_input($_POST['to_district'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');
    
    // Basic validation
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
    
    // Create contact message
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
        // Send notification email
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
    error_log('Contact form error: ' . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Bir hata oluştu. Lütfen tekrar deneyin.'
    ]);
}
?>