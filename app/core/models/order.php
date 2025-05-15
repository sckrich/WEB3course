<?php
require_once __DIR__ . '/../../db.php';


class order
{
    private $conn;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($photographer_id, $service_id, $date)
    {
        $stmt = $this->conn->prepare("INSERT INTO orders (service_id, photographer_id, date) VALUES (:service_id, :photographer_id, :date)");
        $stmt->bindParam(':service_id', $service_id);
        $stmt->bindParam(':photographer_id', $photographer_id);
        $stmt->bindParam(':date', $date);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM orders");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPhotographerById($photographer_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM photographer WHERE id = :photographer_id");
        $stmt->bindParam(':photographer_id', $photographer_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getServiceById($service_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM service WHERE id = :service_id");
        $stmt->bindParam(':service_id', $service_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
