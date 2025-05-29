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
    document.getElementById('record').scrollIntoView({
        behavior: 'smooth'
    });
});

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
