<?php

namespace Controllers\Admin;

use Modules\Main\BaseController;
use Modules\Main\Template;

class HomeController extends BaseController
{
    public function index() : void
    {
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Добро пожаловать в административную панель!');

        Template::getInstance()->includeHeader();
        $this->render('index');
        Template::getInstance()->includeFooter();
    }
}