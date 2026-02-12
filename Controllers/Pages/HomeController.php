<?php

namespace Controllers\Pages;

use Components\ProjectsList\ProjectsList;
use Models\Project;
use Modules\Main\Authenticator;
use Modules\Main\BaseController;
use Modules\Main\Template;
use Modules\Orm\Repository;

class HomeController extends BaseController
{
    public function index(): void
    {
        /* SETTINGS */
        Template::getInstance()->setParam('title', 'Портфолио WEB-Разработчика');


        /* DATA */
        $data = [];

        $projectInfoList = (new Repository(new Project()))->findAll();
        $data['components']['ProjectsList'] = new ProjectsList($projectInfoList);


        /* RENDER */
        Template::getInstance()->includeHeader();
        $this->render('index', $data);
        Template::getInstance()->includeFooter();
    }

    public function login(): void
    {
        if (Authenticator::isAuthorized())
        {
            header('Location: /');
            exit;
        }

        Template::getInstance()->setParam('title', 'Авторизация');

        Template::getInstance()->includeHeader();
        $this->render('login');
        Template::getInstance()->includeFooter();
    }

    public function register()
    {
        if (Authenticator::isAuthorized())
        {
            header('Location: /');
            exit;
        }

        Template::getInstance()->setParam('title', 'Регистрация');

        Template::getInstance()->includeHeader();
        $this->render('register');
        Template::getInstance()->includeFooter();
    }
}