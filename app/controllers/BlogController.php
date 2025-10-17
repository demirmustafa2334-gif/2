<?php
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../models/BlogPost.php';
require_once __DIR__ . '/../models/District.php';
require_once __DIR__ . '/../models/Setting.php';

class BlogController extends Controller {
    
    public function index() {
        $blogModel = new BlogPost();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $data = [
            'title' => 'Blog | İstanbul Nakliyat',
            'meta_description' => 'Nakliyat ipuçları, taşınma rehberi ve faydalı bilgiler.',
            'posts' => $blogModel->getPublished(),
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('blog', $data);
    }
    
    public function post($slug) {
        $blogModel = new BlogPost();
        $districtModel = new District();
        $settingModel = new Setting();
        
        $post = $blogModel->getBySlug($slug);
        
        if (!$post || !$post['is_published']) {
            $this->redirect('/blog');
        }
        
        $recentPosts = $blogModel->getRecent(5);
        
        $data = [
            'title' => $post['meta_title'] ?: $post['title'],
            'meta_description' => $post['meta_description'] ?: $post['excerpt'],
            'post' => $post,
            'recent_posts' => $recentPosts,
            'districts' => $districtModel->getActive(),
            'settings' => $settingModel->getAll()
        ];
        
        $this->view('blog-post', $data);
    }
}
