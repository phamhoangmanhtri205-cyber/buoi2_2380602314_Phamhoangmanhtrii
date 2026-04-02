<?php
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        // Khởi tạo kết nối và model
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        $this->list();
    }

    /**
     * Hiển thị danh sách sản phẩm
     * Giao diện yêu cầu sử dụng Grid và Card của Bootstrap 5
     */
    public function list()
    {
        // Chặn quyền truy cập nếu chưa đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=User/login');
            exit;
        }

        // Lấy danh sách sản phẩm
        $products = $this->productModel->getProducts();
        
        // [SỬA Ở ĐÂY]: Lấy thêm danh sách danh mục để hiển thị ở Sidebar (bên trái)
        $categories = (new CategoryModel($this->db))->getCategories();
        
        include 'app/views/product/list.php';
    }

    /**
     * Form thêm sản phẩm mới
     */
    public function add()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
            exit;
        }
        $categories = (new CategoryModel($this->db))->getCategories();
        include 'app/views/product/add.php';
    }

    /**
     * Xử lý lưu sản phẩm
     */
    public function save()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            
            // Sửa đổi: Sử dụng trực tiếp đường dẫn URL do người dùng nhập vào thay vì upload
            $image = trim($_POST['image'] ?? '');

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                header('Location: index.php?url=Product/list');
                exit();
            }
        }
    }

    /**
     * Xem chi tiết sản phẩm
     */
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            header('Location: index.php?url=Product/list');
            exit();
        }
    }

    /**
     * Form chỉnh sửa sản phẩm
     */
    public function edit($id)
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
            exit;
        }
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            header('Location: index.php?url=Product/list');
            exit();
        }
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            
            // Sửa đổi: Lấy trực tiếp URL ảnh mới từ POST form thay vì upload file
            $image = trim($_POST['image'] ?? '');

            if ($this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image)) {
                header('Location: index.php?url=Product/list');
                exit();
            } else {
                die("Lỗi: Không thể cập nhật sản phẩm.");
            }
        }
    }

    /**
     * Xóa sản phẩm
     */
    public function delete($id)
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=Product/index');
            exit;
        }
        if ($this->productModel->deleteProduct($id)) {
            header('Location: index.php?url=Product/list');
            exit();
        } else {
            die("Lỗi: Không thể xóa sản phẩm này.");
        }
    }


}