import { HttpClient } from "./../http-client.js";
import { AlertMessage } from "@components/alert-message/alert-message.js";

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons : NodeListOf<HTMLElement> = document.querySelectorAll('[data-target="delete-project"]');

    deleteButtons.forEach(item => item.addEventListener('click', (event) => {
        event?.preventDefault();
        let projId : string | null = item.getAttribute('data-project-id');
        if (projId) handleProjectSubmit(parseInt(projId));
    }));
});

function handleProjectSubmit(id : number): void
{
    const api = new HttpClient();

    // Отправляем данные на сервер
    api.delete(
        '/api/projects/delete/' + id,
        {},
        (response) => {
            if (response.status === 'success')
            {
                AlertMessage.create('Удаление проекта произошло успешно!', 'success');
                window.location.reload();
            }
            else
            {
                AlertMessage.create('Удаление проекта не удалось. Попробуйте позже или обратитесь к администратору!', 'warning');
            }
        },
        (status: number, error: any) => {
            AlertMessage.create('Ошибка при обращении к API сервера. Попробуйте позже!', 'warning');
        }
    );
}