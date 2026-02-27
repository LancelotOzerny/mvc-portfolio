export class InputListManager {
    private inputLists: NodeListOf<Element>;
    private groupIndices: Map<Element, number> = new Map();

    constructor() {
        this.inputLists = document.querySelectorAll('.input-list');
        this.init();
    }

    private init(): void {
        this.inputLists.forEach((inputListElement: Element) => {
            const existingGroups = inputListElement.querySelectorAll('.input-list__group');
            let maxIndex = 0;

            existingGroups.forEach((group: Element, index: number) => {
                const groupIndex = index;
                if (groupIndex >= maxIndex) {
                    maxIndex = groupIndex + 1;
                }

                if (!group.querySelector('.btn--danger')) {
                    const removeButton = this.createRemoveButton();
                    group.appendChild(removeButton);
                }
            });

            this.groupIndices.set(inputListElement, maxIndex);
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

        const currentIndex = this.groupIndices.get(inputListElement) || 0;
        const clone = template.cloneNode(true) as HTMLElement;

        clone.classList.remove('input-list__template');
        clone.classList.add('input-list__group');

        const listName = clone.getAttribute('data-name') ?? null;
        clone.querySelectorAll('input').forEach((input: HTMLInputElement) => {
            input.value = '';
            const inputName = input.getAttribute('data-name');

            let name = listName ?? '';
            if (listName && inputName)
            {
                name += `[${currentIndex}][${inputName}]`;
            }
            else if (listName)
            {
                name += '[]';
            }

            if (name)
            {
                input.setAttribute('name', name);
            }
        });

        const removeButton = this.createRemoveButton();
        clone.appendChild(removeButton);
        valuesContainer.appendChild(clone);

        this.groupIndices.set(inputListElement, currentIndex + 1);
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
            const clonedButton = button.cloneNode(true) as HTMLInputElement;
            button.replaceWith(clonedButton);
        });

        const updatedButtons = inputListElement.querySelectorAll('.btn--danger');
        updatedButtons.forEach((button: Element) => {
            button.addEventListener('click', () => {
                const group = button.closest('.input-list__group');
                if (group) group.remove();
            });
        });
    }
}