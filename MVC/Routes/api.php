<?php
use Modules\Main\Router;

Router::add('GET', '/api/assets/styles', \Controllers\Api\AssetsController::class, 'loadStyle');
Router::add('GET', '/api/assets/scripts', \Controllers\Api\AssetsController::class, 'loadScript');

Router::add('POST', '/api/auth/register', Controllers\Api\AuthController::class, 'register');
Router::add('POST', '/api/auth/login', Controllers\Api\AuthController::class, 'login');
Router::add('POST', '/api/feedback/send', Controllers\Api\FeedbackController::class, 'send');
Router::add('GET', '/api/auth/logout', Controllers\Api\AuthController::class, 'logout');

Router::add('GET', '/api/projects/list', Controllers\Api\ProjectsController::class, 'getList');
Router::add('POST', '/api/projects/create', Controllers\Api\ProjectsController::class, 'create');
Router::add('DELETE', '/api/projects/delete/{id}', Controllers\Api\ProjectsController::class, 'delete');