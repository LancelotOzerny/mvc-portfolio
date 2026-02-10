import { HttpClient } from "./../http-client.js";
import { Project } from "./project.js";
import { AlertMessage } from "@components/alert-message/alert-message.js";

export class ProjectsList
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
                    project.createModal({
                        id: response[i].id,
                        title: response[i].title,
                        description: response[i].description,
                        icon: response[i].image_src,
                        tags: response[i].tags,
                        links: response[i].links,
                    });
                    let html = project.getHtml();

                    if (html)
                    {
                        this.list?.append(html);
                    }
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