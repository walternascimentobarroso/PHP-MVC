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

$router->get('/user', [
    function ($id) {
        return (new Pages\UserController)->getAll();
    }
]);

$router->get('/user/{id}', [
    function ($id) {
        return (new Pages\UserController)->get($id);
    }
]);

$router->post('/user', [
    function ($id) {
        return (new Pages\UserController)->create();
    }
]);

$router->put('/user/{id}', [
    function ($id) {
        return (new Pages\UserController)->update($id);
    }
]);

$router->delete('/user/{id}', [
    function ($id) {
        return (new Pages\UserController)->delete($id);
    }
]);
