const glide_key = new Glide('.glide_key_more', {
  type: 'carusel',
  startAt: 0,
  perView: 1,
  gap:20,
  focusAt:'center',
  swipeThreshold:10,
  animationDuration:1000,
});
glide_key.mount();





///////////////////////
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
    } else {
        burgerMenu.classList.toggle('active_burger');
        dropNav.classList.toggle('active_drop_burger_links');
    }  
});

// consule_menu_open
const menu = document.getElementById("menu");
const activate_btn = document.getElementById("active_btn");
const active_consule = document.getElementById("active_consul");
const backPageArrow = document.getElementById("back_page_arrow_consul");

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

// Натискання на кнопку контакти

const active_contact = document.getElementById("active_contact");
const backPageArrowContact = document.getElementById("back_page_arrow_contact");
const contact_btn = document.getElementById("contact_btn");
const contactBurgerBtn = document.getElementById('contact_burger_btn');

contact_btn.addEventListener('click', () => {
    menu.classList.remove('block');
    menu.classList.add('hidden');
    active_contact.classList.remove('hidden');
    active_contact.classList.add('block');
});

contactBurgerBtn.addEventListener('click', () => {
    menu.classList.remove('block');
    menu.classList.add('hidden');
    active_contact.classList.remove('hidden');
    active_contact.classList.add('block');
    burgerMenu.classList.remove('active_burger');
    dropNav.classList.remove('active_drop_burger_links')
});

backPageArrowContact.addEventListener('click', () => {
    active_contact.classList.remove('block');
    active_contact.classList.add('hidden');
    menu.classList.remove('hidden');
    menu.classList.add('block');
});


// Натискання на кнопку навчання

const active_study = document.getElementById("active_study");
const study_btn = document.getElementById("study_btn");
const backPageArrowStudy = document.getElementById('back_page_arrow_study');

study_btn.addEventListener('click', () => {
    menu.classList.remove('block');
    menu.classList.add('hidden');
    active_study.classList.remove('hidden');
    active_study.classList.add('block');
});

backPageArrowStudy.addEventListener('click', () => {
    active_study.classList.remove('block');
    active_study.classList.add('hidden');
    menu.classList.remove('hidden');
    menu.classList.add('block');
});

/// Натискання на кнопку під ключ
const active_key = document.getElementById("active_key");
const key_btn = document.getElementById("key_btn");
const backPageArrowKey = document.getElementById('back_page_arrow_key');

key_btn.addEventListener('click', () => {
    menu.classList.remove('block');
    menu.classList.add('hidden');
    active_key.classList.remove('hidden');
    active_key.classList.add('block');
});

backPageArrowKey.addEventListener('click', () => {
    active_key.classList.remove('block');
    active_key.classList.add('hidden');
    menu.classList.remove('hidden');
    menu.classList.add('block');
});

// Натискання на кнопку більше про послуги під ключ
document.addEventListener('DOMContentLoaded', () => {
const openKeyService = document.getElementById('open_key_serv');
const backPageArrowKeyMore = document.getElementById('back_page_arrow_key_more');
const activeKeyMore = document.getElementById('active_key_more');

openKeyService.addEventListener('click', (e) => {
    e.preventDefault();
    active_key.classList.remove('block');
    active_key.classList.add('hidden');
    activeKeyMore.classList.remove('hidden');
    activeKeyMore.classList.add('block');
    glide_key.update();
    
});
    
backPageArrowKeyMore.addEventListener('click', () => {
    activeKeyMore.classList.remove('block');
    activeKeyMore.classList.add('hidden');
    active_key.classList.remove('hidden');
    active_key.classList.add('block');
});
});

// Заповнення форми під ключ
const formSMM = document.getElementById('put_value_in_form_smm');

formSMM.addEventListener('click', () => {
   problemInput.value = 'Створення та налаштування облікових записів';
   document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
   });
});

const formContentStrategy = document.getElementById('put_value_in_form_content_strategy');

formContentStrategy.addEventListener('click', () => {
   problemInput.value = 'Я хочу сформувати унікальний план публікацій';
   document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
   });
});

const formCreateContent = document.getElementById('put_value_in_form_create_content');

formCreateContent.addEventListener('click', () => {
    problemInput.value = 'Бажаю згенерувати якісьний контент';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});

const formFilming = document.getElementById('put_value_in_form_filming');

formFilming.addEventListener('click', () => {
    problemInput.value = 'Хочу скористатися послугою професійної відеозйомки';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
});

const formOrganization = document.getElementById('put_value_in_form_organization');

formOrganization.addEventListener('click', () => {
    problemInput.value = 'Менторство: Від ідеї до реалізації';
    document.getElementById('record_form').scrollIntoView({
        behavior: 'smooth'
    });
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
    if (window.scrollY > 300) {
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
