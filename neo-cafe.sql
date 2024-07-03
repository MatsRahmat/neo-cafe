-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 06:06 AM
-- Server version: 8.4.0
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neo-cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'Minuman', '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(3, 'Makanan', '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(4, 'Cemilan Ringan', '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(5, 'Sea Food', '2024-06-07 12:17:38', '2024-06-07 12:17:38'),
(6, 'Mie', '2024-06-26 12:15:47', '2024-06-26 12:15:47'),
(7, 'Gorengan', '2024-06-26 12:17:23', '2024-06-26 12:17:23'),
(8, 'Nasi', '2024-06-26 13:23:46', '2024-06-26 13:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Ice Tea with sugar', 12000, 1, '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(2, 'Soda Dingin', 5500, 1, '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(3, 'Chiken Geprek', 15000, 3, '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(4, 'Kentang Goreng', 13000, 4, '2024-05-29 00:00:00', '2024-05-29 00:00:00'),
(7, 'Nasi Padang', 150000, 3, '2024-06-26 12:17:45', '2024-06-26 12:17:45'),
(8, 'Nasi Bakar', 71000, 8, '2024-06-26 13:24:03', '2024-06-26 13:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `no_order` int NOT NULL,
  `no_table` varchar(10) NOT NULL,
  `user_id` int DEFAULT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `note` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `no_order`, `no_table`, `user_id`, `complete`, `note`, `updated_at`, `created_at`) VALUES
(12, 6, 'A14', 2, 0, 'Noted New', '2024-05-31 13:07:37', '2024-05-31 13:07:37'),
(13, 7, 'B04', 2, 1, 'Ini dia si jali jali', '2024-06-01 06:20:14', '2024-06-01 06:20:14'),
(14, 8, 'A14', 2, 0, 'Cepetan woy', '2024-06-26 12:19:34', '2024-06-26 12:19:34'),
(15, 9, 'A13', 2, 1, 'Cepetan', '2024-06-26 13:20:57', '2024-06-26 13:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `menu_id`, `created_at`, `updated_at`, `quantity`) VALUES
(10, 12, 3, '2024-05-31 13:07:37', '2024-05-31 13:07:37', 2),
(11, 12, 1, '2024-05-31 13:07:37', '2024-05-31 13:07:37', 1),
(12, 12, 2, '2024-05-31 13:07:37', '2024-05-31 13:07:37', 1),
(15, 13, 2, '2024-06-01 06:20:14', '2024-06-01 06:20:14', 1),
(16, 13, 3, '2024-06-01 06:20:14', '2024-06-01 06:20:14', 1),
(17, 14, 1, '2024-06-26 12:19:34', '2024-06-26 12:19:34', 1),
(18, 15, 2, '2024-06-26 13:20:57', '2024-06-26 13:20:57', 4),
(19, 15, 3, '2024-06-26 13:20:57', '2024-06-26 13:20:57', 4),
(20, 15, 7, '2024-06-26 13:20:57', '2024-06-26 13:20:57', 1),
(21, 14, 4, '2024-06-26 13:22:15', '2024-06-26 13:22:15', 5),
(22, 14, 1, '2024-06-26 13:22:15', '2024-06-26 13:22:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(200) DEFAULT NULL,
  `created_at` date DEFAULT (now()),
  `updated_at` date DEFAULT (now())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Rahmat', 'rahmat@mail.com', '$2y$10$rks.BjDvv6RgRA5EiqjLrOJMUSVS9kMS/tHOBCoEPOwSY40gpFpPi', 'admin', '2024-05-30', '2024-05-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
