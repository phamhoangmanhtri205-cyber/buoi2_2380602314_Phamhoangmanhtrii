<?php
require_once('app/config/database.php');
require_once('app/Models/CategoryModel.php');
require_once('app/utils/JWTHandler.php');

class CategoryApiController
{
    private $categoryModel;
    private $db;
    private $jwtHandler;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }

    private function authenticate()
    {
        $headers = [];
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            foreach ($_SERVER as $key => $value) {
                if (substr($key, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))))] = $value;
                }
            }
        }

        $authHeader = $headers['Authorization'] ?? ($_SERVER['HTTP_AUTHORIZATION'] ?? ($_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? null));

        if ($authHeader) {
            $arr = explode(" ", $authHeader);
            $jwt = $arr[1] ?? null;
            if ($jwt) {
                $decoded = $this->jwtHandler->decode($jwt);
                return $decoded ? true : false;
            }
        }
        return false;
    }

    // Lấy danh sách danh mục
    public function index()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $categories = $this->categoryModel->getCategories();
            echo json_encode($categories);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }
}
?>
