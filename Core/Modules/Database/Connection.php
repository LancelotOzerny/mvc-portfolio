<?php

namespace Modules\Database;

use Modules\Main\Application;

class Connection
{
    private static \PDO | null $pdo = null;

    private static function getConnect() : \PDO | null
    {
        $config = self::getDatabaseConfig();

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;',
            $config['host'],
            $config['dbname'],
        );

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        return new \PDO($dsn, $config['user'], $config['password'], $options);
    }

    private static function getDatabaseConfig() : array
    {
        $arConfig = [];

        $arConfigPath = Application::getInstance()->root . '/config/database.config.php';
        if (file_exists($arConfigPath))
        {
            $arConfig = require $arConfigPath;
        }

        return $arConfig;
    }

    public static function getPdo() : \PDO
    {
        if (!self::$pdo)
        {
            self::$pdo = self::getConnect();
        }

        return self::$pdo;
    }
}