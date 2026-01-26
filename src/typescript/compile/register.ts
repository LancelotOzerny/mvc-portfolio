import { HttpClient } from "./http-client.js";

function handleRegister(event: Event): void
{
    event.preventDefault();

    const api = new HttpClient('https://cs224814.tw1.ru/api');

    const email = (document.getElementById('email') as HTMLInputElement).value;
    const password = (document.getElementById('password') as HTMLInputElement).value;
    const passwordConfirm = (document.getElementById('password_confirm') as HTMLInputElement).value;

    if (!email || !password || !passwordConfirm)
    {
        alert('Заполните все поля');
        return;
    }

    if (password !== passwordConfirm)
    {
        alert('Пароли не совпадают');
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
                    console.log(response.errors[i]);
                }

                return;
            }

            console.log('Ошибка при создании нового пользователя. Повторите попытку позже или обратитесь в тех поддержку!');
        },
        (status, error) =>
        {
            console.error('Ошибка регистрации:', status, error);
            alert(`Ошибка регистрации: ${error}`);
        }
    );
}

document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.querySelector('form[action="/auth/register"]');

    if (registerForm)
    {
        registerForm.addEventListener('submit', handleRegister);
    }
});