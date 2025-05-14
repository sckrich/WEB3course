<?php
class AppointmentController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function showappointmentform() {
       include __DIR__ . '/../views/main.php'; // Отображаем главную страницу
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['service']) && isset($_POST['photographer']) && isset($_POST['date'])) {
                $service_id = htmlspecialchars(trim($_POST['service']));
                $photographer_id = htmlspecialchars(trim($_POST['photographer']));
                $date = date("Y-m-d", strtotime($_POST["date"]));
    
                if (empty($service_id) || empty($photographer_id)) {
                    echo "Ошибка: Поля 'Услуга' и 'Фотограф' не могут быть пустыми.";
                    exit;
                }
    
                $currentdate = date("Y-m-d");
                if ($date < $currentdate) {
                    echo "Ошибка: Дата не может быть в прошлом";
                    exit; 
                } else {
                    try {
                        $stmt = $this->conn->prepare("INSERT INTO orders (service_id, photographer_id, date) VALUES (:service_id, :photographer_id, :date)");
                        $stmt->bindParam(':service_id', $service_id);
                        $stmt->bindParam(':photographer_id', $photographer_id);
                        $stmt->bindParam(':date', $date);
                        $stmt->execute();
                        echo "Запись успешно добавлена.";
                    } catch (PDOException $e) {
                        echo "Ошибка: " . $e->getMessage();
                    }
                }
            }
            echo "<a href='/'>На главную</a>";
        } else {
            // Если метод не POST, перенаправляем на главную страницу или показываем ошибку
            header("Location: /");
            exit;
        }
    }
    
    public function showSubmitForm() {
        include __DIR__ . '/../views/submitform.php'; // Отображаем страницу отправки формы
    }
}
