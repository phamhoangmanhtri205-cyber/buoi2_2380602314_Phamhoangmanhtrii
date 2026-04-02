<?php include 'app/views/shares/header.php'; ?>
<?php 
$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = ($basePath === '/' || $basePath === '\\') ? '' : $basePath;
$baseUrl = $basePath . '/index.php?url='; 
?>
<style>
/* CSS cho Login Form Mới Cực Đẹp */
.fade-in { animation: fadeIn 0.6s cubic-bezier(0.39, 0.575, 0.565, 1) both; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.spacing-1 { letter-spacing: 1px; }
.CustomPlaceholder::placeholder { color: #b0b0b0; font-weight: 500; font-size: 14px; }
.input-group-text { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
.form-control-lg { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }
.form-control:focus { box-shadow: none; background: #fff !important; border: 1px solid #ffcc00 !important; color: #111; }
.input-group:focus-within .input-group-text, .input-group:focus-within .form-control { background: #fff !important; }
.inline-login-btn { transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(255, 204, 0, 0.2); }
.inline-login-btn:hover { background: #e6b800 !important; transform: translateY(-3px); box-shadow: 0 8px 20px rgba(255, 204, 0, 0.35); }
.hover-txt-gold { transition: color 0.2s; }
.hover-txt-gold:hover { color: #ffcc00 !important; text-decoration: underline !important; }
</style>

<div class="container pb-5" style="margin-top: 60px;">
    <div class="row fade-in d-flex justify-content-center">
        <div class="col-12 px-3" style="max-width: 480px;">
            <div class="card border-0 shadow-lg" style="width: 100%; border-radius: 12px; overflow: hidden;">
                <div class="text-center bg-dark text-white p-4">
                    <h3 class="fw-bold mb-1" style="font-family: 'Oswald', sans-serif; letter-spacing: 1px;">NEYMAR<span style="color: #ffcc00;">SPORT</span></h3>
                    <p class="small text-muted mb-0">Hệ thống thành viên</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger py-2 px-3 small fw-bold" style="border-radius: 8px;"><i class="fas fa-exclamation-triangle me-1"></i> <?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    
                    <form id="ajax-login-form">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark small text-uppercase spacing-1">Tài khoản</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-user" style="color: #999;"></i></span>
                                <input type="text" name="username" class="form-control bg-light border-0 fs-6 CustomPlaceholder" required placeholder="Nhập username">
                            </div>
                        </div>
                        <div class="mb-4 pb-2">
                            <label class="form-label fw-bold text-dark small text-uppercase spacing-1">Mật khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 ps-3"><i class="fas fa-lock" style="color: #999;"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0 fs-6 CustomPlaceholder" required placeholder="Nhập mật khẩu">
                            </div>
                        </div>
                        
                        <div id="login-error" class="alert alert-danger d-none py-2 px-3 small fw-bold" style="border-radius: 8px;"></div>
                        
                        <button type="submit" class="btn w-100 fw-bold py-3 text-dark inline-login-btn" style="background: #ffcc00; border: none; border-radius: 8px; font-size: 15px; text-transform: uppercase;">
                            ĐĂNG NHẬP <i class="fas fa-arrow-right ms-2 fs-6"></i>
                        </button>
                        
                        <div class="text-center mt-4">
                            <span class="text-muted small">Cầu thủ mới?</span>
                            <a href="<?= $baseUrl ?>User/register" class="fw-bold text-dark text-decoration-none hover-txt-gold ms-1 border-bottom border-dark border-2 pb-1">Đăng ký ngay</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const basePath = '<?= $basePath ?>';
    const baseUrl = '<?= $baseUrl ?>';
    
    $('#ajax-login-form').on('submit', function(e) {
        e.preventDefault();
        const username = $(this).find('input[name="username"]').val();
        const password = $(this).find('input[name="password"]').val();
        const errorDiv = $('#login-error');
        const submitBtn = $(this).find('button[type="submit"]');

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> ĐANG XÁC THỰC...');
        errorDiv.addClass('d-none');

        $.ajax({
            url: basePath + '/index.php?url=User/checkLogin',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ username: username, password: password }),
            success: function(response) {
                if(response.token) {
                    localStorage.setItem('jwtToken', response.token);
                    localStorage.setItem('username', response.username);
                    submitBtn.html('<i class="fas fa-check-circle me-2"></i> THÀNH CÔNG!');
                    submitBtn.css({'background': '#28a745', 'color': '#fff'});
                    setTimeout(() => window.location.href = baseUrl + 'Product/list', 500);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('ĐĂNG NHẬP <i class="fas fa-arrow-right ms-2 fs-6"></i>');
                let message = 'Lỗi kết nối Server!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                errorDiv.removeClass('d-none').html('<i class="fas fa-exclamation-triangle me-1"></i> ' + message);
            }
        });
    });
});
</script>

<?php include 'app/views/shares/footer.php'; ?>
