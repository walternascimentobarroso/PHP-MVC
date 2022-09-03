<?php

namespace App\Controller\Utils;

class View
{
    public static function getContentView($template)
    {
        $file = __DIR__ . '/../../View/' . $template . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function render($template, $data = [])
    {
        $contentView = self::getContentView($template);
        $keys = array_keys($data);

        $keys = array_map(function ($key) {
            return '{{' . $key . '}}';
        }, $keys);

        return str_replace($keys, array_values($data), $contentView);
    }
}
