<?php
require 'core/router/Router.php'; // Подключаем файл с классом Router
require 'core/controllers/AppointmentController.php'; // Подключаем контроллеры
require 'db.php'; // Подключаем базу данных

$router = new Router();
$appointment_controller = new AppointmentController($conn);

$router->addRoute("GET", "/", [$appointment_controller, "showappointmentform"]); // Главная страница
$router->addRoute("POST", "/submitform", [$appointment_controller, "create"]); // Обработка формы
$router->addRoute("GET", "/orders", [$appointment_controller, "showOrders"]); // Страница заказов
$router->addRoute("GET", "/submitform", [$appointment_controller, "showSubmitForm"]); // Страница отправки формы

$router->resolve();
