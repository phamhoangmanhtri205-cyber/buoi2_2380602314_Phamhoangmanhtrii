CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'customer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Thêm 1 tài khoản đăng nhập mẫu
-- Tên người dùng: admin
-- Mật khẩu đã được mã hoá (Hash) bằng thư viện của PHP của chuỗi '123456'
INSERT INTO `users` (`username`, `password`, `role`) VALUES
('admin', '$2y$10$aP/.qz6/JBpNYRF0BMcqVuZiUEcT0mXHKsJDQEGK5IVltUJh.sLEa', 'admin');
