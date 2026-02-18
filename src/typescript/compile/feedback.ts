import { HttpClient } from "./http-client.js";
import { MessageManager } from "./message-manager.js";

document.addEventListener('DOMContentLoaded', () => {
    const feedbackForm = document.querySelector('form.feedback-form') as HTMLFormElement | null;

    if (feedbackForm) {
        feedbackForm.addEventListener('submit', handleFeedbackSubmit);
    }
});

function handleFeedbackSubmit(event: Event): void {
    event.preventDefault();

    const messageManager = new MessageManager('#form-errors');
    messageManager.clearAll();

    const api = new HttpClient();

    const name = (document.getElementById('name') as HTMLInputElement).value;
    const email = (document.getElementById('email') as HTMLInputElement).value;
    const message = (document.getElementById('message') as HTMLTextAreaElement).value;

    api.post(
        '/api/feedback/send/',
        { name, email, message },
        (response: any) => {
            if (response.status && response.status === 'success') {
                messageManager.addSuccess('Сообщение успешно отправлено!');
                // Опционально очистить форму
                (document.querySelector('form.feedback-form') as HTMLFormElement).reset();
                return;
            }

            if (response.errors && response.errors.length > 0) {
                for (let i = 0; i < response.errors.length; ++i) {
                    messageManager.addDanger(response.errors[i]);
                }
                return;
            }

            messageManager.addDanger('Ошибка при отправке сообщения. Попробуйте позже.');
        },
        (status: number, error: any) => {
            messageManager.addDanger('Ошибка при отправке сообщения. Попробуйте позже.');
            console.error('Ошибка отправки feedback:', status, error);
        }
    );
}