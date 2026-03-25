<?php
require_once __DIR__ . '/app/config/database.php';

$db = new Database();
$conn = $db->getConnection();

$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$conn->exec($sql);
echo "Tạo bảng users thành công.\n";

// Insert admin
$password = password_hash('123456', PASSWORD_DEFAULT);
$stmt = $conn->prepare("SELECT * FROM users WHERE username = 'admin'");
$stmt->execute();
if($stmt->rowCount() == 0) {
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES ('admin', :password, 'admin')");
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    echo "Tạo tài khoản admin thành công (admin/123456).\n";
} else {
    echo "Tài khoản admin đã tồn tại.\n";
}
?>
