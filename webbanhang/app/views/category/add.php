<?php include 'app/views/shares/header.php'; ?>

<link href="https://www.google.com/search?q=https://fonts.googleapis.com/css2%3Ffamily%3DOswald:wght%40400%3B700%26family%3DRoboto:wght%40300%3B400%3B700%26display%3Dswap" rel="stylesheet">

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
.admin-card {
border: none;
border-radius: 12px;
box-shadow: 0 15px 35px rgba(0,0,0,0.1);
margin-top: 60px;
margin-bottom: 60px;
overflow: hidden;
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
.btn-save {
background: var(--neymar-yellow) !important;
color: #000 !important;
font-family: 'Oswald', sans-serif;
font-weight: 700;
border-radius: 6px;
padding: 12px 35px;
border: none;
transition: all 0.3s ease;
text-transform: uppercase;
letter-spacing: 1px;
}
.btn-save:hover { 
    background: #000 !important; 
    color: var(--neymar-yellow) !important; 
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}
.btn-outline-secondary {
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 12px 25px;
    border-radius: 6px;
    transition: all 0.3s;
    font-size: 14px;
    border-width: 2px;
}
.btn-outline-secondary:hover {
    background: #e2e3e5;
    color: #000;
    transform: translateY(-2px);
}
.form-label {
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
}
.form-control { 
    border-radius: 6px; 
    padding: 12px 15px;
    border: 1px solid #ddd;
    background-color: #fafafa;
    transition: all 0.3s;
    font-size: 15px;
}
.form-control:focus {
    border-color: var(--neymar-yellow);
    box-shadow: 0 0 0 4px rgba(255, 204, 0, 0.2);
    background-color: #fff;
}
</style>

<div class="container mb-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card admin-card">
<div class="card-header text-center">
<h3 class="m-0">Thêm Danh Mục Mới</h3>
</div>
<div class="card-body p-4">
<?php 
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
?>
<form action="<?= $basePath ?>/index.php?url=Category/save" method="POST">
<div class="mb-4">
<label for="name" class="form-label fw-bold">Tên Danh Mục</label>
<input type="text" class="form-control" id="name" name="name" placeholder="VD: Giày Đá Banh Nike" required>
</div>
<div class="mb-4">
<label for="description" class="form-label fw-bold">Mô tả (Không bắt buộc)</label>
<textarea class="form-control" id="description" name="description" rows="3"></textarea>
</div>
<div class="d-flex justify-content-between align-items-center">
<a href="<?= $basePath ?>/index.php?url=Product/list" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Quay lại</a>
<button type="submit" class="btn btn-save"><i class="fas fa-plus-circle me-2"></i>XÁC NHẬN THÊM</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<?php include 'app/views/shares/footer.php'; ?>