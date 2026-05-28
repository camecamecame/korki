<?php
$host = "localhost";
$db = "korki";
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>