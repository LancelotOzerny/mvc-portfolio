import { HttpClient } from "./http-client.js";
import { MessageManager } from "./message-manager.js";

const messageManager = new MessageManager('#form-errors');
const registerForm = document.querySelector('form[action="/auth/register"]');

function handleRegister(event: Event): void
{
    event.preventDefault();
    messageManager.clearAll();

    const api = new HttpClient('https://cs224814.tw1.ru/api');

    const email = (document.getElementById('email') as HTMLInputElement).value;
    const password = (document.getElementById('password') as HTMLInputElement).value;
    const passwordConfirm = (document.getElementById('password_confirm') as HTMLInputElement).value;

    if (!email || !password || !passwordConfirm)
    {
        messageManager.addWarning('Заполните все поля!')
        return;
    }

    if (password !== passwordConfirm)
    {
        messageManager.addDanger('Пароли не совпадают!')
        return;
    }

    api.post(
        '/auth/register/',
        {
            email,
            password
        },
        (response) =>
        {
            if (response.status && response.status === 'success')
            {
                window.location.href = '/';
                return;
            }

            if (response.errors && response.errors.length > 0)
            {
                for (let i = 0; i < response.errors.length; ++i)
                {
                    messageManager.addDanger(response.errors[i]);
                }

                return;
            }

            messageManager.addDanger('Ошибка при создании нового пользователя. Повторите попытку позже или обратитесь в тех поддержку!');
        },
        (status, error) =>
        {
            messageManager.addDanger(`Ошибка регистрации. Повторите попытку позже!`)
            console.error('Ошибка регистрации:', status, error);
        }
    );
}

document.addEventListener('DOMContentLoaded', () => {
    if (registerForm)
    {
        registerForm.addEventListener('submit', handleRegister);
    }
});