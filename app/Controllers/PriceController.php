<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

final class PriceController extends Controller
{
    public function index(Request $request): string
    {
        return $this->view('price/index');
    }

    public function calculate(Request $request): string
    {
        // Placeholder logic; real logic will use DB
        $body = $request->getBody();
        $from = $body['from'] ?? '';
        $to = $body['to'] ?? '';
        $estimate = ($from && $to) ? 1999 : null;
        return $this->view('price/calc', [
            'from' => $from,
            'to' => $to,
            'estimate' => $estimate,
        ]);
    }
}
