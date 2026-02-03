import { ModalWindow } from "@components/modal/modal.js";
import { AlertMessage } from "@components/alert-message/alert-message.js";

document.addEventListener('DOMContentLoaded', () => {
    initModalBindings();

    for (let i = 0; i < 3; ++i)
    {
        AlertMessage.create('Ваше сообщение отправлено!', 'success')
    }
});

function initModalBindings()
{
    const modals = document.querySelectorAll('[data-modal-name]');

    modals.forEach(item => {
        const name = item.getAttribute('data-modal-name');
        if (!name) {
            console.warn(`Модальное окно без data-modal-name`, item);
            return;
        }

        let modal : ModalWindow = new ModalWindow(name);
    });

    console.log('Модальные окна инициализированы:', modals.length);
}
