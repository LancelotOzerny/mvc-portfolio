import { HttpClient } from "./http-client.js";
import { MessageManager } from "./message-manager.js";
document.addEventListener('DOMContentLoaded', function () {
    var feedbackForm = document.querySelector('form.feedback-form');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', handleFeedbackSubmit);
    }
});
function handleFeedbackSubmit(event) {
    event.preventDefault();
    var messageManager = new MessageManager('#form-errors');
    messageManager.clearAll();
    var api = new HttpClient();
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;
    api.post('/api/feedback/send/', { name: name, email: email, message: message }, function (response) {
        if (response.status && response.status === 'success') {
            messageManager.addSuccess('Сообщение успешно отправлено!');
            // Опционально очистить форму
            document.querySelector('form.feedback-form').reset();
            return;
        }
        if (response.errors && response.errors.length > 0) {
            for (var i = 0; i < response.errors.length; ++i) {
                messageManager.addDanger(response.errors[i]);
            }
            return;
        }
        messageManager.addDanger('Ошибка при отправке сообщения. Попробуйте позже.');
    }, function (status, error) {
        messageManager.addDanger('Ошибка при отправке сообщения. Попробуйте позже.');
        console.error('Ошибка отправки feedback:', status, error);
    });
}
