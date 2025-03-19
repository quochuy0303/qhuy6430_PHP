<?php
require_once "../models/SinhVien.php";

$sinhVien = new SinhVien();

// Xử lý thêm sinh viên
if (isset($_POST['add'])) {
    $targetDir = __DIR__ . "/../Content/images/"; // Đường dẫn tuyệt đối đến thư mục ảnh
    $imagePath = "";

    // Kiểm tra nếu có tải lên ảnh
    if (!empty($_FILES['Hinh']['name'])) {
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Đổi tên ảnh để tránh trùng
        $imageName = time() . "_" . basename($_FILES["Hinh"]["name"]);
        $imageFullPath = $targetDir . $imageName;
        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $imageFullPath)) {
            $imagePath = "/Content/images/" . $imageName; // Lưu đường dẫn tương đối để hiển thị đúng trên trình duyệt
        }
    }

    // Thêm sinh viên vào database
    $sinhVien->create($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $imagePath, $_POST['MaNganh']);
    header("Location: ../views/index.php");
    exit();
}

// Xử lý cập nhật sinh viên
if (isset($_POST['update'])) {
    $sinhVienData = $sinhVien->getById($_POST['MaSV']);
    $imagePath = $sinhVienData['Hinh']; // Giữ ảnh cũ nếu không có ảnh mới

    if (!empty($_FILES['Hinh']['name'])) {
        $targetDir = __DIR__ . "/../Content/images/";

        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Xóa ảnh cũ nếu có
        if (!empty($sinhVienData['Hinh']) && file_exists(__DIR__ . "/../" . $sinhVienData['Hinh'])) {
            unlink(__DIR__ . "/../" . $sinhVienData['Hinh']);
        }

        // Đổi tên ảnh mới để tránh trùng
        $imageName = time() . "_" . basename($_FILES["Hinh"]["name"]);
        $imageFullPath = $targetDir . $imageName;
        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $imageFullPath)) {
            $imagePath = "/Content/images/" . $imageName;
        }
    }

    // Cập nhật dữ liệu sinh viên
    $sinhVien->update($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $imagePath, $_POST['MaNganh']);
    header("Location: ../views/index.php");
    exit();
}

// Xóa sinh viên
if (isset($_GET['delete'])) {
    $sinhVienData = $sinhVien->getById($_GET['delete']);

    // Xóa ảnh nếu có
    if (!empty($sinhVienData['Hinh']) && file_exists(__DIR__ . "/../" . $sinhVienData['Hinh'])) {
        unlink(__DIR__ . "/../" . $sinhVienData['Hinh']);
    }

    // Xóa sinh viên khỏi database
    $sinhVien->delete($_GET['delete']);
    header("Location: ../views/index.php");
    exit();
}
// Xử lý hiển thị chi tiết sinh viên
if (isset($_GET['detail'])) {
    $MaSV = $_GET['detail'];
    $sinhVienData = $sinhVien->getDetails($MaSV);
    $courses = $sinhVien->getRegisteredCourses($MaSV);
    include "../views/detail.php";
    exit();
}
?>
