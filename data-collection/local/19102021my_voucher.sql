-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 06:52 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_voucher`
--

-- --------------------------------------------------------

--
-- Table structure for table `0cart`
--

CREATE TABLE `0cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `voucher_type` varchar(500) DEFAULT NULL,
  `paid` int(11) DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `0cart`
--

INSERT INTO `0cart` (`id`, `user_id`, `voucher_id`, `qty`, `voucher_type`, `paid`, `timestamp`) VALUES
(22, 3, 67, 1, 'dynamic', 1, 1631890424),
(24, 3, 70, 2, 'normal', 0, 1631890921),
(27, 2, 67, 1, 'normal', 0, 1631962635),
(29, 14, 18, 1, 'dynamic', 0, 1631976641);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address_lane` varchar(256) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` int(50) DEFAULT NULL,
  `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `name`, `address_lane`, `city`, `postal_code`, `phone`) VALUES
(1, NULL, 'Quyn Palmer', 'Consequuntur accusam', 'vnfnfk', 544, 12),
(2, NULL, 'Hiroko Davis', 'Distinctio Quasi qu', 'vnnjkds', 545, 565),
(3, NULL, 'Oren Jefferson', 'Voluptatum placeat ', 'bvdfbv', 5151, 789345),
(4, NULL, 'Regina Byrd', 'Excepteur dignissimo', 'dbjks', 45, 2121),
(5, 3, 'umair mithawala', 'b/12 sahara flat', 'vfbdjkbj', 380055, 4545),
(6, 3, 'abc', 'A/25 Stark Socity', 'New York ', 2500, 465515),
(7, 2, 'Darrel Charles', 'In voluptas voluptas', 'nvskl', 455, 5454),
(8, 2, 'Darrel Charles', 'In voluptas voluptas', 'nvskl', 455, 5454),
(9, 2, 'umair mithawala', 'b/12 sahara flat', 'dbfdjbdfjkbgjf', 380055, 45645),
(10, 2, 'umair mithawala', 'b/12 sahara flat', 'dbfdjbdfjkbgjf', 380055, 45645),
(11, 2, 'umair mithawala', 'b/12 sahara flat', 'dbfdjbdfjkbgjf', 380055, 45645),
(12, 4, 'umair mithawala', 'b/12 sahara flat', 'fhje', 380055, 6565),
(13, 14, 'Cassandra England', 'Aut ut saepe est tem', 'fjhfhjdf', 544, 455);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `timestamp`) VALUES
(1, 'admin@myvoucherworld.com', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(400) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `is_deleted`, `timestamp`) VALUES
(11, 'Seven Eleven', 'seven-eleven.png', 1, NULL),
(12, 'Amazon', 'amazon.png', 0, NULL),
(13, 'Ebay', 'ebay.png', 0, NULL),
(14, 'Netflix', 'netflix.png', 0, NULL),
(15, 'Flipkart', 'flipkart.png', 0, NULL),
(16, 'IKEA', 'ikea.png', 0, NULL),
(17, 'Zomato', 'zomato.png', 0, NULL),
(18, 'Uber', 'uber.png', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `is_deleted`, `timestamp`) VALUES
(21, 'Samsung', 0, NULL),
(22, 'iPhone', 0, NULL),
(23, 'OnePlus', 0, NULL),
(24, 'Redmi', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `voucher_code_id` int(11) DEFAULT NULL,
  `voucher_type` varchar(500) DEFAULT NULL,
  `buy_price` int(11) DEFAULT NULL,
  `razorpay_order_id` varchar(500) DEFAULT NULL,
  `razorpay_payment_id` varchar(500) DEFAULT NULL,
  `razorpay_signature` varchar(500) DEFAULT NULL,
  `payment_complete_code_not_available` int(11) NOT NULL DEFAULT 0,
  `is_paid` int(11) NOT NULL DEFAULT 0,
  `payment_timestamp` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `voucher_type` varchar(50) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `voucher_id`, `voucher_type`, `timestamp`) VALUES
(13, 1, 67, 'dynamic', 1634475424),
(15, 1, 67, 'normal', 1634476657),
(16, 1, 19, 'dynamic', 1634477643),
(17, 1, 22, 'dynamic', 1634585395),
(18, 1, 69, 'normal', 1634586365);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `email` varchar(300) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `type` varchar(500) DEFAULT NULL,
  `otp` varchar(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `phone`, `type`, `otp`, `timestamp`) VALUES
(8, 'tasu@mailinator.com', NULL, 'email_verification_otp', '393643', 1634125977),
(9, 'wuratudoty@mailinator.com', NULL, 'email_verification_otp', '506717', 1634530121);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(400) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category`, `is_deleted`, `timestamp`) VALUES
(10, 'M30s', 21, 1, 0),
(11, '12 Pro', 22, 0, 0),
(12, 'Nord2 ', 23, 0, 0),
(13, 'Note10 Pro', 24, 0, 0),
(14, 'Note 10', 24, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email_verification` int(11) DEFAULT 0,
  `phone_verification` int(11) DEFAULT 0,
  `is_ban` int(11) DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `gender`, `email`, `password`, `role`, `email_verification`, `phone_verification`, `is_ban`, `timestamp`) VALUES
(1, 'Josiah Porter', '7069324378', NULL, 'tasu@mailinator.com', 'anzar', NULL, 1, 0, 0, NULL),
(2, 'Amela Bridges', '+1 (656) 99', 'female', 'admin@gmail.com', 'admin', NULL, 0, 0, 0, NULL),
(3, 'h', NULL, NULL, 'h@gmail.com', 'h', NULL, 0, 0, 0, NULL),
(4, 'a', NULL, NULL, 'a@gmail.com', 'a', NULL, 0, 0, 0, NULL),
(5, 'm', NULL, NULL, 'm@gmail.com', 'm', NULL, 0, 0, 0, NULL),
(6, 'p', NULL, NULL, 'p@gmail.com', 'o', NULL, 0, 0, 0, NULL),
(7, 'Emerald Moody', NULL, NULL, 'jujogylapu@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 0, NULL),
(8, 'Cyrus Collier', NULL, NULL, 'juzybus@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 0, NULL),
(9, 'Amery Horne', NULL, NULL, 'nemirybyh@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 0, NULL),
(11, '', NULL, NULL, 'j@gmail.com', 'j', NULL, 0, 0, 0, NULL),
(12, '', NULL, NULL, 'amin@gmai.m', 'admin', NULL, 0, 0, 0, NULL),
(13, 'asdfladf', NULL, NULL, 'lkasdfjlsdfkjasdlfkjds@klasdfj.co', 'adminasdfklasdjflasdkj', NULL, 0, 0, 0, NULL),
(14, 'fgjdgfjhsdgf', NULL, NULL, 'bjdfbs@hd.com', 'adminxvncjxjcvj', NULL, 0, 0, 0, NULL),
(15, 'Erich Emerson', '+1 (386) 63', NULL, 'susapa@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 0, 1633840145),
(16, '43HlHq7gGI', '5539470955', NULL, '1shqh@obvl.com', 'j5JlcmI7EU', NULL, 0, 0, 0, 1633840154),
(17, 'Breanna Gay', '+1 (666) 71', NULL, 'wuratudoty@mailinator.com', 'Pa$$w0rd!', NULL, 0, 0, 0, 1634530121);

-- --------------------------------------------------------

--
-- Table structure for table `variable_voucher`
--

CREATE TABLE `variable_voucher` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `min_price` int(11) DEFAULT NULL,
  `max_price` int(11) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `image_one` varchar(500) DEFAULT NULL,
  `image_two` varchar(500) DEFAULT NULL,
  `image_three` varchar(500) DEFAULT NULL,
  `codes_available` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variable_voucher`
--

INSERT INTO `variable_voucher` (`id`, `name`, `min_price`, `max_price`, `description`, `rating`, `qty`, `category`, `sub_category`, `brand`, `image_one`, `image_two`, `image_three`, `codes_available`, `is_deleted`, `timestamp`) VALUES
(19, 'Magee Osborne', 217, 500, 'A tempor rerum hic m', 2, 2, NULL, NULL, NULL, 'brand_image1631889397akc1982685041.jpg', 'brand_image1631889397akc220546672.jpg', 'brand_image1631889397akc1881098329.jpg', 0, 0, NULL),
(21, 'Velma Raymond', 316, 827, 'Alias perspiciatis ', 5, 5, NULL, NULL, NULL, 'brand_image1633776693akc1075156.jpg', '', '', 1, 0, 1633776693),
(22, 'Velma Raymond', 316, 827, 'Alias perspiciatis ', 5, 5, NULL, NULL, NULL, 'brand_image1633777231akc900171408.jpg', '', '', 1, 0, 1633777231),
(23, 'Darrel Hartman', 507, 264, 'Magni anim et ex mag', 2, 5, NULL, NULL, NULL, 'brand_image1633777670akc122131729.jpg', '', '', 1, 0, 1633777670),
(67, 'Chaney Coffey', 20, 40, 'Id aperiam dolorem s', 5, 5, NULL, NULL, NULL, 'brand_image1631889127akc49037211.jpg', 'brand_image1631889127akc859806270.jpg', 'brand_image1631889127akc1322987788.jpg', 1, 0, NULL),
(69, 'Christine Patton', 605, 68, 'Accusamus dolore per', 2, 2, NULL, NULL, NULL, 'brand_image1634553800akc695159471.jpg', '', '', 1, 0, 1634553800),
(70, 'Salvador Gilbert', 243, 898, 'Mollitia illo tempor', 2, 371, 22, 11, 15, 'brand_image1634553888akc326112509.jpg', '', '', 1, 0, 1634553888),
(71, 'Mannix Bowers', 915, 512, 'Ipsa nemo magna ab ', 3, 2, 24, 11, 14, 'brand_image1634623862akc1496613587.jpg', '', '', 1, 0, 1634623862),
(72, 'Upton Mcconnell', 840, 420, 'Consequatur eos mol', 2, 5, 23, 11, 13, 'brand_image1634623981akc1695514611.png', '', '', 1, 0, 1634623981);

-- --------------------------------------------------------

--
-- Table structure for table `variable_voucher_code`
--

CREATE TABLE `variable_voucher_code` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `voucher_code` varchar(500) DEFAULT NULL,
  `is_purchased` int(11) DEFAULT 0,
  `is_used` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variable_voucher_code`
--

INSERT INTO `variable_voucher_code` (`id`, `voucher_id`, `voucher_code`, `is_purchased`, `is_used`, `timestamp`) VALUES
(1, 67, 'Repudiandae sunt re', 0, 0, 1634624835),
(2, 67, 'Adipisicing ipsum au', 1, 0, 1634624835),
(3, 72, 'Minus aperiam error ', 0, 0, 1634624835),
(4, 72, 'Provident nisi quid', 0, 0, 1634624835),
(5, 72, 'Aliquam eos sit eaq', 0, 0, 1634624835);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `image_one` varchar(200) DEFAULT NULL,
  `image_two` varchar(200) DEFAULT NULL,
  `image_three` varchar(200) DEFAULT NULL,
  `codes_available` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `name`, `price`, `discount_price`, `description`, `rating`, `qty`, `category`, `sub_category`, `brand`, `image_one`, `image_two`, `image_three`, `codes_available`, `is_deleted`, `timestamp`) VALUES
(67, 'VSMDL', 554, 123, 'NVSJKLNVJ', 1, NULL, NULL, NULL, NULL, 'brand_image1630403441akc1653184647.png', NULL, 'brand_image1630404556akc2125005271.png', 0, 0, NULL),
(69, 'Cade England', 269, 300, 'Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem ', 1, 10, NULL, NULL, NULL, 'brand_image1630403553akc2078173611.png', NULL, NULL, 1, 0, NULL),
(70, 'Rina Gregory', 90, 801, 'Dolore qui sit null', 2, NULL, NULL, NULL, NULL, 'brand_image1630404556akc2125005271.png', 'brand_image1630404556akc2125005271.png', NULL, 1, 0, NULL),
(82, 'new', 45, 12, 'hello', 1, NULL, NULL, NULL, NULL, 'brand_image1631621484akc1040144678.jpg', '', '', 1, 0, NULL),
(83, 'new', 45, 12, 'hello', 1, NULL, NULL, NULL, NULL, 'brand_image1631621505akc625150489.jpg', '', '', 1, 0, NULL),
(84, 'new', 45, 12, 'hello', 1, NULL, NULL, NULL, NULL, 'brand_image1631621523akc2113385582.jpg', '', '', 1, 0, NULL),
(85, 'vjkjd', 4, 545, '544', 5, NULL, NULL, NULL, NULL, 'brand_image1631621554akc1881049101.jpg', '', '', 1, 0, NULL),
(86, 'kfjk', 454, 45, 'gwjek', 5, NULL, NULL, NULL, NULL, 'brand_image1630403441akc1653184647.png', '', '', 1, 0, NULL),
(87, 'kfjk', 454, 45, 'gwjek', 5, NULL, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(88, 'feh', 45, 54, 'vkjn', 5, NULL, NULL, NULL, NULL, 'brand_image1631621815akc835496976.jpg', 'brand_image1631621815akc558584313.jpg', '', 1, 0, NULL),
(89, 'feh', 45, 54, 'vkjn', 5, NULL, NULL, NULL, NULL, 'brand_image1631621906akc1493623789.jpg', 'brand_image1631621906akc1856589469.jpg', '', 1, 0, NULL),
(90, 'feh', 45, 54, 'vkjn', 5, NULL, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', 'brand_image1631621914akc1078594852.jpg', '', 1, 0, NULL),
(91, 'dkjvsk', 45, 12, 'jgwjghwjkh', 5, NULL, NULL, NULL, NULL, 'brand_image1631621943akc261691425.jpg', 'brand_image1631621943akc952148041.jpg', '', 1, 0, NULL),
(92, 'new', 45, 121, 'dvjsvjkk', 5, NULL, NULL, NULL, NULL, 'brand_image1631622302akc563991047.jpg', 'brand_image1631622302akc1081111664.jpg', '', 1, 0, NULL),
(93, 'vhvjd', 45, 54, 'vsdklm', 5, NULL, NULL, NULL, NULL, 'brand_image1631622378akc67882513.jpg', 'brand_image1631622378akc1520759616.jpg', '', 1, 0, NULL),
(94, 'kjskdfk', 45, 545, 'vmdnvk', 5, NULL, NULL, NULL, NULL, 'brand_image1631622538akc938075822.jpg', '', 'brand_image1631622538akc420774843.jpg', 1, 0, NULL),
(95, 'my full name', 0, 0, 'this is a comment', 4, NULL, NULL, NULL, NULL, 'brand_image1631622828akc1781912029.jpg', 'brand_image1631622828akc1271365359.jpg', 'brand_image1631622828akc378572827.jpg', 1, 0, NULL),
(96, 'my full name', 0, 0, 'this is a comment', 4, NULL, NULL, NULL, NULL, 'brand_image1631622932akc278756512.jpg', 'brand_image1631622932akc1518477389.jpg', 'brand_image1631622932akc97173404.jpg', 1, 0, NULL),
(97, 'my full name', 0, 0, 'this is a comment', 4, NULL, NULL, NULL, NULL, 'brand_image1631622974akc212205869.jpg', 'brand_image1631622974akc1211517621.jpg', 'brand_image1631622974akc415425165.jpg', 1, 0, NULL),
(98, 'my full name', 0, 0, 'this is a comment', 5, NULL, NULL, NULL, NULL, 'brand_image1631622996akc487676016.jpg', '', '', 1, 0, NULL),
(99, 'my full name', 0, 0, 'this is a comment', 5, NULL, NULL, NULL, NULL, 'brand_image1631623032akc741115613.jpg', '', '', 1, 0, NULL),
(100, 'my full name', 0, 0, 'this is a comment', 5, NULL, NULL, NULL, NULL, 'brand_image1631623120akc464580227.jpg', '', '', 1, 0, NULL),
(101, 'my full name', 0, 0, 'this is a comment', 5, NULL, NULL, NULL, NULL, 'brand_image1631623183akc418435219.jpg', '', '', 1, 0, NULL),
(102, 'my full name', 0, 0, 'this is a comment', 5, NULL, NULL, NULL, NULL, 'brand_image1631623214akc2089837921.jpg', '', '', 1, 0, NULL),
(103, 'Marcia Petersen', 109, 921, 'Aut sapiente duis re', 5, NULL, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(104, 'Marcia Petersen', 109, 921, 'Aut sapiente duis re', 5, NULL, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(105, 'Marcia Petersen', 109, 921, 'Aut sapiente duis re', 5, NULL, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(106, 'Anika Miranda', 433, 443, 'Ex aut occaecat labo', 2, NULL, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, 1633772583),
(107, 'a', 10, 590983, 'dGOt6vxqaR', 5, NULL, NULL, NULL, NULL, 'brand_image1633777263akc1641281660.jpg', '', '', 1, 0, 1633777263),
(108, 'Yael Pitts', 888, 547, 'Consequuntur ipsa c', 2, NULL, NULL, NULL, NULL, 'brand_image1633786533akc1884044283.jpg', '', '', 1, 0, 1633786533),
(109, 'Germaine Ratliff', 318, 430, 'Neque id qui totam a', 5, 1, 23, 12, 18, 'brand_image1634553397akc653942900.jpg', '', '', 1, 0, 1634553397),
(110, 'Kirsten Jennings', 901, 1000, 'Exercitationem moles', 1, 2, 24, 14, 16, 'brand_image1634555602akc1063529538.jpg', '', '', 1, 0, 1634555602);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_code`
--

CREATE TABLE `voucher_code` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `voucher_code` varchar(500) DEFAULT NULL,
  `is_purchased` int(11) NOT NULL DEFAULT 0,
  `is_used` int(11) DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voucher_code`
--

INSERT INTO `voucher_code` (`id`, `voucher_id`, `voucher_code`, `is_purchased`, `is_used`, `timestamp`) VALUES
(1, 105, 'Impedit nulla enim ', 0, 0, 1631701173),
(2, 105, 'Accusamus natus labo', 0, 0, 1631701173),
(3, 105, 'Ab deserunt sint qu', 0, 0, 1631701173),
(4, 105, 'Perferendis tempore', 0, 0, 1631701173),
(5, 105, 'Pariatur Officiis q', 0, 0, 1631701173),
(6, 105, 'Molestias ut dolor e', 0, 0, 1631701203),
(7, 105, 'Voluptatem similique', 0, 0, 1631701203),
(8, 105, 'Accusantium eum lore', 0, 0, 1631701203),
(9, 105, 'Sapiente cum qui vol', 0, 0, 1631701203),
(10, 105, 'Illum pariatur Quadd', 0, 0, 1631701203),
(11, 105, 'Molestias ut dolor e', 0, 0, 1631701548),
(12, 105, 'Voluptatem similique', 0, 0, 1631701548),
(13, 105, 'Accusantium eum lore', 0, 0, 1631701548),
(14, 105, 'Sapiente cum qui vol', 0, 0, 1631701548),
(15, 105, 'Illum pariatur Quadd', 0, 0, 1631701548),
(16, 105, 'Distinctio Et lorem', 0, 0, 1631701554),
(17, 105, 'Aliqua Repellendus', 0, 0, 1631701554),
(18, 105, 'Voluptatem magnam al', 0, 0, 1631701554),
(19, 105, 'Necessitatibus enim ', 0, 0, 1631701554),
(20, 105, 'Accusantium dolores ', 0, 0, 1631701554),
(21, 109, 'Nisi officia ipsa l', 0, 0, 1634553402),
(22, 109, 'Sit magna asperiores', 0, 0, 1634553408),
(23, 109, '4568', 0, 0, 1634553413),
(24, 109, '665489646', 0, 0, 1634553419),
(25, 110, '6654896463', 0, 0, 1634560733),
(26, 110, '6654896462', 0, 0, 1634560733);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0cart`
--
ALTER TABLE `0cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variable_voucher`
--
ALTER TABLE `variable_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variable_voucher_code`
--
ALTER TABLE `variable_voucher_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_code`
--
ALTER TABLE `voucher_code`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `0cart`
--
ALTER TABLE `0cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `variable_voucher`
--
ALTER TABLE `variable_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `variable_voucher_code`
--
ALTER TABLE `variable_voucher_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `voucher_code`
--
ALTER TABLE `voucher_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
