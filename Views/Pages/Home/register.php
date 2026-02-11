<div class="page__block">
    <div class="page--height-100 page__container flex align-items--center">
        <form class="form auth-form" action="/auth/register" method="POST">
            <p class="page-title page-title--small text--center mx-auto" href="#">Регистрация</p>
            <div class="form__group" id="form-errors"></div>
            <div class="form__group">
                <label class="form__label form__label--required" for="email">Email</label>
                <input class="form__input" type="email" id="email" name="email" required>
                <p class="form__error is-hidden">Введите корректный email</p>
            </div>
            <div class="form__group">
                <label class="form__label form__label--required" for="password">Пароль</label>
                <input class="form__input" type="password" id="password" name="password" required minlength="6">
                <p class="form__error is-hidden">Минимум 6 символов</p>
            </div>
            <div class="form__group">
                <label class="form__label form__label--required" for="password_confirm">Подтверждение пароля</label>
                <input class="form__input" type="password" id="password_confirm" name="password_confirm" required>
                <p class="form__error is-hidden">Пароли должны совпадать</p>
            </div>
            <div class="form__group text--center mt-2">
                <button class="btn btn--upper btn--large btn--success" type="submit" aria-label="Зарегистрироваться">Зарегистрироваться</button>
            </div>
            <div class="text--center mt-1"><a class="text--muted" href="/login/">Уже есть аккаунт? Войти</a></div>
        </form>
    </div>
</div>
<script type="module" src="/assets/scripts/register.js"></script>