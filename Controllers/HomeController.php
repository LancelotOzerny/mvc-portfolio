<?php

namespace Controllers;

use Modules\Main\BaseController;
use Modules\Main\Template;

class HomeController extends BaseController
{
    public function index(): void
    {
        Template::getInstance()->setParam('title', 'Портфолио WEB-Разработчика');

        Template::getInstance()->includeHeader();
        $this->render('index');
        Template::getInstance()->includeFooter();
    }
}