<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Modules\Main\Router;

/** SYSTEM  */
Router::add('GET', '/api/loader', \Controllers\Api\LoaderController::class, 'load');
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/api.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/admin.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/pages.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/rights.php';

Router::run();