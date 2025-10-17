<?php
return [
    'app_name' => 'Istanbul Nakliyat',
    'base_url' => '', // auto-detect if empty
    'debug' => true,
    'timezone' => 'Europe/Istanbul',

    'db' => [
        'dsn' => 'mysql:host=127.0.0.1;dbname=nakliyat;charset=utf8mb4',
        'user' => 'root',
        'pass' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],

    'security' => [
        'password_algo' => PASSWORD_DEFAULT,
        'csrf_token_key' => '_csrf',
    ],

    'seo' => [
        'default_title' => 'İstanbul Evden Eve Nakliyat | Profesyonel Taşımacılık',
        'default_description' => 'İstanbul içi ev ve ofis taşımacılığı. Uygun fiyat, sigortalı taşıma, ücretsiz ekspertiz.',
        'default_keywords' => 'istanbul nakliyat, evden eve, ofis taşıma',
        'og_image' => '/assets/img/og.jpg',
        'twitter_site' => '@istanbul_nakliyat',
    ],

    'mail' => [
        'to' => 'info@example.com',
        'from' => 'no-reply@example.com',
    ],

    'whatsapp' => [
        'phone' => '+905555555555',
        'message' => 'Merhaba, taşınma için fiyat almak istiyorum.',
    ],
];
