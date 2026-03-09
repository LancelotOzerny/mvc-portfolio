import { ModalWindow } from "/assets/scripts/components/modal/modal.js";
var Project = /** @class */ (function () {
    function Project(data) {
        this.data = {
            title: null,
            description: null,
            icon: null,
            tags: null,
            links: null,
        };
        this.dom = {
            container: null,
            title: null,
            icon: null,
        };
        this.modal = null;
        this.data = data;
        this.createHtml();
        console.log(this.data);
    }
    Project.prototype.createHtml = function () {
        this.dom.container = document.createElement('a');
        this.dom.container.setAttribute('class', 'project');
        this.dom.container.setAttribute('data-index', '1');
        this.dom.title = document.createElement('p');
        this.dom.title.setAttribute('class', 'project__title');
        this.dom.title.textContent = this.data.title;
        this.dom.icon = document.createElement('img');
        this.dom.icon.setAttribute('src', this.data.icon_src);
        this.dom.container.append(this.dom.title);
        this.dom.container.append(this.dom.icon);
    };
    Project.prototype.createModal = function (data) {
        var modalWrapper = document.createElement('div');
        modalWrapper.className = 'modal__wrapper';
        modalWrapper.setAttribute('data-modal-name', "ProjectInfoModal_".concat(data.id));
        var modal = document.createElement('div');
        modal.className = 'modal';
        modal.setAttribute('data-modal-name', "ProjectInfoModal_".concat(data.id));
        // Заголовок
        var header = document.createElement('header');
        header.className = 'flex justify-content--between align-items--center';
        var title = document.createElement('h3');
        title.className = 'modal__title';
        title.textContent = data.title;
        // Кнопка закрытия
        var closeBtn = document.createElement('button');
        closeBtn.className = 'btn square icon icon-close small has-bg';
        closeBtn.setAttribute('data-modal-close', "ProjectInfoModal_".concat(data.id));
        closeBtn.textContent = '×';
        header.append(title, closeBtn);
        // Контент (inner)
        var inner = document.createElement('div');
        inner.className = 'modal__inner';
        // Теги
        var tagsDiv = document.createElement('div');
        tagsDiv.className = 'tags';
        for (var _i = 0, _a = data.tags; _i < _a.length; _i++) {
            var tag = _a[_i];
            var tagEl = document.createElement('span');
            tagEl.className = 'tag';
            tagEl.textContent = tag;
            tagsDiv.append(tagEl);
        }
        // Описание
        var descP = document.createElement('p');
        descP.className = 'mt-3';
        descP.innerHTML = "\n            <span class=\"text--weight-4\">".concat(data.title, "</span>\n            \u2014 \u044D\u0442\u043E ").concat(data.description, "\n        ");
        inner.append(tagsDiv, descP);
        // Footer (control)
        var footer = document.createElement('footer');
        Object.keys(data.links).forEach(function (key) {
            var link = data.links[key];
            var btn = document.createElement('button');
            btn.className = 'btn btn--secondary';
            btn.textContent = link.title;
            btn.addEventListener('click', function () { return window.open(link.url, '_blank'); });
            footer.append(btn);
        });
        modal.append(header, inner, footer);
        modalWrapper.append(modal);
        // Добавляем в конец body
        document.body.append(modalWrapper);
        this.modal = modal;
        var modalWindow = new ModalWindow(modal);
        this.dom.container.addEventListener('click', modalWindow.open.bind(modalWindow));
    };
    Project.prototype.getHtml = function () {
        return this.dom.container;
    };
    return Project;
}());
export { Project };
