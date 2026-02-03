<?php

namespace Controllers;

use Modules\Main\BaseController;
use Modules\Main\Template;

class ErrorsController extends BaseController
{
    public function page404()
    {
        Template::getInstance()->setParam('title', 'Страница 404');

        Template::getInstance()->includeHeader();
        $this->render('404');
        Template::getInstance()->includeFooter();
    }
}