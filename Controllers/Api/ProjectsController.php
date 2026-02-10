<?php

namespace Controllers\Api;

use Models\User;
use Modules\Orm\Repository;

class ProjectsController
{
    public function getList() : void
    {
        $itemsList = $this->getItemsList();
        header('Content-Type: application/json');
        echo json_encode($itemsList);
    }

    private function getItemsList() : array
    {
        return
        [
            [
                'id' => 1,
                'title' => 'Project 1',
                'icon_src' => '/assets/images/project_icon.png.png',
                'description' => 'Unity Developer Toolkit (UDT)- это набор инструментов для Unity разработчика который поможет ускорить процесс разработки через набор готовых скриптов, префабов и спрайтов. Теперь можно в пару нажатий обрабатывать столкновения, создавать счетчик, кошелек персонажа и другое.',
                'links' => [
                    1 => [
                        'href' => '#anchor-projects',
                        'title' => 'Git',
                        'project_id' => 1
                    ],
                    2 => [
                        'href' => '#anchor-projects',
                        'title' => 'Demo',
                        'project_id' => 1
                    ],
                ],
                'tags' => ['Unity', 'C#', 'Git'],
            ],
            [
                'id' => 2,
                'title' => 'Project 2',
                'icon_src' => '/assets/images/project_icon.png.png',
                'description' => 'Unity Developer Toolkit (UDT)- это набор инструментов для Unity разработчика который поможет ускорить процесс разработки через набор готовых скриптов, префабов и спрайтов. Теперь можно в пару нажатий обрабатывать столкновения, создавать счетчик, кошелек персонажа и другое.',
                'links' => [
                    1 => [
                        'href' => '#anchor-projects',
                        'title' => 'Git',
                        'project_id' => 1
                    ],
                    2 => [
                        'href' => '#anchor-projects',
                        'title' => 'Demo',
                        'project_id' => 1
                    ],
                ],
                'tags' => ['Unity', 'C#', 'Git'],
            ],
        ];
    }
}