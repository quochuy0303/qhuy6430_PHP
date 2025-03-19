<?php
require_once "../models/SinhVien.php";

if (!isset($sinhVienData)) {
    die("Không tìm thấy sinh viên.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông Tin Chi Tiết Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-info text-white">
            <h3 class="text-center">Thông Tin Chi Tiết</h3>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <?php if (!empty($sinhVienData['Hinh'])): ?>
                    <img src="<?= "../" . ltrim($sinhVienData['Hinh'], '/') ?>" class="img-thumbnail" width="120">
                <?php else: ?>
                    <span class="text-muted">Không có ảnh</span>
                <?php endif; ?>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>Mã Sinh Viên:</th>
                    <td><?= $sinhVienData['MaSV'] ?></td>
                </tr>
                <tr>
                    <th>Họ Tên:</th>
                    <td><?= $sinhVienData['HoTen'] ?></td>
                </tr>
                <tr>
                    <th>Giới Tính:</th>
                    <td><?= $sinhVienData['GioiTinh'] ?></td>
                </tr>
                <tr>
                    <th>Ngày Sinh:</th>
                    <td><?= date("d-m-Y", strtotime($sinhVienData['NgaySinh'])) ?></td>
                </tr>
                <tr>
                    <th>Ngành:</th>
                    <td><?= $sinhVienData['TenNganh'] ?></td>
                </tr>
            </table>

            <h4 class="mt-4">Các Môn Học Đã Đăng Ký</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Mã HP</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($courses)): ?>
                        <tr>
                            <td colspan="3" class="text-center">Chưa đăng ký môn học nào</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($courses as $course): ?>
                        <tr>
                            <td><?= $course['MaHP'] ?></td>
                            <td><?= $course['TenHP'] ?></td>
                            <td><?= $course['SoTinChi'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="text-center">
            <a href="../views/index.php" class="btn btn-secondary">Quay Lại</a>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
