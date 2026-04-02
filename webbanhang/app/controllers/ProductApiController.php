<?php
require_once('app/config/database.php');
require_once('app/Models/ProductModel.php');
if(file_exists('app/Models/CategoryModel.php')) {
    require_once('app/Models/CategoryModel.php');
}
require_once('app/utils/JWTHandler.php'); // Thêm JWT Handler

class ProductApiController
{
    private $productModel;
    private $db;
    private $jwtHandler; // Thêm Handler JWT

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->jwtHandler = new JWTHandler();
    }

    private function authenticate()
    {
        $headers = [];
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            // Fallback cho môi trường không phải Apache (CGI/FastCGI)
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
                // Giải mã Token
                $decoded = $this->jwtHandler->decode($jwt);
                return $decoded ? true : false;
            }
        }
        return false;
    }

    // Lấy danh sách sản phẩm (public - không cần JWT)
    public function index()
    {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }

    // Lấy thông tin sản phẩm theo ID
    public function show($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $product = $this->productModel->getProductById($id);
            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Product not found']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Thêm sản phẩm mới
    public function store()
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            
            $name = $data['name'] ?? '';
            $description = $data['description'] ?? '';
            $price = $data['price'] ?? '';
            $category_id = $data['category_id'] ?? null;
            $image = $data['image'] ?? null;
            
            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
            
            if (is_array($result)) {
                http_response_code(400);
                echo json_encode(['errors' => $result]);
            } else {
                http_response_code(201);
                echo json_encode(['message' => 'Product created successfully']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Cập nhật sản phẩm theo ID
    public function update($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            try {
                $data = json_decode(file_get_contents("php://input"), true);
                if (!$data) {
                    http_response_code(400);
                    echo json_encode(['message' => 'Dữ liệu JSON không hợp lệ']);
                    return;
                }

                $name        = $data['name'] ?? '';
                $description = $data['description'] ?? '';
                $price       = $data['price'] ?? '';
                $category_id = $data['category_id'] ?? null;
                $image       = $data['image'] ?? null;

                $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

                if ($result) {
                    echo json_encode(['message' => 'Product updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['message' => 'Product update failed - execute returned false']);
                }
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['message' => 'Lỗi server: ' . $e->getMessage()]);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        if ($this->authenticate()) {
            header('Content-Type: application/json');
            $result = $this->productModel->deleteProduct($id);
            
            if ($result) {
                echo json_encode(['message' => 'Product deleted successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Product deletion failed']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Unauthorized']);
        }
    }
}
?>
