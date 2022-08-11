-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2022 at 08:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--
CREATE DATABASE IF NOT EXISTS `ecommerce_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce_db`;

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

DROP TABLE IF EXISTS `orders_tbl`;
CREATE TABLE `orders_tbl` (
  `order_id` int(11) NOT NULL,
  `order_userid` int(11) NOT NULL,
  `order_username` varchar(20) NOT NULL,
  `order_address` varchar(200) NOT NULL,
  `order_country` varchar(20) NOT NULL,
  `order_city` varchar(20) NOT NULL,
  `order_zip` int(11) NOT NULL,
  `order_paymentmethod` varchar(20) NOT NULL,
  `order_ccnum` int(11) NOT NULL,
  `order_ccname` varchar(20) NOT NULL,
  `order_ccexpdate` varchar(20) NOT NULL,
  `order_cccv` varchar(20) NOT NULL,
  `order_product` varchar(20) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `order_product_id` int(11) NOT NULL,
  `order_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_tbl`
--

INSERT INTO `orders_tbl` (`order_id`, `order_userid`, `order_username`, `order_address`, `order_country`, `order_city`, `order_zip`, `order_paymentmethod`, `order_ccnum`, `order_ccname`, `order_ccexpdate`, `order_cccv`, `order_product`, `order_qty`, `order_price`, `order_total`, `order_product_id`, `order_timestamp`) VALUES
(11, 11, 'Daniyal', 'address', 'Pakistan', 'Karachi', 12345, 'Paypal', 12345678, 'cardname', '19/5/23', '1234', 'Dell Latitude 7330 L', 3, 250000, 750000, 12, '2022-08-02 13:09:50'),
(14, 11, 'Daniyal', 'address', 'Pakistan', 'Karachi', 12345, 'Debit card', 12345678, 'cardname', '19/5/23', '1234', 'Dell Latitude 5330 L', 1, 300000, 300000, 13, '2022-08-02 13:12:29'),
(17, 11, 'Daniyal', 'address', 'Pakistan', 'Karachi', 12345, 'Credit card', 23445454, 'cardname', 'sbvc', '23343', 'Dell Latitude 7330 L', 1, 250000, 250000, 12, '2022-08-02 13:18:55'),
(18, 11, 'Daniyal', 'address', 'Pakistan', 'Karachi', 12345, 'Credit card', 23445454, 'cardname', 'sbvc', '23343', 'Dell G15 Ryzen Editi', 1, 400000, 400000, 14, '2022-08-02 13:18:55'),
(27, 14, 'Shahid', 'address', 'Pakistan', 'Lahore', 2343, 'Paypal', 1233435, 'card', 'Expiration', '1234', 'Dell Latitude 7330 L', 2, 250000, 500000, 12, '2022-08-02 17:49:55'),
(28, 14, 'Shahid', 'address', 'Pakistan', 'Lahore', 2343, 'Paypal', 1233435, 'card', 'Expiration', '1234', 'Dell G15 Ryzen Editi', 1, 400000, 400000, 14, '2022-08-02 17:49:55'),
(29, 15, 'Anwar', 'address', 'Pakistan', 'Multan', 1234, 'Debit card', 1233455, 'card', 'Expiration', '12345', 'Dell Latitude 7330 L', 1, 250000, 250000, 12, '2022-08-02 17:51:36'),
(30, 15, 'Anwar', 'address', 'Pakistan', 'Multan', 1234, 'Debit card', 1233455, 'card', 'Expiration', '12345', 'Lenovo ThinkBook Plu', 1, 392000, 392000, 15, '2022-08-02 17:51:36'),
(31, 15, 'Anwar', 'address', 'Pakistan', 'Multan', 1234, 'Debit card', 1233455, 'card', 'Expiration', '12345', 'Lenovo Legion 7i Gen', 1, 768899, 768899, 17, '2022-08-02 17:51:36'),
(32, 15, 'Anwar', 'address', 'Pakistan', 'Multan', 1234, 'Debit card', 1233455, 'card', 'Expiration', '12345', 'HP ProBook 640 G8 LT', 5, 100000, 500000, 18, '2022-08-02 17:51:36'),
(33, 17, 'Usman', 'address', 'Pakistan', 'Karachi', 1234, 'Credit card', 12345678, 'card', '12/05/23', '1234', 'Dell Latitude 5330 L', 5, 300000, 1500000, 13, '2022-08-02 18:01:30'),
(34, 17, 'Usman', 'address', 'Pakistan', 'Karachi', 1234, 'Credit card', 12345678, 'card', '12/05/23', '1234', 'Lenovo Legion 7i Gen', 1, 768899, 768899, 17, '2022-08-02 18:01:30'),
(35, 11, 'Daniyal', 'address', 'Pakistan', 'Karachi', 1234, 'Credit card', 12345678, 'card', '23/3/23', '1234', 'Lenovo Legion 7i Gen', 1, 768899, 768899, 17, '2022-08-02 18:05:46'),
(36, 11, 'Daniyal', 'address', 'Pakistan', 'Karachi', 1234, 'Credit card', 12345678, 'card', '23/3/23', '1234', 'OMEN by HP Laptop 16', 12, 250000, 3000000, 19, '2022-08-02 18:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

DROP TABLE IF EXISTS `products_tbl`;
CREATE TABLE `products_tbl` (
  `pro_id` int(11) NOT NULL,
  `pro_img` varchar(200) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `pro_descrip` varchar(200) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`pro_id`, `pro_img`, `pro_name`, `pro_descrip`, `pro_price`, `pro_stock`) VALUES
(12, 'images/1659422790notebook-latitude-13-7330t-gray-gallery-3.jpg', 'Dell Latitude 7330 Laptop', 'Premium look. Premium options.                                                                          ', 250000, 0),
(13, 'images/1659441873notebook-latitude-13-5330-gray-gallery-3.jpg', 'Dell Latitude 5330 Laptop', 'Work anywhere on our most scalable and sustainable Latitude', 300000, 17),
(14, 'images/1659442096laptops_g-series_g15-5515-phantom-grey-coral-kb_gallery_4.jpg', 'Dell G15 Ryzen Edition Gaming Laptop', 'Power up your skills', 400000, 17),
(15, 'images/1659442482Lenovo-ThinkBook-Plus-Gen-3-Pictures-2.jpg', 'Lenovo ThinkBook Plus Gen 3 (17, Intel)', 'Two epic displays, one epic multitasker', 392000, 32),
(16, 'images/1659442725ThinkPad_X1_Extreme_Gen_5_03.png', 'ThinkPad X1 Extreme Gen 5 (16, Intel)', 'Extreme power, exquisite performance', 549780, 0),
(17, 'images/1659443163A8X5S2112101BLY972A.jpg', 'Lenovo Legion 7i Gen 6 (16, Intel)', 'Claim visual superiority', 768899, 0),
(18, 'images/16594453128um850.png', 'HP ProBook 640 G8 LTE Advanced 14\" Notebook', 'Modern design for the enterprise', 100000, 45),
(19, 'images/1659463417center_facing.png', 'OMEN by HP Laptop 16t-k000', 'The OMEN Laptop is ready to go wherever you are                                        ', 250000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE `user_tbl` (
  `User_id` int(25) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `User_image` varchar(100) NOT NULL,
  `User_role` varchar(25) NOT NULL,
  `phoneNo` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`User_id`, `Username`, `Password`, `Email`, `User_image`, `User_role`, `phoneNo`) VALUES
(11, 'Daniyal', 'Daniyal.485', 'daniyal@gmail.com', 'images/16594634431607499274camera_icon.png', 'Admin', 12345678),
(13, 'Ali Hassan', 'ali@1234', 'Ali@gmail.com', '', 'User', 12345678),
(14, 'Shahid', 'Shahid.1234', 'Shahid@gmail.com', '', 'User', 12345678),
(15, 'Anwar', 'Anwar.1234', 'Anwar@gmail.com', '', 'User', 1245678),
(17, 'Usman', 'Usman.485', 'Usman@gmail.com', '', 'User', 12345678);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products_tbl`
--
ALTER TABLE `products_tbl`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `User_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
