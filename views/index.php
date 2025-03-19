<?php
require_once "../models/SinhVien.php";
$sinhVien = new SinhVien();
$sinhViens = $sinhVien->getAll();

// Định nghĩa biến `$title` và `$content`
$title = "Danh Sách Sinh Viên";
$content = "index_content.php"; // <-- Đảm bảo file này tồn tại

include "layout.php";
?>