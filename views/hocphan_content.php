<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Đăng Ký Học Phần</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark text-center">
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
                        <td class="text-center"><?= htmlspecialchars($hp['MaHP']) ?></td>
                        <td><?= htmlspecialchars($hp['TenHP']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($hp['SoTinChi']) ?></td>
                        <td class="text-center">
                            <form method="POST" action="../controllers/HocPhanController.php">
                                <input type="hidden" name="MaSV" value="<?= $MaSV ?>">
                                <input type="hidden" name="MaHP" value="<?= $hp['MaHP'] ?>">
                                <button type="submit" name="register" class="btn btn-primary btn-sm">
                                    Đăng Ký
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
