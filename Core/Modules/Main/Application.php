<?php
namespace Modules\Main;

use Core\Patterns\Singleton;

class Application
{
    use Singleton;

    public readonly string $root;

    private function __construct()
    {
        $this->root = dirname($_SERVER['DOCUMENT_ROOT']);
    }
}