<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card shadow-sm border-0 rounded-3">
<div class="card-header bg-warning text-dark py-3">
<h5 class="card-title mb-0"><i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm</h5>
</div>
<div class="card-body p-4">
<?php if (!empty($errors)): ?>
<div class="alert alert-danger border-0">
<ul class="mb-0">
<?php foreach ($errors as $error): ?>
<li><i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

                <form method="POST" action="/tri/webbanhang/Product/update" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" id="name" name="name" class="form-control" 
                               value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Giá bán (VND)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="price" name="price" class="form-control" step="0.01" 
                                       value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label fw-bold">Danh mục</label>
                            <select id="category_id" name="category_id" class="form-select" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>" 
                                        <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Mô tả sản phẩm</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label fw-bold">Thay đổi hình ảnh</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                        
                        <div class="row mt-3">
                            <?php if ($product->image): ?>
                            <div class="col-6">
                                <p class="small text-muted mb-1">Ảnh hiện tại:</p>
                                <img src="/tri/webbanhang/<?php echo $product->image; ?>" class="img-thumbnail shadow-sm" style="max-height: 150px;">
                            </div>
                            <?php endif; ?>
                            <div class="col-6 d-none" id="preview-box">
                                <p class="small text-success mb-1">Ảnh mới:</p>
                                <img id="image-preview" src="#" class="img-thumbnail border-success shadow-sm" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="/tri/webbanhang/Product/list" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-warning px-4 text-dark fw-bold">
                            <i class="fas fa-check-circle me-1"></i> Cập nhật ngay
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
const box = document.getElementById('preview-box');

    reader.onload = function() {
        output.src = reader.result;
        box.classList.remove(&#39;d-none&#39;);
    }
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}


</script>

<?php include 'app/views/shares/footer.php'; ?>