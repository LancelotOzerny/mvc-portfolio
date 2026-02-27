<?php

namespace Modules\Main;

use Core\Patterns\Singleton;

class Asset
{
    use Singleton;

    private array $assets = [
        'css' => [],
        'js' => [],
    ];

    public function addStyle(string $path, array $params = [])
    {
        $this->addUniqueElement('css', $path, $params);
    }
    public function addScript(string $path, array $params = [])
    {
        $this->addUniqueElement('js', $path, $params);
    }
    private function addUniqueElement(string $assetGroup, string $path, array $params = []) : void
    {
        if (isset($assets[$assetGroup]) && in_array($path, $assets[$assetGroup]))
        {
            return;
        }

        $this->assets[$assetGroup][] = [
            'path' => str_replace(Application::getInstance()->root, '', $path),
            'params' => $params,
        ];
    }


    public function getStylesIncludes() : string
    {
        $result = '';

        foreach ($this->assets['css'] as $item)
        {
            if (isset($item['params']['is_public_dir']) && $item['params']['is_public_dir'])
            {
                $result .= '<link rel="stylesheet" href="' . $item['path'] . '">';
                continue;
            }

            $result .= '<link rel="stylesheet" href="/api/assets/styles/?path=' . $item['path'] . '">';
        }

        return $result;
    }
    public function getScriptsIncludes() : string
    {
        $result = '';

        foreach ($this->assets['js'] as $item)
        {
            $type = $item['params']['type'] ?? 'text/javascript';

            if (isset($item['params']['is_public_dir']) && $item['params']['is_public_dir'])
            {
                $result .= '<script type="' . $type . '" src="' . $item['path'] . '"></script>';
                continue;
            }

            $result .= '<script type="' . $type . '" src="/api/assets/scripts/?path=' . $item['path'] . '"></script>';
        }
        return $result;
    }
}