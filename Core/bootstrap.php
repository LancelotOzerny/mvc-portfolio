<?php
$root = dirname(__DIR__);
require_once $root . '/Core/Autoload.php';




/* -------------------- AUTOLOAD CONTROL -------------------- */
Autoload::init();
Autoload::addNamespace('Core\\', $root . '/');
Autoload::addNamespace('Modules\\', $root . '/Core/');
Autoload::addNamespace('Models\\', $root . '/MVC/');
Autoload::addNamespace('Controllers\\', $root . '/MVC/');
Autoload::addNamespace('Repositories\\', $root . '/MVC/');
Autoload::addNamespace('Components\\', $root . '/MVC/');



/* -------------------- SESSION TIME CONTROL -------------------- */
session_start();
if (isset($_SESSION['login_time']))
{
    if (time() - $_SESSION['login_time'] >= 60 * 45)
    {
        \Modules\Main\Authenticator::logout();
    }
    else
    {
        $_SESSION['login_time'] = time();
    }
}