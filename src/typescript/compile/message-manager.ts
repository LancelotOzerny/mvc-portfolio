export class MessageManager
{
    private container: HTMLElement;

    constructor(selector: string)
    {
        const element = document.querySelector(selector);
        if (!element || !(element instanceof HTMLElement))
        {
            throw new Error(`Element with selector "${selector}" not found or is not a valid HTMLElement.`);
        }
        this.container = element;
        this.hideIfEmpty();
    }

    addInfo(message: string): void
    {
        this.addMessage(message, 'info');
    }

    addDanger(message: string): void
    {
        this.addMessage(message, 'danger');
    }

    addWarning(message: string): void
    {
        this.addMessage(message, 'warning');
    }

    addSuccess(message: string): void
    {
        this.addMessage(message, 'success');
    }

    private addMessage(message: string, type: string = 'info'): void
    {
        const messageEl = document.createElement('div');
        messageEl.className = `info-area info-area--${type}`;
        messageEl.textContent = message;
        this.container.appendChild(messageEl);

        this.show();
    }

    hideIfEmpty(): void
    {
        if (this.container.children.length === 0)
        {
            this.container.style.display = 'none';
        }
        else
        {
            this.container.style.display = 'block';
        }
    }

    show(): void
    {
        this.container.style.display = 'block';
    }

    clearAll(): void
    {
        while (this.container.firstChild)
        {
            this.container.removeChild(this.container.firstChild);
        }
        this.hideIfEmpty();
    }
}