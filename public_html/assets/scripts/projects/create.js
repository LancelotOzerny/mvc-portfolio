import { HttpClient } from "./../http-client.js";
import { MessageManager } from "./../message-manager.js";
document.addEventListener('DOMContentLoaded', function () {
    var projectForm = document.querySelector('form.form');
    if (projectForm) {
        projectForm.addEventListener('submit', handleProjectSubmit);
    }
});
function handleProjectSubmit(event) {
    event.preventDefault();
    var form = document.getElementById('create-form');
    if (!form) {
        return;
    }
    var messageManager = new MessageManager('#form-errors');
    messageManager.clearAll();
    // Создаём FormData из всей формы — автоматически включаем все поля и файлы
    var formData = new FormData(form);
    var api = new HttpClient();
    // Отправляем данные на сервер
    api.post('/api/projects/create/', formData, function (response) {
        if (response.status && response.status === 'success') {
            console.log(response);
            // window.location.href = '/projects/';
            return;
        }
        if (response.errors && response.errors.length > 0) {
            for (var i = 0; i < response.errors.length; ++i) {
                messageManager.addDanger(response.errors[i]);
            }
            return;
        }
        messageManager.addDanger('Ошибка при создании проекта. Повторите попытку позже или обратитесь в техподдержку!');
    }, function (status, error) {
        messageManager.addDanger("\u041E\u0448\u0438\u0431\u043A\u0430 \u043F\u0440\u0438 \u043E\u0442\u043F\u0440\u0430\u0432\u043A\u0435 \u0434\u0430\u043D\u043D\u044B\u0445. \u041F\u043E\u0432\u0442\u043E\u0440\u0438\u0442\u0435 \u043F\u043E\u043F\u044B\u0442\u043A\u0443 \u043F\u043E\u0437\u0436\u0435!");
        console.error('Ошибка создания проекта:', status, error);
    });
}
