<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm Sinh Viên</title>
    <!-- Thêm Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h3 class="text-center">Thêm Sinh Viên</h3>
        </div>
        <div class="card-body">
            <form action="../controllers/SinhVienController.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Mã Sinh Viên</label>
                    <input type="text" name="MaSV" class="form-control" placeholder="Nhập Mã Sinh Viên" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" name="HoTen" class="form-control" placeholder="Nhập Họ Tên" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select name="GioiTinh" class="form-select">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chọn Ảnh</label>
                    <input type="file" name="Hinh" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mã Ngành</label>
                    <input type="text" name="MaNganh" class="form-control" placeholder="Nhập Mã Ngành" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="add" class="btn btn-primary">Thêm Sinh Viên</button>
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
