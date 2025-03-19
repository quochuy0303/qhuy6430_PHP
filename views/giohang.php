<?php
session_start();
require_once "../models/HocPhan.php";

// Kiểm tra nếu sinh viên chưa đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$hocPhan = new HocPhan();

// Lấy danh sách học phần đã đăng ký
$registeredCourses = $hocPhan->getRegisteredCourses($MaSV);

// Tính tổng số học phần và số tín chỉ
$totalCourses = count($registeredCourses);
$totalCredits = array_sum(array_column($registeredCourses, 'SoTinChi'));

$title = "Giỏ Hàng - Học Phần Đã Đăng Ký";
$content = "giohang_content.php"; // Gọi nội dung từ giohang_content.php
include "layout.php";
?>
