<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;

class Home extends Page
{
    public static function getHome()
    {
        $content = View::render('pages/home', [
            'title' => 'Home',
            'content' => 'This is the home page.'
        ]);

        return self::getPage('Home', $content);
    }
}