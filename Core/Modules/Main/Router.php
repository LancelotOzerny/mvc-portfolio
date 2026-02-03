<?php
namespace Modules\Main;

use Controllers\ErrorsController;

class Router
{
    static private array $routes = [];

    public static function add(string $method, string $path, string $controller, string $action) : void
    {
        self::$routes[] = new RouteElement($method, $path, $controller, $action);
    }

    public static function run() : void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = $path = $_SERVER['REQUEST_URI'];

        /* Xammp error of / page */
        if ($requestUri !== '/')
        {
            $path = self::getNormalizedPath($requestUri);
        }

        foreach (self::$routes as $route)
        {
            if ($route->method === $requestMethod && self::matches($path, $route->path))
            {
                $controller = new $route->controller();
                $params = self::extractParams($path, $route->path);
                call_user_func_array([$controller, $route->action], $params);
                return;
            }
        }

        if (class_exists(ErrorsController::class))
        {
            (new ErrorsController())->page404();
        }
        else
        {
            echo 'Page 404!';
        }
    }

    private static function getNormalizedPath($requestUri) : string
    {
        $result = parse_url($requestUri, PHP_URL_PATH);
        $result = '/' . ltrim($result, '/');
        $result = preg_replace('/\/+/', '/', $result);
        $result = rtrim($result, '/');

        return $result;
    }

    private static function matches(string $path, string $route) : bool
    {
        $route = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
        return preg_match("#^{$route}$#", $path) === 1;
    }

    private static function extractParams(string $path, string $routePath) : array
    {
        preg_match_all('/\{([^}]+)\}/', $routePath, $keys);
        $routePath = preg_replace('/\{[^}]+\}/', '([^/]+)', $routePath);
        preg_match("#^{$routePath}$#", $path, $matches);

        $params = [];
        for ($i = 1; $i < count($matches); $i++)
        {
            $params[] = $matches[$i];
        }
        return $params;
    }
}