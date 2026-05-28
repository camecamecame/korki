<?php
require "db.php";
session_start();

$stmt = $pdo->prepare("
    SELECT * FROM applications
    WHERE user_id = ?
    ORDER BY id DESC
");

$stmt->execute([$_SESSION['user_id']]);
$applications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Мои заявки</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.png">
        <b>Корочки.есть</b>
    </div>

    <nav>
        <a href="applications.php">Заявки</a>
        <a href="create-application.php">Новая заявка</a>
    </nav>
</header>

<main>
<div class="container">

<h3 style="margin-bottom:15px;">Мои заявки</h3>

<div class="grid">

<?php foreach ($applications as $app): ?>

    <div class="app">

        <h4><?= $app['course'] ?></h4>

        <p>Дата: <?= $app['start_date'] ?></p>

        <p>Оплата: <?= $app['payment'] ?></p>

        <span class="status <?= 
            $app['status'] == 'Новая' ? 'new' : 
            ($app['status'] == 'Идет обучение' ? 'prog' : 'done')
        ?>">
            <?= $app['status'] ?>
        </span>

    </div>

<?php endforeach; ?>

</div>

</div>
</main>

<footer>© Корочки.есть</footer>

</body>
</html>