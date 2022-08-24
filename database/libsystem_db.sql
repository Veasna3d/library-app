/*
SQLyog Enterprise - MySQL GUI v8.18 
MySQL - 5.5.5-10.4.22-MariaDB : Database - libsystem
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`libsystem` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `libsystem`;

/*Table structure for table `tbl_book` */

DROP TABLE IF EXISTS `tbl_book`;

CREATE TABLE `tbl_book` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Category_Id` int(11) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `tbl_borrow`;

CREATE TABLE `tbl_borrow` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Student_Id` int(11) NOT NULL,
  `Class_Id` int(11) NOT NULL,
  `Book_Id` int(11) NOT NULL,
  `Date_borrow` datetime NOT NULL,
  `Date_return` datetime NOT NULL,
  `Status` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_borrow` */

/*Table structure for table `tbl_category` */

DROP TABLE IF EXISTS `tbl_category`;

CREATE TABLE `tbl_category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_category` */

/*Table structure for table `tbl_class` */

DROP TABLE IF EXISTS `tbl_class`;

CREATE TABLE `tbl_class` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_class` */

/*Table structure for table `tbl_return` */

DROP TABLE IF EXISTS `tbl_return`;

CREATE TABLE `tbl_return` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Student_Id` int(11) NOT NULL,
  `Class_Id` int(11) NOT NULL,
  `Book_Id` int(11) NOT NULL,
  `Date_return` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_return` */

/*Table structure for table `tbl_student` */

DROP TABLE IF EXISTS `tbl_student`;

CREATE TABLE `tbl_student` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Student_Id` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `Class_Id` int(11) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `tbl_student_fk0` (`Class_Id`),
  CONSTRAINT `tbl_student_fk0` FOREIGN KEY (`Class_Id`) REFERENCES `tbl_class` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_student` */

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `User_type` varchar(50) NOT NULL,
  `User_ip` varchar(100) NOT NULL,
  `Verify_password` int(11) NOT NULL,
  `Timelogin` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`Id`,`Username`,`Password`,`Email`,`Image`,`User_type`,`User_ip`,`Verify_password`,`Timelogin`) values (1,'Veasna','12345678','Veasna@gmail.com','me.png','user','',0,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
