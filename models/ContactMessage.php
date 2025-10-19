<?php
/**
 * Contact Message Model
 * Yereltanitim.com - Turkey Tourism Website
 */

class ContactMessage extends BaseModel {
    protected $table = 'contact_messages';
    
    public function getUnreadMessages() {
        return $this->findAll('is_read = 0', 'created_at DESC');
    }
    
    public function getAllMessages($limit = null) {
        $limitClause = $limit ? "LIMIT {$limit}" : '';
        return $this->findAll('', 'created_at DESC', $limitClause);
    }
    
    public function markAsRead($id) {
        return $this->update($id, ['is_read' => 1]);
    }
    
    public function getUnreadCount() {
        return $this->count('is_read = 0');
    }
    
    public function createMessage($data) {
        // Sanitize input data
        $sanitizedData = [
            'name' => sanitize_input($data['name']),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'phone' => sanitize_input($data['phone'] ?? ''),
            'subject' => sanitize_input($data['subject'] ?? ''),
            'message' => sanitize_input($data['message']),
            'is_read' => 0
        ];
        
        // Validate email
        if (!filter_var($sanitizedData['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        return $this->create($sanitizedData);
    }
    
    public function sendNotificationEmail($messageData) {
        $adminEmail = get_setting('contact_email');
        $siteName = get_setting('site_title');
        
        $subject = "Yeni İletişim Mesajı - " . $siteName;
        
        $message = "
        Yeni bir iletişim mesajı aldınız:\n\n
        Ad Soyad: {$messageData['name']}\n
        E-posta: {$messageData['email']}\n
        Telefon: {$messageData['phone']}\n
        Konu: {$messageData['subject']}\n
        Mesaj: {$messageData['message']}\n\n
        Tarih: " . date('d.m.Y H:i') . "\n
        ";
        
        $headers = "From: noreply@yereltanitim.com\r\n";
        $headers .= "Reply-To: {$messageData['email']}\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        return mail($adminEmail, $subject, $message, $headers);
    }
}
?>