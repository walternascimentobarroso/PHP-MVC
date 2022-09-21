<?php

require __DIR__ . '/../vendor/autoload.php';

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__ . '/../.env');

include __DIR__ . '/../routes/pages.php';

$router->run()->sendResponse();
