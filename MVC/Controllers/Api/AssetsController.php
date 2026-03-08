<?php

namespace Controllers\Api;

use Modules\Main\Application;

class AssetsController
{
    public function loadStyle()
    {
        $params = Application::getInstance()->get;

        if (!$params->has('path'))
        {
            http_response_code(400);
            exit('Invalid request');
        }

        $path = $params->get('path');

        // Проверка расширения
        if (!str_ends_with($path, '.css'))
        {
            http_response_code(400);
            exit('Only .css files are allowed');
        }

        // Безопасное формирование пути
        $safePath = ltrim($path, '/\\');
        $safePath = str_replace(['../', '..\\'], '', $safePath);

        $fullPath = Application::getInstance()->root . '/' . $safePath;

        // Проверка существования файла
        if (!file_exists($fullPath)) {
            http_response_code(404);
            exit('File not found');
        }

        // Заголовки для кэширования (1 неделя)
        $lastModified = gmdate('D, d M Y H:i:s', filemtime($fullPath)) . ' GMT';
        $etag = '"' . md5_file($fullPath) . '"';

        header('Content-Type: text/css; charset=utf-8');
        header('Last-Modified: ' . $lastModified);
        header('ETag: ' . $etag);
        header('Cache-Control: public, max-age=604800, immutable'); // 1 неделя
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 604800) . ' GMT');
        header('Vary: Accept-Encoding');

        // Проверка поддержки Gzip клиентом
        if (strpos($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip') !== false) {

            header('Content-Encoding: gzip');
            echo gzencode(file_get_contents($fullPath), 9);
        }
        else
        {
            readfile($fullPath);
        }

        exit;
    }


    public function loadScript()
    {
        $params = Application::getInstance()->get;

        if (!$params->has('path')) {
            http_response_code(400); // Bad Request
            exit('Invalid request');
        }

        $path = $params->get('path');

        // Проверка расширения
        if (!str_ends_with($path, '.js')) {
            http_response_code(400);
            exit('Only .js files are allowed');
        }

        // Безопасное формирование пути
        $safePath = ltrim($path, '/\\');
        $safePath = str_replace(['../', '..\\'], '', $safePath);

        $fullPath = Application::getInstance()->root . '/' . $safePath;

        // Проверка существования файла
        if (!file_exists($fullPath)) {
            http_response_code(404);
            exit('File not found');
        }

        // Заголовки для кэширования (1 неделя)
        $lastModified = gmdate('D, d M Y H:i:s', filemtime($fullPath)) . ' GMT';
        $etag = '"' . md5_file($fullPath) . '"';

        header('Content-Type: application/javascript; charset=utf-8');
        header('Last-Modified: ' . $lastModified);
        header('ETag: ' . $etag);
        header('Cache-Control: public, max-age=604800, immutable');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 604800) . ' GMT');
        header('Vary: Accept-Encoding');

        // Проверка поддержки Gzip клиентом
        if (strpos($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip') !== false)
        {
            header('Content-Encoding: gzip');
            echo gzencode(file_get_contents($fullPath), 9);
        }
        else
        {
            readfile($fullPath);
        }

        exit;
    }

}