<?php
    use Core\Modules\Main\Template;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title>WEB Project</title>

    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="page">
<div class="admin-panel">
    <div class="sidebar">
        <div class="sidebar__title">Навигация</div>

        <?php
        (new \Components\Navigation\Navigation([
                'template' => 'AdminSide',
                'type' => 'admin'
        ]))->render();
        ?>
    </div>

    <div class="admin-panel__content">
        <header>
            <div class="page-title__wrapper">
                <p class="page-title page-title--small text--weight-2"><?= $this->getParam('title') ?></p>
            </div><a class="btn btn--info btn--large" href="/">Перейти на сайт</a>
        </header>
        <div class="admin-panel__inner">