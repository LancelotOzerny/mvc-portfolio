<?php
$fields = \Modules\Main\Application::getInstance()->post;
$files = \Modules\Main\Application::getInstance()->files;

if ($fields->has('create-project'))
{
    echo '<pre>';
    print_r([
        'fields' => $fields,
        'files' => $files
    ]);
    echo '</pre>';
}
?>

<form id="create-form" class="form" method="post" enctype="multipart/form-data">
    <div class="form__group" id="form-errors"></div>

    <!-- TITLE -->
    <div>
        <label class="form__label" for="project-title">Название</label>
        <input class="form__input" type="text" name="title" id="project-title"
               placeholder="Название проекта" value="<?= $fields->has('title') ? $fields->get('title') : '' ?>">
    </div>

    <!-- ICON -->
    <div class="mt-3">
        <label class="form__label" for="image-input">Иконка проекта</label>
        <div class="image-upload-container">
            <input type="file" id="image-input" name="image" class="image-input" accept="image/*">

            <div class="image-preview-area" id="preview-area">
                <div class="placeholder">
                    <span class="upload-text">Перетащите изображение сюда<br>или кликните для выбора</span>
                </div>
                <button type="button" class="remove-button" id="remove-button">×</button>
            </div>
        </div>
    </div>

    <!-- DESCRIPTION -->
    <div class="mt-3">
        <label class="form__label mt-3" for="project-description">Описание</label>
        <textarea class="form__textarea" id="project-description"
                  name="description"  placeholder="Описание проекта"
        ><?= $fields->has('description') ? $fields->get('description') : '' ?></textarea>
    </div>

    <!-- LINKS -->
    <div class="mt-3">
        <label class="form__label mt-3" for="project-title">Ссылки</label>

        <div class="input-list">
            <div class="input-list__template" data-name="links">
                <input class="form__input" data-name="title" type="text" placeholder="Введите название ссылки">
                <input class="form__input" data-name="url" type="text" placeholder="Введите URL">
            </div>

            <div class="input-list__titles">
                <p>URL</p>
                <p>Ссылка</p>
            </div>

            <div class="input-list__values">
            <?php
            if($fields->has('links'))
                foreach ($fields->get('links') as $key => $link): ?>
                <div class="input-list__group">
                    <input class="form__input" data-name="title" name="links[<?= $key ?>][title]"
                           type="text" placeholder="Введите название ссылки" value="<?= $link['title'] ?>">
                    <input class="form__input" data-name="url" name="links[<?= $key ?>][url]"
                           type="text" placeholder="Введите URL" value="<?= $link['url'] ?>">
                </div>
            <?php endforeach; ?>
            </div>

            <div class="input-list__control">
                <input type="button" class="btn btn--info" value="Добавить">
            </div>
        </div>
    </div>

    <!-- TAGS -->
    <div class="mt-3">
        <label class="form__label mt-3" for="project-title">Теги</label>

        <div class="input-list">
            <div class="input-list__template" data-name="tags">
                <input class="form__input" type="text" placeholder="название">
            </div>

            <div class="input-list__titles">
                <p>Название тега</p>
            </div>

            <div class="input-list__values">
                <?php
                if($fields->has('tags'))
                foreach ($fields->get('tags') as $tag): ?>
                    <div class="input-list__group">
                        <input class="form__input" name="tags[]" type="text" placeholder="название" value="<?= $tag ?>">
                        <input type="button" class="btn btn--danger square small" value="✕">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="input-list__control">
                <input type="button" class="btn btn--info" value="Добавить">
            </div>
        </div>
    </div>

    <!-- SUBMIT -->
    <div class="mt-3 flex justify-content--end">
        <button class="btn btn--success" name="create-project" type="submit">Создать</button>
    </div>

    <script src="/assets/scripts/files/ImageUploader.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new ImageUploader();
        });
    </script>
</form>

<?php
    \Modules\Main\Asset::getInstance()->addScript('/assets/scripts/projects/create.js', [
        'is_public_dir' => true,
        'type' => 'module',
    ]);
?>