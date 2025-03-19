<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require 'config.php';

// Добавление товара
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products (name, price, description, image) VALUES (:name, :price, :description, :image)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':image' => $image
    ]);

    echo 'Товар добавлен!';
}

// Получение списка товаров
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<h1>Управление товарами</h1>
<form method="POST">
    <input type="text" name="name" placeholder="Название товара">
    <input type="text" name="price" placeholder="Цена">
    <textarea name="description" placeholder="Описание"></textarea>
    <input type="text" name="image" placeholder="Ссылка на изображение">
    <button type="submit">Добавить товар</button>
</form>

<h2>Список товаров</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>Изображение</th>
    </tr>
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $row['description'] ?></td>
    <td><img src="<?= $row['image'] ?>" width="100"></td>
    <td>
        <a href="edit_product.php?id=<?= $row['id'] ?>">Редактировать</a> | 
        <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Вы уверены?')">Удалить</a>
    </td>
</tr>
<?php endwhile; ?>
</table>