<?php
namespace App\Controllers;

use Core\Controller;
use Core\CSRF;
use Core\Mailer;
use App\Models\Setting;

class ContactController extends Controller
{
    public function form(): void
    {
        $meta = [
            'title' => 'İletişim | Teklif Al',
            'description' => 'İstanbul içi taşıma için hızlı teklif formu',
        ];
        $this->view->render('contact/form', compact('meta'));
    }

    public function submit(): void
    {
        if (!isset($_POST['_token']) || !\Core\CSRF::verify($_POST['_token'])) {
            http_response_code(422);
            echo 'Geçersiz istek';
            return;
        }
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $message = trim($_POST['message'] ?? '');
        if ($name === '' || $phone === '') {
            http_response_code(422);
            echo 'Ad ve telefon zorunlu';
            return;
        }
        $to = (new Setting())->get('contact_email', 'admin@example.com');
        $ok = Mailer::send($to, 'Yeni Teklif Talebi', nl2br(htmlentities("Ad: $name\nTelefon: $phone\nMesaj: $message")));
        if ($ok) {
            header('Location: /contact?sent=1');
        } else {
            http_response_code(500);
            echo 'Gönderim hatası';
        }
    }
}
