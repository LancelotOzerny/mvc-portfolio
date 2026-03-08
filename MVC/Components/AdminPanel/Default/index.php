<div class="sidebar-menu">
    <div class="menu-trigger" id="menuTrigger">
        <span class="trigger-icon">☰</span>
    </div>
    <div class="menu-content" id="menuContent">
        <div class="menu-header">
            <h3>Админ‑панель</h3>
            <button class="close-btn" id="closeBtn">×</button>
        </div>

        <!-- Группа 1: Работа со страницами -->
        <div class="menu-section">
            <h4>Работа со страницами</h4>
            <div class="menu-item">
                <button class="action-btn full-width" id="createPageBtn">Создание страницы</button>
            </div>
            <div class="menu-item">
                <button class="action-btn full-width" id="editPageBtn">Редактирование страницы</button>
            </div>
            <div class="menu-item">
                <button class="action-btn full-width danger" id="deletePageBtn">Удаление страницы</button>
            </div>
        </div>

        <!-- Группа 2: Отладка -->
        <div class="menu-section">
            <h4>Отладка</h4>
            <div class="menu-item toggle-item">
                <span>Режим отладки</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="debugToggle">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="menu-item toggle-item">
                <span>Показать производительность</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="perfToggle">
                    <span class="slider"></span>
                </label>
            </div>
        </div>

        <!-- Группа 3: Навигация -->
        <div class="menu-section">
            <div class="menu-item">
                <a href="/admin/" class="action-btn full-width primary" id="adminLinkBtn">Переход в админку</a>
            </div>
            <div class="menu-item">
                <button class="action-btn full-width logout" id="logoutBtn">Выйти из системы</button>
            </div>
        </div>
    </div>
</div>