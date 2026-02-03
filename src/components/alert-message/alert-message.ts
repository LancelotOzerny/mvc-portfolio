export class AlertMessage
{
    public static container : HTMLElement | null = null;
    public static create(message : string, type : 'info' | 'danger' | 'warning' | 'success' = 'info') : void
    {
        if (!this.container)
        {
            AlertMessage.container = document.createElement('div');
            AlertMessage.container.classList.add('alert-messages-container');
            document.querySelector('body')?.append(AlertMessage.container);
        }

        let messageWrapper = document.createElement('div');
        messageWrapper.classList.add('alert-message', type);
        messageWrapper.textContent = message;

        let closeButton = document.createElement('button');
        closeButton.classList.add('btn', 'square', 'icon', 'icon-close', 'small', 'has-bg')
        closeButton.setAttribute('data-alert-close', 'true');
        closeButton.addEventListener('click', () => AlertMessage.close(messageWrapper))
        messageWrapper.append(closeButton);


        if (AlertMessage.container)
        {
            AlertMessage.container.append(messageWrapper);
            messageWrapper.classList.add('active');

            setTimeout(() => { AlertMessage.close(messageWrapper) }, 3000);
        }
    }

    private static close(alertWindow : HTMLElement): void
    {
        alertWindow.classList.remove('active')

        setTimeout(() => {
            alertWindow.style.display = 'none';
        }, 100);
    }
}