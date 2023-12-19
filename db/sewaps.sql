/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 8.0.30 : Database - sewa_ps
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sewa_ps` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sewa_ps`;

/*Table structure for table `logins` */

DROP TABLE IF EXISTS `logins`;

CREATE TABLE `logins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `logins` */

LOCK TABLES `logins` WRITE;

insert  into `logins`(`id`,`username`,`password`) values 
(1,'ihsanul','6c3cd60030653232df64a7142a718195');

UNLOCK TABLES;

/*Table structure for table `produks` */

DROP TABLE IF EXISTS `produks`;

CREATE TABLE `produks` (
  `ps_id` int NOT NULL AUTO_INCREMENT,
  `jenis_ps` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `warna` varchar(256) DEFAULT NULL,
  `harga_perjam` int DEFAULT NULL,
  PRIMARY KEY (`ps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `produks` */

LOCK TABLES `produks` WRITE;

insert  into `produks`(`ps_id`,`jenis_ps`,`warna`,`harga_perjam`) values 
(1,'ps3','hijau',4000),
(2,'ps 5','hitam',8000),
(4,'ps 2','hitam',2000),
(6,'ps 3','putih',4000);

UNLOCK TABLES;

/*Table structure for table `transaksis` */

DROP TABLE IF EXISTS `transaksis`;

CREATE TABLE `transaksis` (
  `sewa_id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `No_Telepon` varchar(64) DEFAULT NULL,
  `lama_sewa` int DEFAULT NULL,
  `alamat` varchar(256) DEFAULT NULL,
  `ps_id` int DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`sewa_id`),
  KEY `ps_id` (`ps_id`),
  CONSTRAINT `transaksis_ibfk_1` FOREIGN KEY (`ps_id`) REFERENCES `produks` (`ps_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `transaksis` */

LOCK TABLES `transaksis` WRITE;

insert  into `transaksis`(`sewa_id`,`nama`,`No_Telepon`,`lama_sewa`,`alamat`,`ps_id`,`total_harga`) values 
(3,'ihsanul','0899999999',5,'sukosono',2,40000.00),
(6,'zadun','000008976597000',3,'sukodono',1,12000.00),
(7,'zadun','000008976597000',3,'sukodono',1,12000.00),
(8,'zadun','000000',7,'sukodono',1,28000.00);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
