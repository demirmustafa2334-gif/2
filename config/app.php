<?php
/**
 * Application Configuration
 */

return [
    'name' => 'İstanbul Nakliyat',
    'url' => 'http://localhost',
    'timezone' => 'Europe/Istanbul',
    'locale' => 'tr',
    
    // Admin settings
    'admin_path' => 'admin',
    'session_lifetime' => 7200, // 2 hours
    
    // SEO
    'default_meta_description' => 'İstanbul\'da profesyonel evden eve nakliyat hizmetleri. Güvenilir, hızlı ve uygun fiyatlı taşımacılık.',
    'default_meta_keywords' => 'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye',
    
    // Contact
    'contact_email' => 'info@istanbulnakliyat.com',
    'phone' => '+90 555 123 4567',
    'whatsapp' => '+905551234567',
    
    // Pagination
    'items_per_page' => 10,
    
    // Upload
    'upload_max_size' => 5242880, // 5MB
    'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
];
