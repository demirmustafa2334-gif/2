<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Core\Security; use App\Models\Post; use App\Models\City; use App\Models\District;

final class PostAdminController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        $posts = Post::latest(50); $cities = City::all();
        return $this->render('admin/posts/index', compact('posts','cities')+['csrf'=>Security::csrfToken()], ['title'=>'Yazılar']);
    }
    public function store(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        if (!Security::validateCsrf((string)$r->getPost('csrf'))) return Response::html('Geçersiz CSRF',400);
        $title=(string)$r->getPost('title'); $slug=(string)$r->getPost('slug'); $content=(string)$r->getPost('content'); $districtId=(int)$r->getPost('district_id');
        Post::create($title,$slug,$content,$districtId);
        return Response::redirect('/admin/yazilar');
    }
    public function generateWithAI(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        if (!Security::validateCsrf((string)$r->getPost('csrf'))) return Response::html('Geçersiz CSRF',400);
        $districtId=(int)$r->getPost('district_id');
        $title=(string)$r->getPost('title');
        $content = $this->generateContentTR($districtId, $title);
        $slug = Security::slugify($title);
        Post::create($title,$slug,$content,$districtId);
        return Response::redirect('/admin/yazilar');
    }
    private function generateContentTR(int $districtId, string $title): string
    {
        // Basic OpenAI integration (set OPENAI_API_KEY)
        $apiKey = getenv('OPENAI_API_KEY'); if(!$apiKey) return 'API anahtarı bulunamadı.';
        $prompt = 'Türkçe, SEO uyumlu, özgün bir blog yazısı yaz. Başlık: '. $title . '. En az 600 kelime, alt başlıklar ve iç bağlantılar öner.';
        $payload = json_encode([
            'model' => getenv('OPENAI_MODEL') ?: 'gpt-4o-mini',
            'messages' => [ ['role'=>'system','content'=>'Türkçe içerik üret.'], ['role'=>'user','content'=>$prompt] ],
            'temperature' => 0.7,
        ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_HTTPHEADER=>['Content-Type: application/json','Authorization: Bearer '.$apiKey],CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$payload]);
        $res = curl_exec($ch); $err = curl_error($ch); curl_close($ch);
        if ($err || !$res) return 'İçerik oluşturulamadı.';
        $data = json_decode($res,true); return $data['choices'][0]['message']['content'] ?? 'İçerik bulunamadı.';
    }
}
