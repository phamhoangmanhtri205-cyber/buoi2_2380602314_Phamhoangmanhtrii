<?php include 'app/views/shares/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<style>
:root { --neymar-yellow: #ffcc00; --neymar-dark: #111; }
body { font-family: 'Roboto', sans-serif; background-color: #f8f9fa; }
.cart-header { background: var(--neymar-dark); color: white; font-family: 'Oswald', sans-serif; text-transform: uppercase; padding: 20px; border-bottom: 4px solid var(--neymar-yellow); }
.table th { font-family: 'Oswald', sans-serif; text-transform: uppercase; color: #555; border-bottom: 2px solid #ddd; }
.table td { vertical-align: middle; }
.btn-cart-action { background: var(--neymar-dark); color: white; border: none; font-family: 'Oswald', sans-serif; }
.btn-cart-action:hover { background: var(--neymar-yellow); color: black; }
.btn-checkout { background: var(--neymar-yellow); color: black; font-family: 'Oswald', sans-serif; font-size: 1.2rem; font-weight: 700; border-radius: 0; padding: 15px; width: 100%; border: none; transition: 0.3s; }
.btn-checkout:hover { background: var(--neymar-dark); color: var(--neymar-yellow); }
.qty-input { width: 50px; text-align: center; border: 1px solid #ddd; }
</style>

<div class="container mt-5 mb-5">
    <?php
    if (isset($_SESSION['checkout_error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>' . htmlspecialchars($_SESSION['checkout_error']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['checkout_error']);
    }
    ?>
    <div class="card shadow-sm border-0">
        <div class="cart-header text-center">
            <h2 class="m-0"><i class="fas fa-shopping-cart me-2 text-warning"></i> GIỎ HÀNG CỦA BẠN</h2>
        </div>
        <div class="card-body p-0">
            <?php 
            $basePath = dirname($_SERVER['SCRIPT_NAME']);
            $basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
            ?>
            <?php if(empty($cart)): ?>
                <div class="text-center p-5">
                    <h4 class="text-muted mb-4">Giỏ hàng đang trống</h4>
                    <a href="<?= $basePath ?>/index.php?url=Product/list" class="btn btn-dark fw-bold px-4 rounded-0">TIẾP TỤC MUA SẮM</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Sản Phẩm</th>
                                <th class="text-center">Đơn Giá</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Thành Tiền</th>
                                <th class="text-center"><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; foreach($cart as $id => $item): 
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td class="ps-4 d-flex align-items-center">
                                    <img src="<?= $basePath ?>/<?= $item['image'] ?>" width="60" class="img-thumbnail me-3 shadow-sm" onerror="this.src='https://placehold.co/100x100?text=IMG'">
                                    <span class="fw-bold ms-3"><?= htmlspecialchars($item['name']) ?></span>
                                </td>
                                <td class="text-center text-danger fw-bold align-middle"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                                <td class="text-center align-middle">
                                    <form action="<?= $basePath ?>/index.php?url=Cart/update" method="POST" class="d-inline-flex align-items-center">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary rounded-0">-</button>
                                        <input type="text" class="qty-input py-1" value="<?= $item['quantity'] ?>" readonly>
                                        <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary rounded-0">+</button>
                                    </form>
                                </td>
                                <td class="text-center text-danger fw-bold align-middle fs-5"><?= number_format($subtotal, 0, ',', '.') ?>đ</td>
                                <td class="text-center align-middle">
                                    <a href="<?= $basePath ?>/index.php?url=Cart/remove/<?= $id ?>" class="btn btn-sm btn-danger rounded-0"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 bg-light border-top d-flex justify-content-between align-items-center">
                    <a href="<?= $basePath ?>/index.php?url=Product/list" class="text-decoration-none text-dark fw-bold"><i class="fas fa-arrow-left me-1"></i> Quay lại mua sắm</a>
                    <div class="text-end">
                        <h4 class="mb-3 font-oswald">TỔNG CỘNG: <span class="text-danger fw-bold fs-2"><?= number_format($total, 0, ',', '.') ?>đ</span></h4>
                        <a href="<?= $basePath ?>/index.php?url=Cart/checkout" class="btn btn-checkout shadow"><i class="fas fa-credit-card me-2"></i>TIẾN HÀNH THANH TOÁN</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>