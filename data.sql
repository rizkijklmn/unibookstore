-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for unibookstore
CREATE DATABASE IF NOT EXISTS `unibookstore` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `unibookstore`;

-- Dumping structure for table unibookstore.tb_buku
CREATE TABLE IF NOT EXISTS `tb_buku` (
  `id` int NOT NULL AUTO_INCREMENT,
  `IDBuku` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `IDPenerbit` int NOT NULL DEFAULT '0',
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_buku` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` float(50,0) NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDPenerbit` (`IDPenerbit`),
  CONSTRAINT `FK_IDPenerbit` FOREIGN KEY (`IDPenerbit`) REFERENCES `tb_penerbit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table unibookstore.tb_buku: ~0 rows (approximately)
INSERT INTO `tb_buku` (`id`, `IDBuku`, `IDPenerbit`, `kategori`, `nama_buku`, `harga`, `stock`) VALUES
	(3, 'BK-001', 4, 'Keilmuan', 'Dangerous AI', 80000, 10),
	(4, 'BK-002', 5, 'Astronomi', 'Earth Space', 30000, 2),
	(5, 'BK-003', 6, 'Bisnis', 'Seorang perintis sukses', 100000, 40);

-- Dumping structure for table unibookstore.tb_penerbit
CREATE TABLE IF NOT EXISTS `tb_penerbit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `IDPenerbit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penerbit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kota` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table unibookstore.tb_penerbit: ~1 rows (approximately)
INSERT INTO `tb_penerbit` (`id`, `IDPenerbit`, `nama_penerbit`, `alamat`, `kota`, `telepon`, `createdAt`, `updatedAt`) VALUES
	(4, 'PN-001', 'Penerbit Informatika', 'Jl Buat Batu No 121', 'Bandung', '123123123', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, 'PN-002', 'Penerbit Antartika', 'Jl Batu Buah', 'Bandung', '000999', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, 'PN-003', 'Yudistira', 'jl bangka', 'Jakarta', '091231', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
