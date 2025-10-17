<?php
/**
 * Admin Logout
 * Istanbul Moving Company - Custom PHP Script
 */

require_once '../config/config.php';

// Destroy session
session_destroy();

// Redirect to login
redirect(ADMIN_URL . '/login.php');
?>