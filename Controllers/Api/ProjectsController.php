<?php

namespace Controllers\Api;

use Models\Link;
use Models\Project;
use Models\Tag;
use Modules\FileManager\FileUploader;
use Modules\Main\Application;
use Modules\Orm\Repository;
use Modules\Validator\FileValidator;
use Repositories\ProjectRepository;

class ProjectsController
{
    public function getList() : void
    {
        $itemsList = (new ProjectRepository(new Project()))->findAll();
        header('Content-Type: application/json');
        echo json_encode($itemsList);
    }

    public function create() : void
    {
        $project = new Project();
        $files = Application::getInstance()->files;
        $post = Application::getInstance()->post;
        $data = [
            'status' => 'failure',
            'errors' => []
        ];

        /* --------------------------------------------------------------- */
        /* ------------------------ SAVE TITLE -------------------------- */
        /* ------------------------------------------------------------- */
        $title = $post->has('title') ? $post->get('title') : null;
        if ($title)
        {
            $project->title = $title;
        }
        else
        {
            $data['errors'][] = 'Отсутствует название проекта.';
        }

        /* -------------------------------------------------------------------- */
        /* ------------------------ SAVE PREVIEW TEXT ------------------------ */
        /* ------------------------------------------------------------------ */
        $description = $post->has('description') ? $post->get('description') : null;
        if ($description)
        {
            $project->preview_text = $description;
        }
        else
        {
            $data['errors'][] = 'Отсутствует описание проекта.';
        }

        /* --------------------------------------------------------------- */
        /* ------------------------ SAVE IMAGE -------------------------- */
        /* ------------------------------------------------------------- */
        $uploader = new FileUploader();
        $validator = new FileValidator(
            allowedMimeTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'],
            maxSize: 5 * 1024 * 1024 // 5 МБ
        );
        $uploadedFile = $files->has('image') ? $files->get('image') : [];

        if (!empty($uploadedFile))
        {
            $uniqueFilename = $uploader->generateUniqueFilename($uploadedFile['name']);
            $destinationPath = Application::getInstance()->root . '/public_html/upload/images/projects/' . $uniqueFilename;

            $uploadDir = dirname($destinationPath);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $result = $uploader->saveImage($uploadedFile, $destinationPath, $validator);

            if (count($result['errors']))
            {
                $data['errors'] = array_merge($result['errors'], $data['errors']);
            }
            else
            {
                $project->icon_src = '/upload/images/projects/' . $uniqueFilename;
            }
        }


        /* ----------------------------------------------------------------- */
        /* ------------------------ PROJECT SAVE -------------------------- */
        /* --------------------------------------------------------------- */

        if (empty($data['errors']))
        {
            $data['status'] = 'success';

            $repos = new Repository($project);
            $repos->create();
        }

        if (empty($data['errors']) && is_null($project->id))
        {
            $data['errors'][] = 'Ошибка при создании проекта';
        }
        else
        {
            /* CREATE TAGS */
            if ($post->has('tags'))
                foreach ($post->get('tags') as $tagTitle)
                {
                    $tag = new Tag();
                    $tag->project_id = $project->id;
                    $tag->title = $tagTitle;

                    (new Repository($tag))->create();
                }


            /* CREATE LINKS */
            if ($post->has('links'))
                foreach ($post->get('links') as $linkInfo)
                {
                    $link = new Link();
                    $link->project_id = $project->id;
                    $link->title = $linkInfo['title'];
                    $link->url = $linkInfo['url'];

                    (new Repository($link))->create();
                }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}