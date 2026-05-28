<?php
require "db.php";

if ($_POST) {

    $fio = $_POST['fio'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (fio, phone, email, login, password)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fio, $phone, $email, $login, $password]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Регистрация</title>
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
        <a href="register.php">Регистрация</a>
    </nav>
</header>

<main>
<div class="container">

<div class="card">

<h3>Регистрация</h3>

<form method="POST">

    <input name="fio" placeholder="ФИО" required>
    <input name="phone" placeholder="Телефон" required>
    <input name="email" placeholder="Email" required>
    <input name="login" placeholder="Логин" required>
    <input name="password" type="password" placeholder="Пароль" required>

    <button type="submit">Зарегистрироваться</button>

</form>

</div>

</div>
</main>

<footer>© Корочки.есть</footer>

</body>
</html>