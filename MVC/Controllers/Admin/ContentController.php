<?php

namespace Controllers\Admin;

use Modules\Main\BaseController;
use Modules\Main\Template;

class ContentController extends BaseController
{
    public function index() : void
    {
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Управление контентом');

        Template::getInstance()->includeHeader();
        $this->render('index');
        Template::getInstance()->includeFooter();
    }
}