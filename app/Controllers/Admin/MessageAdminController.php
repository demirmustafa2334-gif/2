<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller; use App\Core\Request; use App\Core\Response; use App\Models\Message;

final class MessageAdminController extends Controller
{
    public function index(Request $r, array $p=[]): Response
    {
        if (empty($_SESSION['admin_id'])) return Response::redirect('/admin/login');
        $messages = Message::latest(100);
        return $this->render('admin/messages/index', compact('messages'), ['title'=>'Mesajlar']);
    }
}
