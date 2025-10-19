<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Models\Post; use App\Models\District; use App\Models\City;

final class BlogController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        $posts = Post::latest(20);
        return $this->render('blog/index', compact('posts'), [ 'title' => 'Blog | yereltanitim.com' ]);
    }
    public function show(Request $r, array $p=[]): Response
    {
        $slug = $p['slug'] ?? ''; $post = Post::findBySlug($slug);
        if(!$post) return Response::html('<div class="container py-5"><h1>Yazı bulunamadı</h1></div>',404);
        $suggestions = [];
        if (!empty($post['district_id'])) {
            $d = District::find((int)$post['district_id']); if ($d) { $suggestions = District::byCityId((int)$d['city_id']); }
        }
        return $this->render('blog/show', compact('post','suggestions'), [
            'title' => $post['title'].' | yereltanitim.com',
            'description' => mb_substr(strip_tags($post['content']),0,160),
        ]);
    }
}
