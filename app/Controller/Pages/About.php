<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;
use App\Controller\Http\Response;

class About extends Page
{
    public function getAbout()
    {
        $content = View::render('pages/about', [
            'title' => 'Sobre',
            'content' => 'This is the About page.'
        ]);

        return new Response(200, self::getPage('About', $content));
    }
}
