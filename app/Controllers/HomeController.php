<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

final class HomeController extends Controller
{
    public function index(Request $request): string
    {
        return $this->view('home/index');
    }

    public function services(Request $request): string
    {
        return $this->view('home/services');
    }

    public function contact(Request $request): string
    {
        if ($request->getMethod() === 'POST') {
            // basic placeholder: in future send email and store in DB
            $_SESSION['flash'] = 'Talebiniz alınmıştır. Teşekkürler!';
            header('Location: /iletisim');
            exit;
        }
        return $this->view('home/contact');
    }
}
