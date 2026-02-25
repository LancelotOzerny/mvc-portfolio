<?php

namespace Repositories;

use Modules\Orm\Entity;
use Modules\Orm\Repository;

class ProjectRepository extends Repository
{
    public function findAll(): ?array
    {
        $projectsTable = $this->model->getTableName();

        $this->queryBuilder
            ->select([
                "{$projectsTable}.id            AS project_id",
                "{$projectsTable}.title         AS project_title",
                "{$projectsTable}.icon_src      AS project_icon_src",
                "{$projectsTable}.preview_text  AS project_preview_text",
                "{$projectsTable}.created_at    AS project_created_at",

                // поля ссылок
                "links.id                       AS link_id",
                "links.title                    AS link_title",
                "links.url                      AS link_url",

                // поля тегов
                "tags.id                        AS tag_id",
                "tags.title                     AS tag_title",
            ])
            ->from($projectsTable)
            ->leftJoin('links', "{$projectsTable}.id = links.project_id")
            ->leftJoin('tags',  "{$projectsTable}.id = tags.project_id")
            ->orderBy([
                "{$projectsTable}.id ASC",
                "links.id ASC",
                "tags.id ASC",
            ]);

        $stmt = $this->executeQuery($this->queryBuilder);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!$rows)
        {
            return [];
        }

        $result = [];

        foreach ($rows as $row)
        {
            $projectId = (int)$row['project_id'];

            // если проект ещё не добавлен — создаём базовую структуру
            if (!isset($result[$projectId]))
            {
                $result[$projectId] = [
                    'id'          => $projectId,
                    'title'       => $row['project_title'],
                    'icon_src'    => $row['project_icon_src'],
                    'preview_text'=> $row['project_preview_text'],
                    'created_at'  => $row['project_created_at'],
                    'links'       => [],
                    'tags'        => [],
                ];
            }

            // ссылка
            if (!empty($row['link_id']))
            {
                $linkId = (int)$row['link_id'];

                if (!isset($result[$projectId]['links'][$linkId]))
                {
                    $result[$projectId]['links'][$linkId] = [
                        'url'        => $row['link_url'],
                        'title'      => $row['link_title'],
                        'project_id' => $projectId,
                    ];
                }
            }

            if (!empty($row['tag_id']) && $row['tag_title'] !== null)
            {
                $tagTitle = $row['tag_title'];

                if (!in_array($tagTitle, $result[$projectId]['tags'], true))
                {
                    $result[$projectId]['tags'][] = $tagTitle;
                }
            }
        }

        return array_values($result);
    }
}
