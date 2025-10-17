<?php
session_start();
require_once 'config/database.php';
require_once 'config/config.php';
require_once 'core/Router.php';
require_once 'core/Controller.php';
require_once 'core/Model.php';

// Initialize router
$router = new Router();

// Define routes
$router->addRoute('', 'HomeController@index');
$router->addRoute('home', 'HomeController@index');
$router->addRoute('services', 'PageController@services');
$router->addRoute('pricing', 'PageController@pricing');
$router->addRoute('reviews', 'PageController@reviews');
$router->addRoute('blog', 'PageController@blog');
$router->addRoute('contact', 'PageController@contact');
$router->addRoute('admin', 'AdminController@login');
$router->addRoute('admin/dashboard', 'AdminController@dashboard');
$router->addRoute('admin/pages', 'AdminController@pages');
$router->addRoute('admin/districts', 'AdminController@districts');
$router->addRoute('admin/neighborhoods', 'AdminController@neighborhoods');
$router->addRoute('admin/pricing', 'AdminController@pricing');
$router->addRoute('admin/reviews', 'AdminController@reviews');
$router->addRoute('admin/settings', 'AdminController@settings');
$router->addRoute('istanbul/([a-z0-9-]+)', 'LocationController@district');
$router->addRoute('istanbul/([a-z0-9-]+)/([a-z0-9-]+)', 'LocationController@neighborhood');

// Handle the request
$router->dispatch();
?>