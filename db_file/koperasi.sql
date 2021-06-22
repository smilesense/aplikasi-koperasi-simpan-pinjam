-- MySQL dump 10.16  Distrib 10.1.48-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: project_pemdesk
-- ------------------------------------------------------
-- Server version	10.1.48-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'bihubbilchoiraidifta@gmail.com','admin','admin'),(2,'azriel@gmail.com','admin','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventaris`
--

DROP TABLE IF EXISTS `inventaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(10) NOT NULL,
  `nominal` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventaris`
--

LOCK TABLES `inventaris` WRITE;
/*!40000 ALTER TABLE `inventaris` DISABLE KEYS */;
INSERT INTO `inventaris` VALUES (1,'Saldo',1037500),(2,'SHU',37500);
/*!40000 ALTER TABLE `inventaris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konfirmasi_pengembalian`
--

DROP TABLE IF EXISTS `konfirmasi_pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konfirmasi_pengembalian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nominal` int(11) NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konfirmasi_pengembalian`
--

LOCK TABLES `konfirmasi_pengembalian` WRITE;
/*!40000 ALTER TABLE `konfirmasi_pengembalian` DISABLE KEYS */;
INSERT INTO `konfirmasi_pengembalian` VALUES (1,1,8,'Azriel Akbar ',500000,538295,'Terkonfirmasi'),(2,1,8,'Azriel Akbar ',37500,38554,'Terkonfirmasi'),(3,2,1,'Bihubbil Choir Aidifta',100000,100870,'Terkonfirmasi'),(4,2,1,'Bihubbil Choir Aidifta',437500,438399,'Terkonfirmasi'),(5,3,1,'Bihubbil Choir Aidifta',537500,538347,'Terkonfirmasi'),(6,4,1,'Bihubbil Choir Aidifta',100000,100742,'Terkonfirmasi'),(7,4,1,'Bihubbil Choir Aidifta',475000,475657,'Terkonfirmasi'),(8,5,1,'Bihubbil Choir Aidifta',500000,500882,'Terkonfirmasi'),(9,5,1,'Bihubbil Choir Aidifta',575000,575463,'Terkonfirmasi'),(10,6,8,'Azriel Akbar ',100000,101041,'Terkonfirmasi'),(11,6,8,'Azriel Akbar ',100000,100401,'Terkonfirmasi'),(12,6,8,'Azriel Akbar ',337500,338160,'Terkonfirmasi'),(13,7,8,'Azriel Akbar ',400000,400990,'Terkonfirmasi'),(14,7,8,'Azriel Akbar ',137500,138325,'Terkonfirmasi');
/*!40000 ALTER TABLE `konfirmasi_pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konfirmasi_tariktunai`
--

DROP TABLE IF EXISTS `konfirmasi_tariktunai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konfirmasi_tariktunai` (
  `id_tariktunai` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tariktunai`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konfirmasi_tariktunai`
--

LOCK TABLES `konfirmasi_tariktunai` WRITE;
/*!40000 ALTER TABLE `konfirmasi_tariktunai` DISABLE KEYS */;
INSERT INTO `konfirmasi_tariktunai` VALUES (1,1,'Bihubbil Choir Aidifta',100000,'Terkonfirmasi'),(2,1,'Bihubbil Choir Aidifta',700000,'Terkonfirmasi');
/*!40000 ALTER TABLE `konfirmasi_tariktunai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pinjaman`
--

DROP TABLE IF EXISTS `pinjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pinjaman` (
  `id_pinjaman` int(20) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nominal` int(20) NOT NULL,
  `bunga` int(50) NOT NULL,
  `total_pinjaman` int(50) NOT NULL,
  `lama_pinjaman` int(10) NOT NULL,
  `jatuh_tempo` varchar(20) NOT NULL,
  `no_rekening` bigint(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pinjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pinjaman`
--

LOCK TABLES `pinjaman` WRITE;
/*!40000 ALTER TABLE `pinjaman` DISABLE KEYS */;
INSERT INTO `pinjaman` VALUES (1,8,'Azriel Akbar ',500000,37500,0,3,'19/9/2021',10212048,'Lunas'),(2,1,'Bihubbil Choir Aidifta',500000,37500,0,3,'9/20/2021',9085330081927,'Lunas'),(3,1,'Bihubbil Choir Aidifta',500000,37500,0,3,'9/20/2021',9085330081927,'Lunas'),(4,1,'Bihubbil Choir Aidifta',500000,75000,0,6,'12/19/2021',9085330081927,'Lunas'),(5,1,'Bihubbil Choir Aidifta',1000000,75000,0,3,'9/20/2021',9085330081927,'Lunas'),(6,8,'Azriel Akbar ',500000,37500,0,3,'20/9/2021',10212048,'Lunas'),(7,8,'Azriel Akbar ',500000,37500,0,3,'20/9/2021',10212048,'Lunas');
/*!40000 ALTER TABLE `pinjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `simpanan`
--

DROP TABLE IF EXISTS `simpanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simpanan` (
  `id_tabungan` int(20) NOT NULL AUTO_INCREMENT,
  `id_user` int(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `nominal` int(20) NOT NULL,
  `kode_unik` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tabungan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simpanan`
--

LOCK TABLES `simpanan` WRITE;
/*!40000 ALTER TABLE `simpanan` DISABLE KEYS */;
INSERT INTO `simpanan` VALUES (1,8,'Azriel Akbar ',1000000,1000823,'Terkonfirmasi'),(2,1,'Bihubbil Choir Aidifta',800000,800439,'Terkonfirmasi');
/*!40000 ALTER TABLE `simpanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabungan`
--

DROP TABLE IF EXISTS `tabungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabungan` (
  `id_tabungan` int(20) NOT NULL AUTO_INCREMENT,
  `id_user` int(20) NOT NULL,
  `nominal` int(20) NOT NULL,
  PRIMARY KEY (`id_tabungan`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan`
--

LOCK TABLES `tabungan` WRITE;
/*!40000 ALTER TABLE `tabungan` DISABLE KEYS */;
INSERT INTO `tabungan` VALUES (20,1,500000),(21,1,600000),(22,1,500000),(23,1,500000),(24,1,1000000);
/*!40000 ALTER TABLE `tabungan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `test`
--

DROP TABLE IF EXISTS `test`;
/*!50001 DROP VIEW IF EXISTS `test`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `test` (
  `id` tinyint NOT NULL,
  `nama_lengkap` tinyint NOT NULL,
  `nik` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `username` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `no_rekening` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(40) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `no_rekening` bigint(50) NOT NULL,
  `iuran_wajib` int(50) NOT NULL,
  `simpanan_sukarela` int(50) NOT NULL,
  `shu` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Bihubbil Choir Aidifta','190411100121','bihubbilchoiraidifta@gmail.com','bihubbil','smile',9085330081927,0,0,7031),(2,'keppin','192','keppin@gmail.com','keppin123','keppin123',0,0,0,0),(3,'Merry Stoner','213','edu@minisites.me','Merry Stoner','123',0,0,0,0),(8,'Azriel Akbar ','190411100192','azriel@gmail.com','azriel','azriel123',10212048,0,1000000,19219),(9,'kappin','1904111','kappin@gmail.com','kappin','kappin123',6745328686,0,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `test`
--

/*!50001 DROP TABLE IF EXISTS `test`*/;
/*!50001 DROP VIEW IF EXISTS `test`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`sbd`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `test` AS select `user`.`id` AS `id`,`user`.`nama_lengkap` AS `nama_lengkap`,`user`.`nik` AS `nik`,`user`.`email` AS `email`,`user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`no_rekening` AS `no_rekening` from `user` where ((`user`.`email` <> 'bihubbilchoiraidifta@gmail.com') or (`user`.`username` <> 'bihubbil')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-22 18:03:31
