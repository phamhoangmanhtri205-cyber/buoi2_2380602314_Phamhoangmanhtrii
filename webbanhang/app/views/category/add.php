<?php include 'app/views/shares/header.php'; ?>

<link href="https://www.google.com/search?q=https://fonts.googleapis.com/css2%3Ffamily%3DOswald:wght%40400%3B700%26family%3DRoboto:wght%40300%3B400%3B700%26display%3Dswap" rel="stylesheet">

<style>
:root {
--neymar-yellow: #ffcc00;
--neymar-dark: #111;
}
body { font-family: 'Roboto', sans-serif; background-color: #f4f4f4; }
.admin-card {
border: none;
border-radius: 0;
box-shadow: 0 10px 30px rgba(0,0,0,0.1);
margin-top: 50px;
}
.card-header {
background: var(--neymar-dark);
color: white;
font-family: 'Oswald', sans-serif;
text-transform: uppercase;
letter-spacing: 1px;
padding: 20px;
border: none;
}
.btn-save {
background: var(--neymar-yellow);
color: #000;
font-family: 'Oswald', sans-serif;
font-weight: 700;
border-radius: 0;
padding: 12px 30px;
border: none;
transition: all 0.3s;
}
.btn-save:hover { background: #000; color: #fff; }
.form-control:focus {
border-color: var(--neymar-yellow);
box-shadow: none;
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
<form action="/tri/webbanhang/Category/save" method="POST">
<div class="mb-4">
<label for="name" class="form-label fw-bold">Tên Danh Mục</label>
<input type="text" class="form-control form-control-lg rounded-0" id="name" name="name" placeholder="VD: Giày Đá Banh Nike" required>
</div>
<div class="mb-4">
<label for="description" class="form-label fw-bold">Mô tả (Không bắt buộc)</label>
<textarea class="form-control rounded-0" id="description" name="description" rows="3"></textarea>
</div>
<div class="d-flex justify-content-between align-items-center">
<a href="/tri/webbanhang/Product/list" class="text-decoration-none text-dark small"><i class="fas fa-arrow-left me-1"></i> Quay lại danh sách</a>
<button type="submit" class="btn btn-save">XÁC NHẬN THÊM</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<?php include 'app/views/shares/footer.php'; ?>