"use strict";
var ImageUploader = /** @class */ (function () {
    function ImageUploader() {
        this.input = document.getElementById('image-input');
        this.previewArea = document.getElementById('preview-area');
        this.removeButton = document.getElementById('remove-button');
        this.placeholder = this.previewArea.querySelector('.placeholder');
        this.init();
    }
    ImageUploader.prototype.init = function () {
        var _this = this;
        // Клик по зоне → открытие диалога выбора файла
        this.previewArea.addEventListener('click', function () {
            if (!_this.previewArea.querySelector('img')) {
                _this.input.click();
            }
        });
        // Выбор файла через input
        this.input.addEventListener('change', function (e) {
            var _a;
            var file = (_a = e.target.files) === null || _a === void 0 ? void 0 : _a[0];
            if (file) {
                _this.handleFile(file);
            }
        });
        // Перетаскивание: визуальная обратная связь
        ['dragover', 'dragenter'].forEach(function (evt) {
            _this.previewArea.addEventListener(evt, function (e) {
                e.preventDefault();
                _this.previewArea.style.borderColor = '#00bcd4';
            });
        });
        ['dragleave', 'dragend', 'drop'].forEach(function (evt) {
            _this.previewArea.addEventListener(evt, function () {
                _this.previewArea.style.borderColor = '#ccc';
            });
        });
        // Обработка сброса файла при перетаскивании
        this.previewArea.addEventListener('drop', function (e) {
            var _a, _b;
            e.preventDefault();
            var file = (_b = (_a = e.dataTransfer) === null || _a === void 0 ? void 0 : _a.files) === null || _b === void 0 ? void 0 : _b[0];
            if (file) {
                _this.handleFile(file);
            }
        });
        // Удаление изображения
        this.removeButton.addEventListener('click', function () {
            _this.resetPreview();
        });
    };
    ImageUploader.prototype.handleFile = function (file) {
        if (!file.type.startsWith('image/')) {
            alert('Пожалуйста, выберите изображение (jpg, png, gif и т. д.)');
            return;
        }
        var img = document.createElement('img');
        img.onload = function () {
            URL.revokeObjectURL(img.src);
        };
        img.src = URL.createObjectURL(file);
        this.previewArea.innerHTML = '';
        this.previewArea.appendChild(img);
        this.previewArea.appendChild(this.removeButton);
        this.removeButton.style.display = 'block';
    };
    ImageUploader.prototype.resetPreview = function () {
        this.previewArea.innerHTML = '';
        this.previewArea.appendChild(this.placeholder);
        this.previewArea.appendChild(this.removeButton);
        this.removeButton.style.display = 'none';
        this.input.value = '';
    };
    return ImageUploader;
}());
