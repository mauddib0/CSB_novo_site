const burgerMenu = document.getElementById("burger_menu");
const dropNav = document.getElementById("drop_burger_links");
burgerMenu.addEventListener('click', () => {
    burgerMenu.classList.toggle('active_burger');
    dropNav.classList.toggle('active_drop_burger_links')
});

// consule_menu_open
const menu = document.getElementById("menu");
const activate_btn = document.getElementById("active_btn");
const active_consule = document.getElementById("active_consul");
const backPageArrow = document.getElementById("back_page_arrow");

activate_btn.addEventListener('click', () => {
    menu.classList.remove('block');
    menu.classList.add('hidden');
    active_consule.classList.remove('hidden');
    active_consule.classList.add('block');
});

backPageArrow.addEventListener('click', () => {
    active_consule.classList.remove('block');
    active_consule.classList.add('hidden');
    menu.classList.remove('hidden');
    menu.classList.add('block');
});

// Скрол з навігації до елементів
const aboutUsScroll = document.getElementById("about_us_scroll");
const teamScroll = document.getElementById("team_scroll");

aboutUsScroll.addEventListener('click', () => {
    document.getElementById('about').scrollIntoView({
        behavior: 'smooth'
    });
});

teamScroll.addEventListener('click', () => {
    document.getElementById('team').scrollIntoView({
        behavior: 'smooth'
    });
});

// Встановлення тексту в інпут через натискання на кнопку
const problemInput = document.getElementById("problem_input");
const putValueConsul = document.getElementById("put_value_in_form_concul");

putValueConsul.addEventListener('click', () => {
    problemInput.value = 'Я хочу записатися на консультацію.';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});

// fixed_header
const header = document.getElementById("scrolled");

window.addEventListener("scroll", () => {
    if (window.scrollY > 150) {
        header.classList.add("scrolled");
    } else {
        header.classList.remove("scrolled");
    }
});

// phone_macket
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
