-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for petshop
CREATE DATABASE IF NOT EXISTS `petshop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `petshop`;

-- Dumping structure for table petshop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `name` varchar(100) NOT NULL,
  `id` int(20) NOT NULL,
  `codeprog` varchar(10) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pfimg` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table petshop.admin: ~4 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`name`, `id`, `codeprog`, `kelas`, `email`, `pfimg`) VALUES
	('Muhammad Haikal Bin Khalid', 2021812708, 'CS230', 'T5CS2304B1', '2021812708@student.uitm.edu.my', 'kal.png'),
	('Aqil Khairy Bin Hamsani', 2021856342, 'CS230', 'T5CS2304B1', '2021856342@student.uitm.edu.my', 'aqil.png'),
	('Muhammad Afif Bin Mohammad Amran', 2021868294, 'CS230', 'T5CS2304B1', '2021868294@student.uitm.edu.my', 'afif.png'),
	('Tuan Ahmad Hakimi Bin Tuan Abdul Aziz', 2021888222, 'CS230', 'T5CS2304B1', '2021888222@student.uitm.edu.my', 'hakimi.png');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table petshop.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table petshop.customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table petshop.product
CREATE TABLE IF NOT EXISTS `product` (
  `name` varchar(100) NOT NULL,
  `prod_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `quantity` int(100) NOT NULL,
  `price` float NOT NULL,
  `imageprod` varchar(100) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table petshop.product: ~16 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
REPLACE INTO `product` (`name`, `prod_id`, `type`, `quantity`, `price`, `imageprod`) VALUES
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
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table petshop.sales_record
CREATE TABLE IF NOT EXISTS `sales_record` (
  `cust_name` varchar(100) NOT NULL,
  `sales_id` int(10) NOT NULL AUTO_INCREMENT,
  `address` varchar(200) NOT NULL,
  `num_phone` varchar(20) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `quantity` int(100) NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`sales_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `sales_record_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table petshop.sales_record: ~2 rows (approximately)
/*!40000 ALTER TABLE `sales_record` DISABLE KEYS */;
REPLACE INTO `sales_record` (`cust_name`, `sales_id`, `address`, `num_phone`, `prod_id`, `quantity`, `total_price`) VALUES
	('Haikal Khalid', 35, 'No.19B, Jalan Jati, Desa Subang Perantau, Kampung Melayu Subang', '0182884073', 4, 2, 16.4),
	('Haikal Khalid', 37, 'No.19B, Jalan Jati, Desa Subang Perantau, Kampung Melayu Subang', '0182884073', 4, 5, 41);
/*!40000 ALTER TABLE `sales_record` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
