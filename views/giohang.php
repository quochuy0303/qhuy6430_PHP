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

// Tính tổng số học phần và số tín chỉ
$totalCourses = count($registeredCourses);
$totalCredits = array_sum(array_column($registeredCourses, 'SoTinChi'));

$title = "Đăng Ký Học Phần";

ob_start();
?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Đăng Ký Học Phần</h3>
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
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registeredCourses as $course): ?>
                        <tr>
                            <td><?= htmlspecialchars($course['MaHP']) ?></td>
                            <td><?= htmlspecialchars($course['TenHP']) ?></td>
                            <td><?= $course['SoTinChi'] ?></td>
                            <td>
                                <a href="../controllers/HocPhanController.php?remove=<?= $course['MaHP'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa học phần này?')">
                                   Xóa
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="mt-3">
                    <p class="fw-bold text-danger">Số học phần: <?= $totalCourses ?></p>
                    <p class="fw-bold text-danger">Tổng số tín chỉ: <?= $totalCredits ?></p>
                </div>
            <?php endif; ?>
            <div class="text-center mt-3">
                <?php if (!empty($registeredCourses)): ?>
                    <a href="../controllers/HocPhanController.php?clear_all=1" 
                       class="btn btn-danger"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ học phần đã đăng ký?')">
                       Xóa Đăng Ký
                    </a>
                <?php endif; ?>
                <a href="hocphan.php" class="btn btn-primary">Lưu Đăng Ký</a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include "layout.php";
?>
