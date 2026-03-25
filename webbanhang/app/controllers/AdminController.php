<?php
require_once 'app/config/database.php';
require_once 'app/Models/ProductModel.php';
require_once 'app/Models/CategoryModel.php';
require_once 'app/Models/UserModel.php';
require_once 'app/Models/OrderModel.php';

class AdminController {
    private $db;
    public function __construct() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/index.php?url=User/login');
            exit;
        }
        $this->db = (new Database())->getConnection();
    }

    public function index() {
        $productModel = new ProductModel($this->db);
        $categoryModel = new CategoryModel($this->db);
        
        $products = $productModel->getProducts();
        $categories = $categoryModel->getCategories();
        
        include 'app/views/admin/dashboard.php';
    }

    public function products() {
        $productModel = new ProductModel($this->db);
        $products = $productModel->getProducts();
        include 'app/views/admin/products.php';
    }
    
    public function categories() {
        $categoryModel = new CategoryModel($this->db);
        $categories = $categoryModel->getCategories();
        include 'app/views/admin/categories.php';
    }

    public function orders() {
        $orderModel = new OrderModel($this->db);
        $orders = $orderModel->getOrders();
        include 'app/views/admin/orders.php';
    }
}
?>
