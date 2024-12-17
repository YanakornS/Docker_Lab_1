-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 04:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `features` text DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `price`, `description`, `features`, `stock`) VALUES
(2, 'Smartphone', 'Electronics', 299.99, 'A modern smartphone with a powerful camera and fast performance.', 'Special Material', 100),
(3, 'Headphones', 'Home', 89.99, 'Noise-canceling over-ear headphones.', 'Size xl<', 50),
(4, 'Laptop', 'Electronics', 799.99, 'A powerful laptop with 16GB RAM.', 'Color made to order', 20),
(5, 'T-Shirt', 'Fashion', 15.99, 'A comfortable cotton t-shirt.', 'Size', 100),
(6, 'Jeans', 'Fashion', 49.99, 'Slim fit denim jeans.', 'Special Material', 50),
(7, 'Sneakers', 'Fashion', 69.99, 'Comfortable running sneakers.', 'Light weight', 30),
(8, 'Sofa', 'Electronics', 499.99, 'A stylish and comfortable sofa.', 'Color', 15),
(10, 'Coffee Maker', 'Home', 79.99, 'Automatic coffee maker with multiple settings.', 'Special Material', 40),
(12, 'Lipstick', 'Beauty', 19.99, 'Matte finish lipstick in various shades.', 'Light weight', 120),
(13, 'Perfume', 'Beauty', 29.99, 'Floral scented perfume for daily wear.', 'Color made to order', 80);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234'),
(2, 'YanakornS', '$2y$10$PE.8GHzj2ol5Zk.IWNJJC.d4NWFPbaT9s9Xz0WunClIcQyMWPfks6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
