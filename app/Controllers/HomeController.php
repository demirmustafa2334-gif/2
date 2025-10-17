<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

final class HomeController extends Controller
{
    /** @param array<string,string> $params */
    public function index(Request $request, array $params = []): Response
    {
        return $this->render('home/index', [
            'hero' => [
                'title' => 'İstanbul Evden Eve Nakliyat',
                'subtitle' => 'Hızlı, güvenilir ve uygun fiyatlı taşımacılık',
                'cta' => 'Hemen Teklif Al',
            ],
        ], [
            'title' => 'İstanbul Evden Eve Nakliyat | Profesyonel Taşımacılık',
            'description' => 'İstanbul içi evden eve nakliyat, ofis taşıma ve asansörlü taşımacılık. Uygun fiyat, sigortalı ve profesyonel hizmet.',
        ]);
    }

    public function services(Request $request, array $params = []): Response
    {
        return $this->render('service/index', [] , [
            'title' => 'Hizmetlerimiz | İstanbul Nakliyat',
            'description' => 'Evden eve nakliyat, ofis taşımacılığı, paketleme ve asansörlü taşımacılık hizmetlerimiz.',
        ]);
    }

    public function prices(Request $request, array $params = []): Response
    {
        return $this->render('price/index', [], [
            'title' => 'Fiyat Listesi | İstanbul Nakliyat',
            'description' => 'İstanbul içi taşımacılık tahmini fiyatları: İlçe → İlçe, Semt → Semt.',
        ]);
    }

    public function reviews(Request $request, array $params = []): Response
    {
        return $this->render('reviews/index', [], [
            'title' => 'Müşteri Yorumları | İstanbul Nakliyat',
            'description' => 'Gerçek müşteri değerlendirmeleri ve memnuniyet puanları.',
        ]);
    }

    public function blog(Request $request, array $params = []): Response
    {
        return $this->render('blog/index', [], [
            'title' => 'Blog | İstanbul Nakliyat',
            'description' => 'Taşınma ipuçları, rehberler ve yenilikler.',
        ]);
    }

    public function contact(Request $request, array $params = []): Response
    {
        return $this->render('contact/index', [], [
            'title' => 'İletişim | İstanbul Nakliyat',
            'description' => 'Bizimle WhatsApp veya telefon üzerinden hemen iletişime geçin.',
        ]);
    }

    /** @param array{locationSlug:string} $params */
    public function location(Request $request, array $params = []): Response
    {
        $slug = $params['locationSlug'] ?? 'istanbul';
        $name = ucwords(str_replace('-', ' ', $slug));
        return $this->render('location/show', [
            'location' => [
                'name' => $name,
                'slug' => $slug,
                'type' => 'İlçe',
            ],
        ], [
            'title' => $name . ' Evden Eve Nakliyat',
            'description' => $name . ' ilçesinde profesyonel evden eve taşımacılık hizmetleri.',
        ]);
    }
}
