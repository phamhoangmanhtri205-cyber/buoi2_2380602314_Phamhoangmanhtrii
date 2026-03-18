<?php
class OrderModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Tạo đơn hàng mới
    public function createOrder($name, $phone, $address, $total) {
        $query = "INSERT INTO orders (customer_name, customer_phone, customer_address, total_price, status) 
                  VALUES (:name, :phone, :address, :total, 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':total', $total);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Thêm chi tiết đơn hàng
    public function createOrderDetail($order_id, $product_id, $quantity, $price) {
        $query = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                  VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Lấy danh sách đơn hàng
    public function getOrders() {
        $query = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Lấy thông tin 1 đơn hàng theo ID
    public function getOrderById($id) {
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Lấy chi tiết các sản phẩm trong đơn hàng
    public function getOrderDetails($order_id) {
        $query = "SELECT od.*, p.name as product_name, p.image as product_image 
                  FROM order_details od 
                  JOIN product p ON od.product_id = p.id 
                  WHERE od.order_id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Hủy đơn hàng (Chỉ khi đang chờ xử lý)
    public function cancelOrder($id) {
        $query = "UPDATE orders SET status = 'cancelled' WHERE id = :id AND status = 'pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>