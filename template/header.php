<!DOCTYPE HTML>
<html lang="en">
<head>
    <?php include_once 'config/env.php' ?>
</head>
    <body>
        <header>
            <a href="index.php">Чат</a>
            <a href="registration.php">Регистрация</a>
            <a href="loginpage.php">Авторизация</a>
            <?php     session_start();
if (isset ($_SESSION['username'])){
    echo '<p> Вы вошли как:'.$_SESSION['username'].'</p>';
} ?>
        </header>