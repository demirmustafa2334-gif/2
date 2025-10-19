<?php
namespace App\Controllers;

use Core\Controller;
use Core\SEO;

class HomeController extends Controller
{
    public function index(): void
    {
        $meta = SEO::meta([
            'title' => 'İstanbul Nakliyat | Evden Eve ve Ofis Taşıma',
            'description' => 'Kadıköy, Beşiktaş, Üsküdar ve tüm İstanbul ilçelerinde profesyonel nakliyat hizmetleri.',
        ]);
        $this->view->render('home/index', compact('meta'));
    }
}
