<?php include 'app/views/shares/header.php'; ?>
<?php
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl  = $basePath . '/index.php?url=';
$cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<style>
:root { --gold: #c9a227; --dark: #111; }
.site-header { background: var(--dark); }
.header-top { padding: 14px 0; }
.brand-name { font-family:'Oswald',sans-serif; font-size:30px; font-weight:700; letter-spacing:1px; text-decoration:none; color:var(--gold)!important; line-height:1; }
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
.header-nav a:hover, .header-nav a.active { color:var(--gold); }
.header-nav a::after { content:''; position:absolute; bottom:0; left:14px; right:14px; height:2px; background:var(--gold); transform:scaleX(0); transition:transform .25s; }
.header-nav a:hover::after, .header-nav a.active::after { transform:scaleX(1); }
.header-nav a.nav-sale { color:#e55; font-weight:700; }
.header-nav a.nav-sale:hover { color:#ff3333; }
.header-nav .admin-btn { margin-left:auto; background:#e53935; color:#fff!important; padding:8px 16px; border-radius:3px; font-size:12px; }
.header-nav .admin-btn:hover { background:#c62828!important; }
.header-nav .admin-btn::after { display:none; }
</style>

<!-- ===== SITE HEADER ===== -->
<header class="site-header">
    <!-- Dòng 1: Logo + Search + Icons -->
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
    <!-- Dòng 2: Nav Menu -->
    <nav class="header-nav">
        <div class="container">
            <a href="<?= $baseUrl ?>Product/list">Trang chủ</a>
            <a href="<?= $baseUrl ?>Category/show/3" class="<?= (isset($category) && $category->id == 3) ? 'active' : '' ?>">Giày Bóng Đá</a>
            <a href="<?= $baseUrl ?>Category/show/3" class="<?= (isset($category) && $category->id == 3) ? 'active' : '' ?>">Nike</a>
            <a href="<?= $baseUrl ?>Category/show/4" class="<?= (isset($category) && $category->id == 4) ? 'active' : '' ?>">Adidas</a>
            <a href="<?= $baseUrl ?>Category/show/30" class="<?= (isset($category) && $category->id == 30) ? 'active' : '' ?>">Puma</a>
            <a href="<?= $baseUrl ?>Category/show/31" class="<?= (isset($category) && $category->id == 31) ? 'active' : '' ?>">Mizuno</a>
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


<div class="container pb-5">
    <div class="row">
        <!-- Sidebar Danh mục -->
        <div class="col-lg-3 pe-lg-4">
            <div class="sidebar-sticky">
                <div class="sidebar-title d-flex justify-content-between align-items-center">
                    DANH MỤC SẢN PHẨM
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="<?= $baseUrl ?>Category/add" class="btn btn-xs btn-dark rounded-circle" title="Thêm danh mục">
                        <i class="fas fa-plus" style="font-size: 10px;"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <ul class="category-list">
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                        <li class="category-item">
                            <a href="<?= $baseUrl ?>Category/show/<?= $cat->id ?>" class="category-link"><i class="fas fa-chevron-right text-muted me-2" style="font-size:10px;"></i> <?= htmlspecialchars($cat->name) ?></a>
                            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                            <div class="d-flex gap-2">
                                <a href="<?= $baseUrl ?>Category/edit/<?= $cat->id ?>" class="text-primary"><i class="fas fa-edit"></i></a>
                                <a href="<?= $baseUrl ?>Category/delete/<?= $cat->id ?>" class="text-danger" onclick="return confirm('Xóa?')"><i class="fas fa-trash"></i></a>
                            </div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted small">Chưa có danh mục nào.</li>
                    <?php endif; ?>
                </ul>
                
                <div class="sidebar-title mt-4">MỨC GIÁ</div>
                <div class="form-check mb-2">
                    <input class="form-check-input border-dark" type="checkbox" value="" id="price1">
                    <label class="form-check-label" for="price1">Dưới 1,000,000đ</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input border-dark" type="checkbox" value="" id="price2">
                    <label class="form-check-label" for="price2">1,000,000đ - 2,000,000đ</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input border-dark" type="checkbox" value="" id="price3">
                    <label class="form-check-label" for="price3">Trên 2,000,000đ</label>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <div class="d-flex align-items-center">
                    <h4 class="fw-bold m-0 me-3 text-uppercase text-dark">
                        <?= isset($category) ? htmlspecialchars($category->name) : 'TẤT CẢ SẢN PHẨM Ở DANH MỤC NÀY' ?>
                    </h4>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="<?= $baseUrl ?>Product/add" class="btn btn-dark btn-sm rounded-0 fw-bold px-3">
                        <i class="fas fa-plus me-1"></i> THÊM
                    </a>
                    <?php endif; ?>
                </div>
                <div>
                    <select class="form-select form-select-sm rounded-0 border-dark" style="width: 150px;">
                        <option>Mới nhất</option>
                        <option>Giá tăng dần</option>
                        <option>Giá giảm dần</option>
                    </select>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-lg-3 g-3">
                <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="product-card h-100">
                        <div class="badge-custom">MỚI</div>
                        <?php if($product->price < 2000000): ?>
                            <div class="badge-custom badge-discount">-10%</div>
                        <?php endif; ?>
                        
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                        <div class="admin-float-actions">
                            <a href="<?= $baseUrl ?>Product/edit/<?= $product->id ?>" class="btn-admin-icon" title="Sửa"><i class="fas fa-pen"></i></a>
                            <a href="<?= $baseUrl ?>Product/delete/<?= $product->id ?>" onclick="return confirm('Xóa?')" class="btn-admin-icon text-danger" title="Xóa"><i class="fas fa-trash"></i></a>
                        </div>
                        <?php endif; ?>

                        <div class="product-img-wrapper cursor-pointer" onclick="window.location.href='<?= $baseUrl ?>Product/show/<?= $product->id ?>'">
                            <img src="<?= (!empty($product->image) && strpos($product->image, 'http') === 0) ? htmlspecialchars($product->image) : $basePath . '/' . (!empty($product->image) ? htmlspecialchars($product->image) : 'assets/no-image.jpg') ?>" 
                                 class="product-img" alt="<?= htmlspecialchars($product->name) ?>" onerror="this.src='https://placehold.co/500x500?text=No+Image'">
                        </div>

                        <a href="<?= $baseUrl ?>Product/show/<?= $product->id ?>" class="product-title">
                            <?= htmlspecialchars($product->name) ?>
                        </a>
                        <div class="product-price">
                            <?= number_format($product->price, 0, ',', '.') ?>đ
                        </div>
                        
                        <a href="<?= $baseUrl ?>Cart/add/<?= $product->id ?>" class="btn bg-dark text-white w-100 rounded-0 fw-bold py-2 mt-auto" style="font-size: 13px;">
                            THÊM VÀO GIỎ
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if(empty($products)): ?>
                <div class="text-center py-5">
                    <p class="text-muted">Không tìm thấy sản phẩm nào.</p>
                </div>
            <?php endif; ?>
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

<?php include 'app/views/shares/footer.php'; ?>