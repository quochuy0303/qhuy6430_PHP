<?php
class Database {
    private $host = "localhost";
    private $db_name = "test1"; // Tên database
    private $username = "root"; // User mặc định của XAMPP
    private $password = ""; // Mật khẩu XAMPP thường để trống
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Lỗi kết nối CSDL: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
