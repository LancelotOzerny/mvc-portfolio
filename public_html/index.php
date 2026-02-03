<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Controllers\Api\AuthController;
use Controllers\HomeController;
use Modules\Main\Router;

/* API */
Router::add('POST', '/api/auth/register', AuthController::class, 'register');
Router::add('POST', '/api/auth/login', AuthController::class, 'login');

Router::add('GET', '/', HomeController::class, 'index');

Router::run();