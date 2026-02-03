<?php
namespace Controllers\Api;

use Models\User;
use Modules\Main\BaseController;
use Modules\Orm\Repository;

class UserController extends BaseController
{
    public function getList()
    {
        $itemsList = new Repository(new User())->findAll();
        header('Content-Type: application/json');
        echo json_encode($itemsList);
    }

    public function findById($id) : void
    {
        $item = new Repository(new User())->findById($id);
        header('Content-Type: application/json');
        echo json_encode($item);
    }
}