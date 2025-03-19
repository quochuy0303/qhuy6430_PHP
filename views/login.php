<?php
session_start();
$title = "Đăng Nhập";
$content = "login_content.php"; // Nội dung trang đăng nhập
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Test1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Sinh Viên</a></li>
                <li class="nav-item"><a class="nav-link" href="hocphan.php">Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="dangky.php">Đăng Ký</a></li>
                <li class="nav-item"><a class="nav-link active" href="login.php">Đăng Nhập</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Nội dung đăng nhập -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <div class="card-header bg-primary text-white text-center">
            <h3>Đăng Nhập</h3>
        </div>
        <div class="card-body">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Mã sinh viên không hợp lệ!</div>
            <?php endif; ?>
            <form action="../controllers/LoginController.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Mã Sinh Viên</label>
                    <input type="text" name="MaSV" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Đăng Nhập</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="index.php" class="text-muted">← Quay lại trang chủ</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
