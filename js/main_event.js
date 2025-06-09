const burgerMenu = document.getElementById("burger_menu");
const dropNav = document.getElementById("drop_burger_links");
burgerMenu.addEventListener('click', () => {
    if (window.scrollY > 300) {
        document.getElementById('header').scrollIntoView({
            behavior: 'smooth'
        });
        // Відкрити меню трохи з затримкою, щоб не перекрити скрол
        setTimeout(() => {
            burgerMenu.classList.toggle('active_burger');
            dropNav.classList.toggle('active_drop_burger_links');
        }, 500); // 0.5 секунди — приблизна тривалість скролу
    }
    else {
        burgerMenu.classList.toggle('active_burger');
        dropNav.classList.toggle('active_drop_burger_links');
    }
});
/// прикріплене меню до низу моібла
const glide_key_mobile = new Glide('.glide_key_more_mobile', {
    type: 'carusel'
    , startAt: 0
    , perView: 1
    , gap: 20
    , focusAt: 'center'
    , swipeThreshold: 10
    , animationDuration: 1000
    , keyboard: false
, });
glide_key_mobile.mount();
const glide_mobile = new Glide('.glide_mobile', {
    type: 'slider'
    , startAt: 3
    , perView: 2
    , gap: 10
    , focusAt: 'center'
    , swipeThreshold: 10
    , animationDuration: 700
    , touchRatio: 1
    , perTouch: false
    , bound: true
    , keyboard: false
, });
glide_mobile.mount();

function adjustMenu() {
    const menu = document.querySelector('.menu_mobile');
    if (!menu) return;
    // фактична висота видимої області екрану
    const vh = window.innerHeight;
    // висота самого меню (з padding-bottom / safe-area)
    const menuHeight = menu.getBoundingClientRect().height;
    // ставимо меню так, щоби воно завжди впритул до низу видимої частини екрану
    menu.style.top = (vh - menuHeight) + 'px';
}
window.addEventListener('resize', adjustMenu);
window.addEventListener('orientationchange', adjustMenu);
document.addEventListener('DOMContentLoaded', adjustMenu);
/////
///МОБІЛЬНІ КНОПКИ МЕНЮ
//Фахові консультації
const btnOpenedFah = document.getElementById("fah_consul_mobile");
const btnOpenFah = document.getElementById("fah_consul_open_more");
const HomeBtn = document.getElementById('home');
const BackBtnConsul = document.getElementById('back_consul');
btnOpenFah.addEventListener('click', () => {
    btnOpenedFah.classList.remove('hidden');
    btnOpenedFah.classList.add('block');
    HomeBtn.classList.add('hidden');
    BackBtnConsul.classList.remove('hidden');
    BackBtnConsul.classList.add('block');
    btnOpenFah.classList.add('hidden');
    glide_mobile.go('=2');
    glide_mobile.update();
});
BackBtnConsul.addEventListener('click', () => {
    btnOpenedFah.classList.add('hidden');
    btnOpenedFah.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenFah.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
});
const putValueConsulMobile = document.getElementById("put_value_in_form_concul_mobile");
putValueConsulMobile.addEventListener('click', () => {
    problemInput.value = 'Я хочу записатися на консультацію.';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
    HomeBtn.classList.remove('hidden');
    BackBtnConsul.classList.add('hidden');
    btnOpenedFah.classList.add('hidden');
    btnOpenedFah.classList.remove('block');
    btnOpenFah.classList.remove('hidden');
    glide_mobile.update();
});
///Контакти
const btnOpenedContact = document.getElementById('contact_mobile');
const btnOpenContact = document.getElementById('contact_open_more');
const navLinkOpenContact = document.getElementById('contact_burger_btn_mobile');
btnOpenContact.addEventListener('click', () => {
    btnOpenedContact.classList.remove('hidden');
    glide_mobile.update();
    btnOpenedContact.classList.add('block');
    HomeBtn.classList.add('hidden');
    BackBtnConsul.classList.remove('hidden');
    BackBtnConsul.classList.add('block');
    btnOpenContact.classList.add('hidden');
    glide_mobile.go('=2');
});
BackBtnConsul.addEventListener('click', () => {
    btnOpenedContact.classList.add('hidden');
    btnOpenedContact.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenContact.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
});
/// Навчання
const btnOpenStudy = document.getElementById('study_open_more');
const btnOpenedStudy = document.getElementById('study_mobile');
btnOpenStudy.addEventListener('click', () => {
    btnOpenedStudy.classList.remove('hidden');
    btnOpenedStudy.classList.add('block');
    HomeBtn.classList.add('hidden');
    BackBtnConsul.classList.remove('hidden');
    BackBtnConsul.classList.add('block');
    btnOpenStudy.classList.add('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
});
BackBtnConsul.addEventListener('click', () => {
    btnOpenedStudy.classList.add('hidden');
    btnOpenedStudy.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenStudy.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
});
document.addEventListener('click', function (e) {
    const isClickInsideMenu = e.target.closest('.menu_mobile_item');
    const isClickOnToggler = e.target.closest('#fah_consul_open_more') || e.target.closest('#contact_open_more') || e.target.closest('#study_open_more') || e.target.closest('#back_consul') || e.target.closest('.glide__bullets') || e.target.closest('.glide__bullet') || e.target.closest('.burger_menu') || e.target.closest('#home');
    // Якщо клік поза елементами меню та кнопками
    if (!isClickInsideMenu && !isClickOnToggler) {
        // Сховати все
        btnOpenedFah.classList.add('hidden');
        btnOpenedFah.classList.remove('block');
        btnOpenedContact.classList.add('hidden');
        btnOpenedContact.classList.remove('block');
        btnOpenedStudy.classList.add('hidden');
        btnOpenedStudy.classList.remove('block');
        btnOpenedKey.classList.add('hidden');
        btnOpenedKey.classList.remove('block');
//        BackBtnConsul.classList.add('hidden');
//        BackBtnConsul.classList.remove('block');
        btnOpenFah.classList.remove('hidden');
        btnOpenContact.classList.remove('hidden');
        btnOpenStudy.classList.remove('hidden');
        HomeBtn.classList.remove('hidden');
        btnOpenKey.classList.remove('hidden');
        glide_mobile.update();
        glide_mobile.go('=3');
    }
});
///Під ключ
const btnOpenKey = document.getElementById('key_open_more');
const btnOpenedKey = document.getElementById('key_mobile');
btnOpenKey.addEventListener('click', () => {
    btnOpenedKey.classList.remove('hidden');
    btnOpenedKey.classList.add('block');
    HomeBtn.classList.add('hidden');
    BackBtnConsul.classList.remove('hidden');
    BackBtnConsul.classList.add('block');
    btnOpenKey.classList.add('hidden');
    glide_mobile.update();
    glide_key_mobile.update();
    glide_mobile.go('=2');
});
BackBtnConsul.addEventListener('click', () => {
    btnOpenedKey.classList.add('hidden');
    btnOpenedKey.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenKey.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
});
////ВСАТВКА В ПОЛЯ ПІД КЛЮЧ ТЕЛЕФОНУ
const formSMMmobile = document.querySelector('[data-name="smmMobile"]');
formSMMmobile.addEventListener('click', () => {
    btnOpenedKey.classList.add('hidden');
    btnOpenedKey.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenKey.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
    problemInput.value = 'Створення та налаштування облікових записів';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});
const formStrategyMobile = document.querySelector('[data-name="strategyMobile"]');
formStrategyMobile.addEventListener('click', () => {
    btnOpenedKey.classList.add('hidden');
    btnOpenedKey.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenKey.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
    problemInput.value = 'Я хочу сформувати унікальний план публікацій';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});
const formCreateMobile = document.querySelector('[data-name="createMobile"]');
formCreateMobile.addEventListener('click', () => {
    btnOpenedKey.classList.add('hidden');
    btnOpenedKey.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenKey.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
    problemInput.value = 'Бажаю згенерувати якісний контент';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});
const formFilmingMobile = document.querySelector('[data-name="filmingMobile"]');
formFilmingMobile.addEventListener('click', () => {
    btnOpenedKey.classList.add('hidden');
    btnOpenedKey.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenKey.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
    problemInput.value = 'Бажаю згенерувати якісний контент';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});
const formOrganizationMobile = document.querySelector('[data-name="organizationMobile"]');
formOrganizationMobile.addEventListener('click', () => {
    btnOpenedKey.classList.add('hidden');
    btnOpenedKey.classList.remove('block');
    HomeBtn.classList.remove('hidden')
    BackBtnConsul.classList.add('hidden');
    btnOpenKey.classList.remove('hidden');
    glide_mobile.update();
    glide_mobile.go('=3');
    problemInput.value = 'Менторство: Від ідеї до реалізації';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});
// fixed_header
const header = document.getElementById("scrolled");
window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
        header.classList.add("scrolled");
    }
    else {
        header.classList.remove("scrolled");
    }
});
//scroll
const navToFormScroll = document.getElementById('nav_to_form_scroll');
navToFormScroll.addEventListener('click', () => {
    burgerMenu.classList.toggle('active_burger');
    dropNav.classList.toggle('active_drop_burger_links');
    document.getElementById('record').scrollIntoView({
        behavior: 'smooth'
    });
});
// phone_macket
document.addEventListener('DOMContentLoaded', () => {
    const phoneInput = document.querySelector('input[name="phone"]');
    const form = phoneInput.closest('form');
    const PREFIX = '+380 ';
    // Встановлюємо префікс, якщо не встановлено
    if (!phoneInput.value.startsWith(PREFIX)) {
        phoneInput.value = "Номер телефону";
    }
    // Маска
    phoneInput.addEventListener('input', () => {
        let digits = phoneInput.value.replace(/\D/g, '');
        if (digits.startsWith('380')) digits = digits.slice(3);
        digits = digits.slice(0, 9);
        phoneInput.value = PREFIX + digits;
    });
    // Заборона стирати префікс
    phoneInput.addEventListener('keydown', (e) => {
        if (phoneInput.selectionStart <= PREFIX.length && ['Backspace', 'Delete'].includes(e.key)) {
            e.preventDefault();
        }
    });
    // Заборона на нецифри
    phoneInput.addEventListener('keypress', (e) => {
        if (!/[0-9]/.test(e.key)) {
            e.preventDefault();
        }
    });
    // Найнадійніше блокування submit
    form.addEventListener('submit', (e) => {
        const digits = phoneInput.value.slice(PREFIX.length).replace(/\D/g, '');
        if (digits.length !== 9) {
            e.preventDefault(); // Блокує стандартний сабміт
            e.stopImmediatePropagation(); // Блокує всі інші сабміт-слухачі
            console.warn('Форма НЕ відправлена. Неправильний номер телефону.');
            alert('Будь ласка, введіть повний номер телефону (9 цифр після +380)');
            return false;
        }
    });
});