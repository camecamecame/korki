<?php
require "db.php";
session_start();

if ($_POST) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];

        if ($user['login'] === 'yebiwe') {
            $_SESSION['is_admin'] = true;
            header("Location: admin.php");
        } else {
            $_SESSION['is_admin'] = false;
            header("Location: applications.php");
        }

        exit;

    } else {
        $error = "Неверный логин или пароль";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Вход</title>
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

<!-- СЛАЙДЕР -->
<div class="slider">
    <div class="slides">

        <div class="slide"><img src="slide1.jpg"></div>
        <div class="slide"><img src="slide2.jpg"></div>
        <div class="slide"><img src="slide3.jpg"></div>
        <div class="slide"><img src="slide4.jpg"></div>

    </div>
</div>

<div class="card">

    <h3>Авторизация</h3>

    <form method="POST">

        <input name="login" placeholder="Логин" required>
        <input name="password" type="password" placeholder="Пароль" required>

        <button type="submit">Войти</button>

    </form>

    <?php if (!empty($error)): ?>
        <p style="color:red; margin-top:10px;">
            <?= $error ?>
        </p>
    <?php endif; ?>

    <a class="link" href="register.php">
        Ещё не зарегистрированы? Регистрация
    </a>

</div>

</div>
</main>

<footer>© Корочки.есть</footer>

<script src="script.js"></script>

</body>
</html>