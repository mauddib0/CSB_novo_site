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
        }, 400); // 0.5 секунди — приблизна тривалість скролу
    } else {
        burgerMenu.classList.toggle('active_burger');
        dropNav.classList.toggle('active_drop_burger_links');
    }  
});


// fixed_header
const header = document.getElementById("scrolled");

window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
        header.classList.add("scrolled");
    } else {
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

//CONFERENS HALL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

//Активний блок вибору оренди конфернес зала
const confHall = document.getElementById("orenda_item_confHall");
const bronHall = document.getElementById("orenda_btn_bron_confHall");
const moreConfHall = document.getElementById("more_confHall");
const lessConfHall = document.getElementById('less_confHall');
//тут назву не змінюємо бо від цього нічого не залежить
const moreAboutConfHall = document.getElementById("more_about_confHall");


moreConfHall.addEventListener('click',() =>{
    moreConfHall.classList.toggle('hidden');
    moreAboutConfHall.classList.remove('hidden');
    bronHall.classList.remove('hidden');
    confHall.classList.add('orenda_item_active');
});

lessConfHall.addEventListener('click',() =>{
    moreConfHall.classList.remove('hidden');
    moreAboutConfHall.classList.add('hidden');
    bronHall.classList.add('hidden');
    confHall.classList.remove('orenda_item_active');
});


//Встановлення в інпути відповідних значень оренди конференс зали

const problemInput = document.getElementById("problem_input");
const confHallButton = document.getElementById("orenda_btn_bron_confHall");

confHallButton.addEventListener('click', () => {
    problemInput.value = 'Я хочу забронювати конференс залу.';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});

//натискання поміж блоку все ховається

document.addEventListener('click', (e) => {
    if (!confHall.contains(e.target)) {
        moreConfHall.classList.remove('hidden');
        moreAboutConfHall.classList.add('hidden');
        bronHall.classList.add('hidden');
        confHall.classList.remove('orenda_item_active');
    }
});

//SPEAK ROOM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

const speakRoom = document.getElementById('orenda_item_speakRoom');
const bronSpeakRoom = document.getElementById('orenda_btn_bron_speakRoom');
const moreSpeakRoom = document.getElementById('more_speakRoom');
const lessSpeakRoom = document.getElementById('less_speakRoom');
const moreAboutSpeakRoom = document.getElementById('more_about_speakRoom');


moreSpeakRoom.addEventListener('click',() =>{
    moreSpeakRoom.classList.toggle('hidden');
    moreAboutSpeakRoom.classList.remove('hidden');
    bronSpeakRoom.classList.remove('hidden');
    speakRoom.classList.add('orenda_item_active');
});

lessSpeakRoom.addEventListener('click',() =>{
    moreSpeakRoom.classList.remove('hidden');
    moreAboutSpeakRoom.classList.add('hidden');
    bronSpeakRoom.classList.add('hidden');
    speakRoom.classList.remove('orenda_item_active');
});

//натискання поміж блоку все ховається

document.addEventListener('click', (e) => {
    if (!speakRoom.contains(e.target)) {
        moreSpeakRoom.classList.remove('hidden');
        moreAboutSpeakRoom.classList.add('hidden');
        bronSpeakRoom.classList.add('hidden');
        speakRoom.classList.remove('orenda_item_active');
    }
});

//Встановлення в інпути відповідних значень оренди переговорної кімнати
const speakRoomButton = document.getElementById("orenda_btn_bron_speakRoom");

speakRoomButton.addEventListener('click', () => {
    problemInput.value = 'Я хочу забронювати переговорну кімнату 1.';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});


//SPEAK ROOM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

const speakRoom2 = document.getElementById('orenda_item_speakRoom2');
const bronSpeakRoom2 = document.getElementById('orenda_btn_bron_speakRoom2');
const moreSpeakRoom2 = document.getElementById('more_speakRoom2');
const lessSpeakRoom2 = document.getElementById('less_speakRoom2');
const moreAboutSpeakRoom2 = document.getElementById('more_about_speakRoom2');


moreSpeakRoom2.addEventListener('click',() =>{
    moreSpeakRoom2.classList.toggle('hidden');
    moreAboutSpeakRoom2.classList.remove('hidden');
    bronSpeakRoom2.classList.remove('hidden');
    speakRoom2.classList.add('orenda_item_active');
});

lessSpeakRoom2.addEventListener('click',() =>{
    moreSpeakRoom2.classList.remove('hidden');
    moreAboutSpeakRoom2.classList.add('hidden');
    bronSpeakRoom2.classList.add('hidden');
    speakRoom2.classList.remove('orenda_item_active');
});

//натискання поміж блоку все ховається

document.addEventListener('click', (e) => {
    if (!speakRoom2.contains(e.target)) {
        moreSpeakRoom2.classList.remove('hidden');
        moreAboutSpeakRoom2.classList.add('hidden');
        bronSpeakRoom2.classList.add('hidden');
        speakRoom2.classList.remove('orenda_item_active');
    }
});

//Встановлення в інпути відповідних значень оренди переговорної кімнати
const speakRoomButton2 = document.getElementById("orenda_btn_bron_speakRoom2");

speakRoomButton2.addEventListener('click', () => {
    problemInput.value = 'Я хочу забронювати переговорну кімнату 2.';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});
//event ROOM!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

const eventRoom = document.getElementById('orenda_item_eventRoom');
const bronEventRoom = document.getElementById('orenda_btn_bron_eventRoom');
const moreEventRoom = document.getElementById('more_eventRoom');
const lessEventRoom = document.getElementById('less_eventRoom');
const moreAboutEventRoom = document.getElementById('more_about_eventRoom');


moreEventRoom.addEventListener('click',() =>{
    moreEventRoom.classList.toggle('hidden');
    moreAboutEventRoom.classList.remove('hidden');
    bronEventRoom.classList.remove('hidden');
    eventRoom.classList.add('orenda_item_active');
});

lessEventRoom.addEventListener('click',() =>{
    moreEventRoom.classList.remove('hidden');
    moreAboutEventRoom.classList.add('hidden');
    bronEventRoom.classList.add('hidden');
    eventRoom.classList.remove('orenda_item_active');
});

//натискання поміж блоку все ховається

document.addEventListener('click', (e) => {
    if (!eventRoom.contains(e.target)) {
        moreEventRoom.classList.remove('hidden');
        moreAboutEventRoom.classList.add('hidden');
        bronEventRoom.classList.add('hidden');
        eventRoom.classList.remove('orenda_item_active');
    }
});

//Встановлення в інпути відповідних значень оренди переговорної кімнати
const eventRoomButton = document.getElementById("orenda_btn_bron_eventRoom");

eventRoomButton.addEventListener('click', () => {
    problemInput.value = 'Я хочу забронювати подієвий майданчик.';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});

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
    const isClickOnToggler = e.target.closest('#fah_consul_open_more') || e.target.closest('#contact_open_more') || e.target.closest('#study_open_more') || e.target.closest('#back_consul') || e.target.closest('.glide__bullets') || e.target.closest('.glide__bullet') || e.target.closest('#home');
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
        BackBtnConsul.classList.add('hidden');
        BackBtnConsul.classList.remove('block');
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
