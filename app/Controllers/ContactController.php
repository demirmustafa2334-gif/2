<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Core\Security; use App\Models\Message;

final class ContactController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        return $this->render('contact/index', ['csrf'=>Security::csrfToken()], ['title'=>'İletişim | yereltanitim.com']);
    }
    public function submit(Request $r, array $p=[]): Response
    {
        $csrf = (string)$r->getPost('csrf'); if(!Security::validateCsrf($csrf)) return Response::html('Geçersiz CSRF',400);
        $name=(string)$r->getPost('name'); $email=(string)$r->getPost('email'); $message=(string)$r->getPost('message');
        Message::create($name,$email,$message);
        return Response::redirect('/iletisim');
    }
}
