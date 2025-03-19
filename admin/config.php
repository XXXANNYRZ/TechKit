<?php
$host = 'localhost'; // Хост базы данных
$dbname = 'techkit'; // Имя базы данных
$username = 'root'; // Имя пользователя MySQL
$password = ''; // Пароль (по умолчанию пустой)

try {
    // Подключение к базе данных
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>