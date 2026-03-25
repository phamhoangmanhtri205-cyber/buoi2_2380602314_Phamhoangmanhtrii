<?php include 'app/views/shares/header.php'; ?>
<?php 
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl = $basePath . '/index.php?url='; 
?>
<style>
    .auth-card {
        max-width: 400px;
        margin: 100px auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: none;
    }
    .auth-card .card-header {
        background: #111;
        color: #ffcc00;
        text-align: center;
        border-radius: 15px 15px 0 0;
        padding: 20px;
        font-family: 'Oswald', sans-serif;
        font-size: 24px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .btn-auth {
        background: #ffcc00;
        color: #111;
        font-weight: bold;
        border: none;
        width: 100%;
        padding: 10px;
    }
    .btn-auth:hover {
        background: #e6b800;
        color: #111;
    }
</style>

<div class="container">
    <div class="card auth-card">
        <div class="card-header">
            Đăng Nhập
        </div>
        <div class="card-body p-4">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="<?= $baseUrl ?>User/login" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control" required placeholder="Nhập username">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-auth mb-3">ĐĂNG NHẬP</button>
            </form>
            <div class="text-center mt-3">
                <p class="mb-0">Chưa có tài khoản? <a href="<?= $baseUrl ?>User/register" class="text-decoration-none fw-bold" style="color: #111;">Đăng ký ngay</a></p>
                <a href="<?= $baseUrl ?>Product/index" class="text-secondary small mt-2 d-inline-block">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
