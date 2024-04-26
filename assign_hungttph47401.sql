-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2024 at 09:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assign_hungttph47401`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `name_pro` varchar(200) NOT NULL,
  `quantity_pro` int NOT NULL,
  `price_pro` int NOT NULL,
  `img_pro` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `product_id`, `name_pro`, `quantity_pro`, `price_pro`, `img_pro`) VALUES
(4, 2, 12, 'so3', 9, 12000000, NULL),
(5, 2, 8, 'ip6s plus', 11, 15000, '1712344784_Feed_back_2.jpg'),
(6, 2, 9, 'gg1', 1, 1200000, '1712350043_Feed_back_1.jpeg'),
(7, 2, 26, 'so1', 1, 12000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int NOT NULL,
  `categories_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(1, 'Laptop'),
(2, 'SmartPhone'),
(3, 'Tablet');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `customer_image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `email`, `password`, `role`, `phone`, `address`, `customer_image`) VALUES
(1, 'admin', 'hungttph47401@gmai.com', 'Hungtran98', 'admin', NULL, NULL, NULL),
(2, 'long', 'longnv@gmail.com', 'long1999', 'user', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `categories_id` int NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_quantity` int NOT NULL,
  `product_price` float NOT NULL,
  `product_img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `categories_id`, `product_name`, `product_quantity`, `product_price`, `product_img`, `product_description`) VALUES
(1, 1, 'Lenovo', 17, 20000000, '', 'Laptop phù hợp cho thiết kế nhẹ nhàng'),
(4, 1, 'dell1', 12, 12000000, '', '                        sadasda                    '),
(5, 1, 'dell2', 10, 12, '1712346264_Tonner_2.jpg', '                                                                        qwertt                                                            '),
(6, 2, 'iphone', 10, 1000000, '1712345812_Combo_1.jpg', '                        hahahah                    '),
(8, 2, 'ip6s plus', 10, 15000, '1712344784_Feed_back_2.jpg', 'cũ bé'),
(9, 3, 'gg1', 10, 1200000, '1712350043_Feed_back_1.jpeg', 'ok1'),
(10, 1, 'so1', 10, 12000000, NULL, 'okok'),
(11, 1, 'so2', 10, 12000000, NULL, 'okok'),
(12, 1, 'so3', 10, 12000000, NULL, 'okok'),
(13, 1, 'so4', 10, 12000000, NULL, 'okok'),
(14, 1, 'so5', 10, 12000000, NULL, 'okok'),
(15, 1, 'so6', 10, 12000000, NULL, 'okok'),
(16, 1, 'so7', 10, 12000000, NULL, 'okok'),
(17, 2, 'so1', 10, 12000000, NULL, 'okok'),
(19, 2, 'so3', 10, 12000000, NULL, 'okok'),
(20, 2, 'so4', 10, 12000000, NULL, 'okok'),
(21, 2, 'so5', 10, 12000000, NULL, 'okok'),
(22, 2, 'so6', 10, 12000000, NULL, 'okok'),
(23, 2, 'so7', 10, 12000000, NULL, 'okok'),
(24, 2, 'so8', 10, 12000000, NULL, 'okok'),
(25, 2, 'so9', 10, 12000000, NULL, 'okok'),
(26, 3, 'so1', 10, 12000000, NULL, 'okok'),
(27, 3, 'so2', 10, 12000000, NULL, 'okok'),
(28, 3, 'so3', 10, 12000000, NULL, 'okok'),
(29, 3, 'so4', 10, 12000000, NULL, 'okok'),
(30, 3, 'so5', 10, 12000000, NULL, 'okok'),
(31, 3, 'so6', 10, 12000000, NULL, 'okok'),
(32, 3, 'so7', 10, 12000000, NULL, 'okok'),
(33, 3, 'so8', 10, 12000000, NULL, 'okok'),
(34, 3, 'so9', 10, 12000000, NULL, 'okok'),
(35, 3, 'dell gffg', 10, 15000, '1712383655_download.png', '                        asdasd                    '),
(36, 2, 'Redmi của sơn ngáo', 1, 1, '1712640620_Sun_Cream_2.jpg', '                                                điện thoại của người ngáo, tránh không nên dùng                                        ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_cart` (`customer_id`),
  ADD KEY `product_cart` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Product_category` (`categories_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `customer_cart` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_cart` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Product_category` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
