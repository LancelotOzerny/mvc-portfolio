<?php
use Modules\Main\Router;

Router::add('POST', '/api/auth/register', Controllers\Api\AuthController::class, 'register');
Router::add('POST', '/api/auth/login', Controllers\Api\AuthController::class, 'login');
Router::add('POST', '/api/feedback/send', Controllers\Api\FeedbackController::class, 'send');
Router::add('GET', '/api/auth/logout', Controllers\Api\AuthController::class, 'logout');
Router::add('GET', '/api/projects/list', Controllers\Api\ProjectsController::class, 'getList');