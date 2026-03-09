var MessageManager = /** @class */ (function () {
    function MessageManager(selector) {
        var element = document.querySelector(selector);
        if (!element || !(element instanceof HTMLElement)) {
            throw new Error("Element with selector \"".concat(selector, "\" not found or is not a valid HTMLElement."));
        }
        this.container = element;
        this.hideIfEmpty();
    }
    MessageManager.prototype.addInfo = function (message) {
        this.addMessage(message, 'info');
    };
    MessageManager.prototype.addDanger = function (message) {
        this.addMessage(message, 'danger');
    };
    MessageManager.prototype.addWarning = function (message) {
        this.addMessage(message, 'warning');
    };
    MessageManager.prototype.addSuccess = function (message) {
        this.addMessage(message, 'success');
    };
    MessageManager.prototype.addMessage = function (message, type) {
        if (type === void 0) { type = 'info'; }
        var messageEl = document.createElement('div');
        messageEl.className = "info-area info-area--".concat(type);
        messageEl.textContent = message;
        this.container.appendChild(messageEl);
        this.show();
    };
    MessageManager.prototype.hideIfEmpty = function () {
        if (this.container.children.length === 0) {
            this.container.style.display = 'none';
        }
        else {
            this.container.style.display = 'block';
        }
    };
    MessageManager.prototype.show = function () {
        this.container.style.display = 'block';
    };
    MessageManager.prototype.clearAll = function () {
        while (this.container.firstChild) {
            this.container.removeChild(this.container.firstChild);
        }
        this.hideIfEmpty();
    };
    return MessageManager;
}());
export { MessageManager };
