<?php
require_once __DIR__ . '/app/config/database.php';

$db = new Database();
$conn = $db->getConnection();

$sqlOrders = "CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sqlOrderDetails = "CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `product`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

try {
    $conn->exec($sqlOrders);
    echo "Bảng orders tạo thành công.\n";
    
    $conn->exec($sqlOrderDetails);
    echo "Bảng order_details tạo thành công.\n";
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage() . "\n";
}
?>
