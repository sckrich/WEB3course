<?php
require_once __DIR__ . '/../../db.php';
class login{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($user_email, $user_name, $user_password, $user_role)
    {
        $hsh_password = password_hash($user_password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (user_email, user_name, user_password, user_role) VALUES (:user_email, :user_name, :user_password, :user_role)");
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->bindParam(':user_password', $hsh_password);
        $stmt->bindParam(':user_role', $user_role);
        return $stmt->execute();
    }

    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}