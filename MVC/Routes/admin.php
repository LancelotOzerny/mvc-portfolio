<?php
use Modules\Main\Router;

Router::add('GET', '/admin', \Controllers\Admin\HomeController::class, 'index');



/* ------------------------ SETTINGS ------------------------ */
Router::add('GET', '/admin/settings', \Controllers\Admin\SettingsController::class, 'index');
Router::add('GET', '/admin/settings/templates', \Controllers\Admin\settings\TemplatesController::class, 'index');




/* ------------------------ CONTENT ------------------------ */
Router::add('GET', '/admin/content', \Controllers\Admin\ContentController::class, 'index');
Router::add('GET', '/admin/content/projects', \Controllers\Admin\Content\ProjectsController::class, 'list');
Router::add('GET', '/admin/content/projects/create', \Controllers\Admin\Content\ProjectsController::class, 'create');
