import {HttpClient} from "./http-client.js";
import {ProjectsList} from "./projects/projects-list.js";

document.addEventListener('DOMContentLoaded', () =>
{
    const api = new HttpClient();
    let projects = new ProjectsList(api, '.project-list');
    projects.run();
    console.log('Список проектов инициализирован');
});