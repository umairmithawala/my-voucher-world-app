-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 02:53 PM
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
-- Table structure for table `0address`
--

CREATE TABLE `0address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address_lane` varchar(256) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` int(50) DEFAULT NULL,
  `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `0address`
--

INSERT INTO `0address` (`id`, `user_id`, `name`, `address_lane`, `city`, `postal_code`, `phone`) VALUES
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

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `user_id`, `voucher_id`, `voucher_code_id`, `voucher_type`, `buy_price`, `razorpay_order_id`, `razorpay_payment_id`, `razorpay_signature`, `payment_complete_code_not_available`, `is_paid`, `payment_timestamp`, `timestamp`) VALUES
(4, 1, 67, 1, 'dynamic', 26, NULL, NULL, NULL, 0, 0, NULL, 1634664236),
(8, 1, 67, 1, 'dynamic', 25, 'order_IBHI84p88wpCJb', 'pay_IBHIHSMRIyzoqU', 'd27e033f6675cb0b78a62f7a64adadb3875c925b92ea5470b27fcce9b4ea343e', 0, 1, 1634666093, 1634664595),
(9, 1, 67, 1, 'dynamic', 25, NULL, NULL, NULL, 0, 0, NULL, 1634666105),
(10, 2, 67, 1, 'dynamic', 25, 'order_IBHk6Yhjvcnt5r', 'pay_IBHpxO4PqYBNK2', '681124b5b2e0cc522e1a11b76f9d861f61a49482d8b3b2ba8526c1d146b290f6', 1, 1, 1634666688, 1634666184),
(11, 1, 67, 1, 'dynamic', 21, 'order_IBHnzZWhmA28hc', 'pay_IBHo99RB1AqG24', 'ffdf40442ee7cb841e786b49a679adf5176c0b7291a7d95be55bb1dd2fb8c8d8', 0, 1, 1634666419, 1634666404),
(12, 1, 67, 1, 'dynamic', 21, 'order_IBHpIROOIJJ0fk', 'pay_IBHpUFQROBCLaN', '2a8a7afb8a150793860d257cb4cec9484e9b1fa1733f856fc91909216b0f52aa', 0, 1, 1634666494, 1634666479),
(13, 1, 67, 1, 'dynamic', 21, 'order_IBIqbdklVMohz1', 'pay_IBIqtW5vZ7tGzr', '36bf83f36510683a0406c21efe3051ee2c837c2888155fdd05f5be95b7d5adad', 1, 1, 1634670464, 1634670074),
(14, 1, 67, 1, 'dynamic', 21, 'order_IBIzJVFI2mtgx7', 'pay_IBIzTBaxS2LaRN', 'ac6dfdbd59fa33f0ee8709fe913975e8cfae6afd9dc519b6439addcd40abbabf', 0, 1, 1634670584, 1634670569),
(16, 1, 67, 1, 'dynamic', 21, 'order_IBJ0mlc3ziX3wu', 'pay_IBJ0wanvYNco1n', '7d44c42f088099523a70f132927cbfe68e61a06d3d4dbc6ee20aa20d69895b54', 0, 1, 1634670667, 1634670653),
(18, 1, 67, 1, 'dynamic', 21, 'order_IBJ2lCdQH4cKKc', 'pay_IBJ2xVsTUmhDMa', '3b0c7187d0f961f984dabe55c3bf31f8edf0104e7840f031632515ad8edae199', 0, 1, 1634670781, 1634670765),
(21, 1, 67, 1, 'dynamic', 21, 'order_IBJ4Sbvn3XQ5Ob', 'pay_IBJ4bJATAtnlfS', 'd4ecb0cfbec327a16a670a601f35407709e6ff9b65e8fefeda8a0f3b83f65276', 0, 1, 1634670876, 1634670861),
(23, 1, 67, 2, 'dynamic', 21, 'order_IBJ75e0Zfk8Sk6', 'pay_IBJ7ERFWFSMuRm', '78f7a6266a11fc72554162ef8a51d9abd5abca7206448ada7bb5499b9c364421', 0, 1, 1634671024, 1634671011),
(25, 1, 67, 2, 'dynamic', 21, 'order_IBJA8aYcktH2DW', 'pay_IBJAHuvwi93XPo', 'c25d9652cc1193f1368ff7ba3bc3fadce67fceeec7a72a61a12b16f0ac43aaed', 1, 1, 1634710966, 1634671184),
(29, 1, 67, 1, 'dynamic', 21, NULL, NULL, NULL, 0, 0, NULL, 1634712342),
(30, 1, 67, 1, 'dynamic', 40, 'order_IBUrnasipFn9al', 'pay_IBUrzJx5BVs6P8', '698f9a13094bebfb8b0fce08730dc9b47fd2ceea3d02417be107b2b7d1d7aeb3', 0, 1, 1634712418, 1634712401),
(33, 1, 70, 2, 'normal', 90, 'order_IBglHM7R4Mv4UQ', 'pay_IBglXBdIL9UhbG', 'dd1ffbd74c94a5ac9641708b5e8ded52c0c7715c34a6c03f37d75b32cacad826', 0, 1, 1634754312, 1634754289),
(34, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634754972),
(35, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634755231),
(36, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634755664),
(37, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634755714),
(38, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634755770),
(39, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634755814),
(40, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634756133),
(41, 1, 69, 1, 'normal', 269, NULL, NULL, NULL, 0, 0, NULL, 1634756202),
(42, 1, 69, 1, 'normal', 269, 'order_IBhKQyPWPzr7Du', 'pay_IBhKZzFfo5PiDV', 'ca670c35089889b3140572db6a68a44e9194278effed53e61b2e0b6af5870574', 0, 1, 1634756300, 1634756286);

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
(17, 1, 22, 'dynamic', 1634585395);

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
(9, 'wuratudoty@mailinator.com', NULL, 'email_verification_otp', '506717', 1634530121),
(10, 'admin@gmail.com', NULL, 'email_verification_otp', '797588', 1634666155);

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
(1, 'Josiah Porter ', '7069324378', 'male', 'tasu@mailinator.com', 'anzar', NULL, 1, 0, 0, NULL),
(2, 'Amela Bridges', '+1 (656) 99', 'female', 'admin@gmail.com', 'admin', NULL, 1, 0, 0, NULL),
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
  `qty` int(11) NOT NULL DEFAULT 0,
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
(67, 'Chaney Coffey', 20, 40, 'Id aperiam dolorem s', 5, 0, NULL, NULL, NULL, 'brand_image1631889127akc49037211.jpg', 'brand_image1631889127akc859806270.jpg', 'brand_image1631889127akc1322987788.jpg', 1, 0, NULL),
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
(1, 67, 'Repudiandae sunt re', 1, 0, 1634624835),
(2, 67, 'Adipisicing ipsum au', 1, 0, 1634624835),
(3, 72, 'Minus aperiam error ', 0, 0, 1634624835),
(4, 72, 'Provident nisi quid', 0, 0, 1634624835),
(5, 72, 'Aliquam eos sit eaq', 0, 0, 1634624835);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `vendor_api_key` varchar(500) DEFAULT NULL,
  `vendor_api_secret` varchar(500) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `company_name`, `email`, `phone`, `vendor_api_key`, `vendor_api_secret`, `is_deleted`, `timestamp`) VALUES
(1, 'Roach Joyce Inc', 'Morin Byrd Associates', 'taxahex@mailinator.com', '48', 'mvw_key_aYbiEAoi', 'mvw_secret_yFxcltcawkcB', 0, 1634980564);

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
  `qty` int(11) NOT NULL DEFAULT 0,
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
(67, 'VSMDL', 554, 123, 'NVSJKLNVJ', 1, 10, NULL, NULL, NULL, 'brand_image1630403441akc1653184647.png', NULL, 'brand_image1630404556akc2125005271.png', 0, 0, NULL),
(69, 'Cade England', 269, 300, 'Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem Fuga Culpa dolorem ', 1, 0, NULL, NULL, NULL, 'brand_image1630403553akc2078173611.png', NULL, NULL, 0, 0, NULL),
(70, 'Rina Gregory', 90, 801, 'Dolore qui sit null', 2, 0, NULL, NULL, NULL, 'brand_image1630404556akc2125005271.png', 'brand_image1630404556akc2125005271.png', NULL, 0, 0, NULL),
(82, 'new', 45, 12, 'hello', 1, 0, NULL, NULL, NULL, 'brand_image1631621484akc1040144678.jpg', '', '', 1, 0, NULL),
(83, 'new', 45, 12, 'hello', 1, 0, NULL, NULL, NULL, 'brand_image1631621505akc625150489.jpg', '', '', 1, 0, NULL),
(84, 'new', 45, 12, 'hello', 1, 0, NULL, NULL, NULL, 'brand_image1631621523akc2113385582.jpg', '', '', 1, 0, NULL),
(85, 'vjkjd', 4, 545, '544', 5, 0, NULL, NULL, NULL, 'brand_image1631621554akc1881049101.jpg', '', '', 1, 0, NULL),
(86, 'kfjk', 454, 45, 'gwjek', 5, 0, NULL, NULL, NULL, 'brand_image1630403441akc1653184647.png', '', '', 1, 0, NULL),
(87, 'kfjk', 454, 45, 'gwjek', 5, 0, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(88, 'feh', 45, 54, 'vkjn', 5, 0, NULL, NULL, NULL, 'brand_image1631621815akc835496976.jpg', 'brand_image1631621815akc558584313.jpg', '', 1, 0, NULL),
(89, 'feh', 45, 54, 'vkjn', 5, 0, NULL, NULL, NULL, 'brand_image1631621906akc1493623789.jpg', 'brand_image1631621906akc1856589469.jpg', '', 1, 0, NULL),
(90, 'feh', 45, 54, 'vkjn', 5, 0, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', 'brand_image1631621914akc1078594852.jpg', '', 1, 0, NULL),
(91, 'dkjvsk', 45, 12, 'jgwjghwjkh', 5, 0, NULL, NULL, NULL, 'brand_image1631621943akc261691425.jpg', 'brand_image1631621943akc952148041.jpg', '', 1, 0, NULL),
(92, 'new', 45, 121, 'dvjsvjkk', 5, 0, NULL, NULL, NULL, 'brand_image1631622302akc563991047.jpg', 'brand_image1631622302akc1081111664.jpg', '', 1, 0, NULL),
(93, 'vhvjd', 45, 54, 'vsdklm', 5, 0, NULL, NULL, NULL, 'brand_image1631622378akc67882513.jpg', 'brand_image1631622378akc1520759616.jpg', '', 1, 0, NULL),
(94, 'kjskdfk', 45, 545, 'vmdnvk', 5, 0, NULL, NULL, NULL, 'brand_image1631622538akc938075822.jpg', '', 'brand_image1631622538akc420774843.jpg', 1, 0, NULL),
(95, 'my full name', 0, 0, 'this is a comment', 4, 0, NULL, NULL, NULL, 'brand_image1631622828akc1781912029.jpg', 'brand_image1631622828akc1271365359.jpg', 'brand_image1631622828akc378572827.jpg', 1, 0, NULL),
(96, 'my full name', 0, 0, 'this is a comment', 4, 0, NULL, NULL, NULL, 'brand_image1631622932akc278756512.jpg', 'brand_image1631622932akc1518477389.jpg', 'brand_image1631622932akc97173404.jpg', 1, 0, NULL),
(97, 'my full name', 0, 0, 'this is a comment', 4, 0, NULL, NULL, NULL, 'brand_image1631622974akc212205869.jpg', 'brand_image1631622974akc1211517621.jpg', 'brand_image1631622974akc415425165.jpg', 1, 0, NULL),
(98, 'my full name', 0, 0, 'this is a comment', 5, 0, NULL, NULL, NULL, 'brand_image1631622996akc487676016.jpg', '', '', 1, 0, NULL),
(99, 'my full name', 0, 0, 'this is a comment', 5, 0, NULL, NULL, NULL, 'brand_image1631623032akc741115613.jpg', '', '', 1, 0, NULL),
(100, 'my full name', 0, 0, 'this is a comment', 5, 0, NULL, NULL, NULL, 'brand_image1631623120akc464580227.jpg', '', '', 1, 0, NULL),
(101, 'my full name', 0, 0, 'this is a comment', 5, 0, NULL, NULL, NULL, 'brand_image1631623183akc418435219.jpg', '', '', 1, 0, NULL),
(102, 'my full name', 0, 0, 'this is a comment', 5, 0, NULL, NULL, NULL, 'brand_image1631623214akc2089837921.jpg', '', '', 1, 0, NULL),
(103, 'Marcia Petersen', 109, 921, 'Aut sapiente duis re', 5, 0, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(104, 'Marcia Petersen', 109, 921, 'Aut sapiente duis re', 5, 0, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(105, 'Marcia Petersen', 109, 921, 'Aut sapiente duis re', 5, 0, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, NULL),
(106, 'Anika Miranda', 433, 443, 'Ex aut occaecat labo', 2, 0, NULL, NULL, NULL, 'brand_image1631621914akc379471447.jpg', '', '', 1, 0, 1633772583),
(107, 'a', 10, 590983, 'dGOt6vxqaR', 5, 0, NULL, NULL, NULL, 'brand_image1633777263akc1641281660.jpg', '', '', 1, 0, 1633777263),
(108, 'Yael Pitts', 888, 547, 'Consequuntur ipsa c', 2, 0, NULL, NULL, NULL, 'brand_image1633786533akc1884044283.jpg', '', '', 1, 0, 1633786533),
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
(1, 69, 'ABCDE', 1, 0, 1631701173),
(2, 70, 'id70', 1, 1, 1631701173),
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
-- Indexes for table `0address`
--
ALTER TABLE `0address`
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
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
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
-- AUTO_INCREMENT for table `0address`
--
ALTER TABLE `0address`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
