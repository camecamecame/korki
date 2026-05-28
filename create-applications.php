<?php
require "db.php";
session_start();

if ($_POST) {

    $course = $_POST['course'];
    $date = $_POST['date'];
    $payment = $_POST['payment'];

    $stmt = $pdo->prepare("
        INSERT INTO applications (user_id, course, start_date, payment, status)
        VALUES (?, ?, ?, ?, 'Новая')
    ");

    $stmt->execute([
        $_SESSION['user_id'],
        $course,
        $date,
        $payment
    ]);

    header("Location: applications.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Новая заявка</title>
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

<div class="card">

    <h3>Создание заявки</h3>

    <form method="POST">

        <select name="course" required>
            <option>Основы алгоритмизации</option>
            <option>Основы веб-дизайна</option>
            <option>Базы данных</option>
        </select>

        <input name="date" placeholder="Дата начала (ДД.ММ.ГГГГ)" required>

        <select name="payment" required>
            <option>Наличные</option>
            <option>Перевод по номеру</option>
        </select>

        <button type="submit">Отправить заявку</button>

    </form>

</div>

</div>
</main>

<footer>© Корочки.есть</footer>

</body>
</html>