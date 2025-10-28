<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Helpers\Seo;
use App\Core\View;

final class LocationController extends Controller
{
    public function district(Request $request, array $params): string
    {
        $slug = $params['slug'] ?? '';
        $title = ucfirst(str_replace('-', ' ', $slug));
        Seo::set([
            'title' => $title . ' Evden Eve Nakliyat',
            'description' => $title . ' ev ve ofis taşımacılığı için profesyonel hizmet.'
        ]);
        return $this->view('location/district', [
            'slug' => $slug,
            'title' => $title,
        ]);
    }

    public function neighborhood(Request $request, array $params): string
    {
        $district = $params['districtSlug'] ?? '';
        $neighborhood = $params['neighborhoodSlug'] ?? '';
        $title = ucfirst(str_replace('-', ' ', $neighborhood)) . ' (' . ucfirst(str_replace('-', ' ', $district)) . ')';
        Seo::set([
            'title' => $title . ' Nakliyat',
            'description' => $title . ' içi taşımacılık ve evden eve nakliyat.'
        ]);
        return $this->view('location/neighborhood', [
            'district' => $district,
            'neighborhood' => $neighborhood,
            'title' => $title,
        ]);
    }
}
