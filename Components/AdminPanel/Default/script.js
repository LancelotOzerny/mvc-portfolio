document.addEventListener('DOMContentLoaded', function() {
    const menuTrigger = document.getElementById('menuTrigger');
    const menuContent = document.getElementById('menuContent');
    const closeBtn = document.getElementById('closeBtn');
    const debugToggle = document.getElementById('debugToggle');
    const perfToggle = document.getElementById('perfToggle');
    const createPageBtn = document.getElementById('createPageBtn');
    const editPageBtn = document.getElementById('editPageBtn');
    const deletePageBtn = document.getElementById('deletePageBtn');
    const adminLinkBtn = document.getElementById('adminLinkBtn');
    const logoutBtn = document.getElementById('logoutBtn');

    // Открытие меню по клику на триггер
    menuTrigger.addEventListener('click', function() {
        if (menuContent.style.width === '280px') {
            menuContent.style.width = '0';
        } else {
            menuContent.style.width = '280px';
        }
    });

    // Закрытие меню кликом на крестик
    closeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        menuContent.style.width = '0';
    });

    // Обработчик для переключателя «Режим отладки»
    debugToggle.addEventListener('change', function() {
        if (this.checked) {
            console.log('Режим отладки: ON');
            // Здесь можно добавить дополнительную логику включения отладки
        } else {
            console.log('Режим отладки: OFF');
            // Здесь можно добавить дополнительную логику выключения отладки
        }
    });

    // Обработчик для переключателя «Показать производительность»
    perfToggle.addEventListener('change', function() {
        if (this.checked) {
            console.log('Производительность: ON');
            // Здесь можно добавить логику для отображения метрик производительности
        } else {
            console.log('Производительность: OFF');
            // Здесь можно добавить логику для скрытия метрик производительности
        }
    });

    // Обработчики для кнопок работы со страницами
    createPageBtn.addEventListener('click', function() {
        console.log('Создаём новую страницу...');
        // Здесь можно добавить логику создания страницы
    });

    editPageBtn.addEventListener('click', function() {
        console.log('Открываем редактор страницы...');
        // Здесь можно добавить логику открытия редактора
    });

    deletePageBtn.addEventListener('click', function() {
        const confirmDelete = confirm('Вы уверены, что хотите удалить страницу? Это действие нельзя отменить.');
        if (confirmDelete) {
            console.log('Удаляем страницу...');
            // Здесь можно добавить логику удаления страницы
        }
    });

    // Обработчики для навигационных кнопок
    adminLinkBtn.addEventListener('click', function() {
        console.log('Переходим в административную панель...');
        // Здесь можно добавить логику перехода в админку (например, window.location.href = '/admin')
    });

    logoutBtn.addEventListener('click', function() {
        const confirmLogout = confirm('Вы уверены, что хотите выйти из системы?');
        if (confirmLogout) {
            console.log('Выполняем выход из системы...');
            // Здесь можно добавить логику выхода (очистка сессии, редирект и т. д.)
        }
    });
});