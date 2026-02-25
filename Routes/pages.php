<?php
use Modules\Main\Router;

Router::add('GET', '/', \Controllers\Pages\HomeController::class, 'index');
Router::add('GET', '/login', \Controllers\Pages\HomeController::class, 'login');
Router::add('GET', '/register', \Controllers\Pages\HomeController::class, 'register');