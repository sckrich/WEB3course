<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация на прием</title>
    <link rel="stylesheet" href="styles/style.css?v=11.0">
</head>
<body>
    <?php
        require "db.php";
        $sql1 = "SELECT id, fio FROM photographer";
        $photographers = $conn->query($sql1);
        $sql2 = "SELECT id, name FROM service";
        $services = $conn->query($sql2);
    ?>
    <div class="page-wrapper">
        <main class="form-container">
            <div class="form-card">
                <form action="/submitform" method="post" class="registration-form">
                    <div class="form-group">
                        <label for="service" class="form-label">Услуга:</label>
                        <select name="service" class="form-input" required>
                            <option value="" disabled selected>Выберите услугу</option>
                            <?php while ($row = $services->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photographer" class="form-label">Фотограф:</label>
                        <select name="photographer" class="form-input" required>
                            <option value="" disabled selected>Выберите фотографа</option>
                            <?php while ($row = $photographers->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['fio']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date" class="form-label">Дата:</label>
                        <input type="date" name="date" class="form-input" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Записаться</button>
                </form>
                <form action="/orders" method="get" class="secondary-form">
                    <button type="submit" class="btn btn-secondary">Получить данные о записях</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
