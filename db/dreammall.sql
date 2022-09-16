-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 10, 2022 at 03:02 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dreammall`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `content` text,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `upload_date`) VALUES
(2, 'Life Style', '2022-06-18'),
(3, 'Agriculture', '2022-06-18'),
(4, 'Social Media', '2022-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comment` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `district_id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `name`, `date_created`) VALUES
(1, 'Balaka', '2021-12-30 15:48:24'),
(2, 'Blantyre', '2021-12-30 15:48:24'),
(3, 'Chikwawa', '2021-12-30 15:49:05'),
(4, 'Chiradzulu', '2021-12-30 15:49:05'),
(5, 'Chitipa', '2021-12-30 15:49:36'),
(6, 'Dedza', '2021-12-30 15:49:36'),
(7, 'Dowa', '2021-12-30 15:51:16'),
(8, 'Karonga', '2021-12-30 15:51:16'),
(9, 'Kasungu', '2021-12-30 15:51:16'),
(10, 'Lilongwe', '2021-12-30 15:51:16'),
(11, 'Likoma', '2021-12-30 15:57:02'),
(12, 'Machinga', '2021-12-30 15:51:16'),
(13, 'Mangochi', '2021-12-30 15:55:53'),
(14, 'Mchinji', '2021-12-30 15:55:53'),
(15, 'Mulanje', '2021-12-30 15:55:53'),
(16, 'Mwanza', '2021-12-30 15:55:53'),
(17, 'Mzimba', '2021-12-30 15:55:53'),
(18, 'Mzuzu', '2021-12-30 15:55:53'),
(19, 'Neno', '2021-12-30 16:04:58'),
(20, 'Nkhata Bay', '2021-12-30 15:55:53'),
(21, 'Nkhotakota', '2021-12-30 15:55:53'),
(22, 'Nkhotakota', '2021-12-30 16:08:42'),
(23, 'Nsanje', '2021-12-30 16:08:42'),
(24, 'Ntcheu', '2021-12-30 16:08:42'),
(25, 'Ntchisi', '2021-12-30 16:08:42'),
(26, 'Phalombe', '2021-12-30 16:08:42'),
(27, 'Rumphi', '2021-12-30 16:08:42'),
(28, 'Salima', '2021-12-30 16:08:42'),
(29, 'Thyolo', '2021-12-30 16:08:42'),
(30, 'Zomba', '2021-12-30 16:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `item_images`
--

DROP TABLE IF EXISTS `item_images`;
CREATE TABLE IF NOT EXISTS `item_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `image_name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_images`
--

INSERT INTO `item_images` (`image_id`, `item_id`, `image_name`) VALUES
(1, 4, '(14).jpg'),
(2, 4, '(16).jpg'),
(3, 4, '(17).jpg'),
(4, 4, '(23).jpg'),
(5, 5, '(16).jpg'),
(6, 5, '(19).jpg'),
(7, 5, '(20).jpg'),
(8, 5, '(23).jpg'),
(106, 32, '0bcf891662472294.jpg'),
(105, 31, '1_OoQ04Tjh-E3a3CIv3cw4VQ1659977497.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `image_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `random_items`
--

DROP TABLE IF EXISTS `random_items`;
CREATE TABLE IF NOT EXISTS `random_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `item_name` varchar(200) DEFAULT NULL,
  `item_area` varchar(200) DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_negotiable` int(11) DEFAULT NULL,
  `item_price` int(11) DEFAULT NULL,
  `item_description` text,
  `views` int(11) DEFAULT NULL,
  `item_date` datetime DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `random_items`
--

INSERT INTO `random_items` (`item_id`, `user_id`, `district_id`, `item_name`, `item_area`, `item_quantity`, `item_negotiable`, `item_price`, `item_description`, `views`, `item_date`) VALUES
(32, 17, 27, 'Laptop', 'Livingstonia', 10, 1, NULL, 'Nice computers', 0, '2022-09-06 06:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `shop_name` varchar(200) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `opening_days` varchar(100) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_2` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(100) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `user_id`, `district_id`, `cat_id`, `shop_name`, `area`, `opening_time`, `closing_time`, `opening_days`, `address`, `phone`, `phone_2`, `email`, `website`, `logo`, `facebook`, `instagram`, `twitter`, `whatsapp`, `views`, `status`, `verified`, `reg_date`) VALUES
(18, 19, 2, 5, 'Jomo', 'Chileka', '06:00:00', '18:00:00', 'Sunday, Monday, Tuesday, Thursday, Friday, Saturday, ', 1010, '0887043733', '', '', '', '1221662469228.png', '', '', '', '', 0, 1, 0, '2022-09-06 06:00:31'),
(17, 13, 1, 5, 'Join the world of fun', 'Chichiri', '06:00:00', '18:00:00', 'Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, ', 20, '0887043733', '', '', '', '0bcf891662428014.jpg', '', '', '', '', 4, 1, 0, '2022-09-05 17:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

DROP TABLE IF EXISTS `shop_categories`;
CREATE TABLE IF NOT EXISTS `shop_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `upload_date` date DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`cat_id`, `cat_name`, `upload_date`) VALUES
(2, 'Electronics Shop', '2022-08-11'),
(6, 'Other', '2022-08-11'),
(3, 'Garage - Mechanic', '2022-08-11'),
(4, 'Fashion', '2022-08-11'),
(5, 'Bakery', '2022-08-11'),
(7, 'ï»¿General Shop', '2022-08-14'),
(8, 'Clothing Store', '2022-08-14'),
(9, 'Barbershop', '2022-08-14'),
(10, 'Beauty Salon', '2022-08-14'),
(12, 'Cake Shop', '2022-08-14'),
(13, 'CafÃ©', '2022-08-14'),
(14, 'Art Shop', '2022-08-14'),
(15, 'Restaurant', '2022-08-14'),
(16, 'Fashion Boutique', '2022-08-14'),
(18, 'Jeweler', '2022-08-14'),
(19, 'Music Shop', '2022-08-14'),
(20, 'Souvenir Shop', '2022-08-14'),
(21, 'Sports Store', '2022-08-14'),
(22, 'Tailor', '2022-08-14'),
(23, 'Stationery Shop', '2022-08-14'),
(24, 'Vegetable Market', '2022-08-14'),
(25, 'Wholesaler', '2022-08-14'),
(26, 'Video Games Shop', '2022-08-14'),
(27, 'Rental', '2022-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE IF NOT EXISTS `shop_products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) DEFAULT NULL,
  `prod_name` varchar(200) DEFAULT NULL,
  `prod_quantity` int(11) DEFAULT NULL,
  `prod_negotiable` int(11) DEFAULT NULL,
  `prod_price` int(11) DEFAULT NULL,
  `prod_description` text,
  `upload_date` datetime DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_2` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reg_date` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone`, `phone_2`, `email`, `password`, `user_type`, `status`, `reg_date`) VALUES
(1, 'Mahala', 'Mkwepu', '0887043733', NULL, 'mahalamkwepu@gmail.com', '$2y$10$ZxYcIZ5buUvqSByIgYChROnyjfS4jRZp0D1jUB0EoJ/sjDrpu48Bi', 'admin', 1, '2022-06-08'),
(19, 'Saul', 'Chirwa', '0888381965', NULL, NULL, '$2y$10$tVL45Ry6OO/95fkOpAryYuEfRz7mAYeDDJP0z2ixcOVW9R86iCICe', 'owner', 1, '2022-09-05'),
(13, 'Jomo', 'Kavinya', '0886787966', NULL, NULL, '$2y$10$guHkDzOkptm.QeKGALVSguuwK7Zb/smMlt4YLj82LbE7yiEsazEM2', 'owner', 1, '2022-09-05'),
(17, 'Ndindase', 'Kumwenda', '0888355104', NULL, 'kumwendandindase@gmail.com', '$2y$10$JXax3pjIRVdHjDr96G0nfekr29Yv7WIH8jKrQy.XAZ5TzOvqxw2iq', 'owner', 1, '2022-09-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
