<?php
// Підключення до БД — повторити як у admin.php
$host = 'localhost';
$db   = 'cpbNOVO';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true, // Додано для роботи з BLOB
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Помилка підключення до БД: ' . $e->getMessage());
}

function getEvent($pdo, $table) {
    $stmt = $pdo->query("SELECT * FROM $table WHERE id=1");
    return $stmt->fetch();
}

$mainEvent = getEvent($pdo, 'main_event');
$sliderEvents = [
    getEvent($pdo, 'event_slider_first'),
    getEvent($pdo, 'event_slider_second'),
    getEvent($pdo, 'event_slider_third'),
    getEvent($pdo, 'event_slider_fourth'),
];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- SEO -->
    <meta name="description" content="Центр Підтримки Бізнесу NOVO — допомога підприємцям, консультації, ресурси для розвитку малого і середнього бізнесу. Новини та події ЦПБ NOVO" />
    <meta name="keywords" content="підприємництво, підтримка бізнесу, ЦПБ, консультації, стартапи, бізнес Україна, як відкрити бізнес, Новини та події ЦПБ NOVO" />
    <meta name="author" content="Predko Viktor" />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../Assets/icon/logo.png">
    <!-- Title -->
    <title>Новини та Події від ЦПБ NOVO</title>
    <!-- Шрифти -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../Css/event.css" />
    <!-- Glide.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.theme.min.css"> </head>

<body>
    <div class="decor"></div>
    <div class="decor1"></div>
    <div class="decor2"></div>
    <div class="decor3"></div>
    <div class="container">
        <!--       NAVIGATION!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
        <header id="header">
            <nav id="scrolled">
                <div class="nav_inner">
                   <a href="../main.html">
                    <div class="logo"><img src="../Assets/icon/logo.png" alt="///">
                        <div class="logo_text"> <span>NOVO</span>
                            <p>Центр Підтримки Бізнесу</p>
                        </div>
                    </div>
                    </a>
                    <div class="nav_links">
                        <p class="change_lang">UA</p>
                        <p class="change_lang">EN</p>
                        <div class="burger_menu" id="burger_menu"> <span></span> <span></span> <span></span> </div>
                    </div>
                </div>
            </nav>
            <div class="drop_burger_links" id="drop_burger_links">
            <a href="../main.html" class="drop_burger">Головна</a> 
            <a href="orenda.html" class="drop_burger">Оренда Простору</a> 
            <a href="#" class="drop_burger" id="nav_to_form_scroll">Форма Зв`язку</a> 
            </div>
        </header>
        <h1>Новини Та Події Від ЦПБ <span>NOVO</span></h1>
        <a href="../main.html">
            <h3 class="home_link">Головна</h3></a>
        <!--        main_event!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
        <section class="main_event"> <a href="main_event.html"> <?php if (!empty($mainEvent['image'])): ?>
        <?php
        // Визначення MIME-типу зображення з BLOB даних
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->buffer($mainEvent['image']);

        // Перевіряємо, чи це дійсно зображення перед відображенням
        if (strpos($mime_type, 'image/') === 0):
        ?>
            <img class="main_event_img" src="data:<?=htmlspecialchars($mime_type)?>;base64,<?=base64_encode($mainEvent['image'])?>" alt="Головна подія" />
        <?php else: ?>
            <p>Зображення головної події недоступне або пошкоджене.</p>
        <?php endif; ?>
    <?php endif; ?></a>
            <div class="main_event_info">
                <h2 class="main_event_title"><?=htmlspecialchars($mainEvent['title'] ?? '')?></h2>
                <div class="main_event_description">
                    <a href="main_event.html"> <p class="main_event_more">Більше</p></a>
                    <div class="main_event_tags">
                        <div id="main_event_date"><?=htmlspecialchars($mainEvent['date'] ?? '')?></div>
                        <div id="main_event_time"><?=htmlspecialchars($mainEvent['time'] ?? '')?></div>
                    </div>
                </div>
            </div>
            <div id="event">Подія</div>
        </section>
        
<!--        SLIDER EVENT-->
        <section class="slider_news glide">
            <div class="glide__track" data-glide-el="track">
                <div class="glide__slides">
    <?php foreach ($sliderEvents as $event): 
        if (!$event) continue;

        $title = htmlspecialchars($event['title'] ?? '');
        $date = htmlspecialchars($event['date'] ?? '');
        $insta = htmlspecialchars($event['insta_link'] ?? '#');
        $tagText = htmlspecialchars($event['tag'] ?? '');

        // Визначення id для стилю: новина чи подія
        $tagId = (mb_strtolower($tagText) === 'новина') ? 'news' : 'event';

        // Перевірка зображення
        $imageHtml = '';
        if (!empty($event['image'])) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime_type = $finfo->buffer($event['image']);

            if (strpos($mime_type, 'image/') === 0) {
                $base64 = base64_encode($event['image']);
                $imageHtml = '<img src="data:' . htmlspecialchars($mime_type) . ';base64,' . $base64 . '" alt="' . $title . '" class="slider_news_img">';
            } else {
                $imageHtml = '<p>Зображення недоступне</p>';
            }
        }
    ?>
    <div class="glide__slide">
        <?= $imageHtml ?>
        <div class="slider_news_info">
            <h2 class="slider_news_title"><?= $title ?></h2>
            <div class="slider_news_description">
                <p class="slider_news_more">
                    <a href="<?= $insta ?>" target="_blank">Переглянути в Instagram</a>
                </p>
                <div class="slider_news_tags">
                    <div id="slider_news_date"><?= $date ?></div>
                </div>
            </div>
        </div>
        <div id="<?= $tagId ?>"><?= $tagText ?></div>
    </div>
    <?php endforeach; ?>
</div>

<div class="event_slider glide__bullets" data-glide-el="controls[nav]">
    <?php for ($i = 0; $i < count($sliderEvents); $i++): ?>
        <span class="glide__bullet" data-glide-dir="=<?= $i ?>"></span>
    <?php endfor; ?>
</div>

        </div>


        </section>
        <!--            record!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
        <section class="record" id="record">
            <div class="record_dot">
                <div class="lined_dot_record">
                    <div class="record_point"> <img src="../Assets/icon/record_icon.png" alt="" class="team_img"> </div>
                </div>
            </div>
            <aside class="record_form block" id="record_form">
                <div class="record_form_text">
                    <p class="record_form_txt"> Є питання? </p>
                    <h2 class="record_form_title">
                        Записуйтесь на консултацію від Центру <span>NOVO</span>
                    </h2> </div>
                <form method="post" id="contactForm">
                    <div class="record_form_inputs">
                        <div class="main_input">
                            <input id="problem_input" type="text" name="problem" placeholder="Опишіть проблему одним реченням..." class="problem_input" name="problem" maxlength="100" required> <img src="../Assets/icon/input_img.png" alt=","> </div>
                        <div class="information_inputs">
                            <input type="text" placeholder="Ім`я" class="information_input" name="name" required>
                            <input type="text" placeholder="Призвіще" class="information_input" name="surname" required>
                            <input type="tel" placeholder="Номер Телефону" class="information_input" name="phone" minlength="10" maxlength="19" title="Формат: +380(__)_______" required> </div>
                    </div>
                    <button type="submit" class="send_btn"> Записатися </button>
                </form>
            </aside>
            <aside class="record_form_sesuccess hidden" id="record_form_sesuccess">
                <div class="record_form_text">
                    <p class="record_form_txt  "> Дякуємо. </p>
                    <p class="record_form_txt"> Ось ось з вами зв`яжуться...</p>
                </div> <img src="../Assets/img/logo_dark.png" alt="" class="success_logo">
                <div class="contacts">
                    <div class="phone_contact">
                        <svg width="40" height="40" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                        <p>+380 (63) 435 56 56</p>
                    </div>
                    <div class="social">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="40px" height="40px">
                            <path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z" /> </svg>
                    </div>
                    <div class="social">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="40px" height="40px">
                            <path d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z" /> </svg>
                    </div>
                    <div class="social">
                        <svg fill="#000000" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 512 512" xml:space="preserve">
                            <g id="7935ec95c421cee6d86eb22ecd125aef">
                                <path style="display: inline; fill-rule: evenodd; clip-rule: evenodd;" d="M116.504,500.219V170.654H6.975v329.564H116.504
		L116.504,500.219z M61.751,125.674c38.183,0,61.968-25.328,61.968-56.953c-0.722-32.328-23.785-56.941-61.252-56.941
		C24.994,11.781,0.5,36.394,0.5,68.722c0,31.625,23.772,56.953,60.53,56.953H61.751L61.751,125.674z M177.124,500.219
		c0,0,1.437-298.643,0-329.564H286.67v47.794h-0.727c14.404-22.49,40.354-55.533,99.44-55.533
		c72.085,0,126.116,47.103,126.116,148.333v188.971H401.971V323.912c0-44.301-15.848-74.531-55.497-74.531
		c-30.254,0-48.284,20.38-56.202,40.08c-2.897,7.012-3.602,16.861-3.602,26.711v184.047H177.124L177.124,500.219z"> </path>
                            </g>
                        </svg>
                    </div>
                    <div class="social">
                        <svg width="40" height="40" viewBox="0 0 44 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="telega_record" d="M43.1537 1.04988C42.4037 0.413881 41.2257 0.322881 40.0077 0.811881H40.0057C38.7247 1.32588 3.74468 16.3299 2.32068 16.9429C2.06168 17.0329 -0.200322 17.8769 0.032678 19.7569C0.240678 21.4519 2.05868 22.1539 2.28068 22.2349L11.1737 25.2799C11.7637 27.2439 13.9387 34.4899 14.4197 36.0379C14.7197 37.0029 15.2087 38.2709 16.0657 38.5319C16.8177 38.8219 17.5657 38.5569 18.0497 38.1769L23.4867 33.1339L32.2637 39.9789L32.4727 40.1039C33.0687 40.3679 33.6397 40.4999 34.1847 40.4999C34.6057 40.4999 35.0097 40.4209 35.3957 40.2629C36.7107 39.7229 37.2367 38.4699 37.2917 38.3279L43.8477 4.25088C44.2477 2.43088 43.6917 1.50488 43.1537 1.04988ZM19.0167 26.4979L16.0167 34.4979L13.0167 24.4979L36.0167 7.49788L19.0167 26.4979Z" fill="black" /> </svg>
                    </div>
                </div>
            </aside>
        </section>
        <footer>
            <div class="nav_inner">
                <div class="logo"> <img src="../Assets/icon/logo.png" alt="///">
                    <div class="logo_text"> <span>NOVO</span>
                        <p>Центр Підтримки Бізнесу</p>
                    </div>
                </div>
                <div class="nav_links">
                    <a href="#">
                        <svg fill="#000000" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50px" height="50px" viewBox="0 0 512 512" xml:space="preserve">
                            <g id="7935ec95c421cee6d86eb22ecd125aef">
                                <path style="display: inline; fill-rule: evenodd; clip-rule: evenodd;" d="M116.504,500.219V170.654H6.975v329.564H116.504
		L116.504,500.219z M61.751,125.674c38.183,0,61.968-25.328,61.968-56.953c-0.722-32.328-23.785-56.941-61.252-56.941
		C24.994,11.781,0.5,36.394,0.5,68.722c0,31.625,23.772,56.953,60.53,56.953H61.751L61.751,125.674z M177.124,500.219
		c0,0,1.437-298.643,0-329.564H286.67v47.794h-0.727c14.404-22.49,40.354-55.533,99.44-55.533
		c72.085,0,126.116,47.103,126.116,148.333v188.971H401.971V323.912c0-44.301-15.848-74.531-55.497-74.531
		c-30.254,0-48.284,20.38-56.202,40.08c-2.897,7.012-3.602,16.861-3.602,26.711v184.047H177.124L177.124,500.219z"> </path>
                            </g>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/share/19snic6veW/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px">
                            <path d="M32,11h5c0.552,0,1-0.448,1-1V3.263c0-0.524-0.403-0.96-0.925-0.997C35.484,2.153,32.376,2,30.141,2C24,2,20,5.68,20,12.368 V19h-7c-0.552,0-1,0.448-1,1v7c0,0.552,0.448,1,1,1h7v19c0,0.552,0.448,1,1,1h7c0.552,0,1-0.448,1-1V28h7.222 c0.51,0,0.938-0.383,0.994-0.89l0.778-7C38.06,19.518,37.596,19,37,19h-8v-5C29,12.343,30.343,11,32,11z" /> </svg>
                    </a>
                    <a href="https://www.instagram.com/bsc_novo?igsh=MTJwYnZiczEyeDVzMA%3D%3D&utm_source=qr" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50px" height="50px">
                            <path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z" /> </svg>
                    </a>
                    <a href="https://t.me/pidtrymka_business" target="_blank" rel="noopener noreferrer">
                        <svg width="44" height="41" viewBox="0 0 44 41" fill="none" xmlns="http://www.w3.org/2000/svg" id="telegram_svg">
                            <path d="M43.1537 1.04988C42.4037 0.413881 41.2257 0.322881 40.0077 0.811881H40.0057C38.7247 1.32588 3.74468 16.3299 2.32068 16.9429C2.06168 17.0329 -0.200322 17.8769 0.032678 19.7569C0.240678 21.4519 2.05868 22.1539 2.28068 22.2349L11.1737 25.2799C11.7637 27.2439 13.9387 34.4899 14.4197 36.0379C14.7197 37.0029 15.2087 38.2709 16.0657 38.5319C16.8177 38.8219 17.5657 38.5569 18.0497 38.1769L23.4867 33.1339L32.2637 39.9789L32.4727 40.1039C33.0687 40.3679 33.6397 40.4999 34.1847 40.4999C34.6057 40.4999 35.0097 40.4209 35.3957 40.2629C36.7107 39.7229 37.2367 38.4699 37.2917 38.3279L43.8477 4.25088C44.2477 2.43088 43.6917 1.50488 43.1537 1.04988ZM19.0167 26.4979L16.0167 34.4979L13.0167 24.4979L36.0167 7.49788L19.0167 26.4979Z" fill="black" /> </svg>
                    </a>
                </div>
            </div>
        </footer>
        
        <div class="menu_mobile_service">
            <div class="active_btn_consule_mobile hidden" id="fah_consul_mobile">
                <div class="consul_inner_mobile">
                    <div class="consul_inner_mobile">
                        <h2 class="consul_inner_title_mobile">Фахові Консультації</h2>
                        <div class="consul_inner_info">
                            <p class="consul_inner_text_mobile"> Отримуйте фахові консультації з ведення <b style="font-size: 16px; font-weight: 500"> бізнесу, бухгалтерії, маркетингу, юриспруденції та грантового фінансування.</b> Наші експерти допоможуть вам правильно вести фінансову звітність, оптимізувати податки, уникати ризиків, ефективно просувати бізнес у соціальних мережах, залучати клієнтів та розширювати діяльність. </p>
                            <div class="consul_inner_connect_info_mobile">
                                <button class="go_to_form_btn_mobile" id="put_value_in_form_concul_mobile">Записатися на Консультацію</button>
                                <div class="consul_inner_img_mobile">
                                    <a href="tel:+380935469097">
                                        <svg width="20" height="20" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="active_btn_contact_mobile hidden" id="contact_mobile">
                <div class="active_btn_contact_inner_mobile ">
                    <h2 class="contact_inner_title_mobile">Контакти</h2>
                    <div class="contact_inner_mobile">
                        <a href="https://www.google.com.ua/maps/place/%D0%BF%D1%80%D0%BE%D0%B2%D1%83%D0%BB%D0%BE%D0%BA+%D0%9F%D0%BE%D1%88%D1%82%D0%BE%D0%B2%D0%B8%D0%B9,+%D0%9D%D0%BE%D0%B2%D0%BE%D0%B2%D0%BE%D0%BB%D0%B8%D0%BD%D1%81%D1%8C%D0%BA,+%D0%92%D0%BE%D0%BB%D0%B8%D0%BD%D1%81%D1%8C%D0%BA%D0%B0+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+45400/@50.7285902,24.160041,16.98z/data=!4m6!3m5!1s0x4724f3c6a71c8a55:0x745a225384ce9358!8m2!3d50.7285952!4d24.1626245!16s%2Fg%2F11_tk1ydg?entry=ttu&g_ep=EgoyMDI1MDQyNy4xIKXMDSoASAFQAw%3D%3D"><img src="../Assets/img/location.png" alt="" class="contact_location_img_mobile"></a>
                        <div class="contacts_mobile">
                            <div class="phone_contact_mobile">
                                <svg width="20" height="20" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                <a href="tel:+380935469097">
                                    <p>+380 (63) 435 56 56</p>
                                </a>
                            </div>
                            <div class="social_mobile">
                                <svg version="1.1" id="location_mobile_contact" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
                                    <style type="text/css">
                                        .st2 {
                                            fill: none;
                                            stroke: #000;
                                            stroke-width: 1;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-miterlimit: 10;
                                            width: 25px;
                                            height: 25px;
                                        }
                                    </style>
                                    <path class="st2" d="M24,10.9c0,7-8,13.1-8,13.1s-8-6.1-8-13.1C8,6.5,11.6,3,16,3S24,6.5,24,10.9z" />
                                    <circle class="st2" cx="16" cy="11" r="2" />
                                    <polyline class="st2" points="19.2,21 25,21 29,29 3,29 7,21 12.8,21 " /> </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="active_btn_study_mobile hidden" id="study_mobile">
                <div class="study_action_inner_mobile">
                    <h2 class="study_inner_title_mobile">Навчання</h2>
                    <div class="study_inner_mobile">
                        <p class="study_inner_text_mobile"> Розширюйте свої знання та вдосконалюйте навички завдяки нашим <b style="font-size: 16px; font-weight: 500"> лекціям, тренінгам та майстер-класам.</b> Ми залучаємо провідних експертів, які діляться актуальними кейсами та практичними рішеннями. Ви отримаєте корисні інструменти для ведення бізнесу, маркетингу, фінансів та інших сфер. </p>
                        <div class="study_inner_connect_info_mobile">
                            <a href="https://www.instagram.com/bsc_novo?igsh=MTJwYnZiczEyeDVzMA%3D%3D&utm_source=qr" target="_blank" rel="noopener noreferrer">
                                <button class="go_to_form_btn">Будьте в курсі наступних навчань</button>
                            </a>
                            <div class="study_inner_img_mobile">
                                <a href="https://www.instagram.com/bsc_novo?igsh=MTJwYnZiczEyeDVzMA%3D%3D&utm_source=qr" target="_blank" rel="noopener noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="25px" height="25px">
                                        <path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z" /> </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="active_btn_key_mobile hidden" id="key_mobile">
                <!--                   -->
                <div class="key_more_slider_mobile glide_key_more_mobile">
                    <div class="key_more_inner_mobile glide__track" data-glide-el="track">
                        <div class="key_more_slides_mobile glide__slides">
                            <div class="key_more_slide_mobile glide__slide">
                                <div class="key_action_inner_mobile">
                                    <h2 class="key_inner_title_mobile">Створення та налаштування облікових записів</h2>
                                    <div class="key_inner_mobile">
                                        <p class="key_inner_text_mobile" style="font-size: 18px"> Створення та налаштування облікових записів <b style="font-size: 20px; font-weight: 500">Запускаємо ваш бренд у соціальних мережах з нуля: </b> професійно оформлюємо профілі, налаштовуємо функціонал і оптимізуємо сторінки для максимального залучення аудиторії. </p>
                                        <div class="key_inner_connect_info_mobile">
                                            <button class="go_to_form_btn" id="put_value_in_form_smm" data-name="smmMobile">Зв`язатися для співпраці</button>
                                            <div class="key_inner_img_mobile">
                                                <a href="tel:+380935469097">
                                                    <svg width="44" height="43" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="key_more_slide_mobile glide__slide">
                                <div class="key_action_inner_mobile">
                                    <h2 class="key_inner_title_mobile">Розробка контент стратегії</h2>
                                    <div class="key_inner_mobile">
                                        <p class="key_inner_text_mobile"> <b style="font-size: 20px; font-weight: 500">Формуємо унікальний план публікацій</b>,який відображає ДНК вашого бренду та відповідає запитам і поведінці цільової аудиторії. </p>
                                        <div class="key_inner_connect_info_mobile">
                                            <button class="go_to_form_btn" id="put_value_in_form_content_strategy" data-name="strategyMobile">Зв`язатися для співпраці</button>
                                            <div class="key_inner_img_mobile">
                                                <a href="tel:+380935469097">
                                                    <svg width="44" height="43" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="key_more_slide_mobile glide__slide">
                                <div class="key_action_inner_mobile">
                                    <h2 class="key_inner_title_mobile">Створення контенту</h2>
                                    <div class="key_inner_mobile">
                                        <p class="key_inner_text_mobile"> <b style="font-size: 20px; font-weight: 500">Генеруємо якісний візуальний і текстовий контент</b> — від гармонійного оформлення профілю до креативних публікацій. За потреби — працюємо з дизайнерами, копірайтерами та стилістами.</p>
                                        <div class="key_inner_connect_info_mobile">
                                            <button class="go_to_form_btn" id="put_value_in_form_create_content" data-name="createMobile">Зв`язатися для співпраці</button>
                                            <div class="key_inner_img_mobile">
                                                <a href="tel:+380935469097">
                                                    <svg width="44" height="43" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="key_more_slide_mobile glide__slide">
                                <div class="key_action_inner_mobile">
                                    <h2 class="key_inner_title_mobile">Фото - та відеозйомка</h2>
                                    <div class="key_inner_mobile">
                                        <p class="key_inner_text_mobile"> <b style="font-size: 20px; font-weight: 500">Організовуємо професійну зйомку подій, рекламних роликів і промоматеріалів.</b></p>
                                        <div class="key_inner_connect_info_mobile">
                                            <button class="go_to_form_btn" id="put_value_in_form_filming" data-name="filmingMobile">Зв`язатися для співпраці</button>
                                            <div class="key_inner_img_mobile">
                                                <a href="tel:+380935469097">
                                                    <svg width="44" height="43" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="key_more_slide_mobile glide__slide">
                                <div class="key_action_inner_mobile">
                                    <h2 class="key_inner_title_mobile">Організація подій “під ключ”</h2>
                                    <div class="key_inner_mobile">
                                        <p class="key_inner_text_mobile"> <b style="font-size: 20px; font-weight: 500">Від ідеї до реалізації:</b> створюємо концепцію, координуємо підрядників, продумуємо логістику, створюємо атмосферу.</p>
                                        <div class="key_inner_connect_info_mobile">
                                            <button class="go_to_form_btn" id="put_value_in_form_organization" data-name="organizationMobile">Зв`язатися для співпраці</button>
                                            <div class="key_inner_img_mobile">
                                                <a href="tel:+380935469097">
                                                    <svg width="44" height="43" viewBox="0 0 44 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M28.3316 2.55263C31.5558 2.91082 34.4573 4.47067 36.7527 6.76315C39.048 9.05563 40.6009 11.9604 40.9632 15.1842M27.279 9.92104C28.831 10.2238 30.3714 10.9082 31.4895 12.0263C32.6076 13.1444 33.292 14.6849 33.5948 16.2368M14.0169 29.4979C-0.505182 14.9741 1.55983 8.32346 3.09071 6.18033C3.28736 5.83393 8.13475 -1.42236 13.3308 2.83488C26.2281 13.4567 10.4369 13.0789 20.7304 22.7869C31.0238 32.4949 30.0609 17.2894 40.6809 30.184C44.9384 35.3821 37.6817 40.2292 37.3375 40.4237C35.1944 41.9568 28.5411 44.0216 14.0169 29.4979Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /> </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="key_slider_mobile glide__bullets" data-glide-el="controls[nav]"> <span class="glide__bullet" data-glide-dir="=0"></span> <span class="glide__bullet" data-glide-dir="=1"></span> <span class="glide__bullet" data-glide-dir="=2"></span> <span class="glide__bullet" data-glide-dir="=3"></span> <span class="glide__bullet" data-glide-dir="=4"></span> </div>
                    </div>
                </div>
            </div>
            <div class="menu_mobile_nav glide_mobile">
                <div class="menu_mobile_wraper_nav glide__track" data-glide-el="track">
                    <div class="menu_mobile_items_nav glide__slides">
                        <div class="menu_mobile_item glide__slide" id="key_open_more">Під ключ</div>
                        <div class="menu_mobile_item glide__slide" id="contact_open_more">Контакти</div>
                        <div class="menu_mobile_item glide__slide" id="fah_consul_open_more">Фахові Консультації</div>
                        <div class="menu_mobile_item glide__slide" id="home">
                           <a href="../main.html"> <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5192 7.82274C2 8.77128 2 9.91549 2 12.2039V13.725C2 17.6258 2 19.5763 3.17157 20.7881C4.34315 22 6.22876 22 10 22H14C17.7712 22 19.6569 22 20.8284 20.7881C22 19.5763 22 17.6258 22 13.725V12.2039C22 9.91549 22 8.77128 21.4808 7.82274C20.9616 6.87421 20.0131 6.28551 18.116 5.10812L16.116 3.86687C14.1106 2.62229 13.1079 2 12 2C10.8921 2 9.88939 2.62229 7.88403 3.86687L5.88403 5.10813C3.98695 6.28551 3.0384 6.87421 2.5192 7.82274ZM11.25 18C11.25 18.4142 11.5858 18.75 12 18.75C12.4142 18.75 12.75 18.4142 12.75 18V15C12.75 14.5858 12.4142 14.25 12 14.25C11.5858 14.25 11.25 14.5858 11.25 15V18Z" fill="#ffffff" /> </svg> </a>
                        </div>
                        <div class="menu_mobile_item glide__slide hidden" id="back_consul">
                            <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                                <path id="XMLID_27_" d="M15,180h263.787l-49.394,49.394c-5.858,5.857-5.858,15.355,0,21.213C232.322,253.535,236.161,255,240,255
	s7.678-1.465,10.606-4.394l75-75c5.858-5.857,5.858-15.355,0-21.213l-75-75c-5.857-5.857-15.355-5.857-21.213,0
	c-5.858,5.857-5.858,15.355,0,21.213L278.787,150H15c-8.284,0-15,6.716-15,15S6.716,180,15,180z" /> </svg>
                        </div>
                        <div class="menu_mobile_item glide__slide"><a href="../main.html">Головна</a></div>
                        <div class="menu_mobile_item glide__slide"> <a href="/Html/orenda.html">Оренда Простору</a></div>
                        <div class="menu_mobile_item glide__slide" id="study_open_more">Навчання</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script src="../js/event.js"></script>
    <script src="../js/sliderEvent.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('contactForm');
            const messageBox = document.getElementById('record_form');
            const changeBox = document.getElementById('record_form_sesuccess');
            form.addEventListener('submit', (e) => {
                e.preventDefault(); // Зупиняє стандартне відправлення форми
                const formData = new FormData(form);
                fetch('../main.php', {
                    method: 'POST'
                    , body: formData
                }).then(res => res.json()).then(data => {
                    if (data.ok) {
                        messageBox.classList.remove('block');
                        messageBox.classList.add('hidden');
                        changeBox.classList.remove("hidden");
                        changeBox.classList.add("block");
                    }
                    else {
                        // Якщо є якась помилка на сервері
                        messageBox.classList.toggle('block');
                    }
                }).catch(() => {
                    messageBox.classList.add('block');
                    messageBox.textContent = '❌ Сталася помилка.';
                });
            });
        });
    </script>
</body>

</html>