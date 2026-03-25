<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn Hàng - Admin Dashboard</title>
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
        <a href="<?= $baseUrl ?>Admin/categories"><i class="fas fa-tags me-2"></i> Quản lý Danh mục</a>
        <a href="<?= $baseUrl ?>Admin/orders" class="active"><i class="fas fa-shopping-cart me-2"></i> Quản lý Đơn hàng</a>
        <hr class="text-secondary mx-3">
        <a href="<?= $baseUrl ?>Product/index" target="_blank"><i class="fas fa-external-link-alt me-2"></i> Xem Website</a>
        <a href="<?= $baseUrl ?>User/logout" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <div class="topbar d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Quản lý Đơn hàng</h4>
            <span class="fw-bold"><i class="fas fa-user-shield me-1"></i> Admin: <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></span>
        </div>

        <div class="container-fluid px-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">Danh sách Đơn hàng Mới nhất</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#ID</th>
                                <th>Khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ giao hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt</th>
                                <th class="text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($orders)): ?>
                                <?php foreach ($orders as $o): ?>
                                <tr>
                                    <td><strong>#<?= $o->id ?></strong></td>
                                    <td><?= htmlspecialchars($o->customer_name) ?></td>
                                    <td><?= htmlspecialchars($o->customer_phone) ?></td>
                                    <td><?= htmlspecialchars($o->customer_address) ?></td>
                                    <td class="text-danger fw-bold"><?= number_format($o->total_price, 0, ',', '.') ?> đ</td>
                                    <td>
                                        <?php if($o->status == 'pending'): ?>
                                            <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> Chờ xử lý</span>
                                        <?php elseif($o->status == 'completed'): ?>
                                            <span class="badge bg-success"><i class="fas fa-check"></i> Hoàn thành</span>
                                        <?php elseif($o->status == 'cancelled'): ?>
                                            <span class="badge bg-danger"><i class="fas fa-times"></i> Đã hủy</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= htmlspecialchars($o->status) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><small><?= date('d/m/Y H:i', strtotime($o->created_at)) ?></small></td>
                                    <td class="text-center">
                                        <a href="<?= $baseUrl ?>Order/show/<?= $o->id ?>" class="btn btn-sm btn-info text-white" target="_blank" title="Xem Chi Tiết"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="8" class="text-center text-muted py-4">Chưa có đơn hàng nào trong hệ thống.</td></tr>
                            <?php endif; ?>
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
