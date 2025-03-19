<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
?>
<h1>Админ-панель</h1>
<ul>
    <li><a href="products.php">Управление товарами</a></li>
</ul>