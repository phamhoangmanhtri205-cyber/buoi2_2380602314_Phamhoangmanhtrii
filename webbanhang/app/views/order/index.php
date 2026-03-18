<?php include 'app/views/shares/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<style>
:root { --neymar-yellow: #ffcc00; --neymar-dark: #111; }
body { background-color: #f8f9fa; }
.header-title { font-family: 'Oswald', sans-serif; background: var(--neymar-dark); color: #fff; padding: 25px; border-bottom: 4px solid var(--neymar-yellow); text-transform: uppercase; }
.badge-pending { background-color: #f39c12; color: #fff; }
.badge-completed { background-color: #27ae60; color: #fff; }
.badge-cancelled { background-color: #e74c3c; color: #fff; }
</style>

<div class="container mt-5 mb-5">
    <div class="card border-0 shadow">
        <div class="header-title text-center">
            <h2 class="m-0"><i class="fas fa-box-open me-2 text-warning"></i> QUẢN LÝ ĐƠN HÀNG</h2>
        </div>
        <div class="card-body p-0">
            <?php 
            $basePath = dirname($_SERVER['SCRIPT_NAME']);
            $basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
            ?>
            <?php if(empty($orders)): ?>
                <div class="text-center p-5">
                    <p class="text-muted fs-4">Chưa có đơn hàng nào.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light font-oswald text-uppercase text-muted">
                            <tr>
                                <th class="ps-4">Mã ĐH</th>
                                <th>Khách Hàng</th>
                                <th>Ngày Đặt</th>
                                <th class="text-end">Tổng Tiền</th>
                                <th class="text-center">Trạng Thái</th>
                                <th class="text-center pe-4">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order): ?>
                            <tr>
                                <td class="ps-4 fw-bold">#<?= $order->id ?></td>
                                <td>
                                    <div class="fw-bold"><?= htmlspecialchars($order->customer_name) ?></div>
                                    <small class="text-muted"><i class="fas fa-phone fa-xs"></i> <?= htmlspecialchars($order->customer_phone) ?></small>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></td>
                                <td class="text-end text-danger fw-bold fs-6"><?= number_format($order->total_price, 0, ',', '.') ?>đ</td>
                                <td class="text-center">
                                    <?php 
                                        if($order->status == 'pending') echo '<span class="badge badge-pending px-3 py-2 rounded-pill">Đang chờ duyệt</span>';
                                        elseif($order->status == 'completed') echo '<span class="badge badge-completed px-3 py-2 rounded-pill">Đã hoàn thành</span>';
                                        else echo '<span class="badge badge-cancelled px-3 py-2 rounded-pill">Đã hủy</span>';
                                    ?>
                                </td>
                                <td class="text-center pe-4">
                                    <a href="<?= $basePath ?>/index.php?url=Order/show/<?= $order->id ?>" class="btn btn-sm btn-info text-dark fw-bold me-1"><i class="fas fa-eye"></i> Chi tiết</a>
                                    <?php if($order->status == 'pending'): ?>
                                        <a href="<?= $basePath ?>/index.php?url=Order/cancel/<?= $order->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')"><i class="fas fa-times me-1"></i>Hủy đơn</a>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-light text-muted" disabled>Không thể hủy</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <div class="p-3 bg-light border-top text-end">
                <a href="<?= $basePath ?>/index.php?url=Product/list" class="btn btn-dark rounded-0 fw-bold px-4">QUAY VỀ TRANG CHỦ</a>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>