<?php
session_start();
if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
    $_SESSION['admin'] = true;
    header('Location: index.php');
} else {
    echo 'Неверный логин или пароль';
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Логин">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit">Войти</button>
</form>