<?php
session_start();
require_once "../models/HocPhan.php";

// Kiểm tra nếu sinh viên chưa đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: ../views/login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$hocPhan = new HocPhan();

// Lấy danh sách tất cả học phần
$hocPhans = $hocPhan->getAll();

// ✅ Xử lý đăng ký môn học
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    if (!empty($_POST['MaHP'])) {
        $MaHP = $_POST['MaHP'];

        // Kiểm tra xem học phần đã được đăng ký chưa
        if ($hocPhan->isCourseRegistered($MaSV, $MaHP)) {
            header("Location: ../views/hocphan.php?error=already_registered");
            exit();
        }

        // Đăng ký học phần
        if ($hocPhan->registerCourse($MaSV, $MaHP)) {
            header("Location: ../views/hocphan.php?success=registered");
            exit();
        } else {
            header("Location: ../views/hocphan.php?error=register_failed");
            exit();
        }
    } else {
        header("Location: ../views/hocphan.php?error=invalid_course");
        exit();
    }
}

// ✅ Xử lý xóa từng học phần đã đăng ký
if (isset($_GET['remove']) && !empty($_GET['remove'])) {
    $MaHP = $_GET['remove'];

    // Kiểm tra xem học phần có tồn tại không
    if (!$hocPhan->isCourseRegistered($MaSV, $MaHP)) {
        header("Location: ../views/giohang.php?error=not_registered");
        exit();
    }

    if ($hocPhan->removeCourse($MaSV, $MaHP)) {
        header("Location: ../views/giohang.php?success=removed");
    } else {
        header("Location: ../views/giohang.php?error=remove_failed");
    }
    exit();
}

// ✅ Xử lý xóa toàn bộ học phần đã đăng ký
if (isset($_GET['clear_all'])) {
    if ($hocPhan->clearAllCourses($MaSV)) {
        header("Location: ../views/giohang.php?success=cleared");
    } else {
        header("Location: ../views/giohang.php?error=clear_failed");
    }
    exit();
}

// Nếu không có hành động hợp lệ, quay về danh sách học phần
header("Location: ../views/hocphan.php");
exit();
?>
