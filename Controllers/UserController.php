<?php
namespace Controllers;

use Models\Theme;
use Models\User;
use Modules\Orm\Repository;
use Repositories\ThemesRepository;

class UserController
{
    public function getAll()
    {
        $itemsList = new Repository(new User())->findAll();
        header('Content-Type: application/json');
        echo json_encode($itemsList);
    }

    public function getById(int $id) : void
    {
        $user = new Repository(new User())->find($id);
        header('Content-Type: application/json');
        echo json_encode($user->getFields());
    }

    public function getThemes(int $id) : void
    {
        $itemsList = new ThemesRepository(new Theme())->findByUserId($id);
        header('Content-Type: application/json');
        echo json_encode($itemsList);
    }
}