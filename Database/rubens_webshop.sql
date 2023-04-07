-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 10:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rubens_webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `material` varchar(20) NOT NULL,
  `display_order_mat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `material`, `display_order_mat`) VALUES
(1, 'Hars', 10),
(2, 'Koper', 20);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `image` varchar(40) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`) VALUES
(1, 'Elf', 'elf.png', 'Een figure van een Elven boogschutter'),
(3, 'Dwerg', 'dwarf.png', 'Een figurine van een Dwerg krijger'),
(4, 'Orc', 'halforc.png', 'Een figurine van een Half-Orc krijger'),
(5, 'Mens', 'human.png', 'Een figurine van een vrouwelijke krijger'),
(6, 'Halfdraak', 'dragonborn.png', 'Een figurine van een Halfdraak krijger');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(3) NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `price` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_size_id`, `material_id`, `price`) VALUES
(22, 1, 1, '9.99'),
(23, 2, 1, '12.99'),
(24, 1, 2, '14.95'),
(25, 2, 2, '19.95'),
(26, 3, 1, '9.99'),
(27, 4, 1, '12.99'),
(28, 3, 2, '14.95'),
(29, 4, 2, '19.95'),
(30, 5, 1, '9.99'),
(31, 6, 1, '12.99'),
(32, 5, 2, '14.95'),
(33, 6, 2, '19.95'),
(34, 7, 1, '9.99'),
(35, 8, 1, '12.99'),
(36, 7, 2, '14.95'),
(37, 8, 2, '19.95'),
(38, 9, 1, '9.99'),
(39, 10, 1, '12.99'),
(40, 9, 2, '14.95'),
(41, 10, 2, '19.95');

-- --------------------------------------------------------

--
-- Table structure for table `product_properties`
--

CREATE TABLE `product_properties` (
  `id` int(11) NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `product_price_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_properties`
--

INSERT INTO `product_properties` (`id`, `product_size_id`, `property_id`, `value`, `product_price_id`) VALUES
(1, 1, 1, 68, NULL),
(2, 3, 1, 68, NULL),
(3, 5, 1, 68, NULL),
(4, 7, 1, 68, NULL),
(5, 9, 1, 68, NULL),
(8, 2, 1, 120, NULL),
(9, 4, 1, 120, NULL),
(10, 6, 1, 120, NULL),
(11, 8, 1, 120, NULL),
(12, 10, 1, 120, NULL),
(15, 2, 2, 37, NULL),
(16, 4, 2, 37, NULL),
(17, 6, 2, 37, NULL),
(18, 8, 2, 37, NULL),
(19, 10, 2, 37, NULL),
(22, 1, 2, 25, NULL),
(23, 3, 2, 25, NULL),
(24, 5, 2, 25, NULL),
(25, 7, 2, 25, NULL),
(26, 9, 2, 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(3) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`) VALUES
(1, 1, 'S'),
(2, 1, 'M'),
(3, 3, 'S'),
(4, 3, 'M'),
(5, 4, 'S'),
(6, 4, 'M'),
(7, 5, 'S'),
(8, 5, 'M'),
(9, 6, 'S'),
(10, 6, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `unit` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `unit`) VALUES
(1, 'Hoogte', 'mm'),
(2, 'Diameter', 'mm'),
(3, 'Gewicht', 'gr');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` char(5) NOT NULL,
  `size` varchar(20) NOT NULL,
  `display_order` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `display_order`) VALUES
('L', 'large', 70),
('M', 'medium', 50),
('S', 'small', 30),
('XL', 'extra large', 80);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `email`, `name`, `password`) VALUES
(1, 'coach@man-kind.nl', 'Geert Weggemans', '4321'),
(3, 'test@account.nl', 'tester1', '1234'),
(8, 'rubenvdzouw@gmail.com', 'ruben', 'test1234'),
(9, 'tester2@account.nl', 'tester2', '1234'),
(10, 'test3@account.nl', 'tester3', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_id` (`product_size_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_properties_ibfk_2` (`product_size_id`),
  ADD KEY `product_properties_ibfk_3` (`property_id`),
  ADD KEY `product_price_id` (`product_price_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_ibfk_1` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_properties`
--
ALTER TABLE `product_properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_price`
--
ALTER TABLE `product_price`
  ADD CONSTRAINT `product_price_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`),
  ADD CONSTRAINT `product_price_ibfk_2` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`);

--
-- Constraints for table `product_properties`
--
ALTER TABLE `product_properties`
  ADD CONSTRAINT `product_properties_ibfk_2` FOREIGN KEY (`product_size_id`) REFERENCES `product_sizes` (`id`),
  ADD CONSTRAINT `product_properties_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`),
  ADD CONSTRAINT `product_properties_ibfk_4` FOREIGN KEY (`product_price_id`) REFERENCES `product_price` (`id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
