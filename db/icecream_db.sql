-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 10:12 AM
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
-- Database: `icecream_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(50) NOT NULL,
  `qty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress',
  `payment_status` varchar(500) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(20) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `product_detail` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `price`, `image`, `stock`, `product_detail`, `status`) VALUES
('76GsYmvbD98oFWzZDxP6', 'ghLJxjB81dKBasQs44sv', 'crunchy cookies', 150, 'sub-banner.png', 100, 'cookies,vanila scoop and chocolate syrup', 'active'),
('vaOH0DI7VNYUHGWhoqMK', 'ghLJxjB81dKBasQs44sv', 'strawberry sundae', 200, 'categories2.jpg', 100, 'strawberry scoop,strawberry syrup ,fresh fruits and roasted nuts.', 'active'),
('9XvPfZp58NGqratyjcBc', 'ghLJxjB81dKBasQs44sv', 'tripple sundae', 130, 'sub-banner-img.png', 4, '3 scoops,chocolate syrup and waffle roll', 'active'),
('8XqqFzWjQLnh2CFAPlOh', 'ghLJxjB81dKBasQs44sv', 'rasberry scoop', 50, 'type5.png', 10, 'vanila scoop with rasberry syrup', 'active'),
('4IzUFoPIOVRyvRw2ZcmZ', 'ghLJxjB81dKBasQs44sv', 'waffle bowl', 230, 'product13-removebg-preview.png', 250, 'waffle bowl with three scoops and syrup ', 'active'),
('PZxj2DA6rlimJC8NBImV', 'ghLJxjB81dKBasQs44sv', 'black current family pack ', 250, 'product10.jpg', 20, '150ml black current family pack', 'deactive'),
('wP2OCBmOveNU4IYGbczR', 'ghLJxjB81dKBasQs44sv', 'strawberry family pack', 250, 'product9.jpg', 0, '150ml', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `password`) VALUES
('ghLJxjB81dKBasQs44sv', 'swathi s', 'swathis@gmail.com', 'swathi.'),
('vBokRSzp6C1RfozyIqe7', 'qqqq', 'qqq@gmail.com', 'qqqq'),
('UkYCinWtyKQsd3EopEMN', 'malathi', 'malathi@123.com', 'malathi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
('uVbgMjaxTxYXeCfGG4lf', 'swathis', 'swathi@gmail.com', 'swathi.'),
('5a1reXldhc6uFVwlTdIQ', 'riya', 'riya@gmail.com', 'riya');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `price`) VALUES
('py9WWFO7XrggBWWuKN2O', 'uVbgMjaxTxYXeCfGG4lf', '76GsYmvbD98oFWzZDxP6', 150),
('w3QUsUupOIgEtHc37Uts', 'uVbgMjaxTxYXeCfGG4lf', '9XvPfZp58NGqratyjcBc', 130),
('ZsbQGj4WFRJJ10bzmiCH', 'uVbgMjaxTxYXeCfGG4lf', 'wP2OCBmOveNU4IYGbczR', 250),
('TqyXPpv1K12GEJJHAicn', '5a1reXldhc6uFVwlTdIQ', '9XvPfZp58NGqratyjcBc', 130);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
