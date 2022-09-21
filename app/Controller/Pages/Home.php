<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;
use App\Controller\Http\Response;

class Home extends Page
{
    public function getHome()
    {
        $content = View::render('pages/home', [
            'title' => 'Home',
            'content' => 'This is the home page.'
        ]);

        return new Response(200, self::getPage('Home', $content));
    }
}
