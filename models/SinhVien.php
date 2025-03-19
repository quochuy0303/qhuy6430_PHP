<?php
require_once "../config/server.php";

class SinhVien {
    private $conn;
    private $table_name = "SinhVien";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy danh sách sinh viên
    public function getAll() {
        $query = "SELECT SinhVien.*, NganhHoc.TenNganh FROM SinhVien 
                  LEFT JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm sinh viên (Hỗ trợ lưu ảnh)
    public function create($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $query = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                  VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':MaSV' => $MaSV,
            ':HoTen' => $HoTen,
            ':GioiTinh' => $GioiTinh,
            ':NgaySinh' => $NgaySinh,
            ':Hinh' => $Hinh, // Đường dẫn hình ảnh
            ':MaNganh' => $MaNganh
        ]);
    }

    // Lấy thông tin một sinh viên
    public function getById($MaSV) {
        $query = "SELECT * FROM SinhVien WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':MaSV' => $MaSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getDetails($MaSV) {
        $query = "SELECT sv.*, ng.TenNganh FROM SinhVien sv
                  JOIN NganhHoc ng ON sv.MaNganh = ng.MaNganh
                  WHERE sv.MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getRegisteredCourses($MaSV) {
        $query = "SELECT hp.MaHP, hp.TenHP, hp.SoTinChi FROM ChiTietDangKy ctdk
                  JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
                  JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
                  WHERE dk.MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$MaSV]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật sinh viên (Hỗ trợ cập nhật ảnh)
    public function update($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $query = "UPDATE SinhVien 
                  SET HoTen = :HoTen, GioiTinh = :GioiTinh, NgaySinh = :NgaySinh, Hinh = :Hinh, MaNganh = :MaNganh 
                  WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':MaSV' => $MaSV,
            ':HoTen' => $HoTen,
            ':GioiTinh' => $GioiTinh,
            ':NgaySinh' => $NgaySinh,
            ':Hinh' => $Hinh, // Đường dẫn hình ảnh mới
            ':MaNganh' => $MaNganh
        ]);
    }

    // Xóa sinh viên
    public function delete($MaSV) {
        $query = "DELETE FROM SinhVien WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':MaSV' => $MaSV]);
    }
}
?>
