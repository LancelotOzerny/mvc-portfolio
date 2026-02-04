import { HttpClient } from "./http-client.js";
import { AlertMessage } from "@components/alert-message/alert-message.js";

document.addEventListener('DOMContentLoaded', () =>
{
    const api = new HttpClient();
    let projects = new ProjectsList(api, '.project-list');
    projects.run();
});

class ProjectsList
{
    private list : HTMLElement | null = null;
    constructor(private api : HttpClient, selector : string)
    {
        this.list = document.querySelector(selector);
    }

    public run(): void
    {
        this.api.get(
            '/api/projects/list',
            {},
            (response) =>
            {
                for (let i = 0; i < response.length; ++i)
                {
                    let project = new Project(response[i]);
                    let html = project.getHtml();

                    if (html)
                        this.list?.append(html);
                }
            },
            (status, error) =>
            {
                AlertMessage.create('К сожалению, часть проектов не смогла загрузиться', 'danger');
                console.error('Script Error:', status, error);
            }
        );
    }


}

class Project
{
    private dom : any = {
        container: null,
        title: null,
        icon: null,
    };

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
        this.dom.container.setAttribute('data-modal-open', 'ProjectInfoModal')

        this.dom.title = document.createElement('p');
        this.dom.title.setAttribute('class', 'project__title')
        this.dom.title.textContent = 'Project Title';

        this.dom.icon = document.createElement('img');
        this.dom.icon.setAttribute('src', '/assets/images/project_icon.png')

        this.dom.container.append(this.dom.title);
        this.dom.container.append(this.dom.icon);
    }

    public getHtml() : null | HTMLElement
    {
        return this.dom.container;
    }
}