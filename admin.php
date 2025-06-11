<?php
// Параметри підключення до БД
$host = 'localhost';
$db   = 'cpbNOVO';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Підключення через PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Налаштування для роботи з BLOB
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true, // Це може бути корисним для BLOB
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Помилка підключення до БД: ' . $e->getMessage());
}

/**
 * Функція для підготовки даних зображення для BLOB.
 * Повертає вміст файлу або null, якщо файл не завантажено або виникла помилка.
 *
 * @param string $inputName Назва поля input type="file"
 * @return string|null Вміст файлу зображення (бінарні дані) або null
 */
function prepareImageForBlob($inputName) {
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$inputName]['tmp_name'];
        // Перевірка розміру файлу, щоб уникнути перевищення memory_limit
        if ($_FILES[$inputName]['size'] > 0 && $_FILES[$inputName]['size'] <= (10 * 1024 * 1024)) { // Приклад: до 10 MB
            $imageData = file_get_contents($fileTmpPath);
            if ($imageData !== false) {
                return $imageData;
            } else {
                error_log("Failed to read image file from " . $fileTmpPath);
                return null;
            }
        } else {
            error_log("Image file is too large or empty. Size: " . $_FILES[$inputName]['size']);
            return null;
        }
    } elseif (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] !== UPLOAD_ERR_NO_FILE) {
        // Логуємо інші помилки завантаження, крім "файл не обрано"
        error_log("File upload error for " . $inputName . ": " . $_FILES[$inputName]['error']);
    }
    return null; // Повертаємо null, якщо файл не обрано або виникла помилка
}


// Обробка форм
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type'])) {
    $formType = $_POST['form_type'];

    // Визначаємо таблицю, поля та обробляємо дані для кожної форми
    switch ($formType) {
        case 'main_event':
            $title = $_POST['title'] ?? '';
            $date = $_POST['date'] ?? '';
            $time = $_POST['time'] ?? '';
            $description = $_POST['description'] ?? '';
            $reg_link = $_POST['reg_link'] ?? '';

            // Отримуємо BLOB дані зображення
            $imageData = prepareImageForBlob('image');

            // Якщо нове фото завантажено, використовуємо його. Інакше, підтягуємо старе.
            if ($imageData === null) {
                $stmt = $pdo->query("SELECT image FROM main_event WHERE id=1");
                $row = $stmt->fetch();
                $imageData = $row ? $row['image'] : null; // Залишаємо null, якщо немає ні нового, ні старого
            }

            // Перевірка, чи існує запис
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM main_event WHERE id=1");
            $stmt->execute();
            $exists = $stmt->fetchColumn() > 0;

            if ($exists) {
                $sql = "UPDATE main_event SET title=?, date=?, time=?, image=?, description=?, reg_link=? WHERE id=1";
                $stmt = $pdo->prepare($sql);
                // Для BLOB даних використовуємо PDO::PARAM_LOB
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $date);
                $stmt->bindParam(3, $time);
                $stmt->bindParam(4, $imageData, PDO::PARAM_LOB); // Зміна тут
                $stmt->bindParam(5, $description);
                $stmt->bindParam(6, $reg_link);
                $stmt->execute();
            } else {
                $sql = "INSERT INTO main_event (id, title, date, time, image, description, reg_link) VALUES (1,?,?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                // Для BLOB даних використовуємо PDO::PARAM_LOB
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $date);
                $stmt->bindParam(3, $time);
                $stmt->bindParam(4, $imageData, PDO::PARAM_LOB); // Зміна тут
                $stmt->bindParam(5, $description);
                $stmt->bindParam(6, $reg_link);
                $stmt->execute();
            }
            break;

        case 'event_slider_first':
        case 'event_slider_second':
        case 'event_slider_third':
        case 'event_slider_fourth':
            $table = $formType;
            $title = $_POST['title'] ?? '';
            $date = $_POST['date'] ?? '';
            $tag = $_POST['tag'] ?? 'подія';
            $insta_link = $_POST['insta_link'] ?? '';

            // Отримуємо BLOB дані зображення
            $imageData = prepareImageForBlob('image');

            // Якщо нове фото завантажено, використовуємо його. Інакше, підтягуємо старе.
            if ($imageData === null) {
                $stmt = $pdo->query("SELECT image FROM $table WHERE id=1");
                $row = $stmt->fetch();
                $imageData = $row ? $row['image'] : null;
            }

            // Перевірка існування запису
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE id=1");
            $stmt->execute();
            $exists = $stmt->fetchColumn() > 0;

            if ($exists) {
                $sql = "UPDATE $table SET title=?, date=?, tag=?, image=?, insta_link=? WHERE id=1";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $date);
                $stmt->bindParam(3, $tag);
                $stmt->bindParam(4, $imageData, PDO::PARAM_LOB); // Зміна тут
                $stmt->bindParam(5, $insta_link);
                $stmt->execute();
            } else {
                $sql = "INSERT INTO $table (id, title, date, tag, image, insta_link) VALUES (1,?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $title);
                $stmt->bindParam(2, $date);
                $stmt->bindParam(3, $tag);
                $stmt->bindParam(4, $imageData, PDO::PARAM_LOB); // Зміна тут
                $stmt->bindParam(5, $insta_link);
                $stmt->execute();
            }
            break;
    }

    header("Location: admin.php");
    exit();
}

// Функція для отримання даних з таблиці
function getEventData($pdo, $table) {
    $stmt = $pdo->query("SELECT * FROM $table WHERE id=1");
    return $stmt->fetch() ?: [];
}

$mainEvent = getEventData($pdo, 'main_event');
$sliderFirst = getEventData($pdo, 'event_slider_first');
$sliderSecond = getEventData($pdo, 'event_slider_second');
$sliderThird = getEventData($pdo, 'event_slider_third');
$sliderFourth = getEventData($pdo, 'event_slider_fourth');
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <title>Адмінка подій</title>
    <style>
        form { border: 1px solid #ccc; padding: 15px; margin-bottom: 25px; }
        label { display: block; margin-top: 10px; }
        input[type=text], input[type=date], input[type=time], select, textarea { width: 100%; }
        /* Розмір зображення буде задаватися через CSS, не через max-width тут */
        img { max-height: 150px; max-width: 150px; margin-top: 10px; object-fit: contain; }
    </style>
</head>
<body>
<h1>Адмінка подій</h1>

<form method="POST" enctype="multipart/form-data">
    <h2>Головна подія (main_event)</h2>
    <input type="hidden" name="form_type" value="main_event" />
    <label>Заголовок
        <input type="text" name="title" required value="<?=htmlspecialchars($mainEvent['title'] ?? '')?>" />
    </label>
    <label>Дата
        <input type="date" name="date" required value="<?=htmlspecialchars($mainEvent['date'] ?? '')?>" />
    </label>
    <label>Час
        <input type="time" name="time" required value="<?=htmlspecialchars($mainEvent['time'] ?? '')?>" />
    </label>
    <label for="image">Фото</label>
    <input type="file" name="image" id="image" accept="image/*" />

    <?php if (!empty($mainEvent['image'])): ?>
        <?php
        // Визначення MIME-типу зображення з BLOB даних
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->buffer($mainEvent['image']);
        if (strpos($mime_type, 'image/') === 0): // Перевіряємо, чи це дійсно зображення
        ?>
            <img src="data:<?=htmlspecialchars($mime_type)?>;base64,<?=base64_encode($mainEvent['image'])?>" alt="Фото головної події" />
        <?php else: ?>
            <p>Не вдалося відобразити зображення (невірний MIME-тип або пошкоджені дані).</p>
        <?php endif; ?>
    <?php endif; ?>

    <label>Опис
        <textarea name="description" required><?=htmlspecialchars($mainEvent['description'] ?? '')?></textarea>
    </label>
    <label>Посилання на реєстрацію (Google Форма)
        <input type="text" name="reg_link" required value="<?=htmlspecialchars($mainEvent['reg_link'] ?? '')?>" />
    </label>
    <button type="submit">Оновити</button>
</form>

<?php
// Функція для форми слайдерів (повторюється для кожного слайду)
function renderSliderForm($tableName, $title, $data) {
    ?>
    <form method="POST" enctype="multipart/form-data">
        <h2><?=htmlspecialchars($title)?></h2>
        <input type="hidden" name="form_type" value="<?=htmlspecialchars($tableName)?>" />
        <label>Заголовок
            <input type="text" name="title" required value="<?=htmlspecialchars($data['title'] ?? '')?>" />
        </label>
        <label>Дата
            <input type="date" name="date" required value="<?=htmlspecialchars($data['date'] ?? '')?>" />
        </label>
        <label>Тег
            <select name="tag" required>
                <option value="Подія" <?= (isset($data['tag']) && $data['tag'] === 'подія') ? 'selected' : '' ?>>Подія</option>
                <option value="Новина" <?= (isset($data['tag']) && $data['tag'] === 'новина') ? 'selected' : '' ?>>Новина</option>
            </select>
        </label>
        <label>Фото
            <input type="file" name="image" accept="image/*" />
            <?php if (!empty($data['image'])): ?>
                <?php
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime_type = $finfo->buffer($data['image']);
                if (strpos($mime_type, 'image/') === 0):
                ?>
                    <img src="data:<?=htmlspecialchars($mime_type)?>;base64,<?=base64_encode($data['image'])?>" alt="Фото події" />
                <?php else: ?>
                    <p>Не вдалося відобразити зображення (невірний MIME-тип або пошкоджені дані).</p>
                <?php endif; ?>
            <?php endif; ?>
        </label>
        <label>Посилання на Instagram пост
            <input type="text" name="insta_link" required value="<?=htmlspecialchars($data['insta_link'] ?? '')?>" />
        </label>
        <button type="submit">Оновити</button>
    </form>
    <?php
}

renderSliderForm('event_slider_first', 'Подія слайдера 1', $sliderFirst);
renderSliderForm('event_slider_second', 'Подія слайдера 2', $sliderSecond);
renderSliderForm('event_slider_third', 'Подія слайдера 3', $sliderThird);
renderSliderForm('event_slider_fourth', 'Подія слайдера 4', $sliderFourth);
?>

</body>
</html>