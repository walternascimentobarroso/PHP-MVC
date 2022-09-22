<?php

use App\Controller\Pages;

$router = new App\Controller\Http\Router();

$router->get('/', [Pages\Home::class, 'getHome']);
$router->get('/about', [Pages\About::class, 'getAbout']);

$router->get('/user', [Pages\UserController::class, 'getAll']);
$router->get('/user/{id}', [Pages\UserController::class, 'get']);
$router->post('/user', [Pages\UserController::class, 'create']);
$router->put('/user/{id}', [Pages\UserController::class, 'update']);
$router->delete('/user/{id}', [Pages\UserController::class, 'delete']);
