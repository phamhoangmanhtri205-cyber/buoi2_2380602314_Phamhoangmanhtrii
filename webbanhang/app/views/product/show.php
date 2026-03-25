<?php include 'app/views/shares/header.php'; ?>
<?php 
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl = $basePath . '/index.php?url='; 
?>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <span><i class="fas fa-truck me-2"></i> GIAO HÀNG TOÀN QUỐC - MIỄN PHÍ ĐỔI TRẢ TRONG 7 NGÀY</span>
        <div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="<?= $baseUrl ?>Admin/index" class="btn btn-sm btn-danger fw-bold text-white me-3"><i class="fas fa-user-shield me-1"></i> Trang Quản Trị</a>
                <?php endif; ?>
                <span class="text-white me-3"><i class="fas fa-user me-1"></i> Xin chào, <?= htmlspecialchars($_SESSION['username']) ?> | <a href="<?= $baseUrl ?>User/logout" class="text-warning text-decoration-none fw-bold ms-1">Đăng xuất</a></span>
            <?php else: ?>
                <a href="<?= $baseUrl ?>User/login" class="text-white text-decoration-none me-3"><i class="fas fa-user me-1"></i> Đăng nhập / Đăng ký</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Nav -->
<nav class="main-nav shadow-sm mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="<?= $baseUrl ?>Product/list" class="brand-logo fw-bold fs-3 text-dark text-decoration-none">NEYMAR<span class="bg-gold px-2 ms-1 text-dark">SPORT</span></a>

        <div class="d-none d-lg-flex">
            <a href="<?= $baseUrl ?>Product/list" class="mx-3 text-dark fw-bold text-decoration-none">TRANG CHỦ</a>
            <a href="<?= $baseUrl ?>Product/list" class="mx-3 text-gold fw-bold text-decoration-none">GIÀY ĐÁ BANH</a>
            <a href="#" class="mx-3 text-dark fw-bold text-decoration-none">PHỤ KIỆN</a>
            <a href="#" class="mx-3 text-dark fw-bold text-decoration-none text-danger">SALE</a>
        </div>

        <div class="d-flex align-items-center">
            <div class="search-box me-3 d-none d-md-block">
                <div class="input-group">
                    <input type="text" class="search-input form-control form-control-sm" placeholder="Tìm kiếm...">
                </div>
            </div>
            <a href="<?= $baseUrl ?>Cart/index" class="text-dark text-decoration-none">
                <div class="position-relative cursor-pointer">
                    <i class="fas fa-shopping-bag fs-4"></i>
                    <?php $cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;"><?= $cartCount ?></span>
                </div>
            </a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $baseUrl ?>Product/list" class="text-dark text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="<?= $baseUrl ?>Product/list" class="text-dark text-decoration-none">Giày đá banh</a></li>
            <li class="breadcrumb-item active fw-bold" aria-current="page"><?= htmlspecialchars($product->name) ?></li>
        </ol>
    </nav>

    <div class="row gx-5">
        <!-- Cột Ảnh -->
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-light text-center border position-relative">
                <div class="badge-custom bg-danger text-white position-absolute top-0 start-0 m-3 px-3 py-1 fw-bold fs-6">-10%</div>
                <img src="<?= (!empty($product->image) && strpos($product->image, 'http') === 0) ? htmlspecialchars($product->image) : $basePath . '/' . (!empty($product->image) ? htmlspecialchars($product->image) : 'assets/no-image.jpg') ?>" 
                     alt="<?= htmlspecialchars($product->name) ?>" class="img-fluid" style="max-height: 500px; object-fit: contain;" onerror="this.src='https://placehold.co/500x500?text=No+Image'">
            </div>
            
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <div class="mt-3 text-center">
                    <a href="<?= $baseUrl ?>Product/edit/<?= $product->id ?>" class="btn btn-outline-dark fw-bold me-2"><i class="fas fa-edit me-1"></i> SỬA SẢN PHẨM</a>
                    <a href="<?= $baseUrl ?>Product/delete/<?= $product->id ?>" class="btn btn-outline-danger fw-bold" onclick="return confirm('Bạn chắc chắn muốn xóa?')"><i class="fas fa-trash me-1"></i> XÓA SẢN PHẨM</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Cột Thông tin -->
        <div class="col-md-6">
            <h1 class="fw-bold mb-3 text-uppercase"><?= htmlspecialchars($product->name) ?></h1>
            <div class="d-flex align-items-center mb-3">
                <span class="text-muted small me-4 border-end pe-4">Thương hiệu: <strong class="text-dark">NeymarSport</strong></span>
                <span class="text-muted small">Tình trạng: <strong class="text-success">Còn hàng</strong></span>
            </div>
            
            <div class="fs-2 fw-bold text-danger mb-4 border-bottom pb-4">
                <?= number_format($product->price, 0, ',', '.') ?>đ
            </div>

            <div class="mb-4">
                <h6 class="fw-bold mb-3">CHỌN SIZE GIÀY:</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold">39</button>
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold active border-dark bg-dark text-white">40</button>
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold">40.5</button>
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold">41</button>
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold">42</button>
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold">42.5</button>
                    <button class="btn btn-outline-dark rounded-0 px-3 fw-bold">43</button>
                </div>
            </div>

            <div class="card bg-light border-0 mb-4">
                <div class="card-body">
                    <ul class="list-unstyled mb-0 small" style="line-height: 2;">
                        <li><i class="fas fa-check-circle text-gold me-2"></i> Giày chính hãng 100% nhập khẩu từ NSX</li>
                        <li><i class="fas fa-check-circle text-gold me-2"></i> Bảo hành lỗi keo, chỉ 6 tháng</li>
                        <li><i class="fas fa-check-circle text-gold me-2"></i> Hỗ trợ trả góp 0% bằng thẻ tín dụng</li>
                        <li><i class="fas fa-sync-alt text-gold me-2"></i> Đổi size trong vòng 7 ngày</li>
                    </ul>
                </div>
            </div>

            <a href="<?= $baseUrl ?>Cart/add/<?= $product->id ?>" class="btn bg-dark text-white w-100 rounded-0 fs-5 fw-bold py-3 mb-3 hover-gold">
                THÊM VÀO GIỎ HÀNG
            </a>

            <!-- Accordion Thông số chi tiết -->
            <div class="accordion accordion-flush border mt-4" id="productSpecs">
                <div class="accordion-item shadow-none">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold bg-white text-dark rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#descCollapse">
                            MÔ TẢ SẢN PHẨM
                        </button>
                    </h2>
                    <div id="descCollapse" class="accordion-collapse collapse show" data-bs-parent="#productSpecs">
                        <div class="accordion-body text-muted" style="line-height: 1.8;">
                            <?= nl2br(htmlspecialchars($product->description)) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer style="background-color: var(--color-dark); padding: 60px 0 20px; margin-top: 50px; color: #CCC;">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <a href="#" class="brand-logo text-white mb-4 d-inline-block text-decoration-none fs-3 fw-bold">NEYMAR<span class="bg-gold px-2 ms-1 text-dark">SPORT</span></a>
                <p class="small pe-lg-5 mt-2">Đại lý phân phối giày đá bóng chính hãng giá tốt top hàng đầu Việt Nam.</p>
            </div>
            <div class="col-lg-4 text-center">
                <h6 class="text-white mb-3 text-uppercase fw-bold">CHÍNH SÁCH</h6>
                <p class="small mb-2"><a href="#" class="text-decoration-none text-muted">Bảo hành trọn đời</a></p>
                <p class="small mb-2"><a href="#" class="text-decoration-none text-muted">Hotline: 090 000 0000</a></p>
                <p class="small mb-2"><a href="#" class="text-decoration-none text-muted">Email: cskh@neymarsport.com</a></p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <h6 class="text-white mb-3 text-uppercase fw-bold">KẾT NỐI</h6>
                <div>
                    <a href="#" class="text-muted me-3 fs-4"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-muted me-3 fs-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-muted fs-4"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center small py-3 border-top border-secondary mt-3">Copyright © 2024 NEYMAR SPORT. Khoa CNTT.</div>
    </div>
</footer>

<style>
.hover-gold:hover {
    background-color: var(--color-gold) !important;
    color: var(--color-dark) !important;
}
</style>

<?php include 'app/views/shares/footer.php'; ?>
