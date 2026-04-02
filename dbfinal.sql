-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~5 rows (approximately)
REPLACE INTO `category` (`id`, `name`, `description`) VALUES
	(3, 'Nike', 'giày chính hãng nike'),
	(4, 'Adidas', 'giày chính hãng adidas'),
	(30, 'Puma', NULL),
	(31, 'Mizuno', NULL),
	(32, 'Danh mục test', 'Mô tả bằng Swagger UI');

-- Dumping structure for table my_store.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` enum('pending','confirmed','shipping','delivered','cancelled') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~12 rows (approximately)
REPLACE INTO `orders` (`id`, `customer_name`, `customer_phone`, `customer_address`, `total_price`, `status`, `created_at`) VALUES
	(1, 'Nguyễn Văn An', '0901234561', '12 Nguyễn Huệ, Q1, TP.HCM', 39000000.00, 'delivered', '2026-03-22 15:57:41'),
	(2, 'Trần Thị Bình', '0901234562', '34 Lê Lợi, Q1, TP.HCM', 2900000.00, 'shipping', '2026-03-24 15:57:41'),
	(3, 'Lê Văn Cường', '0901234563', '56 Điện Biên Phủ, Q3, TP.HCM', 10000000.00, 'confirmed', '2026-03-26 15:57:41'),
	(4, 'Phạm Thị Dung', '0901234564', '78 Cách Mạng Tháng 8, Q3', 5800000.00, 'pending', '2026-03-28 15:57:41'),
	(5, 'Hoàng Văn Em', '0901234565', '90 Võ Văn Tần, Q3, TP.HCM', 3500000.00, 'delivered', '2026-03-29 15:57:41'),
	(6, 'Vũ Thị Phương', '0901234566', '102 Pasteur, Q1, TP.HCM', 12000000.00, 'cancelled', '2026-03-30 15:57:41'),
	(7, 'Đặng Văn Giang', '0901234567', '15 Hai Bà Trưng, Q1, TP.HCM', 7200000.00, 'pending', '2026-03-31 15:57:41'),
	(8, 'Bùi Thị Hoa', '0901234568', '23 Nguyễn Đình Chiểu, Q3', 4100000.00, 'shipping', '2026-04-01 03:57:41'),
	(9, 'Đỗ Văn Ích', '0901234569', '67 Ngô Đức Kế, Q1, TP.HCM', 9500000.00, 'confirmed', '2026-04-01 09:57:41'),
	(10, 'Mai Thị Kim', '0901234570', '89 Trần Hưng Đạo, Q5, TP.HCM', 2100000.00, 'pending', '2026-04-01 13:57:41'),
	(11, 'ád', '12', 'dĩ an\r\n', 6000000.00, 'pending', '2026-04-02 00:10:29'),
	(12, 'tri', '1243', 'dĩ an', 39000000.00, 'pending', '2026-04-02 00:54:30');

-- Dumping structure for table my_store.order_details
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~14 rows (approximately)
REPLACE INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 2, 1, 39000000.00),
	(2, 2, 3, 1, 2900000.00),
	(4, 4, 6, 1, 5800000.00),
	(5, 4, 9, 1, 3500000.00),
	(6, 5, 7, 1, 3500000.00),
	(7, 6, 10, 1, 12000000.00),
	(8, 7, 11, 2, 3600000.00),
	(9, 7, 13, 1, 7200000.00),
	(10, 8, 14, 1, 4100000.00),
	(11, 9, 15, 2, 4750000.00),
	(12, 9, 16, 1, 3200000.00),
	(13, 10, 3, 1, 2100000.00),
	(14, 11, 13, 1, 6000000.00),
	(15, 12, 2, 1, 39000000.00);

-- Dumping structure for table my_store.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~20 rows (approximately)
REPLACE INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(2, 'Nike Phantom GX Elite FG United Pack /65 Pairs US 9 UK 8', 'ab', 39000000.00, 'https://thumblr.uniid.it/product/438058/8762624bf0a5.jpg?width=1024', 3),
	(3, 'F50 Elite Firm Ground Boots', 'ab', 2900000.00, 'https://thumblr.uniid.it/product/431054/89fe8d9ea298.jpg?width=1024', 4),
	(6, 'Nike Zoom Mercurial Vapor 15 Elite FG', 'Mô tả chi tiết cho mẫu giày siêu xịn số 1, chất liệu êm ái, bền bỉ, thích hợp chạy bộ và dạo phố.', 6500000.00, 'https://thumblr.uniid.it/product/437477/646da9ea9a32.jpg?width=1024', 3),
	(7, 'Adidas X Crazyfast.1 FG', 'adidas X Crazyfast vẫn là mẫu giày dành cho các cầu thủ đam mê tốc độ. Đây là một bản nâng cấp dựa trên những thế hệ đi trước, cụ thể là phần trên giống với X Speeddflow trong khi phần đế giữ nguyên của X speedportal.\r\n\r\nVà để giảm trọng lượng tối đa để trở thành một đôi giày tốc độ siêu nhẹ giúp các cầu thủ xử lý bóng một cách linh hoạt, adidas đã bổ sung thêm một số công nghệ đặc biệt giúp đôi giày trở nên hoàn hảo hơn:\r\n\r\n- Aeropacity Speedskin: lớp upper kết hợp giữa sợi và da tổng hợp mang lại sự ổn định và thoải mái.\r\n\r\n- Aerocage: Khung định hình với lớp lót hỗ trợ và ổn định, phù hợp với bàn chân và nâng cao hiệu xuất.\r\n\r\n- Aeroplate: Lớp phủ mới làm giảm trọng lượng cho đôi giày.\r\n\r\nGiống như các thế hệ trước, dòng X Crazyfast vẫn có thiết kế thon gọn phù hợp với lối chơi tốc độ và sự linh hoạt như tiền đạo, tiền vệ...\r\n\r\nSản phẩm Adidas X được các cầu thủ nổi tiếng đại diện gồm có Lionel Messi, Karim Benzema, Marcelo, Mohamed Salah, Son Hueng Min và Timo Werner...', 6200000.00, 'https://www.sport9.vn/images/thumbs/002/0021087_adidas-x-crazyfast-1-fg-crazyrush-footwear-whitecore-blacklucid-lemon.jpeg?preset=xmedium', 4),
	(8, 'Puma Future Ultimate FG/AG', 'Mọi thứ khác đều có thể dạy được. Nhưng còn sáng tạo? Đó là cá tính của bạn. Giải phóng kỹ năng chơi bóng của bạn với FUTURE 9 ULTIMATE. Phần trên FUZIONFIT được thiết kế lại sẽ chuyển động theo bạn như hình với bóng, giúp bạn thoải mái sáng tạo. Phía trên, các vùng bám 3D cố định với GripControl Pro giúp bạn kiểm soát bóng tốt hơn, nhờ đó tận dụng mọi cú chạm bóng – dù là rê bóng qua hậu vệ, chuyền bóng hay ghi bàn. Được trang bị đế ngoài FLEXGILITY cho khả năng linh hoạt 360 độ, đây là đôi giày vừa vặn, di chuyển và chơi bóng theo cách khác biệt – dành cho những cầu thủ dám đột phá. Hỡi các cầu thủ, TƯƠNG LAI là do chính ta tạo ra.', 5800000.00, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_2000,h_2000/global/108883/01/fnd/VNM/fmt/png/Gi%C3%A0y-b%C3%B3ng-%C4%91%C3%A1-FUTURE-9-ULTIMATE-FG-Unisex', 30),
	(9, 'Mizuno Morelia Neo III Japan FG', 'Đỉnh cao của sự đổi mới, Mizuno mang đến siêu phẩm Giày Đá Bóng Mizuno Morelia Neo III Japan FG made in Japan. Cải tiến da thật hoàn hảo với trọng lượng siêu nhẹ giúp các cầu thủ tăng tốc, bứt phá thành công. Mizuno đã kết hợp tất cả các vật liệu sáng tạo nhất trên thế giới cùng với da Kangaroo để tạo ra siêu phẩm Giày Đá Bóng Mizuno Morelia Neo III Japan FG. Nếu bạn đang tìm kiếm một đôi giày sân cỏ tự nhiên thì chắc chắn Giày Đá Bóng Mizuno Morelia Neo III Japan FG là đôi giày bạn không thể bỏ qua.', 7200000.00, 'https://dongduongsport.com/wp-content/uploads/2022/09/giay-da-bong-mizuno-morelia-neo-iii-japan-fg-dongduongsportcom-92-600x600.jpg', 31),
	(10, 'Nike Phantom GX Elite FG', 'Mô tả chi tiết cho mẫu giày siêu xịn số 5, chất liệu êm ái, bền bỉ, thích hợp chạy bộ và dạo phố.', 6700000.00, 'https://thumblr.uniid.it/product/438058/8762624bf0a5.jpg?width=1024', 3),
	(11, 'Adidas Predator Accuracy.1 FG', 'Lớp trên HybridTouch nhẹ thông qua vật liệu sợi nhỏ được phủ giúp mang lại trải nghiệm mềm mại và dễ uốn, vừa vặn độc đáo và giảm trọng lượng so với các thế hệ Predator trước đó\r\nCông nghệ Độ nét cao mang tính cách mạng, là các thành phần cao su tối giản trên bề mặt đá giúp cải thiện độ bám và độ chính xác tối đa mà không ảnh hưởng đến tính linh hoạt\r\nKết cấu 3D Grip bên ngoài giày, đảm bảo khả năng kiểm soát tối ưu giữa giày và bóng khi thực hiện những cú rê bóng quyết đoán\r\nĐược cấu tạo với cổ áo hai mảnh bao gồm Primeknit mềm mại để tạo sự thoải mái, ổn định, khóa chặt và truy cập nhanh vào bên trong giày\r\nCông cụ tách khung Facet tiên tiến mang lại khả năng tăng tốc, lực kéo động và xoay ngay cả ở tốc độ cao nhất\r\nPhần trên bao gồm tối thiểu 50% vật liệu tái chế, đây là một bước tiến xa hơn hướng tới một tương lai xanh hơn\r\nPhiên bản cắt thấp phổ biến\r\nĐinh tán FG cho sân cỏ tự nhiên.\r\nTrọng lượng: 240 gam', 6400000.00, 'https://www.sport9.vn/images/thumbs/002/0021108_adidas-predator-accuracy-1-low-fg-lucid-blueteam-real-magentacore-black-limited-edition.jpeg?preset=large', 4),
	(12, 'Puma Ultra Ultimate FG/AG', 'Mô tả chi tiết cho mẫu giày siêu xịn số 7, chất liệu êm ái, bền bỉ, thích hợp chạy bộ và dạo phố.', 5500000.00, 'https://thumblr.uniid.it/product/434003/450450030e3e.jpg?width=1024', 30),
	(13, 'Nike Tiempo Legend 10 Elite FG', 'Một mùa hè với nhiều giải đấu lớn sôi động đang đến gần, để tiếp thêm sức mạnh cho các cầu thủ khi ra sân, Nike hé lộ những hình ảnh đầu tiên cho BST mới của mình mang tên Ready Pack. BST này được coi là một bản phối màu rực lửa nhất dành cho cả 3 phiên bản Air Zoom Mercurial, Tiempo và Phantom GX từ đầu năm tới nay.\r\n\r\nBộ sưu tập giày đá banh Nike Ready Pack được thiết kế với một phong cách phối màu mang đậm chất lửa bên trong nhờ sử dụng gam màu chủ đạo là Bright Crimson (đỏ đậm và tươi) kết hợp cùng các điểm nhấn màu đen trắng. Nghệ thuật sử dụng màu sắc này không chỉ thể hiện được sức nóng của một mùa hè sôi động mà còn tạo ra được sức hút đặc biệt cho các cầu thủ nổi tiếng như Cristiano Ronaldo, Kylian Mbappé, Erling Haaland,... khi họ mang thi đấu trên sân trong thời gian tới. ', 6000000.00, 'https://product.hstatic.net/1000061481/product/c89cefd3a05b48b1a694b076c2c827e2_c9b03e77366142f8b297df18e734871c_1024x1024.jpeg', 3),
	(14, 'Adidas Copa Pure.1 FG', 'adidas Copa Pure .1 FG là mẫu giày đá bóng sân cỏ tự nhiên adidas chính hãng. Mẫu giày này thường sử dụng trong thi đấu 11 người, mặt sân khô, độ ẩm thấp.\r\n\r\n- adidas Copa Pure .1 FG thay thế cho Copa Sense .1 FG với bề mặt da thật mềm mại hơn cũng như khối lượng nhẹ hơn đáng kể. Ngoài ra Copa Pure có form dễ chịu và thoải mái hơn khi so với Copa Sense.', 5900000.00, 'https://down-vn.img.susercontent.com/file/vn-11134207-7ras8-mc30s2d6rrzm1d@resize_w450_nl.webp', 4),
	(15, 'Mizuno Alpha Japan FG', '\r\nChạy nhanh hơn bao giờ hết với đôi giày bóng đá tăng tốc hàng đầu của Mizuno, chỉ nặng 190 gram. Đôi giày được trang bị nhiều tính năng tuyệt vời, bao gồm lớp đệm MIZUNO ENERZY Foam giúp tăng cường khả năng giảm chấn và hoàn trả năng lượng, đinh tán hình tam giác α giúp tăng độ bám và đế trong KaRVO Half-Board giúp hoàn trả năng lượng, hỗ trợ bứt tốc. • Giày bóng đá tăng tốc nhanh nhất từ ​​trước đến nay của Mizuno, chỉ nặng 200 gram • Khuôn giày Engineered Fit Last Neo (tương tự như MORELIA NEO III) • Phù hợp với mọi bề mặt (đất, cỏ nhân tạo - 4g và 5g, và cỏ tự nhiên)', 7500000.00, 'https://emea.mizuno.com/dw/image/v2/BDBS_PRD/on/demandware.static/-/Sites-masterCatalog_Mizuno/default/dwb2cfe312/AW24/Football/SH_P1GA246027.png?sw=950&sh=950', 31),
	(16, 'ASICS DS Light X-Fly 4', 'Asics đã phát hành một colorway rất đẹp cho Asics DS Light X-Fly 4. Những đôi giày trắng / bạc mới có thể sẽ được Andres Iniesta sử dụng – người đang chơi cho đội bóng Nhật Bản Vissel Kobe. Bản màu mới nhất của DS Light X-Fly 4  được giới thiệu một thiết kế tinh tế nhưng sành điệu với màu trắng và bạc với phần nhận diện thương hiệu màu đen.\r\n\r\nAsics DS Light X-Fly 4 được chế tạo vừa nhẹ vừa bền. Upper được chế tạo từ da kangaroo cực mềm. Mặt đế và bộ gót “được kết hợp” để giảm đáng kể trọng lượng của giày mà không làm giảm độ bền. Giày cao cổ Asics DS Light X-Fly 4 sẽ được bán từ ngày 6 tháng 12 tại Nhật Bản với giá khoảng 19.440 Yên Nhật (155 USD). Bạn có thể ghé qua shop www.soccerstore.vn để sắm cho mình một đôi giày đá bóng Asics sân cỏ nhân tạo chính hãng nhé, có nhiều chương trình giảm giá.', 4800000.00, 'https://soccerstore.vn/wp-content/uploads/2024/10/z1775808881922_da2bec21b5301cfd56d17411cc0c6f23.jpg', 3),
	(17, 'Under Armour Clone Magnetico Pro 2', 'Bề mặt được hình thành từ chất liệu da tổng hợp siêu mỏng, đem lại cảm giác dễ chịu cho đôi bàn chân. Đặc biệt, dựa trên sự thành công của người tiền nhiệm – Under Armour Magnetico Pro, thiết kế Under Armour Clone Magnetico Pro 2 đã có sự cải tiến đáng kế khi bề mặt được chần bông, vừa đảm bảo độ êm ái vừa đảm bảo khả năng cảm nhận cho người đeo. Upper giày với những gờ nổi, được hình thành từ hệ thống đường may dày đặc, khéo léo để khiến người đối diện không cảm thấy rối mắt. Các gờ này đều được chần bông tiếp liền nhau và hệ thống chấm kết cấu, giúp gia tăng độ bám khi chạm bóng.', 5200000.00, 'https://soccerstore.vn/wp-content/uploads/2024/10/unnamed-1-9.jpg', 3),
	(18, 'New Balance Furon V7 Pro FG', 'New Balance Furon V7+ Pro TF là mẫu giày đá banh sân cỏ nhân tạo New Balance chính hãng. Thường dùng trong thi đấu thể thức 5-7 người trên mặt sân cỏ nhân tạo.\r\nNew Balance Furon V7+ Pro TF là mẫu giày thuộc dòng Speed – ưu tiên cho các cầu thủ tốc độ. Đây là dòng giày bán chạy nhất của NB trong nhiều năm trở lại đây.\r\n\r\nThân giày được cấu thành từ da tổng hợp thế hệ mới, mềm mại, êm ái giúp khối lượng giày được tối ưu ở mức nhẹ nhất. Form giày thon và ôm chân, phù hợp với các vị trí tấn công, sử dụng tốc độ và kỹ thuật, chạy cánh, tiền đạo.\r\n\r\nCầu thủ đại diện: Sadio Mane, Bukayo Saka, Raheem Sterling …', 5400000.00, 'https://product.hstatic.net/200000174771/product/5e006e95b40d430287048049d58f6f50_63f763b914614827ac7cb212302fd238_master.jpg', 3),
	(19, 'Nike Premier III FG', 'Cảm nhận sự bất khả chiến bại trên sân cỏ với giày bóng đá Nike Premier III FG màu Đen/Trắng, sở hữu phần thân trên bằng da K mềm mại, dẻo dai mang lại cảm giác chạm bóng và sự thoải mái vượt trội.\r\n\r\nMón quà của Nike dành cho bóng đá nghiệp dư trở lại với thế hệ thứ ba, được thiết kế tinh tế hơn so với kiểu dáng cổ điển. Đường khâu trên lớp da K mềm mại đã được điều chỉnh nhẹ để tạo ra các vùng đệm cụ thể ở mu bàn chân và mu bàn chân, trong khi nhãn &quot;Premier&quot; trên logo Swoosh kết hợp với logo dập nổi ở gót giày tạo nên vẻ ngoài cao cấp – dù sao thì đây cũng là Premier. Tuy nhiên, thay đổi lớn nhất là tùy thuộc vào bạn. Nike biết nhiều cầu thủ thích cắt bỏ lưỡi giày, vì vậy họ đã thêm một đường cắt chấm để giúp bạn giữ mọi thứ gọn gàng và duy trì độ vừa vặn nếu bạn quyết định bỏ lưỡi giày. Có lưỡi giày hay không, Premier vẫn là đôi giày không cầu kỳ dành cho những cầu thủ không cầu kỳ, sẵn sàng thống trị các sân cỏ trên toàn thế giới một lần nữa.', 2800000.00, 'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto/f4bac890-f200-46be-8dbe-81d627c8cfb8/THE+NIKE+PREMIER+III+FG.png', 3),
	(20, 'Adidas X Speedportal.2 FG', 'Hãy xé toạc hàng phòng ngự đối phương với giày bóng đá adidas X Speedportal.2 FG màu Clear Aqua/Solar Red/Power Blue, được thiết kế để tăng tốc vượt trội.\r\n\r\nNhanh hơn ở mọi khía cạnh, X Speedportal sở hữu đế ngoài tốc độ cao mới giúp bạn vượt qua mọi rào cản và thoát khỏi sự truy cản của hậu vệ.\r\n\r\nTất cả là về việc tận dụng khoảng trống, với các đinh tán bổ sung ở phần mũi giày giúp bạn lao vào hành động ngay khi có khoảng trống xuất hiện. Ở phía sau, khóa gót ngoài cung cấp lực ép xuống giúp bạn giữ vững thăng bằng ở tốc độ tối đa.\r\n\r\nPhần thân giày bằng lưới nhẹ, được thiết kế tỉ mỉ với kết cấu bám chắc giúp bạn kiểm soát bóng nhanh chóng và dứt khoát, trong khi cổ giày Primeknit thoải mái và phần giữa bàn chân được đúc khuôn mang lại sự hỗ trợ thích ứng cho những pha di chuyển bùng nổ của bạn.', 3500000.00, 'https://images.prodirectsport.com/ProductImages/Main/266960_Main_1906929.jpg', 4),
	(21, 'Puma King Ultimate FG/AG', 'Người thừa kế xứng đáng đã đến. Đôi giày này có phần thân trên K-BETTER™ cho cảm giác chạm bóng tuyệt vời, GRIPCONTROL 3D giúp kiểm soát bóng tốt hơn và đế ngoài nhẹ giúp tối đa hóa khả năng di chuyển. Trải nghiệm sự vừa vặn và thoải mái hoàn hảo với công nghệ NanoGrip và lớp đệm ORTHOLITE®. Hãy cho mọi người biết: đã có một vị VUA mới ở đây.', 4500000.00, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_550,h_550/global/108303/01/fnd/EEA/fmt/png/KING-ULTIMATE-FG/AG-Football-Boots-Unisex', 30),
	(22, 'Nike Mercurial Superfly 9 Pro', 'Mô tả chi tiết cho mẫu giày siêu xịn số 17, chất liệu êm ái, bền bỉ, thích hợp chạy bộ và dạo phố.', 4200000.00, 'https://thumblr.uniid.it/product/438124/30d4e7818ed9.jpg?width=1024', 3),
	(24, 'Mizuno Monarcida Neo II Select', 'Mô tả chi tiết cho mẫu giày siêu xịn số 19, chất liệu êm ái, bền bỉ, thích hợp chạy bộ và dạo phố.', 1800000.00, 'https://thumblr.uniid.it/product/436827/6b87d5ed90d7.jpg?width=1024', 31);

-- Dumping structure for table my_store.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'customer',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.users: ~22 rows (approximately)
REPLACE INTO `users` (`id`, `username`, `password`, `role`) VALUES
	(1, 'admin', '$2y$10$aP/.qz6/JBpNYRF0BMcqVuZiUEcT0mXHKsJDQEGK5IVltUJh.sLEa', 'admin'),
	(2, 'khachhang1', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'admin'),
	(3, 'khachhang2', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(4, 'khachhang3', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(5, 'khachhang4', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(6, 'khachhang5', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(7, 'khachhang6', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(8, 'khachhang7', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(9, 'khachhang8', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(10, 'khachhang9', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(11, 'khachhang10', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(12, 'khachhang11', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(13, 'khachhang12', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(14, 'khachhang13', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(15, 'khachhang14', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(16, 'khachhang15', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(17, 'khachhang16', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(18, 'khachhang17', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(19, 'khachhang18', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(20, 'khachhang19', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(21, 'khachhang20', '$2y$10$5CmZTqVy.9VYrgIvegM93etsa7pq1Q8Ly2l.lxNdbnHdr1u/kvn2W', 'customer'),
	(22, 'tri', '$2y$10$.fRvXbNDIHQotnhK/.42c.SNWYFlL0/H3U2U5dq1.bcjQzVoWIvT2', 'customer');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
