<?php

namespace Controllers;

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
        Template::getInstance()->setParam('title', 'Авторизация');

        Template::getInstance()->includeHeader();
        $this->render('login');
        Template::getInstance()->includeFooter();
    }

    public function register()
    {
        Template::getInstance()->setParam('title', 'Регистрация');

        Template::getInstance()->includeHeader();
        $this->render('register');
        Template::getInstance()->includeFooter();
    }
}