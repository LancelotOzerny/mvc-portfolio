import { HttpClient } from "./http-client.js";
import { MessageManager } from "./message-manager.js";
function handleRegister(event) {
    event.preventDefault();
    var messageManager = new MessageManager('#form-errors');
    messageManager.clearAll();
    var api = new HttpClient();
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var passwordConfirm = document.getElementById('password_confirm').value;
    if (!email || !password || !passwordConfirm) {
        messageManager.addWarning('Заполните все поля!');
        return;
    }
    if (password !== passwordConfirm) {
        messageManager.addDanger('Пароли не совпадают!');
        return;
    }
    api.post('/api/auth/register/', {
        email: email,
        password: password
    }, function (response) {
        if (response.status && response.status === 'success') {
            window.location.href = '/';
            return;
        }
        if (response.errors && response.errors.length > 0) {
            for (var i = 0; i < response.errors.length; ++i) {
                messageManager.addDanger(response.errors[i]);
            }
            return;
        }
        messageManager.addDanger('Ошибка при создании нового пользователя. Повторите попытку позже или обратитесь в тех поддержку!');
    }, function (status, error) {
        messageManager.addDanger("\u041E\u0448\u0438\u0431\u043A\u0430 \u0440\u0435\u0433\u0438\u0441\u0442\u0440\u0430\u0446\u0438\u0438. \u041F\u043E\u0432\u0442\u043E\u0440\u0438\u0442\u0435 \u043F\u043E\u043F\u044B\u0442\u043A\u0443 \u043F\u043E\u0437\u0436\u0435!");
        console.error('Ошибка регистрации:', status, error);
    });
}
document.addEventListener('DOMContentLoaded', function () {
    var registerForm = document.querySelector('form[action="/auth/register"]');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegister);
    }
});
