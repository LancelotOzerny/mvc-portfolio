<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Controllers\Api\AuthController;
use Controllers\Api\UserController;
use Modules\Api\Router;


/* API */
Router::add('POST', '/api/auth/register', AuthController::class, 'register');
Router::add('POST', '/api/auth/login', AuthController::class, 'login');

Router::run();