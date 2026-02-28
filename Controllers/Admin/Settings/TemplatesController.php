<?php

namespace Controllers\Admin\settings;

use Modules\Main\BaseController;
use Modules\Main\Template;

class TemplatesController extends BaseController
{
    public function index() : void
    {
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Управление шаблонами');

        Template::getInstance()->includeHeader();
        $this->render('index');
        Template::getInstance()->includeFooter();
    }
}