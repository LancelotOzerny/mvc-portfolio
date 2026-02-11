<?php

namespace Controllers\Admin\Content;

use Modules\Main\BaseController;
use Modules\Main\Template;

class ProjectsController extends BaseController
{
    public function list(): void
    {
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Управление проектами');

        Template::getInstance()->includeHeader();
        $this->render('list');
        Template::getInstance()->includeFooter();
    }

    public function create() : void
    {
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Создание проекта');

        Template::getInstance()->includeHeader();
        $this->render('create');
        Template::getInstance()->includeFooter();
    }
}