<?php
namespace Modules\Main;

class BaseController
{
    protected function render(string $view, array $data = [])
    {
        $className = basename(static::class);
        $controllerName = str_replace('Controller', '', $className);
        $viewPath = Application::getInstance()->root . '/Views/' . $controllerName . '/' . $view . '.php';

        if (file_exists($viewPath))
        {
            include $viewPath;
            return;
        }

        echo "View '$view' not found";
    }
}