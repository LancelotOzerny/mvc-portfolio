<?php
/** @param \Modules\Main\BaseController $this */
/** @var array $data */
?>

<div class="flex justify-content--between align-items--center mb-5">
    <a href="/admin/content/projects/create/" class="btn btn--info btn--blue">Создать проект</a>
    <div class="search-box">
        <input type="text" placeholder="Поиск по проектам..." class="form__input">
    </div>
</div>

<?php
$data['components']['ProjectsList']->render();
?>