-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2022 at 07:55 PM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2MrVbGFsSY`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `fullname`, `email`, `contact`, `address`, `password`) VALUES
('nidha', 'nidha', 'nidha@gmail.com', '998696572', 'Maharashtra', 'suhail'),
('pratheek083', 'Pratheek Shiri', 'pratheek@gmail.com', '8779546521', 'Hyderabad', 'pratheek'),
('rakshithk00', 'Rakshith Kotian', 'rakshith@gmail.com', '9547123658', 'Gujarath', 'rakshith'),
('sid', 'Siddiq Omar', 'siddiqomar98@gmail.com', '12335264', 'No 65, Jalan Velox 7, Taman Velox', 'sidd'),
('yey', 'Siddiq Omar', 'diksiddiq@gmail.com', '123', 'edrh', 'yey');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `F_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `R_ID` int(11) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `category` varchar(50) NOT NULL,
  `availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`F_ID`, `name`, `price`, `description`, `R_ID`, `images_path`, `category`, `availability`) VALUES
(58, 'Juicy Masala Paneer Kathi Roll', 40, 'Juicy Masala Paneer Kathi Roll loaded with Masala Paneer chunks, onion & Mayo.', 1, 'images/Masala_Paneer_Kathi_Roll.jpg', '', 'available'),
(59, 'Meurig Fish', 60, 'Try Meurig - A whole Pomfret fish grilled with tangy marination & served with grilled onions and tomatoes.', 2, 'images/Meurig.jpg', '', 'available'),
(60, 'Chocolate', 99, 'Lose', 3, 'images/Chocolate_Hazelnut_Truffle.jpg', 'Breakfast', 'available'),
(61, 'Happy Happy Choco Chip Shake', 80, 'Happy Happy Choco Chip Shake - a perfect party sweet treat.', 1, 'images/Happy_Happy_Choco_Chip_Shake.jpg', '', 'available'),
(62, 'Spring Rolls', 65, 'Delicious Spring Rolls by Dragon Hut, Delhi. Order now!!!', 2, 'images/Spring_Rolls.jpg', '', ''),
(63, 'Baahubali Ice ', 84, 'Baahubali comes with a drinks', 3, 'images/Baahubali_Thali.jpg', 'Breakfast', 'not-available'),
(66, 'Nasi Lemak Antarabangsa', 20, 'Nasi Lemak comes together with  free drinks.', 7, 'images/NasiLemak.jpg', 'Breakfast', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `icnum` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`username`, `name`, `email`, `icnum`, `phone`, `password`, `status`) VALUES
('aditi068', 'Aditi Naik', 'aditi@gmail.com', '', '8654751259', 'aditi', ''),
('aminnikhil073', 'Nikhil Amin', 'aminnikhil073@gmail.com', '', '9632587412', 'nikhil', ''),
('faatihah', 'NUR FAATIHAH BINTI ROSMAN', 'faatihah@gmail.com', '', '0123456789', 'faatihah', ''),
('roshanraj07', 'Roshan Raj', 'roshan@gmail.com', '', '9541258761', 'roshan', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `F_ID` int(11) NOT NULL,
  `foodname` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `username` varchar(30) NOT NULL,
  `R_ID` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `F_ID`, `foodname`, `price`, `quantity`, `order_date`, `username`, `R_ID`, `status`) VALUES
(7, 66, 'Nasi Lemak Antarabangsa', 20, 1, '2021-07-10 00:00:00', 'yey', 7, 'Not Delivered'),
(8, 66, 'Nasi Lemak Antarabangsa', 20, 1, '2021-07-10 07:48:00', 'yey', 7, 'Not Delivered'),
(21, 59, 'Meurig Fish', 60, 1, '2021-07-10 00:52:00', 'yey', 2, 'Not Delivered'),
(22, 59, 'Meurig Fish', 60, 1, '2021-07-10 10:52:00', 'yey', 2, 'Not Delivered'),
(23, 59, 'Meurig Fish', 60, 1, '2021-07-10 08:55:00', 'yey', 2, 'Not Delivered'),
(24, 59, 'Meurig Fish', 60, 1, '2021-07-10 02:08:00', 'yey', 2, 'Not Delivered'),
(25, 60, 'Chocolate', 99, 1, '2021-07-10 02:08:00', 'yey', 3, 'Not Delivered'),
(26, 59, 'Meurig Fish', 60, 1, '2021-07-10 01:13:00', 'yey', 2, 'Not Delivered'),
(27, 59, 'Meurig Fish', 60, 1, '2021-07-10 12:00:00', 'sid', 2, 'Not Delivered'),
(28, 58, 'Juicy Masala Paneer Kathi Roll', 40, 2, '2021-07-10 12:00:00', 'sid', 1, 'Not Delivered'),
(29, 58, 'Juicy Masala Paneer Kathi Roll', 40, 3, '2021-11-03 21:42:00', 'yey', 1, 'Not Delivered'),
(30, 59, 'Meurig Fish', 60, 4, '2022-01-18 00:06:00', 'yey', 2, 'Not Delivered'),
(31, 60, 'Chocolate', 99, 3, '2022-01-18 00:06:00', 'yey', 3, 'Not Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `R_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `M_ID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`R_ID`, `name`, `email`, `contact`, `address`, `M_ID`) VALUES
(1, 'Nikhil\'s Restaurant', 'nikhil@restaurant.com', '7998562145', 'Karnataka', 'aminnikhil073'),
(2, 'Roshan\'s Restaurant', 'roshan@restaurant.com', '9887546821', 'Bihar', 'roshanraj07'),
(3, 'Aditi\'s Restaurant', 'aditi@restaurant.com', '7778564231', 'Goa', 'aditi068'),
(7, 'faatihah homefood', 'faatihahrosman27@gmail.com', '0322413436765', 'bangsar, kuala Lumpur', 'faatihah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`F_ID`,`R_ID`),
  ADD KEY `R_ID` (`R_ID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `F_ID` (`F_ID`),
  ADD KEY `username` (`username`),
  ADD KEY `R_ID` (`R_ID`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`R_ID`),
  ADD UNIQUE KEY `M_ID_2` (`M_ID`),
  ADD KEY `M_ID` (`M_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `F_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`R_ID`) REFERENCES `restaurants` (`r_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`F_ID`) REFERENCES `food` (`f_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`username`) REFERENCES `customer` (`username`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`R_ID`) REFERENCES `restaurants` (`r_id`);

--
-- Constraints for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `manager` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
