<?php

use App\Controller\Http\Response;
use App\Controller\Pages;

$router->get('/', [
    function () {
        return new Response(200, (new Pages\Home)->getHome());
    }
]);

$router->get('/about', [
    function () {
        return new Response(200, (new Pages\About)->getAbout());
    }
]);

$router->get('/pagina/{id}', [
    function ($id) {
        return new Response(200, '10 ' . $id);
    }
]);
