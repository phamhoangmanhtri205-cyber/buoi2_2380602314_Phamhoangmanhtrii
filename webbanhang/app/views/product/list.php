<?php include 'app/views/shares/header.php'; ?>
<?php 
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = ($basePath === '/') ? '' : $basePath;
// Sử dụng index.php?url= để trị dứt điểm 404 cho mọi Server
$baseUrl = $basePath . '/index.php?url='; 
?>


<style>
:root { --gold: #c9a227; --dark: #111; }

/* ===== HEADER ===== */
.site-header { background: var(--dark); }

/* Dòng trên: logo + search + icons */
.header-top { padding: 14px 0; }
.brand-name {
    font-family: 'Oswald', sans-serif;
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 1px;
    text-decoration: none;
    color: var(--gold) !important;
    line-height: 1;
}
.brand-name span { color: #fff; }

/* Search bar */
.header-search { position: relative; flex: 1; max-width: 520px; margin: 0 30px; }
.header-search input {
    width: 100%;
    border: none;
    border-radius: 4px;
    padding: 10px 44px 10px 18px;
    font-size: 14px;
    background: #fff;
    outline: none;
}
.header-search input::placeholder { color: #aaa; }
.header-search button {
    position: absolute; right: 0; top: 0; bottom: 0;
    background: none; border: none;
    padding: 0 14px; color: #555; cursor: pointer; font-size: 16px;
}
.header-search button:hover { color: var(--gold); }

/* Icon links */
.header-icons a { color: #ccc; text-decoration: none; font-size: 22px; margin-left: 18px; position: relative; transition: color .2s; }
.header-icons a:hover { color: var(--gold); }
.header-icons .badge-count {
    position: absolute; top: -7px; right: -9px;
    background: var(--gold); color: #000;
    font-size: 10px; font-weight: 700;
    border-radius: 50%; width: 18px; height: 18px;
    display: flex; align-items: center; justify-content: center;
    line-height: 1;
}
.user-info { font-size: 13px; color: #aaa; margin-left: 18px; }
.user-info a { color: var(--gold); font-weight: 600; text-decoration: none; }

/* Dòng dưới: nav menu */
.header-nav { background: #1a1a1a; border-top: 1px solid #2a2a2a; }
.header-nav .container { display: flex; align-items: center; }
.header-nav a {
    font-family: 'Oswald', sans-serif;
    font-size: 13px;
    font-weight: 500;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: #ccc;
    text-decoration: none;
    padding: 13px 14px;
    display: block;
    white-space: nowrap;
    transition: color .2s, background .2s;
    position: relative;
}
.header-nav a:hover, .header-nav a.active { color: var(--gold); }
.header-nav a::after {
    content: ''; position: absolute; bottom: 0; left: 14px; right: 14px;
    height: 2px; background: var(--gold);
    transform: scaleX(0); transition: transform .25s;
}
.header-nav a:hover::after, .header-nav a.active::after { transform: scaleX(1); }
.header-nav a.nav-sale { color: #e55; font-weight: 700; }
.header-nav a.nav-sale:hover { color: #ff3333; }
.header-nav .admin-btn {
    margin-left: auto;
    background: #e53935; color: #fff !important;
    padding: 8px 16px; border-radius: 3px; font-size: 12px;
}
.header-nav .admin-btn:hover { background: #c62828 !important; }
.header-nav .admin-btn::after { display: none; }
/* ===== CARD SẢN PHẨM ĐẸP HƠN ===== */
.product-card {
    border-radius: 10px;
    overflow: hidden;
    transition: transform .3s ease, box-shadow .3s ease;
    background: #fff;
    border: 1px solid #eee !important;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,.12) !important;
}
.product-img-wrapper { overflow: hidden; }
.product-img-wrapper img {
    transition: transform .4s ease;
}
.product-card:hover .product-img-wrapper img {
    transform: scale(1.07);
}
.product-title { font-size: 13px !important; }
.product-price { font-size: 16px !important; }

/* Fade-in animation */
@keyframes fadeInUp {
    from { opacity:0; transform: translateY(24px); }
    to   { opacity:1; transform: translateY(0); }
}
.card-anim { animation: fadeInUp .45s ease both; }
</style>

<?php
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = ($basePath === '/') ? '' : $basePath;
$baseUrl  = $basePath . '/index.php?url=';
$cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<!-- ===== SITE HEADER ===== -->
<header class="site-header">

    <!-- Dòng 1: Logo + Search + Icons -->
    <div class="header-top">
        <div class="container d-flex align-items-center">
            <!-- Logo -->
            <a href="<?= $baseUrl ?>Product/list" class="brand-name me-4 flex-shrink-0">
                NEYMAR<span>SPORT</span>
            </a>

            <!-- Search -->
            <div class="header-search d-none d-md-block">
                <input type="text" id="header-search-input" placeholder="Bạn cần tìm ..." onkeypress="if(event.key==='Enter') doSearch()">
                <button type="button" onclick="doSearch()"><i class="fas fa-search"></i></button>
            </div>

            <!-- Icons -->
            <div class="header-icons d-flex align-items-center ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-info d-none d-lg-block">
                        <i class="fas fa-user me-1"></i>
                        <?= htmlspecialchars($_SESSION['username']) ?> &nbsp;|&nbsp;
                        <a href="javascript:logoutJWT()">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    <a href="<?= $baseUrl ?>User/login" title="Đăng nhập">
                        <i class="fas fa-user"></i>
                    </a>
                <?php endif; ?>
                <a href="<?= $baseUrl ?>Cart/index" title="Giỏ hàng">
                    <i class="fas fa-shopping-bag"></i>
                    <?php if ($cartCount > 0): ?>
                        <span class="badge-count"><?= $cartCount ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Dòng 2: Navigation Menu -->
    <nav class="header-nav">
        <div class="container">
            <a href="<?= $baseUrl ?>Product/list" class="active">Trang chủ</a>
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
                <a href="<?= $baseUrl ?>Admin/index" class="admin-btn">
                    <i class="fas fa-user-shield me-1"></i>Quản Trị
                </a>
            <?php endif; ?>
        </div>
    </nav>

</header>

<!-- ===== HERO BANNER ===== -->
<div class="hero-banner" style="
    background: linear-gradient(135deg, #111 0%, #1c1c1c 50%, #2a1a00 100%);
    padding: 52px 0;
    border-bottom: 3px solid var(--gold);
    position: relative;
    overflow: hidden;
">
    <!-- Dường kẻ trang trí -->
    <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:repeating-linear-gradient(45deg,transparent,transparent 40px,rgba(201,162,39,.03) 40px,rgba(201,162,39,.03) 80px);pointer-events:none;"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div style="font-family:'Oswald',sans-serif;font-size:13px;letter-spacing:3px;color:var(--gold);text-transform:uppercase;margin-bottom:14px;">
                    ★ ĐẦY ĐỦ BỘ SƯ U 2025 ★
                </div>
                <h1 style="font-family:'Oswald',sans-serif;font-size:clamp(32px,5vw,58px);font-weight:700;color:#fff;line-height:1.1;margin-bottom:16px;text-transform:uppercase;">
                    GIÀY ĐÁ BÓNG<br>
                    <span style="color:var(--gold);">CHÍNH HÃNG 100%</span>
                </h1>
                <p style="color:#aaa;font-size:15px;margin-bottom:28px;max-width:480px;">
                    Phân phối độc quyền Nike, Adidas, Puma, Mizuno — bảo hành chính hãng, đổi trả trong 7 ngày.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#api-product-list" style="background:var(--gold);color:#111;font-family:'Oswald',sans-serif;font-weight:700;font-size:14px;letter-spacing:1px;padding:13px 28px;text-decoration:none;border-radius:4px;transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        XEM SẢN PHẨM →
                    </a>
                    <a href="#" style="border:1.5px solid #555;color:#ccc;font-family:'Oswald',sans-serif;font-weight:600;font-size:14px;letter-spacing:1px;padding:13px 28px;text-decoration:none;border-radius:4px;transition:all .2s;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='#555';this.style.color='#ccc'">
                        HƯỚNG DẬN CHỌN SIZE
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-center" style="gap:16px;">
                <div style="text-align:center;">
                    <div style="background:rgba(201,162,39,.1);border:1px solid rgba(201,162,39,.3);border-radius:12px;padding:20px 24px;margin-bottom:12px;">
                        <div style="font-family:'Oswald',sans-serif;font-size:36px;font-weight:700;color:var(--gold);">500+</div>
                        <div style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:1px;">Sản phẩm</div>
                    </div>
                    <div style="background:rgba(201,162,39,.1);border:1px solid rgba(201,162,39,.3);border-radius:12px;padding:20px 24px;">
                        <div style="font-family:'Oswald',sans-serif;font-size:36px;font-weight:700;color:var(--gold);">3</div>
                        <div style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:1px;">Cửa hàng</div>
                    </div>
                </div>
                <div style="text-align:center;">
                    <div style="background:rgba(255,255,255,.05);border:1px solid #333;border-radius:12px;padding:20px 24px;margin-bottom:12px;">
                        <div style="font-family:'Oswald',sans-serif;font-size:36px;font-weight:700;color:#fff;">30k+</div>
                        <div style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:1px;">Khách hàng</div>
                    </div>
                    <div style="background:rgba(255,255,255,.05);border:1px solid #333;border-radius:12px;padding:20px 24px;">
                        <div style="font-family:'Oswald',sans-serif;font-size:36px;font-weight:700;color:#fff;">100%</div>
                        <div style="font-size:12px;color:#888;text-transform:uppercase;letter-spacing:1px;">Chính hãng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand strip -->
<div style="background:#f8f8f8;border-bottom:1px solid #eee;padding:14px 0;overflow:hidden;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-center gap-5 flex-wrap" style="font-family:'Oswald',sans-serif;font-size:18px;font-weight:700;letter-spacing:2px;color:#bbb;">
            <span style="color:#111;">NIKE</span>
            <span>•</span>
            <span>ADIDAS</span>
            <span>•</span>
            <span>PUMA</span>
            <span>•</span>
            <span>MIZUNO</span>
            <span>•</span>
            <span style="color:var(--gold);">NEW BALANCE</span>
        </div>
    </div>
</div>

<div class="container pb-5">
    <!-- Tiêu đề + nút thêm -->
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4 pb-2 border-bottom">
        <h4 class="fw-bold m-0 text-uppercase text-dark" id="search-title">TẤT CẢ SẢN PHẨM</h4>
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <a href="<?= $baseUrl ?>Product/add" class="btn btn-dark btn-sm rounded-0 fw-bold px-3">
            <i class="fas fa-plus me-1"></i> THÊM
        </a>
        <?php endif; ?>
    </div>

    <!-- Grid sản phẩm: 4 cột trên desktop -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3" id="api-product-list">
        <div class="col-12 text-center py-5">
            <p class="text-muted"><i class="fas fa-spinner fa-spin me-2"></i>Đang tải sản phẩm...</p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const basePath = '<?= $basePath ?>';
    const baseUrl = '<?= $baseUrl ?>';
    const isAdmin = <?= (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') ? 'true' : 'false' ?>;

    const token = localStorage.getItem('jwtToken');
    if(!token) {
        // Nếu chưa có Token, có thể chuyển hướng về trang login hoặc hiển thị thông báo
        console.warn("Chưa đăng nhập (Thiếu JWT Token)");
    }

    // Load category via API Requirement Sidebar
    $.ajax({
        url: basePath + '/index.php?url=api/category',
        type: 'GET',
        headers: { 'Authorization': 'Bearer ' + token },
        success: function(categories) {
            let catHtml = '';
            if(categories.length > 0) {
                $.each(categories, function(i, cat) {
                    let catAdminFlags = '';
                    if(isAdmin) {
                        catAdminFlags = `
                        <div class="d-flex gap-2">
                            <a href="${baseUrl}Category/edit/${cat.id}" class="text-primary"><i class="fas fa-edit"></i></a>
                            <a href="${baseUrl}Category/delete/${cat.id}" class="text-danger" onclick="return confirm('Xóa?')"><i class="fas fa-trash"></i></a>
                        </div>`;
                    }
                    catHtml += `
                    <li class="category-item">
                        <a href="${baseUrl}Category/show/${cat.id}" class="category-link"><i class="fas fa-chevron-right text-muted me-2" style="font-size:10px;"></i> ${cat.name}</a>
                        ${catAdminFlags}
                    </li>`;
                });
            } else {
                catHtml = '<li class="text-muted small">Chưa có danh mục.</li>';
            }
            $('#api-category-list').html(catHtml);
        }
    });

    // Load products via API Requirement Grid
    $.ajax({
        url: basePath + '/index.php?url=api/product',
        type: 'GET',
        headers: { 'Authorization': 'Bearer ' + token },
        success: function(products) {
            let box = $('#api-product-list');
            box.empty();
            if(products.length === 0) {
                box.html('<div class="col-12 text-center py-5"><p class="text-muted">Chưa có sản phẩm nào.</p></div>');
                return;
            }

            $.each(products, function(i, p) {
                let discountHtml = (p.price < 2000000) ? `<div class="badge-custom badge-discount">-10%</div>` : '';
                
                let btnAdmin = '';
                if(isAdmin) {
                    btnAdmin = `
                    <div class="admin-float-actions">
                        <a href="${baseUrl}Product/edit/${p.id}" class="btn-admin-icon" title="Sửa"><i class="fas fa-pen"></i></a>
                        <a href="javascript:void(0)" class="btn-admin-icon text-danger btn-delete-product" data-id="${p.id}" title="Xóa"><i class="fas fa-trash"></i></a>
                    </div>`;
                }

                let oriPrice = Math.round(p.price * 1.15 / 1000) * 1000;
                let disc = Math.round((1 - p.price / oriPrice) * 100);
                let discBadge = disc > 0 ? `<div style="position:absolute;top:10px;left:10px;background:#e53935;color:#fff;font-size:11px;font-weight:700;padding:3px 8px;border-radius:3px;z-index:10;">-${disc}%</div>` : '';
                let newBadge  = `<div style="position:absolute;top:10px;right:10px;background:#111;color:#fff;font-size:10px;font-weight:600;padding:3px 8px;border-radius:3px;z-index:10;">MỚI</div>`;

                // Dùng ảnh từ DB, nếu không có thì fallback placeholder
                let imgUrl = (p.image && p.image.trim() !== '') ? p.image : 'https://placehold.co/300x300/f4f5f7/999?text=No+Image';

                let formatPrice = new Intl.NumberFormat('vi-VN').format(p.price) + 'đ';
                let formatOri   = new Intl.NumberFormat('vi-VN').format(oriPrice) + 'đ';

                let card = `
                <div class="col card-anim" style="animation-delay:${i * 0.06}s">
                    <div class="product-card h-100 position-relative" style="border-radius:10px;overflow:hidden;border:1px solid #eee;">
                        ${discBadge}${newBadge}
                        ${btnAdmin}
                        <div class="product-img-wrapper cursor-pointer text-center py-4"
                             onclick="window.location.href='${baseUrl}Product/show/${p.id}'"
                             style="background:#f7f7f7;overflow:hidden;">
                            <img src="${imgUrl}" class="product-img" alt="${p.name}"
                                 style="height:160px;object-fit:contain;transition:transform .4s ease;"
                                 onerror="this.onerror=null;this.src='https://placehold.co/300x300/f4f5f7/999?text=No+Image'"
                                 onmouseover="this.style.transform='scale(1.08)'"
                                 onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div class="p-3 d-flex flex-column" style="gap:6px;">
                            <a href="${baseUrl}Product/show/${p.id}" class="product-title fw-bold text-dark text-decoration-none d-block" style="font-size:13px;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">${p.name}</a>
                            <p class="text-muted mb-0" style="font-size:12px;">🏷️ ${p.category_name}</p>
                            <div class="d-flex align-items-baseline gap-2 mt-1">
                                <span style="font-size:12px;color:#bbb;text-decoration:line-through;">${formatOri}</span>
                                <span class="product-price fw-bold text-danger" style="font-size:16px;">${formatPrice}</span>
                            </div>
                            <a href="${baseUrl}Cart/add/${p.id}"
                               class="btn w-100 fw-bold py-2 mt-2"
                               style="background:#111;color:#fff;font-size:12px;letter-spacing:.5px;border-radius:6px;transition:background .2s;"
                               onmouseover="this.style.background='var(--gold)';this.style.color='#111';"
                               onmouseout="this.style.background='#111';this.style.color='#fff';">
                                THÊM GIỎ HÀNG
                            </a>
                        </div>
                    </div>
                </div>`;
                box.append(card);
            });
        },
        error: function(jqxhr, textStatus, error) {
            let err = textStatus + ", " + error;
            if(jqxhr.status === 401) {
                window.location.href = baseUrl + 'User/login';
            } else {

                $('#api-product-list').html('<div class="col-12 text-center py-5 text-danger"><p><b>Lỗi tải API Sản phẩm:</b></p><p>'+err+'</p><textarea class="form-control" rows="10">'+jqxhr.responseText+'</textarea></div>');
            }
        }
    });

    $(document).on('click', '.btn-delete-product', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        if(confirm('Bạn có chắc chắn muốn xóa?')) {
            $.ajax({
                url: basePath + '/index.php?url=api/product/' + id,
                type: 'DELETE',
                headers: { 'Authorization': 'Bearer ' + token },
                success: function(res) {
                    location.reload();
                },
                error: function(err) {
                    alert('Lỗi Xóa Sản Phẩm qua API.');
                }
            });
        }
    });

});

// ===== SEARCH LIVE FILTER =====
let allProductCards = [];

function getKeyword() {
    const h = (document.getElementById('header-search-input')?.value || '').trim().toLowerCase();
    const i = (document.getElementById('inline-search')?.value || '').trim().toLowerCase();
    // Header search chỉ active khi bấm nút, inline-search active live
    return h || i;
}

function filterProducts() {
    const keyword = getKeyword();
    const box = document.getElementById('api-product-list');
    if (!box) return;

    // Lần đầu: lưu toàn bộ cards
    if (allProductCards.length === 0) {
        box.querySelectorAll('.col').forEach(card => allProductCards.push(card));
    }

    let count = 0;
    allProductCards.forEach(card => {
        const name = (card.querySelector('a[href*="Product/show"]')?.textContent || '').toLowerCase();
        const cat  = (card.querySelector('.text-muted')?.textContent || '').toLowerCase();
        const match = !keyword || name.includes(keyword) || cat.includes(keyword);
        card.style.display = match ? '' : 'none';
        if (match) count++;
    });

    const title = document.getElementById('search-title');
    if (title) {
        title.textContent = keyword
            ? `KẾT QUẢ TÌM KIẾM: "${keyword.toUpperCase()}" (${count} sản phẩm)`
            : `TẤT CẢ SẢN PHẨM`;
    }

    let emptyMsg = document.getElementById('search-empty');
    if (!emptyMsg) {
        emptyMsg = document.createElement('div');
        emptyMsg.id = 'search-empty';
        emptyMsg.className = 'col-12 text-center py-5';
        emptyMsg.innerHTML = '<p class="text-muted">Không tìm thấy sản phẩm phù hợp.</p>';
        box.appendChild(emptyMsg);
    }
    emptyMsg.style.display = (count === 0 && keyword) ? '' : 'none';
}

function doSearch() {
    filterProducts();
    document.getElementById('api-product-list')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

document.addEventListener('DOMContentLoaded', function() {
    const inlineSearch = document.getElementById('inline-search');
    if (inlineSearch) {
        inlineSearch.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') doSearch();
        });
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>