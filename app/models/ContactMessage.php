<?php
require_once __DIR__ . '/Model.php';

class ContactMessage extends Model {
    protected $table = 'contact_messages';
    
    public function getUnread() {
        return $this->findAllBy('is_read', 0, 'created_at DESC');
    }
    
    public function markAsRead($id) {
        return $this->update($id, ['is_read' => 1]);
    }
}
