<?php
/**
 * Session Management
 */

class Session {
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key) {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
    }

    public static function flash($key, $value = null) {
        self::start();
        
        if ($value === null) {
            $flash = self::get('_flash_' . $key);
            self::remove('_flash_' . $key);
            return $flash;
        }
        
        self::set('_flash_' . $key, $value);
    }

    public static function isLoggedIn() {
        return self::has('admin_user_id');
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: /admin/login');
            exit;
        }
    }
}
