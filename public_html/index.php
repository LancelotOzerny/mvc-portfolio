<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Controllers\Api\ProjectsController;
use Controllers\Api\AuthController;
use Controllers\HomeController;
use Modules\Main\Router;

/* API */
Router::add('POST', '/api/auth/register', AuthController::class, 'register');
Router::add('POST', '/api/auth/login', AuthController::class, 'login');

Router::add('GET', '/api/projects/list', ProjectsController::class, 'getList');

/* PAGES */
Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/login', HomeController::class, 'login');
Router::add('GET', '/register', HomeController::class, 'register');

Router::run();