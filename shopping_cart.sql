/*
SQLyog Ultimate v12.5.1 (32 bit)
MySQL - 8.0.25 : Database - tasks
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tasks` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `tasks`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cartId` int unsigned NOT NULL AUTO_INCREMENT,
  `cartItemId` int DEFAULT NULL COMMENT 'Only save the ID, not for foreign key purpose.',
  `cartItemNo` varchar(50) DEFAULT NULL,
  `cartItemName` varchar(255) NOT NULL,
  `cartItemUnitId` int NOT NULL,
  `cartItemUnitName` varchar(50) DEFAULT NULL,
  `cartItemCategoryId` int DEFAULT NULL,
  `cartItemCategoryName` varchar(100) DEFAULT NULL,
  `cartItemQty` int NOT NULL,
  `cartItemBrand` varchar(50) DEFAULT NULL,
  `cartItemWeight` float DEFAULT NULL,
  `cartItemDescription` text,
  `cartItemTransactionId` int unsigned DEFAULT NULL,
  `cartItemPriceDefault` decimal(14,2) NOT NULL,
  `cartItemPriceCart` decimal(14,2) NOT NULL,
  `cartNote` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `cartIsCheckedOut` smallint DEFAULT NULL COMMENT '1: yes; 0: not yet;',
  `cartUserUsername` varchar(50) NOT NULL,
  `cartUserName` varchar(50) NOT NULL,
  `cartDateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cartId`),
  KEY `cartItemCategoryId` (`cartItemCategoryId`),
  KEY `cartItemUnitId` (`cartItemUnitId`),
  KEY `cartItemTransactionId` (`cartItemTransactionId`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cartItemCategoryId`) REFERENCES `ref_category` (`refcatId`) ON UPDATE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cartItemUnitId`) REFERENCES `ref_unit` (`refunitId`) ON UPDATE CASCADE,
  CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`cartItemTransactionId`) REFERENCES `transaction` (`transId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `item` */

DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
  `itemId` int unsigned NOT NULL AUTO_INCREMENT,
  `itemNo` varchar(50) DEFAULT NULL COMMENT 'Item number/number of product',
  `itemName` varchar(255) NOT NULL,
  `itemCategory` int NOT NULL,
  `itemUnit` int NOT NULL,
  `itemBrand` varchar(50) DEFAULT NULL,
  `itemStock` varchar(20) DEFAULT '0',
  `itemWeight` float DEFAULT NULL,
  `itemPrice` decimal(14,2) NOT NULL,
  `itemDescription` text,
  `itemIsShow` smallint DEFAULT '1' COMMENT '1: show; 0: hide',
  `itemUserUsername` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `itemUserName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `itemDateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemId`),
  KEY `itemCategory` (`itemCategory`),
  KEY `itemUnit` (`itemUnit`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`itemCategory`) REFERENCES `ref_category` (`refcatId`) ON UPDATE CASCADE,
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`itemUnit`) REFERENCES `ref_unit` (`refunitId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `item_image` */

DROP TABLE IF EXISTS `item_image`;

CREATE TABLE `item_image` (
  `itpictId` int NOT NULL AUTO_INCREMENT,
  `itpictItem` int unsigned NOT NULL,
  `itpictName` varchar(255) DEFAULT NULL,
  `itpictFile` text,
  PRIMARY KEY (`itpictId`),
  KEY `itpictItem` (`itpictItem`),
  CONSTRAINT `item_image_ibfk_1` FOREIGN KEY (`itpictItem`) REFERENCES `item` (`itemId`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `ref_category` */

DROP TABLE IF EXISTS `ref_category`;

CREATE TABLE `ref_category` (
  `refcatId` int NOT NULL AUTO_INCREMENT,
  `refcatName` varchar(100) NOT NULL,
  `refcatParent` int DEFAULT NULL COMMENT 'Parent ID is ''refcatId'', left it NULL if no parent.',
  PRIMARY KEY (`refcatId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `ref_unit` */

DROP TABLE IF EXISTS `ref_unit`;

CREATE TABLE `ref_unit` (
  `refunitId` int NOT NULL AUTO_INCREMENT,
  `refunitName` varchar(50) NOT NULL,
  PRIMARY KEY (`refunitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `transaction` */

DROP TABLE IF EXISTS `transaction`;

CREATE TABLE `transaction` (
  `transId` int unsigned NOT NULL AUTO_INCREMENT,
  `transCode` varchar(50) NOT NULL,
  `transIsCheckedOut` smallint NOT NULL DEFAULT '0' COMMENT '1: yes; 0: not yet;',
  `transCheckoutDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `transPriceDefaultTotal` decimal(14,2) DEFAULT NULL,
  `transPriceCartTotal` decimal(14,2) DEFAULT NULL,
  `transUserUsernameCommit` varchar(50) DEFAULT NULL,
  `transUserNameCommit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`transId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
