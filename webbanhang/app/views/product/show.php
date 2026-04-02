<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl  = $basePath . '/index.php?url=';
$cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
// Tính giá gốc (giả lập +18%)
$salePrice    = $product->price ?? 0;
$originalPrice = round($salePrice * 1.18 / 1000) * 1000;
$discountPct   = $originalPrice > 0 ? round((1 - $salePrice / $originalPrice) * 100) : 0;
?><!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product->name ?? 'Chi tiết sản phẩm') ?> - NeymarSport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/neymarsport.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function logoutJWT() {
        localStorage.removeItem('jwtToken');
        window.location.href = '<?= $basePath ?>/index.php?url=User/logout';
    }
    </script>
    <style>
    :root { --gold:#c9a227; --dark:#111; }

    /* ===== HEADER (đồng bộ) ===== */
    .site-header { background:var(--dark); }
    .header-top  { padding:14px 0; }
    .brand-name  { font-family:'Oswald',sans-serif; font-size:30px; font-weight:700; letter-spacing:1px; text-decoration:none; color:var(--gold)!important; line-height:1; }
    .brand-name span { color:#fff; }
    .header-search { position:relative; flex:1; max-width:520px; margin:0 30px; }
    .header-search input { width:100%; border:none; border-radius:4px; padding:10px 44px 10px 18px; font-size:14px; background:#fff; outline:none; }
    .header-search input::placeholder { color:#aaa; }
    .header-search button { position:absolute; right:0; top:0; bottom:0; background:none; border:none; padding:0 14px; color:#555; cursor:pointer; font-size:16px; }
    .header-search button:hover { color:var(--gold); }
    .header-icons a { color:#ccc; text-decoration:none; font-size:22px; margin-left:18px; position:relative; transition:color .2s; }
    .header-icons a:hover { color:var(--gold); }
    .header-icons .badge-count { position:absolute; top:-7px; right:-9px; background:var(--gold); color:#000; font-size:10px; font-weight:700; border-radius:50%; width:18px; height:18px; display:flex; align-items:center; justify-content:center; }
    .user-info { font-size:13px; color:#aaa; margin-left:18px; }
    .user-info a { color:var(--gold); font-weight:600; text-decoration:none; }
    .header-nav { background:#1a1a1a; border-top:1px solid #2a2a2a; }
    .header-nav .container { display:flex; align-items:center; }
    .header-nav a { font-family:'Oswald',sans-serif; font-size:13px; font-weight:500; letter-spacing:0.6px; text-transform:uppercase; color:#ccc; text-decoration:none; padding:13px 14px; display:block; white-space:nowrap; transition:color .2s; position:relative; }
    .header-nav a:hover { color:var(--gold); }
    .header-nav a::after { content:''; position:absolute; bottom:0; left:14px; right:14px; height:2px; background:var(--gold); transform:scaleX(0); transition:transform .25s; }
    .header-nav a:hover::after { transform:scaleX(1); }
    .header-nav a.nav-sale { color:#e55; font-weight:700; }
    .header-nav .admin-btn { margin-left:auto; background:#e53935; color:#fff!important; padding:8px 16px; border-radius:3px; font-size:12px; }
    .header-nav .admin-btn::after { display:none; }

    /* ===== PRODUCT DETAIL ===== */
    body { background:#fff; font-family:'Inter',sans-serif; }

    .breadcrumb-bar { background:#f5f5f5; padding:10px 0; font-size:13px; border-bottom:1px solid #e8e8e8; }
    .breadcrumb-bar a { color:#555; text-decoration:none; }
    .breadcrumb-bar a:hover { color:var(--gold); }

    /* Badge giảm giá */
    .badge-sale { background:#e53935; color:#fff; font-weight:700; font-size:13px; padding:6px 12px; border-radius:3px; display:inline-block; margin-bottom:12px; }

    /* Tên sản phẩm */
    .product-title-main { font-size:22px; font-weight:700; text-transform:uppercase; line-height:1.3; margin-bottom:10px; color:#111; }

    /* Meta info */
    .product-meta { font-size:13px; color:#555; margin-bottom:12px; border-bottom:1px solid #eee; padding-bottom:12px; }
    .product-meta strong { color:#111; }
    .text-instock { color:#28a745; font-weight:600; }

    /* Giá */
    .price-original { font-size:16px; color:#999; text-decoration:line-through; margin-right:12px; }
    .price-current  { font-size:28px; font-weight:700; color:#e53935; }
    .price-vat      { font-size:12px; color:#777; margin-left:8px; }

    /* Cam kết chính hãng */
    .authentic-badge { background:#fff8e1; border:1px solid #ffd54f; border-radius:4px; padding:10px 16px; font-size:13px; font-weight:600; color:#d84315; margin:14px 0; }

    /* Size selector */
    .size-label { font-size:13px; font-weight:700; color:#111; margin-bottom:10px; }
    .size-label span { font-size:12px; color:var(--gold); font-weight:400; cursor:pointer; }
    .size-btn { border:1.5px solid #ccc; background:#fff; padding:7px 14px; font-size:14px; font-weight:600; cursor:pointer; border-radius:3px; transition:all .2s; min-width:52px; text-align:center; }
    .size-btn:hover, .size-btn.active { border-color:#111; background:#111; color:#fff; }

    /* Store branches */
    .store-section { border:1px solid #e8e8e8; border-radius:6px; padding:16px; margin:18px 0; }
    .store-section h6 { font-size:13px; font-weight:700; margin-bottom:4px; }
    .store-section p  { font-size:12px; color:#888; margin-bottom:10px; }
    .branch-card { border:1px solid #e8e8e8; border-radius:4px; padding:12px 16px; margin-bottom:8px; }
    .branch-card h6 { font-size:13px; font-weight:700; margin-bottom:4px; }
    .branch-card p  { font-size:12px; color:#666; margin-bottom:6px; }
    .branch-card a  { font-size:12px; color:#555; text-decoration:none; margin-right:14px; }
    .branch-card a:hover { color:var(--gold); }

    /* Buttons */
    .btn-buynow { background:#e53935; color:#fff; font-size:16px; font-weight:700; letter-spacing:1px; border:none; border-radius:4px; padding:16px; width:100%; cursor:pointer; transition:background .2s; }
    .btn-buynow:hover { background:#c62828; }
    .btn-addcart { background:#111; color:#fff; font-size:15px; font-weight:700; letter-spacing:1px; border:none; border-radius:4px; padding:13px; width:100%; cursor:pointer; margin-top:10px; transition:background .2s; }
    .btn-addcart:hover { background:#333; }

    /* Benefits bar */
    .benefits-bar { background:#f9f9f9; border-top:1px solid #eee; border-bottom:1px solid #eee; padding:20px 0; margin:30px 0; }
    .benefit-item { text-align:center; }
    .benefit-item i { font-size:24px; color:var(--gold); margin-bottom:6px; display:block; }
    .benefit-item strong { font-size:13px; font-weight:700; color:#e53935; display:block; }
    .benefit-item span { font-size:12px; color:#666; }

    /* Tabs */
    .product-tabs { margin-top:20px; }
    .tab-buttons { display:flex; border-bottom:2px solid #e8e8e8; gap:0; }
    .tab-btn { padding:12px 24px; font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:.5px; border:none; background:none; cursor:pointer; border-bottom:3px solid transparent; margin-bottom:-2px; color:#666; transition:all .2s; }
    .tab-btn.active { color:#e53935; border-bottom-color:#e53935; }
    .tab-content-area { padding:24px 0; font-size:14px; line-height:1.9; color:#444; }
    .tab-pane-custom { display:none; }
    .tab-pane-custom.show { display:block; }

    /* Image */
    .product-img-main { background:#f5f5f5; border:1px solid #eee; border-radius:6px; display:flex; align-items:center; justify-content:center; min-height:400px; position:relative; overflow:hidden; }
    .product-img-main img { max-height:420px; width:100%; object-fit:contain; }

    /* Admin controls */
    .admin-controls { margin-top:12px; }

    /* Footer */
    footer { background:#111; padding:50px 0 20px; color:#aaa; margin-top:50px; }
    footer .brand-name-f { font-family:'Oswald',sans-serif; font-size:26px; font-weight:700; color:var(--gold); }
    footer .brand-name-f span { color:#fff; }
    footer h6.ft { color:#fff; font-size:13px; text-transform:uppercase; font-weight:700; mb:16px; }
    footer a { color:#888; text-decoration:none; font-size:13px; transition:color .2s; }
    footer a:hover { color:var(--gold); }
    footer .ft-divider { border-color:#333; }
    footer .ft-copy { font-size:12px; color:#555; padding-top:16px; }
    </style>
</head>
<body>

<!-- ===== SITE HEADER ===== -->
<header class="site-header">
    <div class="header-top">
        <div class="container d-flex align-items-center">
            <a href="<?= $baseUrl ?>Product/list" class="brand-name me-4 flex-shrink-0">NEYMAR<span>SPORT</span></a>
            <div class="header-search d-none d-md-block">
                <input type="text" placeholder="Bạn cần tìm ...">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
            <div class="header-icons d-flex align-items-center ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-info d-none d-lg-block">
                        <i class="fas fa-user me-1"></i>
                        <?= htmlspecialchars($_SESSION['username']) ?> &nbsp;|&nbsp;
                        <a href="javascript:logoutJWT()">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    <a href="<?= $baseUrl ?>User/login" title="Đăng nhập"><i class="fas fa-user"></i></a>
                <?php endif; ?>
                <a href="<?= $baseUrl ?>Cart/index" title="Giỏ hàng">
                    <i class="fas fa-shopping-bag"></i>
                    <?php if ($cartCount > 0): ?><span class="badge-count"><?= $cartCount ?></span><?php endif; ?>
                </a>
            </div>
        </div>
    </div>
    <nav class="header-nav">
        <div class="container">
            <a href="<?= $baseUrl ?>Product/list">Trang chủ</a>
            <a href="<?= $baseUrl ?>Category/show/3">Giày Bóng Đá</a>
            <a href="<?= $baseUrl ?>Category/show/3">Nike</a>
            <a href="<?= $baseUrl ?>Category/show/4">Adidas</a>
            <a href="<?= $baseUrl ?>Category/show/30">Puma</a>
            <a href="<?= $baseUrl ?>Category/show/31">Mizuno</a>
            <a href="#">Phụ Kiện</a>
            <a href="#">Hướng Dẫn</a>
            <a href="#">Blog</a>
            <a href="#" class="nav-sale">Xả Kho</a>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <a href="<?= $baseUrl ?>Admin/index" class="admin-btn"><i class="fas fa-user-shield me-1"></i>Quản Trị</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container">
        <a href="<?= $baseUrl ?>Product/list">Trang chủ</a>
        <span class="mx-2">/</span>
        <a href="<?= $baseUrl ?>Product/list">Giày đá bóng</a>
        <span class="mx-2">/</span>
        <span class="text-dark fw-semibold"><?= htmlspecialchars($product->name) ?></span>
    </div>
</div>

<!-- ===== PRODUCT DETAIL ===== -->
<div class="container py-4">
    <div class="row gx-5">

        <!-- CỘT TRÁI: Ảnh -->
        <div class="col-md-6 mb-4">
            <div class="product-img-main">
                <?php if ($discountPct > 0): ?>
                    <div class="badge-sale position-absolute top-0 start-0 m-3">-<?= $discountPct ?>%</div>
                <?php endif; ?>
                <img src="<?= (!empty($product->image) && strpos($product->image, 'http') === 0) ? htmlspecialchars($product->image) : $basePath . '/' . (!empty($product->image) ? htmlspecialchars($product->image) : 'assets/no-image.jpg') ?>"
                     alt="<?= htmlspecialchars($product->name) ?>"
                     onerror="this.src='https://placehold.co/500x500?text=No+Image'">
            </div>
        </div><!-- end col-md-6 ảnh -->

        <!-- CỘT PHẢI: Thông tin -->
        <div class="col-md-6">

            <!-- Tên -->
            <h1 class="product-title-main"><?= htmlspecialchars($product->name) ?></h1>

            <!-- Meta -->
            <div class="product-meta">
                Nhãn Hiệu: <strong><?= htmlspecialchars($product->category_name ?? 'NeymarSport') ?></strong>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                SKU: <strong>NS-<?= str_pad($product->id, 4, '0', STR_PAD_LEFT) ?></strong>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                Đơn vị phân phối: <strong>Công ty TNHH NeymarSport</strong>
            </div>

            <!-- Cam kết chính hãng -->
            <div class="authentic-badge">
                <i class="fas fa-shield-alt me-2"></i>
                CAM KẾT SẢN PHẨM CHÍNH HÃNG 100%. ĐƯỢC BỒI HOÀN GẤP 10 LẦN NẾU KHÔNG PHẢI CHÍNH HÃNG
            </div>

            <!-- Giá -->
            <div class="d-flex align-items-baseline flex-wrap mb-3">
                <span class="price-original"><?= number_format($originalPrice, 0, ',', '.') ?>đ</span>
                <span class="price-current"><?= number_format($salePrice, 0, ',', '.') ?>đ</span>
                <span class="price-vat">(Đã bao gồm VAT)</span>
            </div>

            <!-- Tình trạng -->
            <div class="mb-3" style="font-size:13px;">
                Tình trạng: <span class="text-instock"><i class="fas fa-circle me-1" style="font-size:9px;"></i>Còn hàng</span>
            </div>

            <!-- Size -->
            <div class="mb-4">
                <div class="size-label">
                    SIZE &nbsp; <span><i class="fas fa-ruler me-1"></i>Hướng dẫn chọn size giày</span>
                </div>
                <div class="d-flex flex-wrap gap-2" id="size-options">
                    <?php foreach(['38.5','39','40','40.5','41','42','42.5','43','44'] as $s): ?>
                        <button class="size-btn <?= $s === '40' ? 'active' : '' ?>" onclick="selectSize(this)"><?= $s ?></button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Chi nhánh -->
            <div class="store-section">
                <h6><i class="fas fa-map-marker-alt me-2 text-danger"></i>Xem chi nhánh có hàng</h6>
                <p>Có 3 cửa hàng có sản phẩm</p>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="branch-card">
                            <h6>Chi nhánh Thủ Đức</h6>
                            <p>148/7 Hoàng Diệu 2, Phường Linh Chiểu, TP.Thủ Đức</p>
                            <a href="tel:02862713504"><i class="fas fa-phone me-1"></i>02862713504</a>
                            <a href="#"><i class="fas fa-map-pin me-1"></i>Bản đồ</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="branch-card">
                            <h6>Chi nhánh Bình Thạnh</h6>
                            <p>43A Điện Biên Phủ, Phường 15, Quận Bình Thạnh</p>
                            <a href="tel:02862713907"><i class="fas fa-phone me-1"></i>02862713907</a>
                            <a href="#"><i class="fas fa-map-pin me-1"></i>Bản đồ</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="branch-card">
                            <h6>Chi nhánh Tân Bình</h6>
                            <p>307 Cộng Hoà, Phường 13, Quận Tân Bình, HCM</p>
                            <a href="tel:02822482307"><i class="fas fa-phone me-1"></i>02822482307</a>
                            <a href="#"><i class="fas fa-map-pin me-1"></i>Bản đồ</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nút mua -->
            <button class="btn-buynow" onclick="window.location.href='<?= $baseUrl ?>Cart/add/<?= $product->id ?>'">
                MUA NGAY
            </button>
            <a href="<?= $baseUrl ?>Cart/add/<?= $product->id ?>" class="btn-addcart d-block text-center text-decoration-none">
                THÊM VÀO GIỎ HÀNG
            </a>
        </div>
    </div>

    <!-- Tabs mô tả -->
    <div class="product-tabs">
        <div class="tab-buttons">
            <button class="tab-btn active" onclick="switchTab(this,'tab-desc')">Mô tả sản phẩm</button>
            <button class="tab-btn" onclick="switchTab(this,'tab-spec')">Thông số kỹ thuật</button>
            <button class="tab-btn" onclick="switchTab(this,'tab-guide')">Hướng dẫn mua hàng</button>
            <button class="tab-btn" onclick="switchTab(this,'tab-warranty')">Chính sách bảo hành</button>
        </div>
        <div class="tab-content-area">
            <div id="tab-desc" class="tab-pane-custom show">
                <?= nl2br(htmlspecialchars($product->description ?? '')) ?>
            </div>
            <div id="tab-spec" class="tab-pane-custom">
                <table class="table table-bordered" style="font-size:14px;">
                    <tr><th width="180">Thương hiệu</th><td><?= htmlspecialchars($product->category_name ?? 'NeymarSport') ?></td></tr>
                    <tr><th>SKU</th><td>NS-<?= str_pad($product->id, 4, '0', STR_PAD_LEFT) ?></td></tr>
                    <tr><th>Chất liệu mũi giày</th><td>Da tổng hợp cao cấp</td></tr>
                    <tr><th>Đế giày</th><td>Firm Ground (FG) – Sân tự nhiên</td></tr>
                    <tr><th>Xuất xứ</th><td>Nhập khẩu chính hãng</td></tr>
                    <tr><th>Phù hợp</th><td>Sân cỏ tự nhiên, sân cỏ nhân tạo ngắn</td></tr>
                </table>
            </div>
            <div id="tab-guide" class="tab-pane-custom">
                <p><strong>Bước 1:</strong> Chọn sản phẩm, chọn size và bấm "MUA NGAY" hoặc "THÊM VÀO GIỎ HÀNG".</p>
                <p><strong>Bước 2:</strong> Xem lại giỏ hàng và điền thông tin giao hàng.</p>
                <p><strong>Bước 3:</strong> Chọn phương thức thanh toán (COD / Chuyển khoản / Thẻ).</p>
                <p><strong>Bước 4:</strong> Xác nhận đơn hàng và chờ giao hàng từ 1–3 ngày làm việc.</p>
            </div>
            <div id="tab-warranty" class="tab-pane-custom">
                <ul style="line-height:2;">
                    <li><i class="fas fa-check-circle text-success me-2"></i>Bảo hành lỗi keo, chỉ trong vòng <strong>6 tháng</strong>.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Đổi size trong vòng <strong>7 ngày</strong> kể từ ngày nhận hàng.</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Hoàn tiền 100% nếu phát hiện hàng giả (kèm hình ảnh thực tế).</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i>Hỗ trợ check hàng khi nhận — không hài lòng không nhận.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- ===== SẢN PHẨM LIÊN QUAN ===== -->
<div class="container" id="related-section" style="margin-top:40px; margin-bottom:50px; display:none;">
    <style>
    .related-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:2px solid #111; padding-bottom:12px; }
    .related-header h5 { font-family:'Oswald',sans-serif; font-size:20px; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin:0; color:#111; }
    .related-nav { display:flex; gap:8px; }
    .related-nav button { width:36px; height:36px; border:1.5px solid #ccc; background:#fff; border-radius:3px; font-size:14px; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; }
    .related-nav button:hover { background:#111; color:#fff; border-color:#111; }
    .related-track-wrap { overflow:hidden; }
    .related-track { display:flex; gap:16px; transition:transform .4s ease; }
    .related-card { flex:0 0 calc(25% - 12px); min-width:0; background:#fff; border:1px solid #eee; border-radius:6px; overflow:hidden; text-decoration:none; color:#111; transition:box-shadow .2s; position:relative; }
    .related-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.12); }
    .related-card .r-badge { position:absolute; top:10px; left:10px; background:#e53935; color:#fff; font-size:11px; font-weight:700; padding:3px 8px; border-radius:3px; }
    .related-card .r-new  { position:absolute; top:10px; right:10px; background:#111; color:#fff; font-size:10px; font-weight:600; padding:3px 8px; border-radius:3px; }
    .related-card .r-img  { background:#f5f5f5; height:160px; display:flex; align-items:center; justify-content:center; overflow:hidden; }
    .related-card .r-img img { max-height:145px; max-width:100%; object-fit:contain; }
    .related-card .r-body { padding:12px; }
    .related-card .r-name { font-size:12px; font-weight:600; text-transform:uppercase; line-height:1.4; margin-bottom:8px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .related-card .r-price-ori { font-size:12px; color:#999; text-decoration:line-through; }
    .related-card .r-price     { font-size:15px; font-weight:700; color:#e53935; }
    @media(max-width:768px) { .related-card { flex:0 0 calc(50% - 8px); } }
    </style>

    <div class="related-header">
        <h5>Sản phẩm liên quan</h5>
        <div class="related-nav">
            <button id="rel-prev" onclick="relSlide(-1)"><i class="fas fa-chevron-left"></i></button>
            <button id="rel-next" onclick="relSlide(1)"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="related-track-wrap">
        <div class="related-track" id="related-track"></div>
    </div>
</div>

<!-- Benefits bar (đặt sau sản phẩm liên quan) -->
<div class="benefits-bar">
    <div class="container">
        <div class="row text-center g-3">
            <div class="col-6 col-md-2 benefit-item">
                <i class="fas fa-phone-alt"></i>
                <strong>0789.970.907</strong>
                <span>Hotline đặt hàng (8h30–21h)</span>
            </div>
            <div class="col-6 col-md-2 benefit-item">
                <i class="fas fa-gift"></i>
                <strong class="text-dark">Nhận Combo quà</strong>
                <span>Khi mua giày <a href="#" style="color:var(--gold);font-weight:600;">XEM</a></span>
            </div>
            <div class="col-6 col-md-2 benefit-item">
                <i class="fas fa-shipping-fast"></i>
                <strong class="text-dark">Giao hàng siêu tốc</strong>
                <span>TP.HCM, Biên Hoà 1–2h</span>
            </div>
            <div class="col-6 col-md-2 benefit-item">
                <i class="fas fa-credit-card"></i>
                <strong class="text-dark">Thanh toán linh hoạt</strong>
                <span>Tiền mặt, chuyển khoản, thẻ</span>
            </div>
            <div class="col-6 col-md-2 benefit-item">
                <i class="fas fa-truck"></i>
                <strong class="text-dark">Miễn phí vận chuyển</strong>
                <span>Đơn hàng từ 1.000.000đ+</span>
            </div>
            <div class="col-6 col-md-2 benefit-item">
                <i class="fas fa-exchange-alt"></i>
                <strong class="text-dark">Đổi hàng 7–14 ngày</strong>
                <span>Sản phẩm chưa qua sử dụng</span>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="brand-name-f mb-3">NEYMAR<span>SPORT</span></div>
                <p style="font-size:13px;">Đại lý phân phối giày đá bóng chính hãng giá tốt top hàng đầu Việt Nam.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="fs-5"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <h6 class="text-white text-uppercase fw-bold mb-3" style="font-size:13px;">Chính sách</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="#">Bảo hành trọn đời</a>
                    <a href="#">Chính sách đổi trả</a>
                    <a href="#">Hotline: 0789 970 907</a>
                    <a href="#">Email: cskh@neymarsport.com</a>
                </div>
            </div>
            <div class="col-lg-4">
                <h6 class="text-white text-uppercase fw-bold mb-3" style="font-size:13px;">Hệ thống cửa hàng</h6>
                <div class="d-flex flex-column gap-2" style="font-size:13px;">
                    <span><i class="fas fa-map-marker-alt me-2 text-danger"></i>148/7 Hoàng Diệu 2, TP.Thủ Đức</span>
                    <span><i class="fas fa-map-marker-alt me-2 text-danger"></i>43A Điện Biên Phủ, Q.Bình Thạnh</span>
                    <span><i class="fas fa-map-marker-alt me-2 text-danger"></i>307 Cộng Hoà, Q.Tân Bình</span>
                </div>
            </div>
        </div>
        <div class="text-center ft-copy border-top ft-divider border-secondary mt-3">
            Copyright © 2024 NEYMAR SPORT. Khoa CNTT.
        </div>
    </div>
</footer>

<script>
function selectSize(btn) {
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}
function switchTab(btn, tabId) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-pane-custom').forEach(p => p.classList.remove('show'));
    btn.classList.add('active');
    document.getElementById(tabId).classList.add('show');
}

// ===== SẢN PHẨM LIÊN QUAN =====
const currentProductId = <?= (int)$product->id ?>;
const relatedBaseUrl   = '<?= $baseUrl ?>';
const relatedBasePath  = '<?= $basePath ?>';
let relatedItems = [];
let relOffset = 0;
const REL_VISIBLE = window.innerWidth < 768 ? 2 : 4;

const jwtToken = localStorage.getItem('jwtToken');
$.ajax({
    url: '<?= $basePath ?>/index.php?url=api/product',
    type: 'GET',
    headers: jwtToken ? { 'Authorization': 'Bearer ' + jwtToken } : {},
    success: function(res) {
        // API trả về mảng hoặc {data:[...]}
        const list = Array.isArray(res) ? res : (res.data || []);
        relatedItems = list.filter(p => p.id != currentProductId);
        if (relatedItems.length === 0) return;

        const track = document.getElementById('related-track');
        track.innerHTML = relatedItems.map(function(p) {
            const price    = parseFloat(p.price) || 0;
            const oriPrice = Math.round(price * 1.15 / 1000) * 1000;
            const disc     = oriPrice > 0 ? Math.round((1 - price / oriPrice) * 100) : 0;
            const img      = (p.image && p.image.startsWith('http')) ? p.image
                            : (p.image ? relatedBasePath + '/' + p.image : 'https://placehold.co/300x300?text=No+Image');
            return `<a href="${relatedBaseUrl}Product/show/${p.id}" class="related-card">
                ${disc > 0 ? `<span class="r-badge">-${disc}%</span>` : ''}
                <span class="r-new">MỚI VỀ</span>
                <div class="r-img">
                    <img src="${img}" alt="${p.name}" onerror="this.src='https://placehold.co/300x300?text=No+Image'">
                </div>
                <div class="r-body">
                    <div class="r-name">${p.name}</div>
                    ${disc > 0 ? `<div class="r-price-ori">${oriPrice.toLocaleString('vi')}đ</div>` : ''}
                    <div class="r-price">${price.toLocaleString('vi')}đ</div>
                </div>
            </a>`;
        }).join('');

        document.getElementById('related-section').style.display = '';
        updateRelNav();
    },
    error: function() {
        // Nếu không có token, thử gọi không auth (sản phẩm không cần đăng nhập để xem)
        console.warn('Related products: auth failed, retrying without token');
    }
});

function relSlide(dir) {
    const maxOffset = Math.max(0, relatedItems.length - REL_VISIBLE);
    relOffset = Math.min(Math.max(relOffset + dir, 0), maxOffset);
    const track = document.getElementById('related-track');
    const cardW = track.querySelector('.related-card')?.offsetWidth || 0;
    const gap = 16;
    track.style.transform = `translateX(-${relOffset * (cardW + gap)}px)`;
    updateRelNav();
}
function updateRelNav() {
    const maxOffset = Math.max(0, relatedItems.length - REL_VISIBLE);
    document.getElementById('rel-prev').style.opacity = relOffset === 0 ? '0.35' : '1';
    document.getElementById('rel-next').style.opacity = relOffset >= maxOffset ? '0.35' : '1';
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
