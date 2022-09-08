<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\Pages\Home;

$test = new \App\Controller\Http\Response(200, '<h1>Hello World</h1>');
$test2 = new \App\Controller\Http\Request();

echo ('<pre>');
var_dump($test);
var_dump($test2);

echo (new Home)->getHome();
