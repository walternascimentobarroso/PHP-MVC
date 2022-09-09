<?php

namespace App\Controller\Utils;

class View
{
    private static $vars = [];

    public static function init($vars = [])
    {
        self::$vars = $vars;
    }

    public static function getContentView($template)
    {
        $file = __DIR__ . '/../../View/' . $template . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public static function render($template, $vars = [])
    {
        $contentView = self::getContentView($template);
        $vars = array_merge(self::$vars, $vars);
        $keys = array_keys($vars);

        $keys = array_map(function ($key) {
            return '{{' . $key . '}}';
        }, $keys);

        return str_replace($keys, array_values($vars), $contentView);
    }
}
