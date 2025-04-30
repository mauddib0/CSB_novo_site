<?php
header('Content-Type: application/json');

// Логування отриманих даних
error_log("POST Data: " . print_r($_POST, true)); 

if (isset($_POST['name'], $_POST['surname'], $_POST['phone'], $_POST['problem'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $problem = $_POST['problem'];

    // Токен бота та чат ID
    $token = "7964273519:AAF5zsG56Gj_jkfobr4vnCtZlYF3eUILYMA";
    $chat_id = "-1002574579240";

    // Формуємо текст повідомлення
    $text = "Новий запис на консультацію 📲\n";
    $text .= "Тема: $problem\nІм'я: $name\nПрізвище: $surname\nТелефон: $phone";

    // Відправка запиту до Telegram API
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $data = ['chat_id' => $chat_id, 'text' => $text];

    $options = [
        "http" => [
            "header"  => "Content-type: application/x-www-form-urlencoded",
            "method"  => "POST",
            "content" => http_build_query($data)
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Логування результату запиту до Telegram
    error_log("Telegram Response: " . $result); 

    // Перевірка відповіді
    if ($result) {
        echo json_encode([
            'ok' => true,
            'description' => 'Повідомлення успішно надіслано.'
        ]);
    } else {
        echo json_encode([
            'ok' => false,
            'description' => 'Не вдалося надіслати повідомлення.'
        ]);
    }
} else {
    echo json_encode([
        'ok' => false,
        'description' => 'Форма неповна'
    ]);
}
