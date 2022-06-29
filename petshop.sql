-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2021 at 02:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Haikal

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(100) NOT NULL,
  `id` int(20) NOT NULL,
  `codeprog` varchar(10) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pfimg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `id`, `codeprog`, `kelas`, `email`, `pfimg`) VALUES
('Aqil Khairy Bin Hamsani', 2021856342, 'CS230', 'T5CS2304B1', '2021856342@student.uitm.edu.my', 'aqil.png'),
('Muhammad Afif Bin Mohammad Amran', 2021868294, 'CS230', 'T5CS2304B1', '2021868294@student.uitm.edu.my', 'afif.png'),
('Muhammad Haikal Bin Khalid', 2021812708, 'CS230', 'T5CS2304B1', '2021812708@student.uitm.edu.my', 'kal.png'),
('Tuan Ahmad Hakimi Bin Tuan Abdul Aziz', 2021888222, 'CS230', 'T5CS2304B1', '2021888222@student.uitm.edu.my', 'hakimi.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `name` varchar(100) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` float NOT NULL,
  `imageprod` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`name`, `prod_id`, `type`, `quantity`, `price`, `imageprod`) VALUES
('Power Cat 500g', 4, 'foods & treats', 45, 8.2, 'powercat500g.png'),
('Sayangku 500g', 5, 'foods & treats', 45, 5.5, 'sayangku500g.png'),
('Whiskas 24 pack', 7, 'foods & treats', 50, 17.5, 'whiskas24pack.png'),
('Litter Box', 9, 'accessories', 50, 18, 'litterbox.png'),
('Pet Bed', 10, 'accessories', 50, 70, 'petbed.png'),
('Whiskas 1.5kg', 23, 'foods & treats', 50, 20, '60087ad1d2bd8.png'),
('Bakers Dry Dog Food 2.85kg', 24, 'foods & treats', 50, 33.2, '600fdfb556d2b.png'),
('ProSeries Puppy Food 2.72kg', 25, 'foods & treats', 50, 37.8, '600fe134d255d.png'),
('Oxbow Adult Rabbit Food 2kg', 26, 'foods & treats', 50, 31.3, '600fe50d37cee.png'),
('Little One Guinea Pig Food 2kg', 27, 'foods & treats', 50, 29.7, '600fe7a4a4964.png'),
('Pet Food Bowl', 28, 'accessories', 50, 19.9, '600fe9eb05283.png'),
('Dog Collar', 29, 'accessories', 50, 32.9, '600fea5f20958.png'),
('Pet Cage', 30, 'accessories', 50, 97.9, '600fed479c633.png'),
('Hamster Cage', 31, 'accessories', 50, 42.4, '600feeda412fe.png'),
('4 Floor Cat Scratcher', 32, 'accessories', 50, 240.9, '600ff2ce38f78.png'),
('Set Of Aquarium', 33, 'accessories', 50, 98, '600ff5291127c.png');

-- --------------------------------------------------------

--
-- Table structure for table `sales_record`
--

CREATE TABLE `sales_record` (
  `cust_name` varchar(100) NOT NULL,
  `sales_id` int(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `num_phone` varchar(20) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `quantity` int(100) NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_record`
--

INSERT INTO `sales_record` (`cust_name`, `sales_id`, `address`, `num_phone`, `prod_id`, `quantity`, `total_price`) VALUES
('Haikal Khalid', 35, 'No.19B, Jalan Jati, Desa Subang Perantau, Kampung Melayu Subang', '0182884073', 4, 2, 16.4),
('Haikal Khalid', 37, 'No.19B, Jalan Jati, Desa Subang Perantau, Kampung Melayu Subang', '0182884073', 4, 5, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sales_record`
--
ALTER TABLE `sales_record`
  MODIFY `sales_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD CONSTRAINT `sales_record_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
