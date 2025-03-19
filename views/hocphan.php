<?php
session_start();
require_once "../models/HocPhan.php";

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$hocPhan = new HocPhan();
$hocPhans = $hocPhan->getAll(); // Lấy danh sách học phần

$title = "Đăng Ký Học Phần";
$content = "hocphan_content.php";

include "layout.php";
?>
