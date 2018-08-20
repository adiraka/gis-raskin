/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.32-MariaDB : Database - dbraskin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `bantuan` */

DROP TABLE IF EXISTS `bantuan`;

CREATE TABLE `bantuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bantuan` varchar(100) NOT NULL,
  `banyak_bantuan` int(11) NOT NULL,
  `satuan` enum('kg','liter') NOT NULL,
  `nominal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `bantuan` */

insert  into `bantuan`(`id`,`nama_bantuan`,`banyak_bantuan`,`satuan`,`nominal`) values 
(2,'Beras Miskin',15,'kg',24000);

/*Table structure for table `pemberian` */

DROP TABLE IF EXISTS `pemberian`;

CREATE TABLE `pemberian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(4) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `bantuan_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `user_akun_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pemberian` */

insert  into `pemberian`(`id`,`bulan`,`tahun`,`penerima_id`,`bantuan_id`,`tanggal`,`user_akun_id`) values 
(3,'8',2018,1,2,'2018-08-13',1),
(4,'8',2018,3,2,'2018-08-05',1);

/*Table structure for table `penerima` */

DROP TABLE IF EXISTS `penerima`;

CREATE TABLE `penerima` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_kk` varchar(16) NOT NULL,
  `kepala_keluarga` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `rt_id` int(11) NOT NULL,
  `bantuan_id` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `penerima` */

insert  into `penerima`(`id`,`no_kk`,`kepala_keluarga`,`alamat`,`telepon`,`rt_id`,`bantuan_id`,`latitude`,`longitude`) values 
(1,'1372022102070002','Budi Harianto B','Koto Panjang','081268280648',2,2,122.331,-123.123),
(2,'1372726103690001','Leni Aroza','Koto Panjang','081343214321',2,2,122.331,-123.123),
(3,'1372025509780021','Joni Amza','Koto Panjang','085257468228',2,2,122.331,-123.123);

/*Table structure for table `rt` */

DROP TABLE IF EXISTS `rt`;

CREATE TABLE `rt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rw_id` int(11) NOT NULL,
  `nama_rt` varchar(10) NOT NULL,
  `ketua_rt` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `rt` */

insert  into `rt`(`id`,`rw_id`,`nama_rt`,`ketua_rt`) values 
(2,1,'01','Ahmad S');

/*Table structure for table `rw` */

DROP TABLE IF EXISTS `rw`;

CREATE TABLE `rw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_rw` varchar(3) NOT NULL,
  `ketua_rw` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `rw` */

insert  into `rw`(`id`,`nama_rw`,`ketua_rw`) values 
(1,'01','Muslim Siregar'),
(2,'02','Sanusi Son'),
(3,'03','Jon Kapak');

/*Table structure for table `user_akun` */

DROP TABLE IF EXISTS `user_akun`;

CREATE TABLE `user_akun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` enum('admin','staff') NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user_akun` */

insert  into `user_akun`(`id`,`username`,`password`,`hak_akses`,`status`,`nama`,`nip`) values 
(1,'staff','1253208465b1efa876f982d8a9e73eef','staff',1,'RICO SAPUTRA S, STP','199103132014061001');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
