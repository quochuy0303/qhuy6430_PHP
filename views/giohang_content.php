<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Học Phần Đã Đăng Ký</h3>
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
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registeredCourses as $course): ?>
                        <tr>
                            <td><?= htmlspecialchars($course['MaHP']) ?></td>
                            <td><?= htmlspecialchars($course['TenHP']) ?></td>
                            <td><?= $course['SoTinChi'] ?></td>
                            <td><?= date("d-m-Y", strtotime($course['NgayDK'])) ?></td>
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
                <a href="hocphan.php" class="btn btn-primary">Tiếp Tục Đăng Ký</a>
                <?php if (!empty($registeredCourses)): ?>
                    <a href="../controllers/HocPhanController.php?clear_all=1" 
                       class="btn btn-danger"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ học phần đã đăng ký?')">
                       Xóa Đăng Ký
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
