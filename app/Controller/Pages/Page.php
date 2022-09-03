<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;

class Page
{

    public static function getHeader()
    {
      return View::render('pages/header');
    }

    public static function getFooter()
    {
      return View::render('pages/footer');
    }

    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter(),
        ]);
    }
}