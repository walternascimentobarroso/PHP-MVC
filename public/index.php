<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\Http\Router;
use App\Controller\Utils\View;

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . '/../.env');

define('URL', 'http://localhost');

View::init([
    'URL' => URL
]);

$router = new Router(URL);

// $router->get('/', ['controller' => 'Home', 'action' => 'index']);
include __DIR__ . '/../routes/pages.php';


$router->run()->sendResponse();
