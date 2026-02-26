<div class="form">
    <div class="form__group">
        <div>
            <label class="form__label" for="project-title">Название</label>
            <input class="form__input" type="text" name="project-title" id="project-title" placeholder="Название проекта">
        </div>

        <div class="mt-3">
            <label class="form__label" for="image-input">Иконка проекта</label>
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

        <div class="mt-3">
            <label class="form__label mt-3" for="project-description">Описание</label>
            <textarea class="form__textarea" name="project-description" id="project-description" placeholder="Описание проекта"></textarea>
        </div>

        <div class="mt-3">
            <label class="form__label mt-3" for="project-title">Ссылки</label>

            <div class="input-list">
                <div class="input-list__template">
                    <input class="form__input" type="text" placeholder="Введите URL">
                    <input class="form__input" type="text" placeholder="Введите ссылку">
                </div>

                <div class="input-list__titles">
                    <p>URL</p>
                    <p>Ссылка</p>
                </div>

                <div class="input-list__values">
                    <div class="input-list__group"></div>
                </div>

                <div class="input-list__control">
                    <input type="button" class="btn btn--info" value="Добавить">
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label class="form__label mt-3" for="project-title">Теги</label>

            <div class="input-list">
                <div class="input-list__template">
                    <input class="form__input" type="text" placeholder="#тег">
                </div>

                <div class="input-list__titles">
                    <p>URL</p>
                    <p>Ссылка</p>
                </div>

                <div class="input-list__values">
                    <div class="input-list__group"></div>
                </div>

                <div class="input-list__control">
                    <input type="button" class="btn btn--info" value="Добавить">
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