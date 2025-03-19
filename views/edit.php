<?php
require_once "../models/SinhVien.php";
$sinhVien = new SinhVien();
$sinhVienData = $sinhVien->getById($_GET['MaSV']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa Sinh Viên</title>
    <!-- Thêm Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">Sửa Thông Tin Sinh Viên</h3>
        </div>
        <div class="card-body">
            <form action="../controllers/SinhVienController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="MaSV" value="<?= $sinhVienData['MaSV'] ?>">
                
                <div class="mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" name="HoTen" class="form-control" value="<?= $sinhVienData['HoTen'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="Nam" <?= $sinhVienData['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                        <option value="Nữ" <?= $sinhVienData['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control" value="<?= $sinhVienData['NgaySinh'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh Hiện Tại</label><br>
                    <?php if (!empty($sinhVienData['Hinh'])): ?>
                        <img src="<?= $sinhVienData['Hinh'] ?>" class="img-thumbnail" width="150">
                    <?php else: ?>
                        <p class="text-muted">Không có ảnh</p>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chọn Ảnh Mới (Nếu có)</label>
                    <input type="file" name="Hinh" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã Ngành</label>
                    <input type="text" name="MaNganh" class="form-control" value="<?= $sinhVienData['MaNganh'] ?>" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-success">Cập Nhật</button>
                    <a href="index.php" class="btn btn-secondary">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
