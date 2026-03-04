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
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    /**
     * Form thêm sản phẩm mới
     */
    public function add()
    {
        $categories = (new CategoryModel($this->db))->getCategories();
        include 'app/views/product/add.php';
    }

    /**
     * Xử lý lưu sản phẩm
     */
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? 0;
            $category_id = $_POST['category_id'] ?? null;
            
            // Xử lý upload ảnh chuyên nghiệp
            $image = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image = $this->uploadImage($_FILES['image']);
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                // Sử dụng thông báo flash session nếu có thể, ở đây redirect trực tiếp
                header('Location: /tri/webbanhang/Product/list');
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
            header('Location: /tri/webbanhang/Product/list');
            exit();
        }
    }

    /**
     * Form chỉnh sửa sản phẩm
     */
    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            header('Location: /tri/webbanhang/Product/list');
            exit();
        }
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            
            // Giữ lại ảnh cũ nếu không có ảnh mới
            $product = $this->productModel->getProductById($id);
            $image = $_POST['existing_image'] ?? $product->image;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $newImage = $this->uploadImage($_FILES['image']);
                if ($newImage) {
                    // Nếu cần, có thể thêm code xóa file ảnh cũ ở đây để tiết kiệm bộ nhớ
                    $image = $newImage;
                }
            }

            if ($this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image)) {
                header('Location: /tri/webbanhang/Product/list');
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
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /tri/webbanhang/Product/list');
            exit();
        } else {
            die("Lỗi: Không thể xóa sản phẩm này.");
        }
    }

    /**
     * Helper: Upload hình ảnh
     */
    private function uploadImage($file)
    {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        // Tạo tên file duy nhất để tránh ghi đè
        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $file_name = time() . "_" . uniqid() . "." . $ext;
        $target_file = $target_dir . $file_name;

        // Chỉ cho phép một số định dạng ảnh nhất định
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($ext, $allowed)) {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file;
            }
        }
        return null;
    }
}