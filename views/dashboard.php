<?php
session_start();
require_once "../models/SinhVien.php";
require_once "../models/HocPhan.php";

// Kiểm tra nếu sinh viên chưa đăng nhập
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$sinhVien = new SinhVien();
$hocPhan = new HocPhan();

$sinhVienData = $sinhVien->getById($MaSV);
$registeredCourses = $hocPhan->getRegisteredCourses($MaSV);

$title = "Dashboard - " . htmlspecialchars($sinhVienData['HoTen']);

ob_start();
?>

<div class="container mt-5">
    <div class="row">
        <!-- Thông tin cá nhân -->
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Thông Tin Cá Nhân</h3>
                </div>
                <div class="card-body text-center">
                    <img src="<?= !empty($sinhVienData['Hinh']) ? "../" . ltrim($sinhVienData['Hinh'], '/') : "../Content/images/default-avatar.png"; ?>" 
                         class="img-thumbnail mb-3" width="150">
                    <h5><?= htmlspecialchars($sinhVienData['HoTen']) ?></h5>
                    <p><strong>Mã SV:</strong> <?= htmlspecialchars($sinhVienData['MaSV']) ?></p>
                    <p><strong>Giới Tính:</strong> <?= htmlspecialchars($sinhVienData['GioiTinh']) ?></p>
                    <p><strong>Ngày Sinh:</strong> <?= date("d-m-Y", strtotime($sinhVienData['NgaySinh'])) ?></p>
                    <p><strong>Ngành:</strong> <?= htmlspecialchars($sinhVienData['TenNganh']) ?></p>
                    <a href="index.php" class="btn btn-secondary mt-2">Quay Lại</a>
                </div>
            </div>
        </div>

        <!-- Danh sách học phần đã đăng ký -->
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h3>Môn Học Đã Đăng Ký</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($registeredCourses)): ?>
                        <div class="alert alert-warning text-center">Bạn chưa đăng ký môn học nào.</div>
                    <?php else: ?>
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mã HP</th>
                                    <th>Tên Học Phần</th>
                                    <th>Số Tín Chỉ</th>
                                    <th>Ngày Đăng Ký</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registeredCourses as $course): ?>
                                <tr>
                                    <td><?= htmlspecialchars($course['MaHP']) ?></td>
                                    <td><?= htmlspecialchars($course['TenHP']) ?></td>
                                    <td><?= $course['SoTinChi'] ?></td>
                                    <td><?= date("d-m-Y", strtotime($course['NgayDK'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <div class="text-center mt-3">
                        <a href="hocphan.php?MaSV=<?= $MaSV ?>" class="btn btn-primary">Đăng Ký Môn Học</a>
                        <a href="logout.php" class="btn btn-danger">Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include "layout.php";
?>
