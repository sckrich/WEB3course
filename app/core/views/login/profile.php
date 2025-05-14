<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../../styles/profilestyle.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <div class="user-info">
            <h1 class = "textBig">Добро пожаловать в личный кабинет</h1>
            <h2 class = "textBig"><?php echo "Добро пожаловать, ".$_SESSION['user_name'] ?></h2>
            <h2 class = "textBig"><?php echo "E-mail: ".$_SESSION['user_email']?></h2>
            <?php if ($_SESSION['user_role'] === 'administrator'): ?>
            <h2 class = "textBig"><?php echo "роль: ".$_SESSION['user_role']?></h2>
             <?php endif; ?>
        </div>
        <div class="admin-panel">
        <?php if ($_SESSION['user_role'] === 'administrator'): ?>
            <h3 class = "textBig">Вам доступно кое-что еще!</h3>
            <a class = "btn"href="/orders">Получить все данные о записях на фото</a>
            <a class = "btn" href="/users">Получить все данные о пользователях</a>
        <?php endif; ?>
        </div>
        <div class="btns">
            <a class = "btn" href="/">Вернуться на главную</a>
            <a class = "btn" href="/logout">Выйти из аккаунта</a>
            
        </div>
    </div> 
</body>
</html>
