<?php
session_start();

// Tự động load Database để các Controller không cần require lại thủ công quá nhiều
require_once 'app/config/database.php';

$url = $_GET['url'] ?? 'Product/index';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controllerName = (!empty($url[0])) ? ucfirst($url[0]) . 'Controller' : 'ProductController';
$action = $url[1] ?? 'index';

$controllerPath = 'app/controllers/' . $controllerName . '.php';

if (!file_exists($controllerPath)) {
    die("Lỗi: Không tìm thấy Controller tại $controllerPath");
}

require_once $controllerPath;
$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    die("Lỗi: Không tìm thấy hàm $action trong $controllerName");
}

// Tham số truyền vào hàm (ví dụ ID sản phẩm)
$params = array_slice($url, 2);
call_user_func_array([$controller, $action], $params);