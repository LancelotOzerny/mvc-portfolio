var AlertMessage = /** @class */ (function () {
    function AlertMessage() {
    }
    AlertMessage.create = function (message, type) {
        var _a;
        if (type === void 0) { type = 'info'; }
        if (!this.container) {
            AlertMessage.container = document.createElement('div');
            AlertMessage.container.classList.add('alert-messages-container');
            (_a = document.querySelector('body')) === null || _a === void 0 ? void 0 : _a.append(AlertMessage.container);
        }
        var messageWrapper = document.createElement('div');
        messageWrapper.classList.add('alert-message', type);
        messageWrapper.textContent = message;
        var closeButton = document.createElement('button');
        closeButton.classList.add('btn', 'square', 'icon', 'icon-close', 'small', 'has-bg');
        closeButton.setAttribute('data-alert-close', 'true');
        closeButton.addEventListener('click', function () { return AlertMessage.close(messageWrapper); });
        messageWrapper.append(closeButton);
        if (AlertMessage.container) {
            AlertMessage.container.append(messageWrapper);
            messageWrapper.classList.add('active');
            setTimeout(function () { AlertMessage.close(messageWrapper); }, 3000);
        }
    };
    AlertMessage.close = function (alertWindow) {
        alertWindow.classList.remove('active');
        setTimeout(function () {
            alertWindow.style.display = 'none';
        }, 100);
    };
    AlertMessage.container = null;
    return AlertMessage;
}());
export { AlertMessage };
