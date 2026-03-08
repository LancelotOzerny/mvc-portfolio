<?php

namespace Components\Navigation;

use Modules\Main\Application;
use Modules\Main\BaseComponent;
use Modules\Main\Config;

class Navigation extends BaseComponent
{
    protected function prepareData(array $params = []): void
    {
        $this->params = [];
        $this->params['type'] = $type = $params['type'] ?? 'main';
        $this->params['template'] = $params['template'] ?? 'Default';

        if (isset(Config::getInstance()->navigation[$type]) === false)
        {
            return;
        }
        $arItems = Config::getInstance()->navigation[$type];
        $this->params['items'] = $arItems;

        foreach ($this->params['items'] as &$item)
        {
            $item['is_active'] = $_SERVER['REQUEST_URI'] === $item['url'];
        }
    }
}