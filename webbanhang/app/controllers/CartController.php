<?php
require_once('app/models/ProductModel.php');
require_once('app/models/OrderModel.php');

class CartController {
    private $db;
    private $productModel;
    private $orderModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->orderModel = new OrderModel($this->db);
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function index() {
        $cart = $_SESSION['cart'];
        include 'app/views/cart/index.php';
    }

    public function add($id) {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1
                ];
            }
        }
        header('Location: index.php?url=Cart/index');
        exit;
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $action = $_POST['action']; // 'increase' hoặc 'decrease'
            if (isset($_SESSION['cart'][$id])) {
                if ($action == 'increase') {
                    $_SESSION['cart'][$id]['quantity']++;
                } elseif ($action == 'decrease') {
                    $_SESSION['cart'][$id]['quantity']--;
                    if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                        unset($_SESSION['cart'][$id]);
                    }
                }
            }
        }
        header('Location: index.php?url=Cart/index');
        exit;
    }

    public function remove($id) {
        if (isset($_SESSION['cart'][$id])) unset($_SESSION['cart'][$id]);
        header('Location: index.php?url=Cart/index');
        exit;
    }

    public function checkout() {
        if (empty($_SESSION['cart'])) {
            header('Location: index.php?url=Product/list'); exit;
        }
        include 'app/views/cart/checkout.php';
    }

    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
            try {
                $this->db->beginTransaction();

                $total = array_sum(array_map(function($i) { return $i['price'] * $i['quantity']; }, $_SESSION['cart']));
                $orderId = $this->orderModel->createOrder($_POST['fullname'], $_POST['phone'], $_POST['address'], $total);

                if (!$orderId) {
                    throw new Exception("Không thể tạo đơn hàng.");
                }

                foreach ($_SESSION['cart'] as $item) {
                    if (!$this->orderModel->createOrderDetail($orderId, $item['id'], $item['quantity'], $item['price'])) {
                        throw new Exception("Không thể lưu chi tiết đơn hàng.");
                    }
                }

                $this->db->commit();
                unset($_SESSION['cart']);
                header('Location: index.php?url=Order/index');
                exit;

            } catch (Exception $e) {
                $this->db->rollBack();
                // Optional: log the error: error_log($e->getMessage());
                $_SESSION['checkout_error'] = "Đã có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại.";
            }
        }
        header('Location: index.php?url=Cart/index');
        exit;
    }
}