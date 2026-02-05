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
}