<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
    <style>
        body{
            background-color: #323232;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: white;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;

        }
        th {
            color: white;
            background-color:rgb(53, 53, 53);
        }
        a {
            color: white;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            
            display: inline-block;
            margin: 10px 0;
            padding: 12px 20px;
            text-decoration: none;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;

            color: white;
            background-color:rgb(138, 138, 138);
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            position: relative;
            overflow: hidden;
        }
       
        a:hover {
            background-color:rgb(48, 48, 48);
            transform: translateY(-3px);
            outline: 1px solid white;
        }
        h1{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
color: white;
        }
    </style>
</head>
<body>
    
    <h1>Список записей</h1>
    <table>
        <thead>
            <tr>
                <th>Услуга</th>
                <th>Фотограф Id</th>
                <th>Дата съемок</th>
                <th>Пользователь id</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['photographer_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['service_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['date']); ?></td>
                    <td><?php echo htmlspecialchars($order['user_id']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/download_pdf_report_appointments">Скачать PDF отчет</a>
    <a href="/download_csv_report_appointments">Скачать CSV отчет</a>
    <a href="/profile">Обратно к профилю</a>
</body>
</html>
