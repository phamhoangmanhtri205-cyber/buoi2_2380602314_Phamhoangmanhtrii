<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Hiển thị danh sách danh mục
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    // Hiển thị form thêm danh mục
    public function add()
    {
        include 'app/views/category/add.php';
    }

    // Xử lý lưu danh mục mới
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if ($this->categoryModel->addCategory($name, $description)) {
                // Điều hướng về danh sách sản phẩm hoặc danh mục tùy hệ thống
                header('Location: /webbanhang/Product/list'); 
                exit;
            } else {
                echo "Có lỗi xảy ra khi thêm danh mục.";
            }
        }
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit($id)
    {
        // Lấy dữ liệu danh mục từ Model
        $category = $this->categoryModel->getCategoryById($id);
        
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Danh mục không tồn tại.";
        }
    }

    // Xử lý cập nhật danh mục
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                header('Location: /webbanhang/Product/list');
                exit;
            } else {
                echo "Có lỗi xảy ra khi cập nhật.";
            }
        }
    }

    // Xử lý xóa danh mục
    public function delete($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /webbanhang/Product/list');
            exit;
        } else {
            echo "Lỗi khi xóa: Danh mục có thể đang chứa sản phẩm hoặc không tồn tại.";
        }
    }
}
?>