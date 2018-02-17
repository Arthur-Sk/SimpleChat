<?php include_once 'template/header.php';

if (empty($_SESSION['username'])){
    ?>

    <form action="login.php" method="post">
        <div>
            <label for="Username">Логин:</label>
            <input id="Username" placeholder="Логин" name="username">
        </div>
        <div>
            <label for="InputPassword">Пароль:</label>
            <input type="password" id="Password" placeholder="Пароль" name="password">
        </div>
        <button type="submit">Войти</button>
    </form>
    <form action="registration.php">
        <input type="submit" value="Регистрация" />
    </form>


<?php } else { ?>

    <form action="logout.php">
        <input type="submit" value="Выйти" />
    </form>
<?php
    }
include_once 'template/footer.php'; ?>
