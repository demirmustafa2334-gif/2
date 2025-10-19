<?php
namespace App\Controllers;

use Core\Controller;
use Core\Response;
use App\Models\Price;
use App\Models\District;

class PriceController extends Controller
{
    public function estimateApi(): void
    {
        $from = (int)($_GET['from'] ?? 0);
        $to = (int)($_GET['to'] ?? 0);
        $variant = $_GET['variant'] ?? 'home';

        if (!$from || !$to) {
            Response::json(['error' => 'Missing parameters'], 400);
            return;
        }
        $priceModel = new Price();
        $value = $priceModel->estimate($from, $to, $variant);
        if ($value === null) {
            Response::json(['estimated' => null]);
            return;
        }
        Response::json(['estimated' => $value]);
    }

    public function form(): void
    {
        $districts = (new District())->all();
        $this->view->render('prices/form', compact('districts'));
    }
}
