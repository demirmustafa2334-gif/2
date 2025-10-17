<?php
namespace App\Controllers;

use Core\Controller;
use Core\SEO;
use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug): void
    {
        $page = (new Page())->findBySlug($slug);
        if (!$page) {
            http_response_code(404);
            $this->view->render('errors/404', []);
            return;
        }
        $meta = SEO::meta([
            'title' => $page['meta_title'] ?: $page['title'],
            'description' => $page['meta_description'] ?: '',
        ]);
        $this->view->render('page/show', compact('meta', 'page'));
    }
}
