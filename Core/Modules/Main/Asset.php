<?php

namespace Modules\Main;

use Core\Patterns\Singleton;

class Asset
{
    use Singleton;

    private array $assets = [];

    public function addStyle(string $path, bool $isPublicDir = false)
    {
        $this->addUniqueElement($path, $isPublicDir, 'css');
    }
    public function addScript(string $path, bool $isPublicDir = false)
    {
        $this->addUniqueElement($path, $isPublicDir, 'js');
    }
    private function addUniqueElement(string $path, bool $isPublicDir, string $assetGroup) : void
    {
        if (isset($assets[$assetGroup]) && in_array($path, $assets[$assetGroup]))
        {
            return;
        }

        $this->assets[$assetGroup][] = [
            'path' => str_replace(Application::getInstance()->root, '', $path),
            'is_public' => $isPublicDir,
        ];
    }


    public function getStylesIncludes() : string
    {
        $result = '';

        foreach ($this->assets['css'] as $item)
        {
            if ($item['is_public'])
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
            if ($item['is_public'])
            {
                $result .= '<link rel="stylesheet" href="' . $item['path'] . '">';
                continue;
            }

            $result .= '<script type="text/javascript" src="/api/assets/scripts/?path=' . $item['path'] . '"></script>';
        }

        return $result;
    }
}