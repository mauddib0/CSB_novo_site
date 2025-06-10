<?php
require_once('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = mysqli_real_escape_string($connection, $_POST['login']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM loginData WHERE login = '$login'";
    $result = $connection->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $login;
            header("Location: admin.php");
            exit;
        } else {
            echo "❌ Невірний пароль.";
        }
    } else {
        echo "❌ Користувача не знайдено.";
    }
}
?>









