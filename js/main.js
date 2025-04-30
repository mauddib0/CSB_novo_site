const burgerMenu = document.getElementById("burger_menu");
const dropNav = document.getElementById("drop_burger_links");



burgerMenu.addEventListener('click', () => {
    burgerMenu.classList.toggle('active_burger');
    dropNav.classList.toggle('active_drop_burger_links')
})


//telegram_bot_setup



document.addEventListener('DOMContentLoaded', () => {
    const phoneInput = document.querySelector('input[name="phone"]');

    phoneInput.addEventListener('input', (e) => {
        let numbers = phoneInput.value.replace(/\D/g, '');

        if (numbers.startsWith('380')) {
            numbers = numbers.slice(3); // видаляємо 380, бо воно буде вставлено вручну
        }

        numbers = numbers.slice(0, 9); // обмежуємо до 9 цифр після +380

        let formatted = '+380';

        if (numbers.length > 0) {
            formatted += ` (${numbers.slice(0, 2)}`;
        }
        if (numbers.length >= 2) {
            formatted += `) ${numbers.slice(2, 4)}`;
        }
        if (numbers.length >= 4) {
            formatted += ` ${numbers.slice(4, 6)}`;
        }
        if (numbers.length >= 6) {
            formatted += ` ${numbers.slice(6, 9)}`;
        }

        phoneInput.value = formatted;
    });

    // Заборона введення нецифрових символів (крім керуючих)
    phoneInput.addEventListener('keypress', (e) => {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault();
        }
    });
});





