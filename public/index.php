<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\Http\Router;

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . '/../.env');

$router = new Router();

include __DIR__ . '/../routes/pages.php';

$router->run()->sendResponse();
