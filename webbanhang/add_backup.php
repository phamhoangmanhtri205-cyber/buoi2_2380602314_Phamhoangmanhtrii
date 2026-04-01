<?php include 'app/views/shares/header.php'; ?>

<!-- Import Font -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<style>
:root {
    --neymar-yellow: #ffcc00;
    --neymar-dark: #111;
}
body { 
    font-family: 'Roboto', sans-serif; 
    background-color: #f4f5f7; 
    background-image: radial-gradient(#d1d1d1 1px, transparent 1px);
    background-size: 20px 20px;
}
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-top: 40px;
    margin-bottom: 40px;
    background: #fff;
}
.card-header {
    background: var(--neymar-dark) !important;
    color: white !important;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
    padding: 25px 20px;
    border-bottom: 4px solid var(--neymar-yellow) !important;
}
.card-body { padding: 40px !important; }
.form-label {
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
}
.form-control, .form-select { 
    border-radius: 6px; 
    padding: 12px 15px;
    border: 1px solid #ddd;
    background-color: #fafafa;
    transition: all 0.3s;
    font-size: 15px;
}
.form-control:focus, .form-select:focus {
    border-color: var(--neymar-yellow);
    box-shadow: 0 0 0 4px rgba(255, 204, 0, 0.2);
    background-color: #fff;
}
.btn-primary {
    background: var(--neymar-yellow) !important;
    color: #000 !important;
    font-family: 'Oswald', sans-serif;
    font-weight: 700;
    border-radius: 6px;
    border: none;
    padding: 12px 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
.btn-primary:hover { 
    background: #000 !important; 
    color: var(--neymar-yellow) !important; 
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}
.btn-light {
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 12px 25px;
    border-radius: 6px;
    transition: all 0.3s;
    font-size: 14px;
}
.btn-light:hover {
    background: #e2e3e5;
    transform: translateY(-2px);
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="m-0">THÊM SẢN PHẨM MỚI</h3>
                </div>
                <div class="card-body">

<?php if (!empty($errors)): ?>
<div class="alert alert-danger border-0 shadow-sm">
<ul class="mb-0">
<?php foreach ($errors as $error): ?>
<li><i class="fas fa-exclamation-triangle me-2"></i><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

                <?php 
                // Xử lý tự động đường dẫn submit
                $basePath = dirname($_SERVER['SCRIPT_NAME']);
                $basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
                ?>
                <form method="POST" action="<?= $basePath ?>/index.php?url=Product/save">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: Giày đá bóng Nike..." required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả sản phẩm..." required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label fw-bold">Giá sản phẩm (VNĐ)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Ví dụ: 2500000" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-bold">Danh mục</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="" disabled selected>-- Chọn danh mục --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"><?= htmlspecialchars($category->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">Đường dẫn hình ảnh (URL)</label>
                        <input type="text" class="form-control" id="image" name="image" placeholder="Nhập link ảnh (VD: https://...)" oninput="previewImage(event)">
                        <div id="image-preview-container" class="mt-3 d-none">
                            <p class="small mb-1">Xem trước ảnh:</p>
                            <img id="image-preview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px;" onerror="this.onerror=null; this.src='https://placehold.co/500x500?text=Lỗi+Hình+Ảnh';">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="<?= $basePath ?>/index.php?url=Product/list" class="btn btn-light border">
                            <i class="fas fa-arrow-left me-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Thêm sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function previewImage(event) {
    var output = document.getElementById('image-preview');
    var url = event.target.value;
    if (url.trim() !== "") {
        output.src = url;
        document.getElementById('image-preview-container').classList.remove('d-none');
    } else {
        document.getElementById('image-preview-container').classList.add('d-none');
    }
}
</script>

<?php include 'app/views/shares/footer.php'; ?>