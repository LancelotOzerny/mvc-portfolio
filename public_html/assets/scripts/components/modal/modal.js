var ModalWindow = /** @class */ (function () {
    function ModalWindow(modalWindow) {
        this.modalWindow = modalWindow;
        this.modal = null;
        this.modalName = 'none';
        if (typeof modalWindow === 'object')
            this.initByObject(modalWindow);
        else
            this.modal = document.querySelector('*[data-modal-name="' + this.modalName + '"]');
        this.setStyles();
        this.setOpenButtons();
        this.setCloseButtons();
    }
    ModalWindow.prototype.initByObject = function (modalWindow) {
        var _a;
        this.modal = modalWindow;
        this.modalName = (_a = this.modal.getAttribute('data-modal-name')) !== null && _a !== void 0 ? _a : 'NoNe';
        if (this.modalName === 'NoNe') {
            console.error('Модальное окно не содержит значения "data-modal-name"!');
        }
    };
    ModalWindow.prototype.setStyles = function () {
        if (!this.modal) {
            return;
        }
        this.modal.style.left = '-105%';
    };
    ModalWindow.prototype.setCloseButtons = function () {
        var _this = this;
        var buttons = document.querySelectorAll('*[data-modal-close="' + this.modalName + '"]');
        buttons.forEach(function (btn) { return btn.addEventListener('click', _this.close.bind(_this)); });
    };
    ModalWindow.prototype.setOpenButtons = function () {
        var _this = this;
        var buttons = document.querySelectorAll('*[data-modal-open="' + this.modalName + '"]');
        buttons.forEach(function (btn) { return btn.addEventListener('click', _this.open.bind(_this)); });
    };
    ModalWindow.prototype.open = function (event) {
        var _a, _b;
        event.preventDefault();
        if (this.modal === null) {
            return;
        }
        if (!((_a = this.modal.parentElement) === null || _a === void 0 ? void 0 : _a.classList.contains('active'))) {
            (_b = this.modal.parentElement) === null || _b === void 0 ? void 0 : _b.classList.add('active');
        }
        this.modal.style.left = 'calc(50% - ' + this.modal.clientWidth / 2 + 'px )';
        this.modal.style.top = 'calc(50% - ' + this.modal.clientHeight / 2 + 'px )';
    };
    ModalWindow.prototype.close = function () {
        var _a, _b;
        if (this.modal === null) {
            return;
        }
        if ((_a = this.modal.parentElement) === null || _a === void 0 ? void 0 : _a.classList.contains('active')) {
            (_b = this.modal.parentElement) === null || _b === void 0 ? void 0 : _b.classList.remove('active');
        }
        this.modal.style.left = '-105%';
    };
    return ModalWindow;
}());
export { ModalWindow };
