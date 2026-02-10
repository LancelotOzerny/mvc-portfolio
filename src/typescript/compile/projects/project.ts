import {ModalWindow} from "@components/modal/modal.js";

export class Project
{
    private dom : any = {
        container: null,
        title: null,
        icon: null,
    };

    private modal : HTMLElement | null = null;

    set Title(value : string)
    {
        this.dom.title.textContent = value;
    }

    get Title() : string
    {
        return this.dom.title.textContent;
    }

    constructor(data : {
        title: string,
        description: string,
        icon: string,
        tags: [],
        links: [],
    })
    {
        this.createHtml();
        this.Title = data.title;
    }

    private createHtml() : void
    {
        this.dom.container = document.createElement('a');
        this.dom.container.setAttribute('href', '#')
        this.dom.container.setAttribute('class', 'project')
        this.dom.container.setAttribute('data-index', '1')

        this.dom.title = document.createElement('p');
        this.dom.title.setAttribute('class', 'project__title')
        this.dom.title.textContent = 'Project Title';

        this.dom.icon = document.createElement('img');
        this.dom.icon.setAttribute('src', '/assets/images/project_icon.png')

        this.dom.container.append(this.dom.title);
        this.dom.container.append(this.dom.icon);
    }

    public createModal(data: any): void
    {
        const modalWrapper = document.createElement('div');
        modalWrapper.className = 'modal__wrapper';
        modalWrapper.setAttribute('data-modal-name', `ProjectInfoModal_${data.id}`);


        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.setAttribute('data-modal-name', `ProjectInfoModal_${data.id}`);


        // Заголовок
        const header = document.createElement('header');
        header.className = 'flex justify-content--between align-items--center';
        const title = document.createElement('h3');
        title.className = 'modal__title';
        title.textContent = data.title;


        // Кнопка закрытия
        const closeBtn = document.createElement('button');
        closeBtn.className = 'btn square icon icon-close small has-bg';
        closeBtn.setAttribute('data-modal-close', `ProjectInfoModal_${data.id}`);
        closeBtn.textContent = '×';

        header.append(title, closeBtn);


        // Контент (inner)
        const inner = document.createElement('div');
        inner.className = 'modal__inner';


        // Теги
        const tagsDiv = document.createElement('div');
        tagsDiv.className = 'tags';
        for (const tag of data.tags) {
            const tagEl = document.createElement('span');
            tagEl.className = 'tag';
            tagEl.textContent = tag;
            tagsDiv.append(tagEl);
        }


        // Описание
        const descP = document.createElement('p');
        descP.className = 'mt-3';
        descP.innerHTML = `
            <span class="text--weight-4">${data.title}</span>
            — это ${data.description}
        `;

        inner.append(tagsDiv, descP);


        // Footer (control)
        const footer = document.createElement('footer');


        Object.keys(data.links).forEach(key => {
            const link = data.links[key];
            const btn = document.createElement('button');
            btn.className = 'btn btn--secondary';
            btn.textContent = link.title;
            btn.addEventListener('click', () => window.open(link.href, '_blank'));
            footer.append(btn);
        });

        modal.append(header, inner, footer);
        modalWrapper.append(modal);

        // Добавляем в конец body
        document.body.append(modalWrapper);
        this.modal = modal;
        let modalWindow = new ModalWindow(modal);

        this.dom.container.addEventListener('click', modalWindow.open.bind(modalWindow))
    }

    public getHtml() : null | HTMLElement
    {
        return this.dom.container;
    }
}