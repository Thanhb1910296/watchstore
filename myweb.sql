-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2021 lúc 04:09 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `myweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `login_name` varchar(100) DEFAULT NULL,
  `login_password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `login_name`, `login_password`) VALUES
(1, 'Admin', 'Tran ', 'thanh_admin@gmail.com', '18184125c63b2f5580e406521fab8e84');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'breguet'),
(2, 'rolex'),
(3, 'patek philippe'),
(4, 'vachiron constantin'),
(5, 'omega'),
(6, 'zenith');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `coment_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `login_name` varchar(100) DEFAULT NULL,
  `content` varchar(540) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`coment_id`, `product_id`, `login_name`, `content`, `created_at`) VALUES
(4, 3, 'thanh_user', 'oh, nice', '2021-11-27 22:52:16'),
(5, 3, 'thanh_user', 'very good', '2021-11-27 22:54:54'),
(6, 3, 'thanh_user', 'oh my god', '2021-11-27 22:57:15'),
(12, 1, 'thanh_user', 'wow', '2021-11-28 09:24:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `customer_address` varchar(240) DEFAULT NULL,
  `zip_code` int(6) DEFAULT NULL,
  `login_name` varchar(100) DEFAULT NULL,
  `login_password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone_number`, `customer_address`, `zip_code`, `login_name`, `login_password`) VALUES
(1, 'Tien Thanh', 'Tran', 'thanh_user', 123456789, 'Soc Trang', 950000, 'thanh_user', 'b1910296');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `order_status` text DEFAULT NULL,
  `order_total` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `payment_method`, `order_status`, `order_total`, `created_at`) VALUES
(1, 1, 'credit card', 'confirmed', 444444, '2021-11-27 20:06:42'),
(2, 1, 'credit card', 'pending', 777777, '2021-11-28 09:26:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_image` varchar(540) DEFAULT NULL,
  `quantity` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_image`, `quantity`) VALUES
(2, 1, 2, 'Breguet Classique 7787 MoonPhase', 222222, 'breguet2.jpg', 2),
(3, 2, 7, 'Breguet Marine 5517 40mm 5517BR/12/9ZU', 777777, 'breguet7.jpg', 1),
(4, NULL, 4, 'Breguet Marine Tourbillon 5837BR/92/5ZU', 444444, 'breguet4.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `payment_method` text DEFAULT NULL,
  `card_number` int(16) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `coupon_code` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `customer_id`, `payment_method`, `card_number`, `expiration_date`, `cvv`, `coupon_code`) VALUES
(1, 1, 'credit card', 2147483647, '2021-11-27', '000', 1239),
(2, 1, 'credit card', 2147483647, '2021-11-28', '999', 3912);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_image` varchar(540) DEFAULT NULL,
  `product_description` varchar(720) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product_name`, `product_price`, `product_image`, `product_description`) VALUES
(1, 1, 'Breguet Marie Antoinette', 30000000, 'breguet1.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(2, 1, 'Breguet Classique 7787 MoonPhase', 222222, 'breguet2.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(3, 1, 'Breguet White Gold Chronograph Skeleton Baguette', 333333, 'breguet3.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(4, 1, 'Breguet Marine Tourbillon 5837BR/92/5ZU', 444444, 'breguet4.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(5, 1, 'Breguet Rose gold watches', 555555, 'breguet5.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(6, 1, 'Breguet Tradition 7077 Chronograph Independent', 666666, 'breguet6.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(7, 1, 'Breguet Marine 5517 40mm 5517BR/12/9ZU', 777777, 'breguet7.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(8, 1, 'Breguet Marine Chronograph Rose Gold and Black', 888888, 'breguet8.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(9, 2, 'Rolex Taurillon Grey Heritage Leather', 111111, 'rolex1.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(10, 2, 'Rolex 6062 Bao Dai King Reference', 30000000, 'rolex2.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(11, 2, 'Rolex Jack Nicklaus\' Hot Day Date', 333333, 'rolex3.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(12, 2, 'Rolex White Gold GMT-Master Ice Ref 116769', 444444, 'rolex4.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(13, 2, 'Rolex Pearlmaster Day-Date Ref 18956', 555555, 'rolex5.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(14, 2, 'Rolex Daytona Ferrari Red 6263', 666666, 'rolex6.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(15, 2, 'Rolex Submariner Steve MCQueen', 777777, 'rolex7.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel'),
(16, 2, 'Rolex The 18k JPS Paul Newman Daytona 6264', 888888, 'rolex8.jpg', 'Global Brands Coverage. 100% On-time Shipment Protection. Shop Online Today! Trade Assurance. Logistics Service. Most Popular. Production Monitoring. Types: Machinery, Home & Kitchen, Consumer Electronics, Packaging & Printing, Lights & Lighting, Apparel');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shipping_addresses`
--

CREATE TABLE `shipping_addresses` (
  `shipping_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `shipping_address` varchar(240) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `shipping_addresses`
--

INSERT INTO `shipping_addresses` (`shipping_id`, `customer_id`, `order_id`, `shipping_address`) VALUES
(1, 1, 1, 'Can Tho'),
(2, 1, 2, 'Can Tho');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`coment_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  ADD PRIMARY KEY (`shipping_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `coment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `shipping_addresses`
--
ALTER TABLE `shipping_addresses`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
