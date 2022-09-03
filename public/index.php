<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controller\Pages\Home;

echo (new Home)->getHome();
