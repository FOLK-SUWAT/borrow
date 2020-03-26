-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2019 at 03:56 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-borrow`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `item_order` int(11) NOT NULL,
  `borrow_id` int(50) NOT NULL,
  `borrow_topic` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_request` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `num_sendback` int(50) NOT NULL,
  `unit` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `return_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `member_id` int(11) NOT NULL,
  `mem_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_department` varchar(255) COLLATE utf8_bin NOT NULL,
  `sum_request` int(255) NOT NULL,
  `sum_amount` int(255) NOT NULL,
  `sum_amount_all` int(255) NOT NULL,
  `sum_sendback` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `borrowcart`
--

CREATE TABLE `borrowcart` (
  `item_order` int(11) NOT NULL,
  `borrow_id` int(10) NOT NULL,
  `create_date` datetime NOT NULL,
  `borrow_topic` varchar(255) COLLATE utf8_bin NOT NULL,
  `num_request` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `unit` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `return_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `status` varchar(255) COLLATE utf8_bin NOT NULL,
  `item_id` varchar(11) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `member_id` int(11) NOT NULL,
  `mem_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_department` varchar(225) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_bill`
--

CREATE TABLE `borrow_bill` (
  `borrow_id` int(5) NOT NULL,
  `borrow_topic` varchar(255) COLLATE utf8_bin NOT NULL,
  `detail` varchar(255) COLLATE utf8_bin NOT NULL,
  `member_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `mem_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `create_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_bill` varchar(255) COLLATE utf8_bin NOT NULL,
  `status_bill` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `return_date` varchar(255) COLLATE utf8_bin NOT NULL,
  `borrow_department` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `cat_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `mem_type_department` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_id`, `cat_name`, `type_id`, `mem_type_department`) VALUES
(28, 'F8', 'เครื่องคอมพิวเตอร์', '56', '9767'),
(31, 'F9', 'เครื่องปรับอากาศ', '56', '9767');

-- --------------------------------------------------------

--
-- Table structure for table `category_type`
--

CREATE TABLE `category_type` (
  `id` int(10) NOT NULL,
  `type_id` varchar(11) COLLATE utf8_bin NOT NULL,
  `type_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `mem_type_department` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category_type`
--

INSERT INTO `category_type` (`id`, `type_id`, `type_name`, `mem_type_department`) VALUES
(56, 'F', 'เครื่องตกแต่งและอุปกรณ์สำนักงาน', '9767');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(10) NOT NULL,
  `item_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `detail` varchar(255) COLLATE utf8_bin NOT NULL,
  `serail` varchar(255) COLLATE utf8_bin NOT NULL,
  `create_date` datetime NOT NULL,
  `cat_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `type_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `unit_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `in_use` varchar(50) COLLATE utf8_bin NOT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL,
  `department` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `detail`, `serail`, `create_date`, `cat_id`, `type_id`, `unit_name`, `in_use`, `picture`, `department`) VALUES
(170, 'asd', 'test1', 'asd', '2019-12-01 18:34:23', '28', '56', '11', '2', 'img/image_item/97021074826472_2362188213885825_5035485310700486656_o.jpg', '9767');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(5) NOT NULL,
  `mem_name` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `mem_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `department` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  `mem_type_id` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `mem_name`, `email`, `mem_id`, `department`, `password`, `mem_type_id`) VALUES
(111120, 'FOLKQQ', 'FOLKQQ@OUTLOOK.COM', '1234', 'IT', '0000', 'ADMIN'),
(111121, 'FOLKQQ', 'fbifolkcom2@hotmail.com', '9767', 'ACC', '0000', 'MANAGER'),
(123456, 'ADMIN โฟล์ค', 'ADMIN@OUTLOOK.COM', '9767', 'ACC', '0000', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `mem_type`
--

CREATE TABLE `mem_type` (
  `mem_id` int(10) NOT NULL,
  `mem_type_department` varchar(255) COLLATE utf8_bin NOT NULL,
  `line_token` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mem_type`
--

INSERT INTO `mem_type` (`mem_id`, `mem_type_department`, `line_token`) VALUES
(1234, 'IT', 'TOcGgoeWCd06Dwb79ieXBBGPePS6tJXlu1APnRQlySK'),
(9767, 'OP', 'TOcGgoeWCd06Dwb79ieXBBGPePS6tJXlu1APnRQlySK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`item_order`),
  ADD KEY `borrow_id` (`borrow_id`);

--
-- Indexes for table `borrowcart`
--
ALTER TABLE `borrowcart`
  ADD PRIMARY KEY (`item_order`);

--
-- Indexes for table `borrow_bill`
--
ALTER TABLE `borrow_bill`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_type`
--
ALTER TABLE `category_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `mem_type`
--
ALTER TABLE `mem_type`
  ADD PRIMARY KEY (`mem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `item_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `borrowcart`
--
ALTER TABLE `borrowcart`
  MODIFY `item_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `borrow_bill`
--
ALTER TABLE `borrow_bill`
  MODIFY `borrow_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category_type`
--
ALTER TABLE `category_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123458;

--
-- AUTO_INCREMENT for table `mem_type`
--
ALTER TABLE `mem_type`
  MODIFY `mem_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9773;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
