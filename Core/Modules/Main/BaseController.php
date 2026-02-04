<?php
namespace Modules\Main;

class BaseController
{
    protected function render(string $view, array $data = [])
    {
        $className = basename(static::class);
        $controllerName = preg_replace('#^.*[\\\/]([^\\\/]+)Controller$#', '$1', $className);
        $viewPath = Application::getInstance()->root . '/Views/' . $controllerName . '/' . $view . '.php';

        if (file_exists($viewPath))
        {
            include $viewPath;
            return;
        }

        echo "View '$view' not found";
    }
}