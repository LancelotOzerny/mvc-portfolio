<?php
$root = dirname(__DIR__);
require_once $root . '/Core/Autoload.php';

Core\Autoload::init();
Core\Autoload::addNamespace('Core\\', $root . '/');
Core\Autoload::addNamespace('Modules\\', $root . '/Core/');
Core\Autoload::addNamespace('Models\\', $root . '/');
Core\Autoload::addNamespace('Controllers\\', $root . '/');
Core\Autoload::addNamespace('Repositories\\', $root . '/');