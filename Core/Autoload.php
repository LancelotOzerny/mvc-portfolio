<?php

class Autoload
{
    private static array $namespaces = [];

    public static function loadClass($className)
    {
        foreach (self::$namespaces as $namespace => $path)
        {
            if (str_starts_with($className, $namespace))
            {
                $classPath = str_replace('\\', '/', $path . $className . '.php');

                if (file_exists($classPath))
                {
                    include_once ($classPath);
                }
            }
        }
    }

    public static function addNamespace($namespace, $path)
    {
        self::$namespaces[$namespace] = $path;
    }

    static function init()
    {
        spl_autoload_register(Autoload::class . '::loadClass');
    }
}