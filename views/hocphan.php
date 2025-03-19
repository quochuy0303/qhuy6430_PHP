<?php
require_once "../controllers/HocPhanController.php";
session_start();

if (!isset($_GET['MaSV'])) {
    die("Không tìm thấy mã sinh viên!");
}

$MaSV = $_GET['MaSV'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Ký Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">Đăng Ký Học Phần</h3>
        </div>
        <div class="card-body">
            <h5>Mã Sinh Viên: <strong><?= $MaSV ?></strong></h5>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Đăng ký thành công!</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Bạn đã đăng ký môn học này trước đó!</div>
            <?php endif; ?>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Học Phần</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hocPhans as $hp): ?>
                    <tr>
                        <td><?= $hp['MaHP'] ?></td>
                        <td><?= $hp['TenHP'] ?></td>
                        <td><?= $hp['SoTinChi'] ?></td>
                        <td>
                            <form method="POST" action="../controllers/HocPhanController.php">
                                <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                                <input type="hidden" name="MaHP" value="<?= $hp['MaHP'] ?>">
                                <button type="submit" name="register" class="btn btn-success btn-sm">Đăng Ký</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="text-center">
                <a href="index.php" class="btn btn-secondary">Quay Lại</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
