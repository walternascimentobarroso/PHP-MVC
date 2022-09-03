<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;
use App\Model\Entity\User;

class Home extends Page
{
    public static function getHome()
    {
        $user = new User();
        $content = View::render('pages/home', [
            'title' => $user->name,
            'content' => 'This is the home page.'
        ]);

        return self::getPage('Home', $content);
    }
}