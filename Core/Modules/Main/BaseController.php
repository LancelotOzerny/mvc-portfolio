<?php
namespace Modules\Main;

class BaseController
{
    protected function render(string $view, array $data = [])
    {
        $className = basename(static::class);
        $withoutPrefix = preg_replace('~^Controllers\\\\~', '', $className);
        $controllerName = preg_replace('~Controller$~', '', $withoutPrefix);
        $viewPath = Application::getInstance()->root . '/Views/' . $controllerName . '/' . $view . '.php';
        $viewPath = str_replace('\\', '/', $viewPath);

        if (file_exists($viewPath))
        {
            include $viewPath;
            return;
        }

        echo "View '$view' not found";
    }
}