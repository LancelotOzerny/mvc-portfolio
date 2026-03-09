var InputListManager = /** @class */ (function () {
    function InputListManager() {
        this.groupIndices = new Map();
        this.inputLists = document.querySelectorAll('.input-list');
        this.init();
    }
    InputListManager.prototype.init = function () {
        var _this = this;
        this.inputLists.forEach(function (inputListElement) {
            var existingGroups = inputListElement.querySelectorAll('.input-list__group');
            var maxIndex = 0;
            existingGroups.forEach(function (group, index) {
                var groupIndex = index;
                if (groupIndex >= maxIndex) {
                    maxIndex = groupIndex + 1;
                }
                if (!group.querySelector('.btn--danger')) {
                    var removeButton = _this.createRemoveButton();
                    group.appendChild(removeButton);
                }
            });
            _this.groupIndices.set(inputListElement, maxIndex);
            _this.initializeInputList(inputListElement);
        });
    };
    InputListManager.prototype.initializeInputList = function (inputListElement) {
        var _this = this;
        var template = inputListElement.querySelector('.input-list__template');
        var valuesContainer = inputListElement.querySelector('.input-list__values');
        var addButton = inputListElement.querySelector('.btn--info');
        if (addButton && template && valuesContainer) {
            addButton.addEventListener('click', function () {
                _this.addRow(inputListElement, template, valuesContainer);
            });
        }
        this.setupRemoveButtons(inputListElement);
    };
    InputListManager.prototype.addRow = function (inputListElement, template, valuesContainer) {
        var _a;
        if (!template || !valuesContainer)
            return;
        var currentIndex = this.groupIndices.get(inputListElement) || 0;
        var clone = template.cloneNode(true);
        clone.classList.remove('input-list__template');
        clone.classList.add('input-list__group');
        var listName = (_a = clone.getAttribute('data-name')) !== null && _a !== void 0 ? _a : null;
        clone.querySelectorAll('input').forEach(function (input) {
            input.value = '';
            var inputName = input.getAttribute('data-name');
            var name = listName !== null && listName !== void 0 ? listName : '';
            if (listName && inputName) {
                name += "[".concat(currentIndex, "][").concat(inputName, "]");
            }
            else if (listName) {
                name += '[]';
            }
            if (name) {
                input.setAttribute('name', name);
            }
        });
        var removeButton = this.createRemoveButton();
        clone.appendChild(removeButton);
        valuesContainer.appendChild(clone);
        this.groupIndices.set(inputListElement, currentIndex + 1);
        this.setupRemoveButtons(inputListElement);
    };
    InputListManager.prototype.createRemoveButton = function () {
        var button = document.createElement('input');
        button.type = 'button';
        button.className = 'btn btn--danger square small';
        button.value = '✕';
        return button;
    };
    InputListManager.prototype.setupRemoveButtons = function (inputListElement) {
        var removeButtons = inputListElement.querySelectorAll('.btn--danger');
        removeButtons.forEach(function (button) {
            var clonedButton = button.cloneNode(true);
            button.replaceWith(clonedButton);
        });
        var updatedButtons = inputListElement.querySelectorAll('.btn--danger');
        updatedButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var group = button.closest('.input-list__group');
                if (group)
                    group.remove();
            });
        });
    };
    return InputListManager;
}());
export { InputListManager };
