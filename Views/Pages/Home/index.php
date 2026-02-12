<?php
/** @param \Modules\Main\BaseController $this */
/** @var array $data */
?>

<div class="page__block main-header theme--blue py-10">
    <div class="page__container main-header__inner">
        <h1 class="main-header__name">Максим Александрович Беляков</h1>
        <p class="main-header__jobname">WEB-программист, Unity разработчик</p>
        <p class="main-header__slogan">Каждая задача - это новый вызов на моем пути</p>
        <div class="main-header__control mt-5">
            <a class="btn btn--white large text--upper rounded" href="#anchor-projects" type="button" aria-label="Проекты">Проекты</a>
            <button class="btn btn--white large text--upper rounded" type="button" aria-label="Резюме">Резюме</button>
        </div><img class="main-header__image" src="/assets/images/profile.png" alt="Profile image">
    </div>
</div>

<div class="page__block py-5">
    <div class="page__container">
        <div class="text--right my-5">
            <p class="page-title text--weight-2 page-title--animated" href="#">Немного о себе</p>
        </div>
        <div class="about-me"><img class="about-me__image" src="/assets/images/goblin.png">
            <div class="about-me__text">
                <p>
                    Меня зовут Максим Александрович Беляков.
                    Я программист из Липецкой области, в направлении WEB-разработки.
                    Каждый день я изучаю что-то новое и совершенствую свои навыки, пишу новые проекты и совершенствую старые.
                </p>
                <p class="pt-2">
                    В работе мне помогают мои профессиональные хобби - разработка игр на C# и Unity, дизайн сайтов и видеоигры.
                    В разработке игр я каждый день узнаю что-либо новое, к примеру, паттерны проектирования или какой-либо новый алгоритм.
                    Дизайн помогает мне делать красивые сайты, верстать великолепные сайты спонтанно.
                    Времяпрепровождение за компьютерными играми позволяет не только расслабиться, но и взглянуть на игру с точки
                    зрения программиста - "А как персонажи взаиодействуют?", "Как работает внутриигровая торговля" или же "Почему мне не удается пройти этот уровень...".
                    Играя в игры очень часто хочется что-то сломать, чтобы получить игровое преимущество. Так я и научился тестированию.
                </p>
                <p class="pt-2">Самое главное для меня - это непрерывное саморазвитие, непрерывное следование за мечтой и всегда иметь перед собой четко поставленную цель.</p>
            </div>
        </div>
    </div>
</div>
<div id="anchor-projects" class="page__block py-5">
    <div class="page__container">
        <div class="my-5">
            <p class="page-title text--weight-2 page-title--animated">Лучшие проекты</p>
        </div>

        <?php
        $data['components']['ProjectsList']->render();
        ?>
    </div>
</div>
<div class="page__block py-5">
    <div class="page__container">
        <div class="text--center my-5">
            <p class="page-title text--weight-2 text--center page-title--animated mx-auto" href="#">Форма обратной связи</p>
        </div>
        <form class="form feedback-form" action="#" method="POST">
            <div class="form__group--flex">
                <div class="form__group">
                    <label class="form__label form__label--required" for="name">Имя</label>
                    <input class="form__input" type="text" id="name" name="name" required>
                    <p class="form__error is-visible">Поле обязательно для заполнения</p>
                </div>
                <div class="form__group">
                    <label class="form__label form__label--required" for="email">Email</label>
                    <input class="form__input" type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form__group">
                <label class="form__label" for="message">Сообщение</label>
                <textarea class="form__textarea" id="message" name="message" placeholder="Напишите что-нибудь..."></textarea>
            </div>
            <div class="form__group">
                <button class="btn btn--info large" type="submit" aria-label="Отправить">Отправить</button>
            </div>
        </form>
    </div>
</div>

<div class="modal__wrapper">
    <div class="modal" data-modal-name="ProjectInfoModal">
        <header class="flex justify-content--between align-items--center">
            <div class="modal__title">Unity Developer Toolkit</div>
            <button class="btn square icon icon-close small has-bg" data-modal-close="ProjectInfoModal"></button>
        </header>
        <div class="modal__inner">
            <div class="tags">
                <div class="tag">Unity</div>
                <div class="tag">C#</div>
                <div class="tag">Git</div>
            </div>
            <p class="mt-5"><span class="text--weight-4">Unity Developer Toolkit (UDT)</span>- это набор инструментов для Unity разработчика который поможет
                ускорить процесс разработки через набор готовых скриптов, префабов и спрайтов. Теперь можно в пару нажатий
                обрабатывать столкновения, создавать счетчик, кошелек персонажа и другое.
            </p>
        </div>
        <footer>
            <button class="btn btn--secondary">Git</button>
            <button class="btn btn--info">Demo</button>
        </footer>
    </div>
</div>