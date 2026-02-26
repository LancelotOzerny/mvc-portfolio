export class InputListManager {
    private inputLists: NodeListOf<Element>;

    constructor() {
        this.inputLists = document.querySelectorAll('.input-list');
        this.init();
    }

    private init(): void {
        this.inputLists.forEach((inputListElement: Element) => {
            this.initializeInputList(inputListElement);
        });
    }

    private initializeInputList(inputListElement: Element): void {
        const template = inputListElement.querySelector('.input-list__template');
        const valuesContainer = inputListElement.querySelector('.input-list__values');
        const addButton = inputListElement.querySelector('.btn--info');

        if (addButton && template && valuesContainer) {
            addButton.addEventListener('click', () => {
                this.addRow(inputListElement, template, valuesContainer);
            });
        }

        this.setupRemoveButtons(inputListElement);
    }

    private addRow(
        inputListElement: Element,
        template: Element | null,
        valuesContainer: Element | null
    ): void {
        if (!template || !valuesContainer) return;

        // Клонируем шаблон
        const clone = template.cloneNode(true) as HTMLElement;

        // Убираем класс шаблона, чтобы он не мешал стилям
        clone.classList.remove('input-list__template');
        clone.classList.add('input-list__group');

        // Очищаем значения полей в новой строке
        clone.querySelectorAll('input').forEach((input: HTMLInputElement) => {
            input.value = '';
        });

        // Добавляем кнопку удаления
        const removeButton = this.createRemoveButton();
        clone.appendChild(removeButton);

        // Вставляем новую строку в контейнер
        valuesContainer.appendChild(clone);

        // Переинициализируем обработчики удаления для обновлённого списка
        this.setupRemoveButtons(inputListElement);
    }

    private createRemoveButton(): HTMLInputElement {
        const button = document.createElement('input');
        button.type = 'button';
        button.className = 'btn btn--danger square small';
        button.value = '✕';
        return button;
    }

    private setupRemoveButtons(inputListElement: Element): void {
        const removeButtons = inputListElement.querySelectorAll('.btn--danger');

        removeButtons.forEach((button: Element) => {
            // Удаляем старые обработчики, чтобы избежать дублирования
            const clonedButton = button.cloneNode(true) as HTMLInputElement;
            button.replaceWith(clonedButton);
        });

        // Добавляем новые обработчики
        const updatedButtons = inputListElement.querySelectorAll('.btn--danger');
        updatedButtons.forEach((button: Element) => {
            button.addEventListener('click', () => {
                const group = button.closest('.input-list__group');
                if (group) group.remove();
            });
        });
    }
}
