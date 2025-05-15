<?php
session_start();
require_once __DIR__ . '/../models/login.php';
require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../../dompdf/autoload.inc.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class loginController{
    private $model;
    private $order_model;
    public function __construct($db){
        $this->model = new login($db);
        $this->order_model = new order($db);
    }


    public function showathoriz_or_reg_form(){
        require_once __DIR__ .'/../Views/login/loginform.php';
    }

    public function showRegistrationForm() {
        require_once __DIR__ . '/../Views/login/registration.php';
    }
    

    public function showathorizationForm(){
        require_once __DIR__ . '/../Views/login/authorization.php';
    }


    public function reg(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_email = htmlspecialchars(trim($_POST['user_email']));
            $user_name = htmlspecialchars(trim($_POST['user_name']));
            $user_password = htmlspecialchars(trim($_POST['user_password']));
            $user_role = 'DefaultUser';
            if (empty($user_email) && empty($user_name) && empty($user_password)){
                echo "<script>alert('Поля не могут быть пустыми')</script>";
                require_once __DIR__ ."/../views/login/registration.php";
                return;
            }
            $this->model->create($user_email, $user_name, $user_password, $user_role);
            echo "<script>alert('Вы успешно зарегистрировались')</script>";
            echo "<script>window.location.href='/'</script>";
        }
    }

    public function authoriz(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user_email = htmlspecialchars(trim($_POST['user_email']));
            $user_password= htmlspecialchars(trim($_POST['user_password']));
            if (empty($user_email) || empty($user_password))
                echo "<script>alert('Поля не должны быть пустыми')</script>";
            $users = $this->model->getAll();
            $athoriz_flag = false;
            foreach($users as $user){
                if (password_verify($user_password, $user['user_password']) && $user['user_email'] == $user_email){
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_password'] = $user_password;
                    $_SESSION['user_role'] = $user['user_role'];
                     $athoriz_flag = true;
                }
            }
            if ($athoriz_flag){
                echo "<script>alert('Вы были успешно авторизованы')</script>";
                echo "<script>window.location.href='/'</script>";
            }
            else{
                echo "<script>alert('Неверный логин или пароль')</script>";
                echo "<script>window.location.href=''</script>";
            }
        }
    }
    public function show_user_lk(){
        if (!empty($_SESSION["user_email"]) && !empty($_SESSION['user_password'])){
            require_once __DIR__ ."/../Views/login/profile.php";
            return;
        }
        else{
            echo "<script>alert('Вы не авторизованы')</script>";
            require_once __DIR__ ."/../Views/login/loginform.php";
            return;
        }
    }
    public function logout() {
        $_SESSION = [];
        session_destroy();
        header("Location: /");
        exit;
    }
    public function display_all_users(){
        $users = $this->model->getAll();
        require_once __DIR__ . '/../views/login/users.php';
    }

    public function display_orders(){
        $orders = $this->order_model->getAll();
        require_once __DIR__ . '/../views/login/orders.php';
    }

    public function downloadPDFReport_users() {
        $dompdf = new Dompdf();
        $html = '<h1>User Report</h1>';
        $users = $this->model->getAll();
        foreach ($users as $user) {
            $html .= '<p>' . htmlspecialchars($user['user_name']) . ' - ' . htmlspecialchars($user['user_email']) . '</p>';
        }
    
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('user_report.pdf'); 
    }
    public function transliterate($string) {
        $transliterationTable = [
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
                'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
                'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
                'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',
                'ш' => 'sh', 'щ' => 'shch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
                'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
                'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
                'У' => 'U', 'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Ts', 'Ч' => 'Ch',
                'Ш' => 'Sh', 'Щ' => 'Shch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
        ];

        return strtr($string, $transliterationTable);
    }

    public function downloadPDFReport_appointments() {
    $dompdf = new Dompdf();
    
    $html = '<h1>All orders</h1>';
    
    $orders = $this->order_model->getAll();
    
    foreach ($orders as $order) {
        $photographer = $this->order_model->getPhotographerById($order['photographer_id']);
        $service = $this->order_model->getServiceById($order['service_id']);
        
        $photographerName = $this->transliterate($photographer['fio']);
        $serviceName = $this->transliterate($service['name']);
        $orderDate = $order['date'];

        $html .= '<p>' . htmlspecialchars($serviceName, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($photographerName, ENT_QUOTES, 'UTF-8') . ' - ' . htmlspecialchars($orderDate, ENT_QUOTES, 'UTF-8') . '</p>';
    }

    $dompdf->loadHtml($html, 'UTF-8');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->set_option('defaultFont', 'Go'); 
    $dompdf->render();
    $dompdf->stream('orders.pdf'); 
}


    public function downloadExcelReport_users() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'User Name');
        $sheet->setCellValue('B1', 'User Email');

        $users = $this->model->getAll();
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user['user_name']);
            $sheet->setCellValue('B' . $row, $user['user_email']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="user_report.xlsx"');
        $writer->save('php://output'); 
    }

    public function downloadExcelReport_appointments() {

    $objPHPExcel = new PHPExcel();
    $sheet = $objPHPExcel->getActiveSheet();
    $sheet->setCellValue('A1', 'Фотограф');
    $sheet->setCellValue('B1', 'Сервис');
    $sheet->setCellValue('C1', 'Дата');

    
    $orders = $this->order_model->getAll();
    $row = 2; 
    foreach ($appointments as $appointment) {
        $sheet->setCellValue('A' . $row, $order['appointment_patient_name']);
        $sheet->setCellValue('B' . $row, $appointment['appointment_doctor_name']);
        $sheet->setCellValue('C' . $row, $appointment['appointment_date']);
        $row++;
    }


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="appointments_report.xlsx"');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
}


    public function downloadCSVReport_users() {
        $users = $this->model->getAll();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="user_report.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['User Name', 'User Email']); 

        foreach ($users as $user) {
            fputcsv($output, [$user['user_name'], $user['user_email']]);
        }

        fclose($output); 
    }

    public function downloadCSVReport_appointments() {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="orderscsv.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Фотограф', 'Сервис', 'Дата']); 

    $orders = $this->order_model->getAll();
    
    foreach ($orders as $order) {
        $photographer = $this->order_model->getPhotographerById($order['photographer_id']);
        $service = $this->order_model->getServiceById($order['service_id']);

        $photographerName = $this->transliterate($photographer['fio']);
        $serviceName = $this->transliterate($service['name']);
        $orderDate = $order['date'];

        fputcsv($output, [$photographerName, $serviceName, $orderDate]);
    }

    fclose($output); 
}

}