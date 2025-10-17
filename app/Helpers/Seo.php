<?php
declare(strict_types=1);

namespace App\Helpers;

final class Seo
{
    /** @var array<string,string> */
    private static array $stack = [
        'title' => '',
        'description' => '',
        'keywords' => '',
        'ogImage' => '',
    ];

    /** @param array{title?:string,description?:string,keywords?:string,ogImage?:string} $meta */
    public static function set(array $meta): void
    {
        foreach ($meta as $k => $v) {
            if (array_key_exists($k, self::$stack)) {
                self::$stack[$k] = (string) $v;
            }
        }
    }

    /** @return array<string,string> */
    public static function get(array $defaults = []): array
    {
        return array_merge($defaults, array_filter(self::$stack, fn($v) => $v !== ''));
    }
}
