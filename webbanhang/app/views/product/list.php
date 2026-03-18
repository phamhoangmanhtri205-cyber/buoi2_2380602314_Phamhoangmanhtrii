<?php include 'app/views/shares/header.php'; ?>

<!-- Import Font & Animation Libraries -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
:root {
--neymar-yellow: #ffcc00;
--neymar-dark: #111;
--neymar-gray: #f8f8f8;
--neymar-text: #333;
--neymar-red: #e10600;
--transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
}

body {
    background-color: #fff;
    font-family: 'Roboto', sans-serif;
    color: var(--neymar-text);
    overflow-x: hidden;
}

h1, h2, h3, .brand-logo, .btn-shopping, .sidebar-title {
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
}

/* --- Custom Scrollbar --- */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: #f1f1f1; }
::-webkit-scrollbar-thumb { background: var(--neymar-dark); }

/* --- Header & Nav --- */
.top-bar {
    background: var(--neymar-dark);
    color: #fff;
    font-size: 11px;
    letter-spacing: 1px;
    padding: 8px 0;
}

.main-nav {
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(10px);
    border-bottom: 2px solid var(--neymar-yellow);
    padding: 10px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.brand-logo {
    font-size: 28px;
    color: var(--neymar-dark);
    text-decoration: none;
    letter-spacing: -1px;
    font-weight: 700;
}

.brand-logo span {
    background: var(--neymar-yellow);
    padding: 0 8px;
    margin-left: 3px;
}

/* --- Category Sidebar --- */
.sidebar-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 3px solid var(--neymar-yellow);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-list {
    list-style: none;
    padding: 0;
}

.category-item {
    margin-bottom: 2px;
    position: relative;
    transition: var(--transition);
    border-radius: 4px;
}

.category-item:hover {
    background: var(--neymar-gray);
}

.category-link {
    color: #444;
    text-decoration: none;
    padding: 12px 15px;
    display: block;
    transition: var(--transition);
    font-weight: 500;
    flex-grow: 1;
}

.category-item:hover .category-link {
    color: var(--neymar-red);
    padding-left: 25px;
}

.category-actions {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    display: none;
    gap: 8px;
    background: var(--neymar-gray);
    padding-left: 10px;
}

.category-item:hover .category-actions {
    display: flex;
}

/* --- Hero Banner --- */
.hero-banner {
    height: 450px;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                url('https://images.unsplash.com/photo-1510129107424-48208398b7be?q=80&w=2070&auto=format&fit=crop');
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    color: white;
    margin-bottom: 50px;
    clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
}

/* --- Product Card --- */
.product-card {
    border: none;
    border-radius: 0;
    overflow: hidden;
    transition: var(--transition);
    background: #fff;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.image-wrapper {
    position: relative;
    overflow: hidden;
    background: #fff;
    height: 280px;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.product-card:hover .product-img {
    transform: scale(1.15);
}

/* Overlay Shopping Buttons */
.shopping-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    opacity: 0;
    transition: var(--transition);
    z-index: 5;
}

.product-card:hover .shopping-overlay {
    opacity: 1;
    background: rgba(0,0,0,0.5);
}

.btn-action {
    width: 80%;
    transform: translateY(20px);
    transition: var(--transition);
    opacity: 0;
    font-size: 12px;
    letter-spacing: 1px;
}

.product-card:hover .btn-action {
    transform: translateY(0);
    opacity: 1;
}

/* Admin Buttons - Floating Style */
.admin-float-actions {
    position: absolute;
    top: 15px;
    right: -60px;
    z-index: 10;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.product-card:hover .admin-float-actions {
    right: 15px;
}

.btn-admin-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    color: #333;
    text-decoration: none;
}

.btn-admin-icon:hover {
    background: var(--neymar-dark);
    color: white;
}

/* --- Footer --- */
footer {
    background: #000;
    color: #888;
    padding: 80px 0 20px;
    margin-top: 100px;
}

footer h5 { color: #fff; margin-bottom: 25px; }

.btn-buy { background: var(--neymar-yellow); color: #000; border: none; }
.btn-cart { background: #fff; color: #000; border: none; }
.btn-detail { background: transparent; color: #fff; border: 1px solid #fff; }

.btn-buy:hover { background: #fff; }
.btn-cart:hover { background: var(--neymar-yellow); }
.btn-detail:hover { background: #fff; color: #000; }

.pulse {
    animation: pulse-red 2s infinite;
}

@keyframes pulse-red {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container d-flex justify-content-between align-items-center">
        <span><i class="fas fa-truck me-2"></i> GIAO HÀNG TOÀN QUỐC - MIỄN PHÍ ĐỔI TRẢ TRONG 7 NGÀY</span>
        <div>
            <a href="#" class="text-white text-decoration-none me-3"><i class="fas fa-user me-1"></i> Đăng nhập / Đăng ký</a>
        </div>
    </div>
</div>

<?php 
// Lấy tự động thư mục gốc để tránh lỗi 404 trên các môi trường khác nhau
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl = $basePath . '/index.php?url='; 
?>

<!-- Main Nav -->
<nav class="main-nav shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="<?= $baseUrl ?>Product/list" class="brand-logo">NEYMAR<span>SPORT</span></a>

        <div class="d-none d-lg-flex">
            <a href="#" class="mx-3 text-dark fw-bold text-decoration-none">TRANG CHỦ</a>
            <a href="#" class="mx-3 text-dark fw-bold text-decoration-none">SẢN PHẨM</a>
            <a href="#" class="mx-3 text-dark fw-bold text-decoration-none text-danger pulse">HOT DEALS</a>
        </div>

        <div class="d-flex align-items-center">
            <div class="search-box me-3 d-none d-md-block">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm rounded-pill px-3" placeholder="Tìm kiếm...">
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

<!-- Hero -->
<div class="hero-banner" data-aos="fade-in">
    <div class="container">
        <div class="row">
            <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                <h1 class="display-3 fw-bold mb-4">THE ART OF <span class="text-warning">FOOTBALL</span></h1>
                <p class="lead mb-5">Hệ thống phân phối giày bóng đá chính hãng Nike, Adidas, Puma... hàng đầu Việt Nam.</p>
                <button class="btn btn-warning btn-lg rounded-0 px-5 fw-bold">XEM NGAY BỘ SƯU TẬP</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Sidebar Danh mục -->
        <div class="col-lg-3 pe-lg-5" data-aos="fade-up">
            <div class="sidebar-sticky">
                <div class="sidebar-title">
                    DANH MỤC
                    <!-- NÚT THÊM DANH MỤC -->
                    <a href="<?= $baseUrl ?>Category/add" class="btn btn-xs btn-dark rounded-circle" title="Thêm danh mục">
                        <i class="fas fa-plus" style="font-size: 10px;"></i>
                    </a>
                </div>

                <ul class="category-list">
                    <!-- [SỬA Ở ĐÂY]: Vòng lặp lấy dữ liệu thật từ Database thay vì code cứng -->
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                        <li class="category-item">
                            <a href="#" class="category-link"><?= htmlspecialchars($cat->name) ?></a>
                            <!-- NÚT SỬA XÓA DANH MỤC TRUYỀN ĐÚNG ID -->
                            <div class="category-actions">
                                <a href="<?= $baseUrl ?>Category/edit/<?= $cat->id ?>" class="text-primary" title="Sửa"><i class="fas fa-edit"></i></a>
                                <a href="<?= $baseUrl ?>Category/delete/<?= $cat->id ?>" class="text-danger" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục [<?= htmlspecialchars($cat->name) ?>] này không?')"><i class="fas fa-trash"></i></a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted small">Chưa có danh mục nào.</li>
                    <?php endif; ?>
                </ul>

                <div class="mt-5 d-none d-lg-block" data-aos="zoom-in">
                    <img src="https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?q=80&w=2070&auto=format&fit=crop" class="img-fluid border" alt="Promo">
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom" data-aos="fade-left">
                <div class="d-flex align-items-center">
                    <h3 class="fw-bold m-0 me-3">SẢN PHẨM MỚI VỀ</h3>
                    <!-- NÚT THÊM SẢN PHẨM -->
                    <a href="<?= $baseUrl ?>Product/add" class="btn btn-dark btn-sm rounded-0 fw-bold px-3">
                        <i class="fas fa-plus-circle me-1"></i> THÊM MỚI
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <select class="form-select form-select-sm rounded-0" style="width: 160px;">
                        <option>Sắp xếp: Mới nhất</option>
                        <option>Giá: Thấp - Cao</option>
                        <option>Giá: Cao - Thấp</option>
                    </select>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <?php foreach ($products as $index => $product): ?>
                <div class="col" data-aos="fade-up" data-aos-delay="<?= ($index % 3) * 100 ?>">
                    <div class="card h-100 product-card shadow-sm">
                        <div class="image-wrapper">
                            <span class="badge-new bg-danger text-white position-absolute p-2 px-3 fw-bold" style="top:10px; left:10px; z-index:10; font-size:10px;">HOT</span>
                            
                            <!-- ADMIN FLOATING BUTTONS (SỬA / XÓA SẢN PHẨM) -->
                            <div class="admin-float-actions">
                                <a href="<?= $baseUrl ?>Product/edit/<?= $product->id ?>" class="btn-admin-icon" title="Sửa sản phẩm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="<?= $baseUrl ?>Product/delete/<?= $product->id ?>" 
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" 
                                   class="btn-admin-icon" title="Xóa sản phẩm" style="color: var(--neymar-red);">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>

                        <img src="<?= $basePath ?>/<?= !empty($product->image) ? $product->image : 'assets/no-image.jpg' ?>" 
                                 class="product-img" alt="<?= htmlspecialchars($product->name) ?>"
                                 onerror="this.src='https://placehold.co/500x500?text=Product'">

                            <!-- Shopping Overlay (MUA / GIỎ HÀNG / CHI TIẾT) -->
                            <div class="shopping-overlay">
                                <a href="#" class="btn btn-action btn-buy fw-bold py-2 shadow-lg">MUA NGAY</a>
                                <a href="<?= $baseUrl ?>Cart/add/<?= $product->id ?>" class="btn btn-action btn-cart fw-bold py-2 shadow-lg">THÊM GIỎ HÀNG</a>
                                <a href="<?= $baseUrl ?>Product/show/<?= $product->id ?>" class="btn btn-action btn-detail fw-bold py-2">XEM CHI TIẾT</a>
                            </div>
                        </div>

                        <div class="card-body p-3 text-center">
                            <!-- Hiển thị tên Danh mục của sản phẩm -->
                            <p class="text-muted small mb-1 uppercase letter-spacing-1"><?= !empty($product->category_name) ? htmlspecialchars($product->category_name) : 'Chưa phân loại' ?></p>
                            
                            <a href="<?= $baseUrl ?>Product/show/<?= $product->id ?>" class="product-name fw-bold text-dark text-decoration-none fs-6">
                                <?= htmlspecialchars($product->name) ?>
                            </a>
                            <div class="mt-3">
                                <span class="fs-5 fw-bold text-danger"><?= number_format($product->price, 0, ',', '.') ?>đ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <button class="btn btn-outline-dark rounded-0 px-5 py-2 fw-bold letter-spacing-1">XEM TẤT CẢ SẢN PHẨM</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a href="#" class="brand-logo text-white mb-4 d-inline-block">NEYMAR<span>SPORT</span></a>
                <p class="small pe-lg-5">Hệ thống cửa hàng giày đá banh chính hãng chuyên nghiệp và uy tín nhất Việt Nam từ năm 2013.</p>
                <div class="mt-4">
                    <a href="#" class="text-white me-3 fs-5"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2">
                <h5>CHÍNH SÁCH</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-muted small d-block mb-2">Bảo hành</a></li>
                    <li><a href="#" class="text-decoration-none text-muted small d-block mb-2">Đổi hàng</a></li>
                    <li><a href="#" class="text-decoration-none text-muted small d-block mb-2">Giao hàng</a></li>
                </ul>
            </div>
            <div class="col-lg-6 text-lg-end">
                <h5>LIÊN HỆ</h5>
                <p class="small mb-1">Hotline: 090.000.0000</p>
                <p class="small">Email: support@neymarsport.com</p>
                <div class="mt-3">
                    <img src="https://neymarsport.com/cdn/shop/files/da-dang-ky-bo-cong-thuong_large.png?v=1614324321" width="150" alt="BCT">
                </div>
            </div>
        </div>
        <hr class="mt-5 border-secondary">
        <div class="text-center small py-3">Copyright © 2024 NEYMAR SPORT. Powered by Team Tri.</div>
    </div>
</footer>

<script>
    // Khởi tạo Animation AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // Hiệu ứng Header khi cuộn
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('.main-nav');
        if (window.scrollY > 50) {
            nav.classList.add('py-1', 'shadow-lg');
            nav.style.background = "rgba(255,255,255,1)";
        } else {
            nav.classList.remove('py-1', 'shadow-lg');
            nav.style.background = "rgba(255,255,255,0.95)";
        }
    });
</script>

<?php include 'app/views/shares/footer.php'; ?>