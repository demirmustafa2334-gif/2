<?php
/**
 * Frontend Controller
 */

class FrontendController extends Controller {
    
    public function home() {
        $reviewModel = new Review();
        $blogModel = new BlogPost();
        
        $data = [
            'featuredReviews' => $reviewModel->getFeatured(6),
            'recentBlogs' => $blogModel->getRecent(3),
            'averageRating' => $reviewModel->getAverageRating()
        ];

        $this->view('frontend/home', $data);
    }

    public function services() {
        $pageModel = new Page();
        $page = $pageModel->getBySlug('hizmetlerimiz');
        
        $this->view('frontend/services', ['page' => $page]);
    }

    public function prices() {
        $priceModel = new Price();
        $districtModel = new District();
        
        $data = [
            'prices' => $priceModel->getAll(),
            'districts' => $districtModel->getAll(true)
        ];

        $this->view('frontend/prices', $data);
    }

    public function calculatePrice() {
        if ($this->isPost()) {
            $fromDistrictId = $this->input('from_district');
            $toDistrictId = $this->input('to_district');

            $priceModel = new Price();
            $price = $priceModel->calculatePrice($fromDistrictId, $toDistrictId);

            $this->json([
                'success' => true,
                'price' => $price,
                'formatted_price' => formatPrice($price)
            ]);
        }

        $this->json(['success' => false], 400);
    }

    public function district($slug) {
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        
        $district = $districtModel->getBySlug($slug);

        if (!$district) {
            http_response_code(404);
            $this->view('frontend/404');
            return;
        }

        $neighborhoods = $neighborhoodModel->getByDistrict($district['id']);
        $allDistricts = $districtModel->getAll(true);

        $data = [
            'district' => $district,
            'neighborhoods' => $neighborhoods,
            'relatedDistricts' => array_slice($allDistricts, 0, 5)
        ];

        $this->view('frontend/district', $data);
    }

    public function neighborhood($slug) {
        $neighborhoodModel = new Neighborhood();
        $districtModel = new District();
        
        $neighborhood = $neighborhoodModel->getBySlug($slug);

        if (!$neighborhood) {
            http_response_code(404);
            $this->view('frontend/404');
            return;
        }

        $otherNeighborhoods = $neighborhoodModel->getByDistrict($neighborhood['district_id']);
        $district = $districtModel->getById($neighborhood['district_id']);

        $data = [
            'neighborhood' => $neighborhood,
            'district' => $district,
            'otherNeighborhoods' => $otherNeighborhoods
        ];

        $this->view('frontend/neighborhood', $data);
    }

    public function blog($page = 1) {
        $blogModel = new BlogPost();
        $perPage = config('items_per_page', 10);
        $offset = ($page - 1) * $perPage;
        
        $posts = $blogModel->getAll(true, $perPage, $offset);
        $totalPosts = $blogModel->count(true);
        $totalPages = ceil($totalPosts / $perPage);

        $data = [
            'posts' => $posts,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ];

        $this->view('frontend/blog', $data);
    }

    public function blogPost($slug) {
        $blogModel = new BlogPost();
        $post = $blogModel->getBySlug($slug);

        if (!$post) {
            http_response_code(404);
            $this->view('frontend/404');
            return;
        }

        $blogModel->incrementViews($post['id']);
        $recentPosts = $blogModel->getRecent(5);

        $data = [
            'post' => $post,
            'recentPosts' => $recentPosts
        ];

        $this->view('frontend/blog-post', $data);
    }

    public function reviews() {
        $reviewModel = new Review();
        $data['reviews'] = $reviewModel->getAll(true);

        $this->view('frontend/reviews', $data);
    }

    public function contact() {
        if ($this->isPost()) {
            $name = $this->sanitize($this->input('name'));
            $email = $this->sanitize($this->input('email'));
            $phone = $this->sanitize($this->input('phone'));
            $message = $this->sanitize($this->input('message'));

            // Send email
            $to = getSetting('contact_email', config('contact_email'));
            $subject = 'Yeni İletişim Formu Mesajı';
            $body = "İsim: {$name}\nE-posta: {$email}\nTelefon: {$phone}\n\nMesaj:\n{$message}";
            $headers = "From: {$email}";

            mail($to, $subject, $body, $headers);

            Session::flash('success', 'Mesajınız başarıyla gönderildi!');
            $this->redirect('/iletisim');
        }

        $this->view('frontend/contact');
    }

    public function page($slug) {
        $pageModel = new Page();
        $page = $pageModel->getBySlug($slug);

        if (!$page) {
            http_response_code(404);
            $this->view('frontend/404');
            return;
        }

        $this->view('frontend/page', ['page' => $page]);
    }

    public function sitemap() {
        header('Content-Type: application/xml; charset=utf-8');
        
        $districtModel = new District();
        $neighborhoodModel = new Neighborhood();
        $blogModel = new BlogPost();
        $pageModel = new Page();

        $data = [
            'districts' => $districtModel->getAll(true),
            'neighborhoods' => $neighborhoodModel->getAll(true),
            'blogPosts' => $blogModel->getAll(true),
            'pages' => $pageModel->getAll(true),
            'baseUrl' => config('url')
        ];

        $this->view('frontend/sitemap', $data);
    }
}
