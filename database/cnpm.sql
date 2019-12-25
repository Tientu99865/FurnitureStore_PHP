-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 25, 2019 lúc 06:47 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnpm`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `display` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `url`, `position`, `display`) VALUES
(13, 'Đèn ', '', 3, 0),
(12, 'Đồ trang trí', '', 2, 0),
(10, 'Ghế', '', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `introduce` text COLLATE utf8_unicode_ci NOT NULL,
  `made_in` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `post_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `cat_id`, `product_name`, `product_price`, `selling_price`, `image`, `introduce`, `made_in`, `post_on`) VALUES
(39, 10, 'Ghế Lớp Học', '500000.00', '500000.00', 'our-team.jpeg', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:40:24'),
(33, 12, 'Thùng rác cute', '500000.00', '500000.00', 'news_19.jpeg', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:34:05'),
(34, 12, 'Đồng hồ Tròn', '4000000.00', '3800000.00', 'saleoff_03.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:35:26'),
(35, 12, 'Cây Cảnh Treo', '1200000.00', '1200000.00', 'product_20.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:36:53'),
(36, 10, 'Ghế Làm Việc', '2500000.00', '2500000.00', 'news_04.jpeg', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:38:10'),
(37, 10, 'Ghế Phòng khách', '3000000.00', '2800000.00', 'news_07.jpeg', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:38:54'),
(38, 10, 'Ghế Làm Việc Xám', '3000000.00', '2900000.00', 'product_04.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:39:46'),
(32, 12, 'Tranh Để Bàn', '1500000.00', '1500000.00', 'instagram_08.jpeg', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:31:58'),
(31, 12, 'Đồng Hồ Đẹp', '5000000.00', '4500000.00', 'news_22.jpeg', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:31:11'),
(30, 12, 'Đồng Hồ Treo Tường Lịch Lãm', '8000000.00', '8000000.00', 'news_11.jpeg', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:29:57'),
(29, 13, 'Đèn Treo Ngược', '3000000.00', '3000000.00', 'slide_10.png', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:28:25'),
(28, 13, 'Đèn Treo Thời Trang', '4000000.00', '3500000.00', 'product_36.png', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:27:22'),
(27, 13, 'Đèn Trang Trí', '4500000.00', '4300000.00', 'product_26.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:26:19'),
(26, 13, 'Đèn ngủ đen', '3500000.00', '3400000.00', 'product_24.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:25:06'),
(25, 13, 'Đèn ngủ', '3400000.00', '3400000.00', 'product_09.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:23:46'),
(24, 13, 'Đèn Kim Cương', '5000000.00', '5000000.00', 'product_05.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:23:04'),
(40, 10, 'Ghế Sofa Dài', '8000000.00', '8000000.00', 'product_12.png', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:41:01'),
(41, 10, 'Ghế Thư Giãn', '5000000.00', '5000000.00', 'product_18.png', '<p>Good</p>\r\n', 'Hàn Quốc', '2019-10-17 23:41:46'),
(42, 10, 'Ghế Thư Giãn Trắng', '4500000.00', '4300000.00', 'product_22.jpeg', '<p>Good</p>\r\n', 'Việt Nam', '2019-10-17 23:42:27'),
(43, 10, 'Ghế Diamond', '700000.00', '700000.00', '77306_350_200_W.png', '<p>Ghế Diamond được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế Diamond c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:29:37'),
(44, 10, 'Ghế Sofa G002', '4500000.00', '4000000.00', '74134_350_200_W.jpg', '<p>Ghế Sofa được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế Sofa c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:34:45'),
(45, 10, '  Ghế Sofa G003', '7000000.00', '6000000.00', '74132_350_200_W.jpg', '<p>Ghế SOFA được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế SOFA&nbsp;c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:36:15'),
(46, 10, 'Ghế cafe', '1500000.00', '1500000.00', '77285_350_200_W.png', '<p>Ghế được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:37:28'),
(47, 10, 'Ghế Sofa G004', '6500000.00', '5000000.00', '74130_350_200_W.jpg', '<p>Ghế SOFA được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế SOFA&nbsp;c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:38:27'),
(48, 10, 'Ghế sofa đơn MH 002', '3400000.00', '3400000.00', '74136_350_200_W.jpg', '<p>Ghế SOFA được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế SOFA&nbsp;c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:39:10'),
(49, 10, 'Ghế Sofa G005', '6500000.00', '6500000.00', '74128_350_200_W.jpg', '<p>Ghế SOFA được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế SOFA&nbsp;c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:40:02'),
(50, 10, ' Ghế Tolix GA01 Morechair', '500000.00', '400001.00', '77309_350_200_W.png', '<p>Ghế SOFA được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế SOFA&nbsp;c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:40:56'),
(51, 10, 'Ghế Eames GE-08', '1200000.00', '1200000.00', '77307_350_200_W.png', '<p>Ghế&nbsp;được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:41:40'),
(52, 10, 'Ghế Kennedy DC-08', '2300000.00', '2300000.00', '77234_350_200_W.png', '<p>Ghế Cafe&nbsp;được cấu tạo từ th&eacute;p kh&ocirc;ng rỉ v&agrave; da pvc.&nbsp;</p>\r\n\r\n<p>Ghế Cafe&nbsp;c&oacute; 2 m&agrave;u : đen, đỏ&nbsp;</p>\r\n\r\n<p>K&iacute;ch thước : 85 x 68 x 44 cm&nbsp;</p>\r\n', 'Việt Nam', '2019-10-29 01:42:52'),
(53, 13, 'Đèn chùm', '6500000.00', '6500000.00', 'đèn-chùm.jpg', '<p>Trong kh&ocirc;ng gian ph&ograve;ng kh&aacute;ch, đ&egrave;n ch&ugrave;m thường được lắp đặt ở vị tr&iacute; trung t&acirc;m căn ph&ograve;ng hoặc trung t&acirc;m khu vực tiếp kh&aacute;ch. Ch&uacute;ng kh&ocirc;ng chỉ mang đến &aacute;nh s&aacute;ng cho kh&ocirc;ng gian m&agrave; c&ograve;n l&agrave; điểm nhấn thu h&uacute;t tất cả mọi người. Khi đặt ch&acirc;n v&agrave;o căn ph&ograve;ng, đ&egrave;n ch&ugrave;m mang đến sự sang trọng, qu&yacute; ph&aacute;i cho kh&ocirc;ng gian nội thất.</p>\r\n\r\n<p>Đ&egrave;n ch&ugrave;m được đ&aacute;nh gi&aacute; l&agrave; một trong số những loại đ&egrave;n trang tr&iacute; ph&ograve;ng kh&aacute;ch mang đến vẻ đẹp m&atilde;n nh&atilde;n nhất. Ch&uacute;ng đặc biệt ph&ugrave; hợp với những thiết kế cổ điển, t&acirc;n cổ điển. Một gợi &yacute; ho&agrave;n hảo l&agrave; bạn c&oacute; thể sử dụng những thiết kế&nbsp;<a href=\"https://blog.noithat9x.vn/den-trang-tri/\" target=\"_blank\"><strong>đ&egrave;n trang tr&iacute;</strong>&nbsp;</a>cho ph&ograve;ng kh&aacute;ch để tăng t&iacute;nh sang trọng v&agrave; bắt mắt.</p>\r\n', 'Việt Nam', '2019-10-29 01:47:10'),
(54, 13, 'Đèn led âm trần', '4500000.00', '400000.00', 'Đèn-led-âm-trần.jpg', '<p>Loại đ&egrave;n n&agrave;y c&oacute; đặc trưng l&agrave; được ốp tr&ecirc;n trần nh&agrave; với c&ocirc;ng dụng chiếu s&aacute;ng v&agrave; mang đến n&eacute;t hiện đại cho kh&ocirc;ng gian. Đối với nhiều ph&ograve;ng kh&aacute;ch hiện đại, mẫu đ&egrave;n trang tr&iacute; n&agrave;y được sử dụng rất phổ biến. Ngay khi đặt ch&acirc;n v&agrave;o kh&ocirc;ng gian, bạn sẽ cảm nhận được sự đơn giản, s&aacute;ng rộng v&agrave; gọn g&agrave;ng.</p>\r\n\r\n<p>Th&ecirc;m một đặc điểm nữa khiến bạn dễ d&agrave;ng h&agrave;i l&ograve;ng đ&oacute; ch&iacute;nh l&agrave; sản phẩm đ&egrave;n ốp trần c&oacute; gi&aacute; th&agrave;nh ph&ugrave; hợp. Ch&uacute;ng &iacute;t bị lỗi thời cũng như gặp những sự cố ngo&agrave;i &yacute; muốn như đ&egrave;n thả, đ&egrave;n trần.</p>\r\n\r\n<p>Đ&egrave;n trang tr&iacute; ph&ograve;ng kh&aacute;ch loại ốp trần kh&ocirc;ng hề k&eacute;n kh&ocirc;ng gian. Trong ph&ograve;ng kh&aacute;ch ấn tượng c&oacute; thể b&agrave;i tr&iacute; th&ecirc;m cả đ&egrave;n ch&ugrave;m hoặc đ&egrave;n thả. Ch&uacute;ng sẽ l&agrave; một sự kết hợp tương đối h&agrave;i h&ograve;a.</p>\r\n', 'Việt Nam', '2019-10-29 01:47:52'),
(55, 13, 'Đèn thả', '4000000.00', '4000000.00', 'đèn-thả.jpg', '<p>Nếu bạn l&agrave; một trong những t&iacute;n đồ của phong c&aacute;ch tinh tế, hiện đại th&igrave; đ&egrave;n thả l&agrave; lựa chọn v&ocirc; c&ugrave;ng ho&agrave;n hảo. Bạn sẽ kh&ocirc;ng phải lo lắng c&aacute;c loại đ&egrave;n thả khiến kh&ocirc;ng gian xấu x&iacute; hay rối mắt. Ngược lại, sự tươi mới của c&aacute;c thiết kế n&agrave;y sẽ lấy l&ograve;ng được cả những gia chủ kh&oacute; t&iacute;nh nhất.</p>\r\n\r\n<p>Đương nhi&ecirc;n, với loại thiết kế đ&egrave;n trang tr&iacute; ph&ograve;ng kh&aacute;ch n&agrave;y, sự cố định v&agrave; kết hợp ăn &yacute; giữa những chiếc đ&egrave;n l&agrave; v&ocirc; c&ugrave;ng cần thiết. Đối với ph&ograve;ng kh&aacute;ch ấn tượng, bạn c&oacute; thể sử dụng đơn giản từ 1 &ndash; 3 chiếc đ&egrave;n thả hoặc một bộ đ&egrave;n thả l&agrave; đủ.</p>\r\n', 'Hàn Quốc', '2019-10-29 01:48:35'),
(56, 13, 'Đèn downlight', '2000000.00', '1500000.00', 'Đèn-downlight.jpg', '<p>Đ&acirc;y l&agrave; loại đ&egrave;n trang tr&iacute; ph&ograve;ng kh&aacute;ch tuy &iacute;t được nhắc đến nhưng lại c&oacute; được một chỗ đứng trong thiết kế trang tr&iacute; nội thất. Loại đ&egrave;n n&agrave;y được lắp tr&ecirc;n trần nh&agrave; với hệ thống &acirc;m trần hoặc lắp nổi.</p>\r\n\r\n<p>Điều đặc biệt l&agrave; &aacute;nh s&aacute;ng của đ&egrave;n c&oacute; t&aacute;n quang hoặc định hướng, thứ &aacute;nh s&aacute;ng n&agrave;y tỏa ra nhiều kh&ocirc;ng gian rộng r&atilde;i. Mang đến cho&nbsp;<a href=\"https://vietnamembassy-iran.org/noi-that/\" target=\"_blank\"><strong>nội thất nh&agrave; cửa</strong></a>&nbsp;sự nổi bật v&agrave; ấn tượng nhất. Ch&uacute;ng đặc biệt ph&ugrave; hợp khi gia đ&igrave;nh tổ chức những sự kiện đặc biệt.</p>\r\n', 'Việt Nam', '2019-10-29 01:49:12'),
(57, 13, 'Đèn cây/đèn bàn', '3500000.00', '3500000.00', 'Đèn-cây-đèn-bàn.jpg', '<p>Đ&egrave;n trang tr&iacute; ph&ograve;ng kh&aacute;ch dạng đ&egrave;n c&acirc;y lớn hơn đầu người hoặc dạng đ&egrave;n để b&agrave;n đều c&oacute; thể đem lại những hiệu ứng tuyệt vời. T&ugrave;y thuộc v&agrave;o từng gia đ&igrave;nh m&agrave; bạn c&oacute; thể thiết kế v&agrave; nhấn nh&aacute; sử dụng ch&uacute;ng.</p>\r\n', 'Hàn Quốc', '2019-10-29 01:49:50'),
(58, 13, 'Đèn dây', '1000000.00', '1000000.00', 'Đèn-dây.jpg', '<p>Được trang ho&agrave;ng trong những dịp đặc biệt, đ&egrave;n led d&acirc;y sẽ mang đến cho bạn nguồn cảm hứng bất tận cho một ph&ograve;ng kh&aacute;ch lung linh &aacute;nh s&aacute;ng.</p>\r\n', 'Việt Nam', '2019-10-29 01:50:28'),
(60, 12, 'Gương treo tường trang trí nội thất GS 046', '4500000.00', '4500000.00', 'guong-treo-tuong-trang-tri-noi-that-gs-046-6.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 70cm</p>\r\n', 'Việt Nam', '2019-10-29 01:56:10'),
(61, 12, 'Tranh nghệ thuật treo tường trang trí nội thất TS ', '5700000.00', '5000000.00', 'tranh-decor-phong-cach-a-dong-lich-lam-ts-271.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 160x90cm</p>\r\n', 'Việt Nam', '2019-10-29 03:24:36'),
(62, 12, 'Decor trang trí nội thất độc đáo TS 331', '4500000.00', '4500000.00', 'decor-trang-tri-noi-that-doc-dao-ts-331-1.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 160cm</p>\r\n', 'Việt Nam', '2019-10-29 01:57:59'),
(63, 12, 'Tranh decor hoa mai trang trí TS 329', '4500000.00', '4500000.00', 'tranh-decor-hoa-mai-trang-tri-ts-329-4.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 130cm</p>\r\n', 'Việt Nam', '2019-10-29 01:59:21'),
(64, 12, 'Lá chuối decor trang trí nội thất TS 325', '5600000.00', '5000000.00', 'la-chuoi-decor-trang-tri-noi-that-ts-325-9.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 55cm =&nbsp;<strong>2,500,000đ&nbsp;</strong>------- 65cm =&nbsp;<strong>3,000,000đ</strong></p>\r\n\r\n<p>* K&iacute;ch thước : 75cm =&nbsp;<strong>3,500,000đ</strong>&nbsp;-------- 85cm =&nbsp;<strong>4000,000đ</strong></p>\r\n', 'Việt Nam', '2019-10-29 02:00:26'),
(65, 12, 'Decor nghệ thuật gắn tường TS 323', '4000000.00', '4000000.00', 'decor-nghe-thuat-gan-tuong-ts-323-7.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 100cm</p>\r\n', 'Việt Nam', '2019-10-29 02:01:04'),
(66, 12, 'Lá decor trang trí nội thất ấn tượng TS 311', '5000000.00', '4500000.00', 'la-decor-trang-tri-noi-that-an-tuong-ts-311-6.jpg', '<p>* Chất liệu : Kim loại</p>\r\n', 'Việt Nam', '2019-10-29 02:02:33'),
(67, 12, 'Tranh nghệ thuật sắt cây dương xỉ TS 309', '4500000.00', '4500000.00', 'tranh-nghe-thuat-sat-cay-duong-xi-ts-309-5.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 140cm</p>\r\n', 'Việt Nam', '2019-10-29 02:03:16'),
(68, 12, 'Decor trang trí nội thất cao cấp TS 290', '6000000.00', '5000000.00', 'decor-trang-tri-noi-that-cao-cap-ts-290-1.jpg', '<p>* K&iacute;ch thước : 160cm</p>\r\n', 'Việt Nam', '2019-10-29 02:04:07'),
(69, 12, 'Tranh decor trang trí Á Đông TS 289', '3500000.00', '3500000.00', 'tranh-decor-trang-tri-a-dong-ts-289-1.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 150x53cm</p>\r\n', 'Việt Nam', '2019-10-29 02:04:52'),
(70, 12, 'Tranh lá Ginko trang trí nội thất TS 287', '3500000.00', '3500000.00', 'tranh-la-ginko-trang-tri-noi-that-ts-287-10.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 120x65cm</p>\r\n', 'Việt Nam', '2019-10-29 02:05:38'),
(71, 12, 'Decor gắn tường trang trí phòng khách TS 286', '4000000.00', '3499999.00', 'decor-gan-tuong-trang-tri-phong-khach-ts-286-4.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 80cm =&nbsp;<strong>4,000,000đ</strong></p>\r\n\r\n<p>* K&iacute;ch thước : 110cm =&nbsp;<strong>5,000,000đ</strong></p>\r\n', 'Việt Nam', '2019-10-29 02:06:16'),
(72, 12, 'Tranh decor hoa trang trí nội thất TS 285', '3400000.00', '3400000.00', 'tranh-decor-hoa-trang-tri-noi-that-ts-285-1.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 160cm</p>\r\n', 'Việt Nam', '2019-10-29 02:07:00'),
(73, 12, 'Decor trang trí treot tường độc đáo TS 280', '4500000.00', '4500000.00', 'decor-trang-tri-treot-tuong-doc-dao-ts-280-1.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 80cm =&nbsp;<strong>3,500,000đ</strong></p>\r\n\r\n<p>* K&iacute;ch thước : 110cm =<strong>&nbsp;4,500,000đ</strong></p>\r\n', 'Hàn Quốc', '2019-10-29 02:07:48'),
(74, 12, 'Tranh sắt lá tia trang trí nội thất TS 270', '5500000.00', '5000000.00', 'tranh-sat-la-tia-trang-tri-noi-that-ts-270-1.jpg', '<p>* Chất liệu : Kim loại</p>\r\n\r\n<p>* K&iacute;ch thước : 130x60cm =&nbsp;<strong>5,500,000đ</strong></p>\r\n\r\n<p>* K&iacute;ch thước : 160x70cm =&nbsp;<strong>6,000,000đ</strong></p>\r\n', 'Việt Nam', '2019-10-29 02:09:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `permission`) VALUES
(1, 'Admin', 'login,add_category,delete_user,delete_role,edit_role,add_role,edit_category'),
(2, 'Member', 'login'),
(8, 'User', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(255) NOT NULL,
  `slide_image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `post_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_image`, `description`, `post_on`) VALUES
(11, 'slide_03.jpeg', '<p>Slide 3</p>\r\n', '2019-10-17 23:16:35'),
(10, 'slide_02.jpeg', '<p>Slide 2</p>\r\n', '2019-10-17 23:16:16'),
(9, 'slide_01.jpeg', '<p>Slide 1</p>\r\n', '2019-10-17 23:15:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(255) NOT NULL,
  `transaction_code` int(255) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` int(11) NOT NULL,
  `customer_address` text COLLATE utf8_unicode_ci NOT NULL,
  `product` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `time_order` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `transaction_code`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `product`, `quantity`, `subtotal`, `time_order`) VALUES
(14, 595306, 'Nguyễn Tiến Tú', 'tientu99865@gmail.com', 358828585, 'Nam Hưng - Nam Sách', 'Ghế Làm Việc', 1, '2500000.00', '2019-10-27 19:30:26'),
(12, 595306, 'Nguyễn Tiến Tú', 'tientu99865@gmail.com', 358828585, 'Nam Hưng - Nam Sách', 'Đèn Treo Thời Trang', 3, '10500000.00', '2019-10-27 19:30:25'),
(13, 595306, 'Nguyễn Tiến Tú', 'tientu99865@gmail.com', 358828585, 'Nam Hưng - Nam Sách', 'Cây Cảnh Treo', 1, '1200000.00', '2019-10-27 19:30:26'),
(16, 722596, 'Nguyễn Thị Tính', 'tinhnt.gha@gmail.com', 123456789, 'Thanh Hóa', 'Đèn ngủ', 1, '3400000.00', '2019-10-27 22:52:53'),
(17, 722596, 'Nguyễn Thị Tính', 'tinhnt.gha@gmail.com', 123456789, 'Thanh Hóa', 'Tranh Để Bàn', 1, '1500000.00', '2019-10-27 22:52:53'),
(18, 722596, 'Nguyễn Thị Tính', 'tinhnt.gha@gmail.com', 123456789, 'Thanh Hóa', 'Ghế Làm Việc', 2, '5000000.00', '2019-10-27 22:52:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_account` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_account`, `user_password`, `role_id`) VALUES
(3, 'Tính', 'tinhnt.gha@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', 2),
(2, 'Tiến Tú ', 'admin@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1),
(10, 'Phuong', 'tientu99865@gmail.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', 8);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `tu` (`role`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `tu` (`user_account`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
