<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Controllers\ThemeController;
use Controllers\UserController;
use Modules\Api\Router;

Router::add('GET', '/users', UserController::class, 'getAll');
Router::add('GET', '/users/{id}', UserController::class, 'getById');
Router::add('GET', '/users/{id}/themes', UserController::class, 'getThemes');

Router::add('GET', '/themes', ThemeController::class, 'getAll');
Router::add('DELETE', '/themes/{id}', ThemeController::class, 'delete');

Router::run();