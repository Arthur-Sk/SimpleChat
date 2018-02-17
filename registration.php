<?php include_once 'template/header.php'; ?>

<form action="signUp.php" method="post">
    <div>
        <label for="Username">Логин:</label>
        <input id="Username" placeholder="Логин" name="username">
    </div>
    <div>
        <label for="InputPassword">Пароль:</label>
        <input type="password" id="Password" placeholder="Пароль" name="password">
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>

<?php include_once 'template/footer.php'; ?>
