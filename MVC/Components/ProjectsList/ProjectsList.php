<?php

namespace Components\ProjectsList;

use Models\Project;
use Modules\Main\BaseComponent;
use Repositories\ProjectRepository;

class ProjectsList extends BaseComponent
{
    protected function prepareData(array $params = []): void
    {
        $this->params['items'] = (new ProjectRepository(new Project()))->findAll();
    }
}