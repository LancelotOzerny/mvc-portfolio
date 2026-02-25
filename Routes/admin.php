<?php
use Modules\Main\Router;

Router::add('GET', '/admin', \Controllers\Admin\HomeController::class, 'index');
Router::add('GET', '/admin/content', \Controllers\Admin\ContentController::class, 'index');
Router::add('GET', '/admin/content/projects', \Controllers\Admin\Content\ProjectsController::class, 'list');
Router::add('GET', '/admin/content/projects/create', \Controllers\Admin\Content\ProjectsController::class, 'create');
