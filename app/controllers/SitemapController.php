<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Neighborhood.php';
require_once __DIR__ . '/../models/Service.php';
require_once __DIR__ . '/../models/BlogPost.php';

class SitemapController extends Controller {
    
    public function index() {
        header('Content-Type: application/xml; charset=utf-8');
        
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $serviceModel = new Service();
        $blogModel = new BlogPost();
        
        $data = [
            'districts' => $districtModel->getActive(),
            'neighborhoods' => $neighborhoodModel->getActive(),
            'services' => $serviceModel->getActive(),
            'blog_posts' => $blogModel->getPublished()
        ];
        
        $this->view('sitemap', $data);
    }
}
