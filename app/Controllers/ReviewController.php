<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function list(): void
    {
        $reviews = (new Review())->approved(20);
        $meta = [
            'title' => 'Müşteri Yorumları',
            'description' => 'Nakliyat müşterilerimizin güncel yorumları',
        ];
        $this->view->render('reviews/index', compact('meta', 'reviews'));
    }
}
