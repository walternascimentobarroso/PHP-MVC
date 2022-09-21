<?php

use App\Controller\Pages;

use App\Controller\Http\Router;

$router = new Router();

$router->get('/', [
    function () {
        return (new Pages\Home)->getHome();
    }
]);

$router->get('/about', [
    function () {
        return (new Pages\About)->getAbout();
    }
]);

$router->get('/pagina/{id}', [
    function ($id) {
        return '10 ' . $id;
    }
]);

// Route::get('/user', [UserController::class, 'index']);

$router->get('/user', [
    function () {
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
