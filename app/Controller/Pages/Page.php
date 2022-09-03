<?php

namespace App\Controller\Pages;

use App\Controller\Utils\View;

class Page
{

    public function getHeader()
    {
      return View::render('templat/header');
    }

    public function getFooter()
    {
      return View::render('templat/footer');
    }

    public function getPage($title, $content)
    {
        return View::render('templat/layout', [
            'title' => $title,
            'header' => $this->getHeader(),
            'content' => $content,
            'footer' => $this->getFooter(),
        ]);
    }
}