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


-- Dumping database structure for pens
CREATE DATABASE IF NOT EXISTS `pens` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pens`;

-- Dumping structure for table pens.frs
CREATE TABLE IF NOT EXISTS `frs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_matkul` int(11) DEFAULT NULL,
  `student_id` int(20) DEFAULT NULL,
  `sks` int(20) DEFAULT NULL,
  `nilai_angka` int(20) DEFAULT NULL,
  `nilai_huruf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table pens.frs: ~5 rows (approximately)
/*!40000 ALTER TABLE `frs` DISABLE KEYS */;
INSERT INTO `frs` (`id`, `id_matkul`, `student_id`, `sks`, `nilai_angka`, `nilai_huruf`) VALUES
	(1, 1, 32, 2, 89, 'A'),
	(2, 1, 31, 2, 66, 'C'),
	(3, 2, 32, 3, 75, 'B'),
	(4, 2, 31, 3, 43, 'D'),
	(5, 3, 32, 4, 20, 'E');
/*!40000 ALTER TABLE `frs` ENABLE KEYS */;

-- Dumping structure for table pens.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nrp` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `path` text,
  `tahun_lahir` year(4) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table pens.mahasiswa: ~7 rows (approximately)
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` (`id`, `nrp`, `nama`, `gender`, `path`, `tahun_lahir`, `telp`, `address`) VALUES
	(25, '10007', 'Irena', 'P', NULL, '1999', '0987645327', 'Benowo'),
	(26, '10006', 'Watson', 'L', NULL, '2001', '0987645326', 'Nginden'),
	(27, '10005', 'Holmes', 'L', NULL, '1999', '0987645325', 'Ngagel'),
	(29, '10004', 'Sherlock', 'L', NULL, '2000', '0987645324', 'Lontar'),
	(30, '10003', 'Monica', 'P', NULL, '2002', '0987645323', 'Rungkut'),
	(31, '10002', 'Agnes', 'P', NULL, '2001', '0987645322', 'Tandes'),
	(32, '10001', 'John ', 'L', '', '2002', '0987645321', 'Medokan');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;

-- Dumping structure for table pens.matkul
CREATE TABLE IF NOT EXISTS `matkul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_mk` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table pens.matkul: ~3 rows (approximately)
/*!40000 ALTER TABLE `matkul` DISABLE KEYS */;
INSERT INTO `matkul` (`id`, `kode_mk`, `nama`) VALUES
	(1, 'MKA', 'Matematika'),
	(2, 'MKB', 'Biologi'),
	(3, 'MKC', 'Fisika');
/*!40000 ALTER TABLE `matkul` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
