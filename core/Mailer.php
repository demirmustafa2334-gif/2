<?php
namespace Core;

class Mailer
{
    public static function send(string $to, string $subject, string $html): bool
    {
        $headers = "MIME-Version: 1.0\r\n" .
                   "Content-type:text/html;charset=UTF-8\r\n" .
                   "From: no-reply@localhost\r\n";
        return @mail($to, $subject, $html, $headers);
    }
}
