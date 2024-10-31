document.addEventListener("DOMContentLoaded", function () {
    // Проверяем, есть ли сохраненная позиция скролла в localStorage
    const scrollPosition = localStorage.getItem("scrollPosition");

    // Если позиция есть, восстанавливаем её
    if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
    }

    // Сохраняем текущую позицию скролла в localStorage при прокрутке страницы
    window.addEventListener("scroll", function () {
        localStorage.setItem("scrollPosition", window.scrollY);
    });
});
