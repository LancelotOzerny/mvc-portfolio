import { Project } from "./project.js";
import { AlertMessage } from "/assets/scripts/components/alert-message/alert-message.js";
var ProjectsList = /** @class */ (function () {
    function ProjectsList(api, selector) {
        this.api = api;
        this.list = null;
        this.list = document.querySelector(selector);
    }
    ProjectsList.prototype.run = function () {
        var _this = this;
        this.api.get('/api/projects/list', {}, function (response) {
            var _a;
            for (var i = 0; i < response.length; ++i) {
                var project = new Project(response[i]);
                project.createModal({
                    id: response[i].id,
                    title: response[i].title,
                    description: response[i].preview_text,
                    icon: response[i].image_src,
                    tags: response[i].tags,
                    links: response[i].links,
                });
                var html = project.getHtml();
                if (html) {
                    (_a = _this.list) === null || _a === void 0 ? void 0 : _a.append(html);
                }
            }
        }, function (status, error) {
            AlertMessage.create('К сожалению, часть проектов не смогла загрузиться', 'danger');
            console.error('Script Error:', status, error);
        });
    };
    return ProjectsList;
}());
export { ProjectsList };
