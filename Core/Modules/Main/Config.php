<?php

namespace Modules\Main;

use Core\Patterns\Singleton;

class Config
{
    use Singleton;

    private array $fields = [];

    private function __construct()
    {
        $folder = Application::getInstance()->root . '/Config';

        $items = scandir($folder);
        foreach ($items as $item)
        {
            if ($item == '.' || $item == '..' || $item == 'hidden' || is_file($folder . '/' . $item))
            {
                continue;
            }

            $this->$item = $this->getConfigItems($folder . '/' . $item);;
        }
    }

    protected function getConfigItems($filePath) : array
    {
        $result = [];

        if (!file_exists($filePath))
        {
            return $result;
        }

        $items = scandir($filePath);
        foreach ($items as $item)
        {
            if (str_ends_with($item, '.config.php'))
            {
                $configDataList = include $filePath . "/$item";

                if (is_array($configDataList))
                {
                    $result[str_replace('.config.php', '', $item)] = $configDataList;
                }
            }
        }
        return $result;
    }

    public function __get(string $name) : array | null
    {
        return $this->fields[$name] ?? null;
    }

    public function __set(string $name, $value) : void
    {
        $this->fields[$name] = $value;
    }
}