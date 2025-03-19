<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require 'config.php';

// Получение данных о товаре для редактирования
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Обновление данных товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE products SET name = :name, price = :price, description = :description, image = :image WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':image' => $image
    ]);

    header('Location: products.php');
    exit();
}
?>
<h1>Редактирование товара</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <input type="text" name="name" value="<?= $product['name'] ?>" placeholder="Название товара">
    <input type="text" name="price" value="<?= $product['price'] ?>" placeholder="Цена">
    <textarea name="description" placeholder="Описание"><?= $product['description'] ?></textarea>
    <input type="text" name="image" value="<?= $product['image'] ?>" placeholder="Ссылка на изображение">
    <button type="submit">Сохранить изменения</button>
</form>