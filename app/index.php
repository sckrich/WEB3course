<?php
require 'core/router/Router.php'; // Подключаем файл с классом Router
require 'core/controllers/AppointmentController.php'; // Подключаем контроллеры
require 'core/controllers/loginController.php';
require 'db.php'; // Подключаем базу 

$router = new Router();
$appointment_controller = new AppointmentController($conn);
$Lkcontroller = new loginController($conn);

$router->addRoute("GET", "/", [$appointment_controller, "showappointmentform"]); // Главная страница
$router->addRoute("POST", "/submitform", [$appointment_controller, "create"]); // Обработка формы
 // Страница заказов
$router->addRoute("GET", "/submitform", [$appointment_controller, "showSubmitForm"]); // Страница отправки формы
$router->addRoute("GET","/profile", [$Lkcontroller, 'show_user_lk']);
$router->addRoute('GET','/athorization', [$Lkcontroller, 'showathorizationForm']);
$router->addRoute('GET', '/registration', [$Lkcontroller, 'showRegistrationForm']);
$router->addRoute('POST', '/registration', [$Lkcontroller, 'reg']);
$router->addRoute('POST', '/athorization', [$Lkcontroller, 'authoriz']);
$router->addRoute('GET','/athoriz_or_reg', [$Lkcontroller, 'showathoriz_or_reg_form']);
$router->addRoute('GET', '/logout', [$Lkcontroller, 'logout']);
$router->addRoute('GET', '/orders', [$Lkcontroller, 'display_orders']);
$router->addRoute('GET', '/users', [$Lkcontroller, 'display_all_users']);
$router->addRoute('GET', '/exel_report_users', [$Lkcontroller, 'downloadExcelReport_users']);
$router->addRoute('GET', '/download_pdf_report_users', [$Lkcontroller, 'downloadPDFReport_users']);
$router->addRoute('GET', '/download_csv_report_users', [$Lkcontroller, 'downloadCSVReport_users']);
$router->addRoute('GET', '/exel_report_appointments', [$Lkcontroller, 'downloadExcelReport_appointments']);
$router->addRoute('GET', '/download_pdf_report_appointments', [$Lkcontroller, 'downloadPDFReport_appointments']);
$router->addRoute('GET', '/download_csv_report_appointments', [$Lkcontroller, 'downloadCSVReport_appointments']);
$router->resolve(); 
