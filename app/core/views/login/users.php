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
            background-color:rgb(61, 61, 61);
        }
        h1{
            color: white;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            
        }
        a {
            color: white;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;

            display: inline-block;
            margin: 10px 0;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            background-color:rgb(45, 45, 45);
            border-radius: 5px;
            position: relative;
            overflow: hidden;
        }
        
        a:hover {
            background-color:rgb(255, 255, 255);
            transform: translateY(-3px);
            color: black;
            outline: 1px solid black;
        }
    </style>
</head>
<body>
    
    <h1>Список пользователей</h1>
    <table>
        <thead>
            <tr>
                <th>Имя пользователя</th>
                <th>Email</th>
                <th>Роль</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($user['user_email']); ?></td>
                    <td><?php echo htmlspecialchars($user['user_role']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/download_pdf_report_users">Скачать PDF отчет</a>
    <a href="/download_csv_report_users">Скачать CSV отчет</a>
    <a href="/profile">Обратно к профилю</a>
</body>
</html>
