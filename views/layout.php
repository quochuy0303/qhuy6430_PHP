<?php
// ✅ Chỉ gọi session_start() nếu chưa có session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title : "Trang Chủ" ?></title>
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
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Thông Tin Cá Nhân</a></li>
                <li class="nav-item"><a class="nav-link" href="hocphan.php">Đăng Ký Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="giohang.php">Giỏ Hàng</a></li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['HoTen'])): ?>
                    <li class="nav-item"><span class="nav-link text-white">Xin chào, <?= $_SESSION['HoTen'] ?>!</span></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Đăng Xuất</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Đăng Nhập</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Nội dung trang -->
<!-- Nội dung trang -->
<div class="container mt-4">
    <?php 
    $file_path = __DIR__ . '/' . $content;
    if (!empty($content) && file_exists($file_path)) {
        include $file_path;
    } else {
        echo "<div class='alert alert-warning text-center'>Lỗi: Không tìm thấy nội dung trang!</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
