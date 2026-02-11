<div class="form">
    <div class="form__group--flex">
        <div class="form__group">
            <div>
                <label class="form__label" for="project-title">Название</label>
                <input class="form__input" type="text" name="project-title" id="project-title" placeholder="Название проекта">
            </div>

            <div class="mt-3">
                <label class="form__label mt-3" for="project-description">Описание</label>
                <textarea class="form__textarea" name="project-description" id="project-description" placeholder="Описание проекта"></textarea>
            </div>

            <div class="mt-3">
                <label class="form__label mt-3" for="project-title">Теги проекта</label>
                <div class="tags">
                    <input type="text" class="form__input" placeholder="tag">
                </div>

                <div class="control flex justify-content--end">
                    <div class="btn btn--info mt-3">Добавить</div>
                </div>
            </div>

            <div class="mt-3">
                <label class="form__label mt-3" for="project-title">Ссылки проекта</label>
                <div class="links">
                    <div class="flex">
                        <input type="text" class="form__input" style="margin-right: 25px; width: 45%" placeholder="Название">
                        <input type="text" class="form__input" placeholder="Адрес">
                    </div>
                </div>

                <div class="control flex justify-content--end">
                    <div class="btn btn--info mt-3">Добавить</div>
                </div>
            </div>
        </div>

        <div class="form__group" style="display: inline-flex; width: min-content">
            <label class="form__label">Иконка проекта</label>
            <div class="image-upload-container">
                <input type="file" id="image-input" class="image-input" accept="image/*">

                <div class="image-preview-area" id="preview-area">
                    <div class="placeholder">
                        <span class="upload-text">Перетащите изображение сюда<br>или кликните для выбора</span>
                    </div>
                    <button type="button" class="remove-button" id="remove-button">×</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/scripts/files/ImageUploader.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new ImageUploader();
        });
    </script>
</div>