<?php

namespace Controllers\Admin\Content;

use Components\ProjectsList\ProjectsList;
use Models\Project;
use Modules\Main\BaseController;
use Modules\Main\Template;
use Modules\Orm\Repository;

class ProjectsController extends BaseController
{
    public function list(): void
    {
        /* SETTINGS */
        Template::getInstance()->template = 'Admin';
        Template::getInstance()->setParam('title', 'Управление проектами');


        /* DATA */
        $data = [];

        // Projects List
        $projectInfoList = (new Repository(new Project()))->findAll();
        $componentProjectsList = new ProjectsList([
            'projects' => $projectInfoList
        ]);
        $componentProjectsList->setParam('template', 'Admin');
        $data['components']['ProjectsList'] = $componentProjectsList;


        /* RENDER*/
        Template::getInstance()->includeHeader();
        $this->render('list', $data);
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