<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Danh Mục - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #343a40; padding-top: 20px; }
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 12px 20px; display: block; font-weight: 500; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background-color: #007bff; color: white; border-radius: 5px; margin: 0 10px; }
        .topbar { background-color: white; padding: 15px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
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
        <a href="<?= $baseUrl ?>Admin/index"><i class="fas fa-home me-2"></i> Tổng quan</a>
        <a href="<?= $baseUrl ?>Admin/products"><i class="fas fa-box me-2"></i> Quản lý Sản phẩm</a>
        <a href="<?= $baseUrl ?>Admin/categories" class="active"><i class="fas fa-tags me-2"></i> Quản lý Danh mục</a>
        <a href="<?= $baseUrl ?>Admin/orders"><i class="fas fa-shopping-cart me-2"></i> Quản lý Đơn hàng</a>
        <hr class="text-secondary mx-3">
        <a href="<?= $baseUrl ?>Product/index" target="_blank"><i class="fas fa-external-link-alt me-2"></i> Xem Website</a>
        <a href="<?= $baseUrl ?>User/logout" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <div class="topbar d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Quản lý Danh mục</h4>
            <span class="fw-bold"><i class="fas fa-user-shield me-1"></i> Admin: <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        </div>

        <div class="container-fluid px-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Danh sách Danh mục</h6>
                    <a href="<?= $baseUrl ?>Category/add" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Thêm mới</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $c): ?>
                            <tr>
                                <td><?= $c->id ?></td>
                                <td><?= htmlspecialchars($c->name) ?></td>
                                <td><?= htmlspecialchars($c->description ?? '') ?></td>
                                <td class="text-center">
                                    <a href="<?= $baseUrl ?>Category/edit/<?= $c->id ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="<?= $baseUrl ?>Category/delete/<?= $c->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa danh mục này?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
