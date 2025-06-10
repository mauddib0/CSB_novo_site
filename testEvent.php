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
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <title>Події</title>
    <style>
        /* Додамо стилі, щоб зображення не були занадто великими */
        #main-event img {
            max-width: 100%; /* Зображення займає всю доступну ширину контейнера */
            height: auto;    /* Зберігає пропорції */
            display: block;  /* Прибирає зайві пробіли */
            margin: 0 auto;  /* Центрує зображення */
        }
        .slider img {
            max-width: 100%;
            max-height: 200px; /* Обмеження висоти для слайдерів */
            width: auto;
            object-fit: contain; /* Зберігає пропорції та вміщує зображення */
        }
    </style>
</head>
<body>

<section id="main-event">
    <h2><?=htmlspecialchars($mainEvent['title'] ?? '')?></h2>
    <p><strong>Дата:</strong> <?=htmlspecialchars($mainEvent['date'] ?? '')?> <strong>Час:</strong> <?=htmlspecialchars($mainEvent['time'] ?? '')?></p>
    <?php if (!empty($mainEvent['image'])): ?>
        <?php
        // Визначення MIME-типу зображення з BLOB даних
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->buffer($mainEvent['image']);

        // Перевіряємо, чи це дійсно зображення перед відображенням
        if (strpos($mime_type, 'image/') === 0):
        ?>
            <img src="data:<?=htmlspecialchars($mime_type)?>;base64,<?=base64_encode($mainEvent['image'])?>" alt="Головна подія" />
        <?php else: ?>
            <p>Зображення головної події недоступне або пошкоджене.</p>
        <?php endif; ?>
    <?php endif; ?>
    <p><?=nl2br(htmlspecialchars($mainEvent['description'] ?? ''))?></p>
    <p><a href="<?=htmlspecialchars($mainEvent['reg_link'] ?? '#')?>" target="_blank">Реєстрація на подію</a></p>
</section>

<section id="event-slider">
    <h2>Події слайдера</h2>
    <div class="slider">
        <?php foreach ($sliderEvents as $event):
            if (!$event) continue; // Пропускаємо, якщо подія порожня
        ?>
            <article class="slide">
                <h3><?=htmlspecialchars($event['title'] ?? '')?></h3>
                <p><strong>Дата:</strong> <?=htmlspecialchars($event['date'] ?? '')?> | <strong>Тип:</strong> <?=htmlspecialchars($event['tag'] ?? '')?></p>
                <?php if (!empty($event['image'])): ?>
                    <?php
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mime_type = $finfo->buffer($event['image']);

                    if (strpos($mime_type, 'image/') === 0):
                    ?>
                        <img src="data:<?=htmlspecialchars($mime_type)?>;base64,<?=base64_encode($event['image'])?>" alt="<?=htmlspecialchars($event['title'] ?? 'Подія')?>" />
                    <?php else: ?>
                        <p>Зображення слайдера "<?=htmlspecialchars($event['title'] ?? 'Подія')?>" недоступне або пошкоджене.</p>
                    <?php endif; ?>
                <?php endif; ?>
                <p><a href="<?=htmlspecialchars($event['insta_link'] ?? '#')?>" target="_blank">Instagram пост</a></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>