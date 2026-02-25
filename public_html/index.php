<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/Core/bootstrap.php';

use Modules\Main\Router;

/** SYSTEM  */
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/api.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/admin.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/pages.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '../Routes/rights.php';

$content = ob_start();
Router::run();
$content = ob_get_clean();

/* PREPARE PAGE */
$additionalStyles = \Modules\Main\Asset::getInstance()->getStylesIncludes();
$additionalScripts = \Modules\Main\Asset::getInstance()->getScriptsIncludes();


$content = str_replace('</head>', $additionalStyles . '</head>', $content);
$content = str_replace('</body>', $additionalScripts . '</body>', $content);


echo $content;