<?php include 'app/views/shares/header.php'; ?>
<?php 
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = ($basePath === '/') ? '' : $basePath;
// Sử dụng index.php?url= để trị dứt điểm 404 cho mọi Server
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
                <span class="text-white me-3"><i class="fas fa-user me-1"></i> Xin chào, <?= htmlspecialchars($_SESSION['username']) ?> | <a href="javascript:logoutJWT()" class="text-warning text-decoration-none fw-bold ms-1">Đăng xuất</a></span>
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
                <ul class="category-list" id="api-category-list">
                    <li class="text-muted small">Đang nạp danh mục API...</li>
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
                    <h4 class="fw-bold m-0 me-3 text-uppercase text-dark">TẤT CẢ SẢN PHẨM (API)</h4>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="<?= $baseUrl ?>Product/add" class="btn btn-dark btn-sm rounded-0 fw-bold px-3">
                        <i class="fas fa-plus me-1"></i> THÊM
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-lg-3 g-3" id="api-product-list">
                <div class="col-12 text-center py-5">
                    <p class="text-muted"><i class="fas fa-spinner fa-spin me-2"></i>Đang gọi jQuery AJAX tải dữ liệu...</p>
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

                // Fallback since API assignment drop image
                let imgUrl = basePath + '/assets/no-img.jpg';

                let formatPrice = new Intl.NumberFormat('vi-VN').format(p.price) + 'đ';

                let card = `
                <div class="col">
                    <div class="product-card h-100 shadow-sm border-0 position-relative">
                        <div class="badge-custom" style="position: absolute; top:10px; left:10px; background: #000; color: #fff; padding: 2px 8px; font-size:12px; font-weight: bold; z-index:10;">MỚI</div>
                        ${discountHtml}
                        ${btnAdmin}
                        <div class="product-img-wrapper cursor-pointer text-center py-4" onclick="window.location.href='${baseUrl}Product/show/${p.id}'" style="background:#f4f5f7;">
                            <img src="${imgUrl}" class="product-img" alt="${p.name}" style="height: 150px; object-fit: cover;" onerror="this.src='https://placehold.co/300x300?text=No+Image'">
                        </div>
                        <div class="p-3 d-flex flex-column h-100">
                            <a href="${baseUrl}Product/show/${p.id}" class="product-title fw-bold text-dark text-decoration-none mb-1 d-block text-truncate">${p.name}</a>
                            <p class="small text-muted mb-2">🏷️ ${p.category_name}</p>
                            <div class="product-price fw-bold text-danger mb-3 fs-5">${formatPrice}</div>
                            <a href="${baseUrl}Cart/add/${p.id}" class="btn bg-dark text-white w-100 rounded-0 fw-bold py-2 mt-auto" style="font-size: 13px;">THÊM GIỎ HÀNG</a>
                        </div>
                    </div>
                </div>`;
                box.append(card);
            });
        },
        error: function(jqxhr, textStatus, error) {
            let err = textStatus + ", " + error;
            if(jqxhr.status === 401) {
                $('#api-product-list').html('<div class="col-12 text-center py-5 text-warning"><p><i class="fas fa-lock me-2"></i><b>Bạn cần đăng nhập để xem sản phẩm (Bài 6 - JWT).</b></p><a href="'+baseUrl+'User/login" class="btn btn-dark mt-2">Đăng nhập ngay</a></div>');
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
</script>

<?php include 'app/views/shares/footer.php'; ?>