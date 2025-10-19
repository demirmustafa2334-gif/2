<?php
/**
 * Yönetici Çıkış
 * Yerel Tanıtım - Özel PHP Scripti
 */

require_once '../config/config.php';

// Oturumu sonlandır
session_destroy();

// Giriş sayfasına yönlendir
redirect(ADMIN_URL . '/giris.php');
?>