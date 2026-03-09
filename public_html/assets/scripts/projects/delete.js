import { HttpClient } from "./../http-client.js";
import { AlertMessage } from "/assets/scripts/components/alert-message/alert-message.js";
document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('[data-target="delete-project"]');
    deleteButtons.forEach(function (item) { return item.addEventListener('click', function (event) {
        event === null || event === void 0 ? void 0 : event.preventDefault();
        var projId = item.getAttribute('data-project-id');
        if (projId)
            handleProjectSubmit(parseInt(projId));
    }); });
});
function handleProjectSubmit(id) {
    var api = new HttpClient();
    // Отправляем данные на сервер
    api.delete('/api/projects/delete/' + id, {}, function (response) {
        if (response.status === 'success') {
            AlertMessage.create('Удаление проекта произошло успешно!', 'success');
            window.location.reload();
        }
        else {
            AlertMessage.create('Удаление проекта не удалось. Попробуйте позже или обратитесь к администратору!', 'warning');
        }
    }, function (status, error) {
        AlertMessage.create('Ошибка при обращении к API сервера. Попробуйте позже!', 'warning');
    });
}
