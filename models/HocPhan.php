<?php
require_once "../config/server.php";

class HocPhan {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy danh sách tất cả học phần
    public function getAll() {
        $query = "SELECT * FROM HocPhan";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đăng ký môn học
    public function registerCourse($MaSV, $MaHP) {
        // Kiểm tra xem sinh viên đã đăng ký môn học này chưa
        $queryCheck = "SELECT * FROM ChiTietDangKy 
                       WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?) 
                       AND MaHP = ?";
        $stmt = $this->conn->prepare($queryCheck);
        $stmt->execute([$MaSV, $MaHP]);
        if ($stmt->rowCount() > 0) {
            return false; // Đã đăng ký môn này trước đó
        }

        // Kiểm tra xem sinh viên đã có đăng ký chưa
        $query = "SELECT MaDK FROM DangKy WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $MaDK = $result['MaDK'];
        } else {
            // Nếu chưa có đăng ký nào, tạo mới
            $queryInsert = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), ?)";
            $stmt = $this->conn->prepare($queryInsert);
            $stmt->execute([$MaSV]);
            $MaDK = $this->conn->lastInsertId();
        }

        // Thêm vào ChiTietDangKy
        $queryInsert = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
        $stmt = $this->conn->prepare($queryInsert);
        return $stmt->execute([$MaDK, $MaHP]);
    }
    public function getRegisteredCourses($MaSV) {
        $query = "SELECT HocPhan.MaHP, HocPhan.TenHP, HocPhan.SoTinChi, DangKy.NgayDK
                  FROM ChiTietDangKy
                  JOIN HocPhan ON ChiTietDangKy.MaHP = HocPhan.MaHP
                  JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
                  WHERE DangKy.MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeCourse($MaSV, $MaHP) {
        $query = "DELETE FROM ChiTietDangKy 
                  WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?) 
                  AND MaHP = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaSV, $MaHP]);
    }
    
    public function clearAllCourses($MaSV) {
        $query = "DELETE FROM ChiTietDangKy 
                  WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$MaSV]);
    }
    public function isCourseRegistered($MaSV, $MaHP) {
        $query = "SELECT COUNT(*) FROM ChiTietDangKy 
                  WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = ?) 
                  AND MaHP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV, $MaHP]);
        return $stmt->fetchColumn() > 0;
    }
}
?>
