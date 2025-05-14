<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../../styles/registration_style.css">
    <title>Регистрация</title>
</head>
<body>
    <form action="/registration" method="post">
        <h2>Регистрация</h2>
        <input type="email" name="user_email" placeholder="Введите свою почту" required>
        <input type="text" name="user_name" placeholder="Введите имя пользователя" required>
        <input type="password" name="user_password" placeholder="Введите пароль" required>
        <button type="submit">Зарегистрироваться</button>
    </form>

</body>
</html>