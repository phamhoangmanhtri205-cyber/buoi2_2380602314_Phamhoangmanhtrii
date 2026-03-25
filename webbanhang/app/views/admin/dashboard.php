<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #343a40; padding-top: 20px; }
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 12px 20px; display: block; font-weight: 500; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #007bff; color: white; border-radius: 5px; margin: 0 10px; }
        .topbar { background-color: white; padding: 15px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .stat-card { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .stat-icon { font-size: 30px; color: #007bff; }
    </style>
</head>
<body>

<?php 
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl = $basePath . '/index.php?url='; 
?>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" style="width: 250px;">
        <h3 class="text-white text-center mb-4"><i class="fas fa-store"></i> My Store DB</h3>
        <a href="<?= $baseUrl ?>Admin/index" class="active"><i class="fas fa-home me-2"></i> Tổng quan</a>
        <a href="<?= $baseUrl ?>Admin/products"><i class="fas fa-box me-2"></i> Quản lý Sản phẩm</a>
        <a href="<?= $baseUrl ?>Admin/categories"><i class="fas fa-tags me-2"></i> Quản lý Danh mục</a>
        <a href="<?= $baseUrl ?>Admin/orders"><i class="fas fa-shopping-cart me-2"></i> Quản lý Đơn hàng</a>
        <hr class="text-secondary mx-3">
        <a href="<?= $baseUrl ?>Product/index" target="_blank"><i class="fas fa-external-link-alt me-2"></i> Xem Website</a>
        <a href="<?= $baseUrl ?>User/logout" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Trang Quản Trị Hệ Thống</h4>
            <div>
                <span class="me-3 fw-bold"><i class="fas fa-user-shield me-1"></i> Admin: <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
            </div>
        </div>

        <div class="container-fluid px-4">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="stat-card d-flex align-items-center justify-content-between border-left-primary">
                        <div>
                            <p class="text-muted mb-1 text-uppercase fw-bold" style="font-size: 12px;">Tổng Số Sản Phẩm</p>
                            <h2 class="mb-0 fw-bold"><?= count($products) ?></h2>
                        </div>
                        <i class="fas fa-box stat-icon"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 text-uppercase fw-bold" style="font-size: 12px;">Tổng Số Danh Mục</p>
                            <h2 class="mb-0 fw-bold"><?= count($categories) ?></h2>
                        </div>
                        <i class="fas fa-tags stat-icon text-success"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 fw-bold text-primary">Lối tắt thao tác</h6>
                        </div>
                        <div class="card-body">
                            <a href="<?= $baseUrl ?>Product/add" class="btn btn-primary me-2"><i class="fas fa-plus"></i> Thêm Sản Phẩm Mới</a>
                            <a href="<?= $baseUrl ?>Category/add" class="btn btn-success"><i class="fas fa-plus"></i> Thêm Danh Mục Mới</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
