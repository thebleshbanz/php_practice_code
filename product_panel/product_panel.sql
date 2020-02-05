-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 02:38 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_add`
--

CREATE TABLE `product_add` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_add`
--

INSERT INTO `product_add` (`id`, `name`, `description`, `image`) VALUES
(21, 'Bedrock rims', 'finibus tortor massa, sit amet volutpat lorem\r\nGolden Jubilee 50 Years', 'CNR-Rao-Heroes-from-Karnataka.jpg'),
(22, 'Bedrock chains', 'Quisque tortor lectus, congue eget arcu ac, tincidunt rhoncus nulla', 'Anil-Kumble-Heroes-from-Karnataka.jpg'),
(23, 'Bedrock tubes', 'Donec luctus enim justo. Cras viverra ', 'Bhimsen-Joshi-Heroes-from-Karnataka.jpg'),
(25, 'raynold pen', 'acerat porttitor. Quisque et bibendum arc', 'FB_IMG_14456844771917744.jpg'),
(26, 'arpit agarbatti', 'get arcu ac, tincidunt rhoncus nulla. Donec luctus enim justo. Cras viverra interdum diam, ultrice', 'FB_IMG_14456844871682062.jpg'),
(27, 'raynold marker', 'verra quam tincidunt. Vivamus molestie dictum urna id placQu', 'FB_IMG_14456844948364435.jpg'),
(28, 'Badam Pak', ' Intornare. Sed elementum at velit at vestibulum. Proin vitae metus', 'FB_IMG_14456844995871874.jpg'),
(29, 'Chyawanprash', '190Rs me 1KG', 'Narayan-Murthy-Heroes-from-Karnataka.jpg'),
(30, 'Pachak Ajwain', '46RS me 100gm', 'Narayan-Murthy-Heroes-from-Karnataka.jpg'),
(31, 'Pachak Hing Goli ', '55RS me 100gm', 'FB_IMG_14456845273904066.jpg'),
(32, 'Pachak Hing Peda ', '30RS 100GM', 'FB_IMG_14456845357063578.jpg'),
(33, 'Pachak Hing Peda ', '30RS 100GM', 'FB_IMG_14456845357063578.jpg'),
(34, 'Desi Ghee', '1KG 510RS', 'Prakash-Padukone-Heroes-from-Karnataka1.jpg'),
(35, 'biscuit parleyG', 'mfg by parley G', 'FB_IMG_14456845644576782.jpg'),
(36, 'Wills Classic', 'Both Wills and Classic enjoyed their time in the market and their respective audiences,', 'Shakuntala-Devi-Heroes-from-Karnataka1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(5) NOT NULL,
  `customer_id` int(5) DEFAULT '0',
  `product_id` int(5) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `rate` int(5) NOT NULL,
  `color` int(5) NOT NULL,
  `date` datetime(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `customer_id`, `product_id`, `quantity`, `rate`, `color`, `date`) VALUES
(1, 1, 32, 12, 55, 4, '2018-02-16 06:55:20.000000'),
(2, 1, 31, 250, 65, 3, '2018-02-16 07:05:21.000000'),
(6, 1, 25, 10, 8, 1, '2018-02-16 10:16:59.000000'),
(4, 1, 31, 100, 65, 4, '2018-02-16 07:06:51.000000'),
(5, 1, 23, 5, 33, 2, '2018-02-16 07:07:43.000000'),
(7, 1, 29, 5, 35, 1, '2018-02-16 10:17:23.000000'),
(8, 1, 21, 8, 60, 1, '2018-02-16 10:17:51.000000'),
(9, 1, 34, 2, 510, 1, '2018-02-16 10:19:54.000000'),
(10, 1, 22, 14, 50, 3, '2018-02-17 07:48:29.000000'),
(11, 1, 36, 25, 15, 1, '2018-02-17 14:36:23.000000');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `customer_id` int(12) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `usertype` int(2) NOT NULL DEFAULT '1',
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`customer_id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `usertype`, `date`) VALUES
(1, 'Blesh', 'Banz', 'thecoderway@gmail.com', '7000597690', '0192023a7bbd73250516f069df18b500', 0, '2018-02-12'),
(2, 'shivam', 'enterprise', 'shivamenterprise@gmail.com', '99888456321', 'e4a1660e45d370c7c722c56ac5160909', 1, '2018-02-12'),
(3, 'aaditya', 'bharat', 'aaditya@bharat.com', '99888456321', 'e4a1660e45d370c7c722c56ac5160909', 1, '2018-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `count` int(3) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(5) DEFAULT NULL,
  `rate` decimal(5,0) DEFAULT NULL,
  `color` varchar(15) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`count`, `product_id`, `quantity`, `rate`, `color`, `date`) VALUES
(6, 22, 15, '50', '2', NULL),
(7, 23, 32, '33', '2', '2018-02-15 06:06:29'),
(8, 33, 150, '46', '4', '2018-02-15 12:17:23'),
(9, 32, 10, '55', '3', '2018-02-15 12:17:44'),
(10, 31, 75, '65', '3', '2018-02-15 12:18:08'),
(11, 22, 15, '50', '4', '2018-02-16 09:26:06'),
(12, 21, 150, '60', '4', '2018-02-16 09:26:58'),
(13, 24, 15, '150', '2', '2018-02-16 09:27:18'),
(14, 25, 150, '8', '1', '2018-02-16 09:27:42'),
(15, 28, 45, '80', '3', '2018-02-16 09:28:26'),
(16, 29, 200, '35', '4', '2018-02-16 09:29:07'),
(17, 30, 145, '5', '4', '2018-02-16 09:29:28'),
(18, 31, 75, '55', '1', '2018-02-16 09:30:21'),
(19, 34, 5, '510', '1', '2018-02-16 09:30:36'),
(20, 27, 20, '24', '3', '2018-02-16 09:31:05'),
(21, 26, 15, '180', '1', '2018-02-16 09:31:30'),
(23, 31, 300, '55', '1', '2018-02-16 10:21:30'),
(24, 35, 150, '12', '4', '2018-02-16 13:06:25'),
(25, 22, 12, '140', '1', '2018-02-17 12:25:08'),
(29, 36, 150, '15', '1', '2018-02-17 14:25:39'),
(30, 36, 150, '15', '3', '2018-02-17 14:34:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_add`
--
ALTER TABLE `product_add`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`count`),
  ADD UNIQUE KEY `stock_id` (`count`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_add`
--
ALTER TABLE `product_add`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `customer_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `count` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
