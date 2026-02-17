<?php
$root = dirname(__DIR__);
require_once $root . '/Core/Autoload.php';




/* -------------------- AUTOLOAD CONTROL -------------------- */
Autoload::init();
Autoload::addNamespace('Core\\', $root . '/');
Autoload::addNamespace('Modules\\', $root . '/Core/');
Autoload::addNamespace('Models\\', $root . '/');
Autoload::addNamespace('Controllers\\', $root . '/');
Autoload::addNamespace('Repositories\\', $root . '/');
Autoload::addNamespace('Components\\', $root . '/');



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