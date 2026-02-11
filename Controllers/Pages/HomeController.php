<?php

namespace Controllers\Pages;

use Modules\Main\Authenticator;
use Modules\Main\BaseController;
use Modules\Main\Template;

class HomeController extends BaseController
{
    public function index(): void
    {
        Template::getInstance()->setParam('title', 'Портфолио WEB-Разработчика');

        Template::getInstance()->includeHeader();
        $this->render('index');
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