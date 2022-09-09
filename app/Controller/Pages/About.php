<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;
use App\Model\User;

class About extends Page
{
    public function getAbout()
    {
        $user = new User();
        $content = View::render('pages/about', [
            'title' => $user->name,
            'content' => 'This is the About page.'
        ]);

        return self::getPage('About', $content);
    }
}
