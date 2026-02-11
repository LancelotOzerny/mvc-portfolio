<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Modules\Main\Router;

/* API */
Router::add('POST', '/api/auth/register', Controllers\Api\AuthController::class, 'register');
Router::add('POST', '/api/auth/login', Controllers\Api\AuthController::class, 'login');
Router::add('GET', '/api/projects/list', \Controllers\Api\ProjectsController::class, 'getList');


/* ADMIN */
Router::add('GET', '/admin', \Controllers\Admin\HomeController::class, 'index');
Router::add('GET', '/admin/content', \Controllers\Admin\ContentController::class, 'index');
Router::add('GET', '/admin/content/projects', \Controllers\Admin\Content\ProjectsController::class, 'list');
Router::add('GET', '/admin/content/projects/create', \Controllers\Admin\Content\ProjectsController::class, 'create');


/* PAGES */
Router::add('GET', '/', \Controllers\Pages\HomeController::class, 'index');
Router::add('GET', '/login', \Controllers\Pages\HomeController::class, 'login');
Router::add('GET', '/register', \Controllers\Pages\HomeController::class, 'register');

Router::run();