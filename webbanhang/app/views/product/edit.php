<?php include 'app/views/shares/header.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<style>
:root { --neymar-yellow: #ffcc00; --neymar-dark: #111; }
body { font-family: 'Roboto', sans-serif; background-color: #f4f5f7; background-image: radial-gradient(#d1d1d1 1px, transparent 1px); background-size: 20px 20px; }
.card { border: none; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); overflow: hidden; margin-top: 40px; margin-bottom: 40px; background: #fff; }
.card-header { background: var(--neymar-dark) !important; color: white !important; font-family: 'Oswald', sans-serif; text-transform: uppercase; letter-spacing: 2px; padding: 25px 20px; border-bottom: 4px solid var(--neymar-yellow) !important; }
.card-body { padding: 40px !important; }
.form-label { font-family: 'Oswald', sans-serif; text-transform: uppercase; letter-spacing: 1px; font-size: 14px; color: #333; margin-bottom: 8px; }
.form-control, .form-select { border-radius: 6px; padding: 12px 15px; border: 1px solid #ddd; background-color: #fafafa; transition: all 0.3s; font-size: 15px; }
.form-control:focus, .form-select:focus { border-color: var(--neymar-yellow); box-shadow: 0 0 0 4px rgba(255, 204, 0, 0.2); background-color: #fff; }
.btn-warning { background: var(--neymar-yellow) !important; color: #000 !important; font-family: 'Oswald', sans-serif; font-weight: 700; border-radius: 6px; border: none; padding: 12px 30px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; }
.btn-warning:hover { background: #000 !important; color: var(--neymar-yellow) !important; transform: translateY(-2px); box-shadow: 0 8px 15px rgba(0,0,0,0.2); }
.btn-outline-secondary { font-family: 'Oswald', sans-serif; text-transform: uppercase; letter-spacing: 1px; padding: 12px 25px; border-radius: 6px; transition: all 0.3s; font-size: 14px; }
.btn-outline-secondary:hover { background: #e2e3e5; color: #000; transform: translateY(-2px); }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="m-0">CHỈNH SỬA SẢN PHẨM (Bài 5 API)</h3>
                </div>
                <div class="card-body">
                <?php 
                $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
                $basePath = ($basePath === '/') ? '' : $basePath;
                $baseUrl = $basePath . '/index.php?url=';
                ?>
                <form id="form-edit-product">
                    <input type="hidden" name="id" id="id" value="">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-bold">Giá sản phẩm (VNĐ)</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-bold">Danh mục</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <!-- Sẽ được load bằng API -->
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="<?= $baseUrl ?>Product/list" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">
                            <i class="fas fa-check-circle me-1"></i> Cập nhật qua API
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const basePath = '<?= $basePath ?>';
    const baseUrl = '<?= $baseUrl ?>';
    const token = localStorage.getItem('jwtToken');

    $.ajax({
        url: basePath + '/index.php?url=api/category',
        type: 'GET',
        headers: { 'Authorization': 'Bearer ' + token },
        success: function(cats) {
            let options = '';
            $.each(cats, function(i, c) { options += `<option value="${c.id}">${c.name}</option>`; });
            $('#category_id').html(options);

            // Sau khi load xong category thì load sản phẩm
            $.ajax({
                url: basePath + '/index.php?url=api/product/' + productId,
                type: 'GET',
                headers: { 'Authorization': 'Bearer ' + token },
                success: function(p) {
                    $('#id').val(p.id);
                    $('#name').val(p.name);
                    $('#description').val(p.description);
                    $('#price').val(p.price);
                    $('#category_id').val(p.category_id);
                },
                error: function() {
                    alert('Lỗi nạp mã sản phẩm JSON. Có thể phiên đăng nhập hết hạn.');
                }
            });
        }
    });

    $('#form-edit-product').on('submit', function(e) {
        e.preventDefault();
        let jsonData = {};
        $(this).serializeArray().forEach(item => jsonData[item.name] = item.value);

        $.ajax({
            url: basePath + '/index.php?url=api/product/' + jsonData.id,
            type: 'PUT',
            headers: { 'Authorization': 'Bearer ' + token },
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(jsonData),
            success: function(res) {
                 window.location.href = baseUrl + 'Product/list';
            },
            error: function(xhr) {
                 if(xhr.status === 401) {
                    alert('Phiên làm việc hết hạn. Vui lòng đăng nhập lại!');
                    window.location.href = '<?= $baseUrl ?>User/login';
                 } else {
                    alert('Cập nhật thất bại API.');
                 }
            }
        });
    });
});
</script>
<?php include 'app/views/shares/footer.php'; ?>