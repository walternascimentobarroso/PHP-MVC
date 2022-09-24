<?php

use App\Controller\Pages;
use App\Controller\Http\Router;

Router::get('/', [Pages\Home::class, 'getHome']);
Router::get('/about', [Pages\About::class, 'getAbout']);

Router::get('/user', [Pages\UserController::class, 'getAll']);
Router::get('/user/{id}', [Pages\UserController::class, 'get']);
Router::post('/user', [Pages\UserController::class, 'create']);
Router::put('/user/{id}', [Pages\UserController::class, 'update']);
Router::delete('/user/{id}', [Pages\UserController::class, 'delete']);
