-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 08:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kshan-ecommerce-j-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `emailAddress` varchar(30) NOT NULL,
  `phoneNumber` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sign_up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `password`, `sign_up_date`) VALUES
(4, 'New', 'Admin', 'newadmin@kshan.com', '+254111222333', '$2y$10$RTfOoPolG4u6BfOK8OklG.FgXsaac8jgBuNsS5VlBrkxDfEhnNz86', '2024-03-05 19:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_addresses`
--

CREATE TABLE `client_addresses` (
  `address_id` int(8) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `additional_phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `additional_information` text DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_addresses`
--

INSERT INTO `client_addresses` (`address_id`, `client_id`, `first_name`, `last_name`, `phone_number`, `additional_phone_number`, `address`, `additional_information`, `area`, `city`) VALUES
(0, 19, 'Sylvia', 'Rwenyo', '+254111620385', '+254751839562', '10233', '', 'Langata', 'Nairobi');

-- --------------------------------------------------------

--
-- Table structure for table `endusers`
--

CREATE TABLE `endusers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `middleName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthDate` date NOT NULL,
  `emailAddress` varchar(30) NOT NULL,
  `phoneNumber` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `sign_up_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `endusers`
--

INSERT INTO `endusers` (`id`, `firstName`, `middleName`, `lastName`, `gender`, `birthDate`, `emailAddress`, `phoneNumber`, `password`, `pin`, `sign_up_date`) VALUES
(11, '', '', '', '', '0000-00-00', 'user@user.com', '', '$2y$10$g2rvEJHqpFfirjZIPU5OnenpXtZI8bnaJUUZi/yt0YF/RZ8QP4mIK', '', '2024-03-04 20:49:52'),
(12, '', '', '', '', '0000-00-00', '', '', '$2y$10$Ub4BxKlz39kQ0BkdjPJPr.lbQjJRtAxy5jb9WEr5pzzo5QxqIjlLq', '', '2024-03-05 09:18:33'),
(13, '', '', '', '', '0000-00-00', '', '', '$2y$10$mkSJpfnP/UC3ygARVvw9Ou/njRJsZxQ1SU7nn527IwQQeAW1XOU8i', '', '2024-03-05 10:11:48'),
(18, '', '', '', '', '0000-00-00', '', '+254751839562', '$2y$10$vKtTVItTQTOIFgyMyYmkDOy6kUM3UboMnu/jp.wKMDMVpkMAbWTyC', '', '2024-03-05 11:15:45'),
(19, 'Sylvia', 'Kemunto', 'Rwenyo', 'female', '2002-02-17', 'rwenyosylvia@gmail.com', '+254111620385', '$2y$10$6cdtrtpY6spkO.KJ3yOjoewskxx.wVKVWkva19O/1qFB4aqflzLKy', '', '2024-03-05 11:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(100) NOT NULL,
  `mpesa_phone_number` varchar(20) DEFAULT NULL,
  `merchant_rq_id` varchar(100) NOT NULL,
  `checkout_rq_id` varchar(100) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `total_price` int(100) NOT NULL,
  `total_items` int(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(30) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `stockQuantity`, `description`, `price`) VALUES
(8, 'Nivea cream', 'Health & Beauty', 10, 'Nivea cream', 400.00),
(9, 'Lotion', 'Health & Beauty', 10, 'Moisturising lotion', 200.00),
(10, 'Toner', 'Health & Beauty', 5, 'A new Toner', 300.00),
(11, 'Body wash', 'Health & Beauty', 4, 'Medium size body wash', 400.00),
(12, 'Body scrub', 'Health & Beauty', 4, 'Exfoliating body scrub', 250.00),
(13, 'Nivea cream', 'Health & Beauty', 3, 'Nourishing moisturising cream', 200.00),
(14, 'Laptop', 'Computing', 10, 'Brand New | 8GB ram | 256GB SSD ', 40000.00),
(15, 'Monitor', 'Computing', 20, '24 inch | Brand New', 20000.00),
(16, 'Curved Monitor', 'Computing', 20, 'Curved screen || Brand New || Smart Screen', 50000.00),
(17, 'Keyboard', 'Computing', 6, 'Regular Keyboard', 2000.00),
(18, 'Perfume', 'Health & Beauty', 10, 'Kayali perfume', 2000.00),
(19, 'Vaseline', 'Health & Beauty', 50, 'Vaseline blue seal', 100.00),
(20, 'Wireless mouse', 'Computing', 5, 'A brand new wireless mouse', 1500.00),
(21, 'Mouse', 'Computing', 10, 'Regular mouse', 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `file_path`) VALUES
(1, 3, 'uploads/pic.png'),
(2, 1, '65b866aeb35aa_j-help-prompt.png'),
(3, 6, 'uploads/fast_ethernet_connection.png'),
(4, 6, 'uploads/j-help-prompt.png'),
(5, 6, 'uploads/pic.png'),
(11, 8, 'uploads/65c0c97ece69d.jpg'),
(12, 9, 'uploads/65c55082b5e17.jpg'),
(13, 10, 'uploads/65c550b4c6c94.jpg'),
(14, 11, 'uploads/65c550ed388c4.jpg'),
(15, 12, 'uploads/65c55125844fa.jpg'),
(16, 13, 'uploads/65c55188b6d35.jpg'),
(17, 14, 'uploads/65cf5eab6eec8.jpg'),
(18, 15, 'uploads/65cf5ee98dc8f.jpg'),
(19, 16, 'uploads/65cf5f1daa363.jpg'),
(20, 17, 'uploads/65cf5f54e20af.jpg'),
(21, 18, 'uploads/65cf5f86c45fa.jpg'),
(22, 19, 'uploads/65cf5fb4b3263.jpg'),
(23, 20, 'uploads/65cf5fe83f828.jpg'),
(24, 21, 'uploads/65cf602d49fa0.jpg'),
(25, 21, 'uploads/65cf602d66d0f.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_addresses`
--
ALTER TABLE `client_addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `endusers`
--
ALTER TABLE `endusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `endusers`
--
ALTER TABLE `endusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_addresses` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
