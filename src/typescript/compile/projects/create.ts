import { HttpClient } from "./../http-client.js";
import { MessageManager } from "./../message-manager.js";

document.addEventListener('DOMContentLoaded', () => {
    const projectForm = document.querySelector('form.form') as HTMLFormElement;

    if (projectForm) {
        projectForm.addEventListener('submit', handleProjectSubmit);
    }
});

function handleProjectSubmit(event: Event): void {
    event.preventDefault();
    const form = document.getElementById('create-form') as HTMLFormElement;

    if (!form) {
        return;
    }

    const messageManager = new MessageManager('#form-errors');
    messageManager.clearAll();

    // Создаём FormData из всей формы — автоматически включаем все поля и файлы
    const formData = new FormData(form);

    console.log('=== Проверка FormData ===');
    console.log('Форма содержит:', form.elements.length, 'элементов');

// Проверяем, есть ли хотя бы одно поле
    let hasFields = false;
    formData.forEach(() => hasFields = true);
    console.log('FormData содержит поля:', hasFields);

// Выводим все поля
    formData.forEach((value, key) => {
        if (value instanceof File) {
            console.log(`  ${key}: File(${value.name}, ${value.size} bytes, ${value.type})`);
        } else {
            console.log(`  ${key}: ${value}`);
        }
    });
    console.log('====================');


    const api = new HttpClient();

    // Отправляем данные на сервер
    api.post(
        '/api/projects/create/',
        formData,
        (response) => {
            if (response.status && response.status === 'success') {
                console.log(response);
                // window.location.href = '/projects/';
                return;
            }

            if (response.errors && response.errors.length > 0) {
                for (let i = 0; i < response.errors.length; ++i) {
                    messageManager.addDanger(response.errors[i]);
                }
                return;
            }

            messageManager.addDanger('Ошибка при создании проекта. Повторите попытку позже или обратитесь в техподдержку!');
        },
        (status: number, error: any) => {
            messageManager.addDanger(`Ошибка при отправке данных. Повторите попытку позже!`);
            console.error('Ошибка создания проекта:', status, error);
        }
    );
}