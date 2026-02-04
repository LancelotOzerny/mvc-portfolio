<?php
namespace Controllers\Api;

use Models\User;
use Modules\Main\Authenticator;
use Modules\Main\BaseController;
use Repositories\UserRepository;

class UserController extends BaseController
{
    public function getList()
    {
        $itemsList = new UserRepository(new User())->findAll();
        header('Content-Type: application/json');
        echo json_encode($itemsList);
    }

    public function findById($id) : void
    {
        $item = new UserRepository(new User())->findById($id);
        header('Content-Type: application/json');
        echo json_encode($item);
    }
}