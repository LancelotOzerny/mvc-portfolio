import { ModalWindow } from "@components/modal/modal.js";
import { InputListManager } from "./forms/input-list-manager.js";

document.addEventListener('DOMContentLoaded', () => {
    initModalBindings();

    console.log('test 1');
    let inputListManager = new InputListManager();
    console.log('test 2');
});

function initModalBindings()
{
    const modals = document.querySelectorAll('[data-modal-name]');

    modals.forEach(item => {
        const name = item.getAttribute('data-modal-name');
        if (!name)
        {
            console.warn(`Модальное окно без data-modal-name`, item);
            return;
        }

        let modal : ModalWindow = new ModalWindow(name);
    });

    console.log('Модальные окна инициализированы:', modals.length);
}