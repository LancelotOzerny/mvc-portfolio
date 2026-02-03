<?php
namespace Modules\Main;

use Core\Patterns\Singleton;

class Template
{
    use Singleton;

    public string $template = 'default';
    public readonly string $templateFolderPath;
    public array $params = [];


    public function __construct(?string $templateFolderPath = null)
    {
        $this->templateFolderPath = $templateFolderPath ?? Application::getInstance()->root . '/Views/Templates';
    }

    public function setParam(string $key, $value): void
    {
        $this->params[$key] = $value;
    }

    public function getParam(string $key)
    {
        return $this->params[$key] ?? null;
    }

    public function includeHeader() : void
    {
        $filePath = "$this->templateFolderPath/$this->template/header.php";

        if (!file_exists($filePath))
        {
            echo "Header of template '$this->template' is not founded!";
            return;
        }

        include $filePath;
    }

    public function includeFooter() : void
    {
        $filePath = "$this->templateFolderPath/$this->template/footer.php";

        if (!file_exists($filePath))
        {
            echo "Footer of template '$this->template' is not founded!";
            return;
        }

        include $filePath;
    }
}