<?php

namespace Controllers\Admin;

use Modules\Main\BaseController;
use Modules\Main\Template;

class SettingsController extends BaseController
{
    public function index() : void
    {
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Настройки сайта');

        Template::getInstance()->includeHeader();
        $this->render('index');
        Template::getInstance()->includeFooter();
    }
}