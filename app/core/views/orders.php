<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Записи</title>
    </head>
    <body>
        <h1>Записи</h1>
        <?php
        require 'db.php'; // Подключаем базу данных
        $sql = "SELECT * FROM orders";
        if ($result = $conn->query($sql)) {
            echo "<div class='appointment-list'>";
            foreach($result as $row) {
                echo "<div class='appointment-card'>";
                echo "<h3>Id-приема: {$row['id']}</h3>";
                echo "<p><strong>Id услуги:</strong> {$row['service_id']}</p>";
                echo "<p><strong>Id фотографа:</strong> {$row['photographer_id']}</p>";
                echo "<p><strong>Дата приема:</strong> {$row['date']}</p>";
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
        <a href="/">На главную</a>
    </body>
    </html>
    ```
