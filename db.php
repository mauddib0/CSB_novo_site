<?php
$servname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'cpbNOVO';

$connection = mysqli_connect($servname, $username, $password, $dbname);

if (!$connection) {
    die("❌ Помилка підключення до БД: " . mysqli_connect_error());
}
?>