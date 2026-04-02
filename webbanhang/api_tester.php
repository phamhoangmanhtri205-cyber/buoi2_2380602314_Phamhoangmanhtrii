<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚡ API Swagger-lite Tester</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #1a1a1a; color: #fff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { background-color: #262626; border: 1px solid #333; margin-bottom: 20px; border-radius: 8px; }
        .card-header { font-weight: bold; font-size: 1.1rem; border-bottom: 1px solid #333; background-color: #303030; display: flex; align-items: center; justify-content: space-between; cursor: pointer; }
        .form-control, .form-select { background-color: #1a1a1a; border: 1px solid #444; color: #fff; }
        .form-control:focus, .form-select:focus { background-color: #222; border-color: #ffcc00; color: #fff; box-shadow: none; }
        .badge-method { font-size: 0.9rem; padding: 5px 10px; border-radius: 4px; font-weight: bold; margin-right: 10px; }
        .badge-GET { background-color: #007bff; }
        .badge-POST { background-color: #28a745; }
        .badge-PUT { background-color: #ffc107; color: #000; }
        .badge-DELETE { background-color: #dc3545; }
        pre { background-color: #111; border-radius: 8px; padding: 15px; color: #00ff00; max-height: 400px; overflow-y: auto; border: 1px solid #333; margin-bottom: 0; }
        .btn-gold { background-color: #ffcc00; color: #000; font-weight: bold; border: none; }
        .btn-gold:hover { background-color: #e6b800; color: #000; }
        .header-title { color: #ffcc00; font-weight: 800; border-bottom: 2px solid #ffcc00; padding-bottom: 10px; margin-bottom: 30px; margin-top: 20px; }
        .response-status { font-weight: bold; padding: 5px 10px; border-radius: 4px; display: inline-block; margin-bottom: 10px; }
        .status-200, .status-201 { background-color: #28a745; color: white; }
        .status-error { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

<div class="container py-4">
    <h2 class="header-title"><i class="fa-solid fa-bolt"></i> NEYMARSPORT API TESTER UI</h2>

    <!-- Auth Section -->
    <div class="card mb-4 border-warning shadow">
        <div class="card-header bg-dark text-warning">
            <span><i class="fa-solid fa-shield-halved"></i> 1. Xác Thực (Authentication)</span>
        </div>
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label>Username</label>
                    <input type="text" id="auth-user" class="form-control" value="admin" placeholder="Nhập username">
                </div>
                <div class="col-md-3">
                    <label>Password</label>
                    <input type="password" id="auth-pass" class="form-control" value="123" placeholder="Nhập password">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-gold w-100" id="btn-login"><i class="fa-solid fa-key"></i> Lấy Token</button>
                </div>
                <div class="col-md-4">
                    <label>JWT Token hiện tại (Tự động đính kèm)</label>
                    <input type="text" id="jwt-token" class="form-control text-warning" readonly placeholder="Chưa có Token, hãy đăng nhập...">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- API List -->
        <div class="col-lg-6">
            <h4 class="mb-3 border-bottom pb-2">Danh Sách API</h4>
            <div class="accordion" id="apiAccordion">

                <!-- API: Lấy DS Danh Mục -->
                <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#api-cat-index">
                        <div><span class="badge-method badge-GET">GET</span>/CategoryApi/index</div>
                    </div>
                    <div id="api-cat-index" class="collapse" data-bs-parent="#apiAccordion">
                        <div class="card-body">
                            <p class="text-muted"><small>Lấy danh sách toàn bộ danh mục sản phẩm.</small></p>
                            <button class="btn btn-primary btn-sm btn-execute" data-method="GET" data-url="CategoryApi/index">Execute</button>
                        </div>
                    </div>
                </div>

                <!-- API: Thêm Danh Mục -->
                <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#api-cat-store">
                        <div><span class="badge-method badge-POST">POST</span>/CategoryApi/store</div>
                    </div>
                    <div id="api-cat-store" class="collapse" data-bs-parent="#apiAccordion">
                        <div class="card-body">
                            <p class="text-muted"><small>Thêm một danh mục mới. Yêu cầu JSON Body.</small></p>
                            <textarea class="form-control mb-3 json-input" rows="4">{
  "name": "Danh mục test",
  "description": "Mô tả bằng Swagger UI"
}</textarea>
                            <button class="btn btn-success btn-sm btn-execute" data-method="POST" data-url="CategoryApi/store">Execute</button>
                        </div>
                    </div>
                </div>

                <!-- API: Xóa Danh Mục -->
                <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#api-cat-del">
                        <div><span class="badge-method badge-DELETE">DELETE</span>/CategoryApi/destroy/{id}</div>
                    </div>
                    <div id="api-cat-del" class="collapse" data-bs-parent="#apiAccordion">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nhập ID Danh mục cần xóa:</label>
                                <input type="number" class="form-control param-id" placeholder="Ví dụ: 5">
                            </div>
                            <button class="btn btn-danger btn-sm btn-execute" data-method="DELETE" data-url="CategoryApi/destroy">Execute</button>
                        </div>
                    </div>
                </div>

                <!-- API: Lấy DS Sản phẩm -->
                <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#api-prod-index">
                        <div><span class="badge-method badge-GET">GET</span>/ProductApi/index</div>
                    </div>
                    <div id="api-prod-index" class="collapse" data-bs-parent="#apiAccordion">
                        <div class="card-body">
                            <button class="btn btn-primary btn-sm btn-execute" data-method="GET" data-url="ProductApi/index">Execute</button>
                        </div>
                    </div>
                </div>

                 <!-- API: Chi tiết Sản phẩm -->
                 <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#api-prod-show">
                        <div><span class="badge-method badge-GET">GET</span>/ProductApi/show/{id}</div>
                    </div>
                    <div id="api-prod-show" class="collapse" data-bs-parent="#apiAccordion">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nhập ID Sản phẩm:</label>
                                <input type="number" class="form-control param-id" placeholder="Ví dụ: 1">
                            </div>
                            <button class="btn btn-primary btn-sm btn-execute" data-method="GET" data-url="ProductApi/show">Execute</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Response Area -->
        <div class="col-lg-6">
            <h4 class="mb-3 border-bottom pb-2">Response Viewer</h4>
            <div class="card" style="min-height: 500px;">
                <div class="card-body position-relative">
                    <div id="loader" class="text-center d-none" style="position: absolute; top: 40%; left: 0; right: 0;">
                        <div class="spinner-border text-warning" role="status"></div>
                        <p class="mt-2 text-warning">Đang gửi Request...</p>
                    </div>
                    
                    <div id="response-container">
                        <div class="d-flex align-items-center mb-2">
                            <span id="res-status" class="response-status bg-secondary" style="display:none;">---</span>
                            <span id="res-url" class="ms-3 text-muted small"></span>
                        </div>
                        <pre id="res-body">// Bấm Execute ở cột bên trái để test API
// Kết quả trả về sẽ hiển thị tại đây...</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const baseUrl = window.location.pathname.replace('api_tester.php', 'index.php?url=');

    // Nút Login Lấy Token
    $('#btn-login').click(function() {
        const username = $('#auth-user').val();
        const password = $('#auth-pass').val();
        const btn = $(this);
        btn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);

        $.ajax({
            url: baseUrl + 'User/checkLogin',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({username: username, password: password}),
            success: function(res) {
                if(res.token) {
                    $('#jwt-token').val(res.token);
                    showResponse(200, baseUrl + 'User/checkLogin', res);
                } else {
                    showResponse(200, baseUrl + 'User/checkLogin', "Thành công nhưng không tìm thấy token trong response", false);
                }
            },
            error: function(xhr) {
                showResponse(xhr.status, baseUrl + 'User/checkLogin', xhr.responseJSON || xhr.responseText, false);
                $('#jwt-token').val('');
            },
            complete: function() {
                btn.html('<i class="fa-solid fa-key"></i> Lấy Token').prop('disabled', false);
            }
        });
    });

    // Bắt sự kiện click nút Execute
    $('.btn-execute').click(function() {
        const method = $(this).data('method');
        let endpointUrl = $(this).data('url');
        const cardBody = $(this).closest('.card-body');
        
        // Nếu API cần truyền ID
        const idInput = cardBody.find('.param-id');
        if(idInput.length > 0) {
            const idVal = idInput.val();
            if(!idVal) {
                alert('Vui lòng nhập ID!');
                idInput.focus();
                return;
            }
            endpointUrl += '/' + idVal;
        }

        const fullUrl = baseUrl + endpointUrl;
        const token = $('#jwt-token').val();
        
        // Setup thông tin ajax cơ bản
        let ajaxConf = {
            url: fullUrl,
            type: method,
            headers: {
                "Authorization": token ? "Bearer " + token : ""
            },
            beforeSend: function() {
                $('#loader').removeClass('d-none');
                $('#response-container').css('opacity', '0.3');
            },
            complete: function() {
                $('#loader').addClass('d-none');
                $('#response-container').css('opacity', '1');
            },
            success: function(res, textStatus, xhr) {
                showResponse(xhr.status, fullUrl, res);
            },
            error: function(xhr) {
                showResponse(xhr.status, fullUrl, xhr.responseJSON || xhr.responseText, false);
            }
        };

        // Nếu là POST/PUT thì cần gửi Body Data
        if(method === 'POST' || method === 'PUT') {
            const jsonTextarea = cardBody.find('.json-input');
            if(jsonTextarea.length > 0) {
                try {
                    // Kiểm tra JSON hợp lệ trước khi gửi
                    const jsonData = JSON.parse(jsonTextarea.val());
                    ajaxConf.contentType = "application/json";
                    ajaxConf.data = JSON.stringify(jsonData);
                } catch(e) {
                    alert('Lỗi JSON Format! Vui lòng kiểm tra lại cứu pháp JSON trong khung dữ liệu.');
                    return;
                }
            }
        }

        $.ajax(ajaxConf);
    });

    // Hàm hiển thị kết quả
    function showResponse(status, url, data, isSuccess = true) {
        const statusEl = $('#res-status');
        statusEl.show().text('HTTP ' + status);
        
        if(status >= 200 && status < 300) {
            statusEl.removeClass('status-error').addClass('status-200');
        } else {
            statusEl.removeClass('status-200').addClass('status-error');
        }

        $('#res-url').text(url);
        
        let outputStr = '';
        if(typeof data === 'object') {
            outputStr = JSON.stringify(data, null, 4);
        } else {
            outputStr = data; // HTML or Text
        }
        
        $('#res-body').text(outputStr);
    }
</script>
</body>
</html>
