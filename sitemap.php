<?php
require_once 'config/database.php';
require_once 'config/config.php';
require_once 'includes/functions.php';

// Generate sitemap
generateSitemap();

// Output sitemap
header('Content-Type: application/xml');
readfile('sitemap.xml');
?>