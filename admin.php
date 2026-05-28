<?php
require "db.php";
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['update_status'])) {
    $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['status'], $_POST['id']]);
}

$stmt = $pdo->query("
    SELECT applications.*, users.fio 
    FROM applications
    JOIN users ON applications.user_id = users.id
    ORDER BY applications.id DESC
");

$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Админ панель</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.png">
        <b>Корочки.есть</b>
    </div>

    <nav>
        <a href="index.php">Вход</a>
        <a href="admin.php">Админ</a>
    </nav>
</header>

<main>
<div class="container">

<h3 style="margin-bottom:15px;">Панель администратора</h3>

<table>

<tr>
    <th>Пользователь</th>
    <th>Курс</th>
    <th>Дата</th>
    <th>Статус</th>
    <th>Действие</th>
</tr>

<?php foreach ($applications as $app): ?>

<tr>

    <td><?= $app['fio'] ?></td>
    <td><?= $app['course'] ?></td>
    <td><?= $app['start_date'] ?></td>

    <td><?= $app['status'] ?></td>

    <td>
        <form method="POST">
            
            <input type="hidden" name="id" value="<?= $app['id'] ?>">

            <select name="status">
                <option <?= $app['status']=="Новая"?"selected":"" ?>>Новая</option>
                <option <?= $app['status']=="Идет обучение"?"selected":"" ?>>Идет обучение</option>
                <option <?= $app['status']=="Обучение завершено"?"selected":"" ?>>Обучение завершено</option>
            </select>

            <button name="update_status" type="submit">
                Сохранить
            </button>

        </form>
    </td>

</tr>

<?php endforeach; ?>

</table>

</div>
</main>

<footer>© Корочки.есть</footer>

</body>
</html>