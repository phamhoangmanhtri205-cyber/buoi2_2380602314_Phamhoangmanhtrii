<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card shadow-sm border-0 rounded-3">
<div class="card-header bg-primary text-white py-3">
<h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới</h5>
</div>
<div class="card-body p-4">
<?php if (!empty($errors)): ?>
<div class="alert alert-danger border-0 shadow-sm">
<ul class="mb-0">
<?php foreach ($errors as $error): ?>
<li><i class="fas fa-exclamation-triangle me-2"></i><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

                <form method="POST" action="/tri/webbanhang/Product/save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên sản phẩm..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Giá bán (VND)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="price" name="price" class="form-control" step="0.01" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label fw-bold">Danh mục</label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <option value="" disabled selected>-- Chọn danh mục --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>">
                                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Mô tả sản phẩm</label>
                        <textarea id="description" name="description" class="form-control" rows="4" placeholder="Viết mô tả chi tiết sản phẩm tại đây..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">Hình ảnh sản phẩm</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <div class="form-text mt-2 text-muted">Hỗ trợ: JPG, PNG, WEBP.</div>
                        <div id="image-preview-container" class="mt-3 d-none">
                            <p class="small mb-1">Xem trước ảnh:</p>
                            <img id="image-preview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="/tri/webbanhang/Product/list" class="btn btn-light border">
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
const reader = new FileReader();
const output = document.getElementById('image-preview');
const container = document.getElementById('image-preview-container');

    reader.onload = function() {
        output.src = reader.result;
        container.classList.remove(&#39;d-none&#39;);
    }
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}


</script>

<?php include 'app/views/shares/footer.php'; ?>