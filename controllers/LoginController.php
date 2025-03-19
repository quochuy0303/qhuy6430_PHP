<?php
require_once "../models/SinhVien.php";
session_start();

// Kiểm tra nếu form được submit
if (isset($_POST['login'])) {
    $MaSV = trim($_POST['MaSV']); // Xóa khoảng trắng

    // Kiểm tra Mã SV có trống không
    if (empty($MaSV)) {
        header("Location: ../views/login.php?error=empty");
        exit();
    }

    $sinhVien = new SinhVien();
    $sinhVienData = $sinhVien->getById($MaSV);

    // Nếu tìm thấy sinh viên, lưu session & chuyển hướng
    if ($sinhVienData) {
        $_SESSION['MaSV'] = $sinhVienData['MaSV'];
        $_SESSION['HoTen'] = $sinhVienData['HoTen'];

        // Chuyển hướng về trang Dashboard sau khi đăng nhập
        header("Location: ../views/index.php");
        exit();
    } else {
        // Nếu không tìm thấy, quay lại login với thông báo lỗi
        header("Location: ../views/login.php?error=invalid");
        exit();
    }
}

// Nếu truy cập file trực tiếp, chuyển về trang đăng nhập
header("Location: ../views/login.php");
exit();
