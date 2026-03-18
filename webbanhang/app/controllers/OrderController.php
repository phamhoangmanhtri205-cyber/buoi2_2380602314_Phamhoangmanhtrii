<?php
require_once('app/models/OrderModel.php');

class OrderController {
    private $db;
    private $orderModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
    }

    public function index() {
        $orders = $this->orderModel->getOrders();
        include 'app/views/order/index.php';
    }

    // Hiển thị chi tiết 1 đơn hàng
    public function show($id) {
        $order = $this->orderModel->getOrderById($id);
        $orderDetails = $this->orderModel->getOrderDetails($id);
        
        if (!$order) {
            header('Location: index.php?url=Order/index');
            exit;
        }
        
        include 'app/views/order/show.php';
    }

    public function cancel($id) {
        $this->orderModel->cancelOrder($id);
        header('Location: index.php?url=Order/index');
    }
}