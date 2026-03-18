<?php include 'app/views/shares/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<style>
:root { --neymar-yellow: #ffcc00; --neymar-dark: #111; }
body { background-color: #f4f5f7; }
.checkout-title { font-family: 'Oswald', sans-serif; border-left: 5px solid var(--neymar-yellow); padding-left: 10px; text-transform: uppercase; }
.form-control { border-radius: 0; padding: 12px; }
.form-control:focus { border-color: var(--neymar-yellow); box-shadow: none; }
.order-summary { background: var(--neymar-dark); color: white; padding: 30px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
.btn-submit { background: var(--neymar-yellow); color: #000; font-family: 'Oswald', sans-serif; font-size: 1.2rem; padding: 15px; border: none; border-radius: 4px; transition: 0.3s; }
.btn-submit:hover { background: #fff; color: #000; transform: translateY(-3px); }
</style>

<div class="container mt-5 mb-5">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="checkout-title mb-4">THÔNG TIN GIAO HÀNG</h3>
                <?php 
                $basePath = dirname($_SERVER['SCRIPT_NAME']);
                $basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
                ?>
                <form action="<?= $basePath ?>/index.php?url=Cart/processCheckout" method="POST">
                    <div class="mb-3">
                        <label class="fw-bold mb-2">Họ và tên *</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên đầy đủ..." required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold mb-2">Số điện thoại *</label>
                        <input type="text" name="phone" class="form-control" placeholder="Ví dụ: 0901234567..." required>
                    </div>
                    <div class="mb-4">
                        <label class="fw-bold mb-2">Địa chỉ nhận hàng chi tiết *</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Số nhà, Đường, Phường/Xã, Quận/Huyện..." required></textarea>
                    </div>
                    
                    <h4 class="checkout-title mt-5 mb-3">PHƯƠNG THỨC THANH TOÁN</h4>
                    <div class="border p-3 mb-2 bg-light">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" checked>
                            <label class="form-check-label fw-bold">Thanh toán khi nhận hàng (COD)</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-submit w-100 mt-4 shadow">XÁC NHẬN ĐẶT HÀNG</button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="order-summary sticky-top" style="top: 20px;">
                <h4 class="font-oswald border-bottom border-secondary pb-3 mb-4">TÓM TẮT ĐƠN HÀNG</h4>
                <?php 
                $total = 0;
                foreach($_SESSION['cart'] as $item): 
                    $sub = $item['price'] * $item['quantity'];
                    $total += $sub;
                ?>
                <div class="d-flex justify-content-between mb-3 border-bottom border-secondary pb-2">
                    <div class="text-light">
                        <span class="fw-bold d-block"><?= htmlspecialchars($item['name']) ?></span>
                        <small class="text-muted">SL: <?= $item['quantity'] ?> x <?= number_format($item['price'], 0, ',', '.') ?>đ</small>
                    </div>
                    <div class="text-warning fw-bold"><?= number_format($sub, 0, ',', '.') ?>đ</div>
                </div>
                <?php endforeach; ?>
                
                <div class="d-flex justify-content-between mt-4 pt-3 border-top border-secondary">
                    <h5 class="mb-0">TỔNG CỘNG</h5>
                    <h3 class="mb-0 text-warning font-oswald"><?= number_format($total, 0, ',', '.') ?> VNĐ</h3>
                </div>
                <p class="text-center text-muted small mt-4"><i class="fas fa-shield-alt"></i> Mua sắm an toàn & bảo mật 100% tại NeymarSport</p>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>