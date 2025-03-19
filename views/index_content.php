<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">Danh Sách Sinh Viên</h3>
        </div>
        <div class="card-body">
            
            <!-- Chỉ hiển thị nút "Thêm Sinh Viên" nếu chưa đăng nhập -->
            <?php if (!$loggedIn): ?>
                <a href="create.php" class="btn btn-success mb-3">Thêm Sinh Viên</a>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Mã SV</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Hình</th>
                        <th>Ngành</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sinhViens as $sv): ?>
                        <?php if (!$loggedIn || $sv['MaSV'] == $MaSV): // Nếu chưa đăng nhập, hiển thị toàn bộ. Nếu đăng nhập, chỉ hiển thị SV hiện tại. ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($sv['MaSV']) ?></td>
                            <td><?= htmlspecialchars($sv['HoTen']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($sv['GioiTinh']) ?></td>
                            <td class="text-center"><?= date("d-m-Y", strtotime($sv['NgaySinh'])) ?></td>
                            <td class="text-center">
                                <?php if (!empty($sv['Hinh'])): ?>
                                    <img src="<?= "../" . ltrim($sv['Hinh'], '/') ?>" class="img-thumbnail" width="50">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td><?= isset($sv['TenNganh']) ? htmlspecialchars($sv['TenNganh']) : "Chưa cập nhật" ?></td>
                            <td class="text-center">
                                <a href="edit.php?MaSV=<?= $sv['MaSV'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="../controllers/SinhVienController.php?delete=<?= $sv['MaSV'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                                <a href="../controllers/SinhVienController.php?detail=<?= $sv['MaSV'] ?>" 
                                   class="btn btn-info btn-sm">Xem Chi Tiết</a>
                                <a href="hocphan.php?MaSV=<?= $sv['MaSV'] ?>" 
                                   class="btn btn-success btn-sm">Đăng Ký Học Phần</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
