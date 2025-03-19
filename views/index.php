<?php
session_start();
require_once "../models/SinhVien.php";

$sinhVien = new SinhVien();
$sinhViens = $sinhVien->getAll();

// Kiểm tra nếu sinh viên đã đăng nhập
$loggedIn = isset($_SESSION['MaSV']);
$MaSV = $loggedIn ? $_SESSION['MaSV'] : null;

$title = "Danh Sách Sinh Viên";

// ✅ Gán nội dung file index_content.php
$content = "index_content.php";
include "layout.php";
?>
