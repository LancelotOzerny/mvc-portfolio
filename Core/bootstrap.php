<?php

$root = dirname(__DIR__);
require_once $root . '/Core/Autoload.php';

session_start();

Autoload::init();
Autoload::addNamespace('Core\\', $root . '/');
Autoload::addNamespace('Modules\\', $root . '/Core/');
Autoload::addNamespace('Models\\', $root . '/');
Autoload::addNamespace('Controllers\\', $root . '/');
Autoload::addNamespace('Repositories\\', $root . '/');
Autoload::addNamespace('Components\\', $root . '/Views/');