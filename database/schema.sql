-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: tisamidb
-- ------------------------------------------------------
-- Server version	5.7.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_accessories`
--

DROP TABLE IF EXISTS `tbl_accessories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_accessories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset` varchar(45) NOT NULL DEFAULT '',
  `qty` varchar(45) NOT NULL DEFAULT '',
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) DEFAULT NULL,
  `colname` varchar(45) NOT NULL DEFAULT '',
  `type` varchar(45) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_adstatus`
--

DROP TABLE IF EXISTS `tbl_adstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_adstatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_applicationservice`
--

DROP TABLE IF EXISTS `tbl_applicationservice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_applicationservice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `applicationName` varchar(100) NOT NULL DEFAULT '',
  `managedBy` varchar(45) NOT NULL DEFAULT '',
  `shortDescription` varchar(50) NOT NULL DEFAULT '',
  `applicationSupplier` varchar(45) NOT NULL DEFAULT '',
  `supportContract` varchar(45) NOT NULL DEFAULT '',
  `contractStartDate` date DEFAULT NULL,
  `contractEndDate` date DEFAULT NULL,
  `authenticationMode` varchar(45) NOT NULL DEFAULT '',
  `applicationType` varchar(50) NOT NULL DEFAULT '',
  `vpn` varchar(45) NOT NULL DEFAULT '',
  `database` varchar(45) NOT NULL DEFAULT '',
  `hosting` varchar(45) NOT NULL DEFAULT '',
  `license` varchar(45) NOT NULL DEFAULT '',
  `link` varchar(80) NOT NULL DEFAULT '',
  `annualCost` varchar(45) NOT NULL DEFAULT '',
  `monthlyCost` varchar(45) NOT NULL DEFAULT '',
  `numberUsers` varchar(45) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `operationGroup` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_assetloan`
--

DROP TABLE IF EXISTS `tbl_assetloan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assetloan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `igg` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(45) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `contactNo` varchar(45) NOT NULL DEFAULT '',
  `asset` varchar(45) NOT NULL DEFAULT '',
  `qty` varchar(45) NOT NULL DEFAULT '',
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `remarks` text NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '',
  `approvedBy` varchar(100) NOT NULL DEFAULT '',
  `approvedDate` datetime DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(100) NOT NULL DEFAULT '',
  `ref_id` varchar(45) NOT NULL DEFAULT '',
  `comments` text NOT NULL,
  `country` varchar(45) NOT NULL DEFAULT '',
  `loanStatus` varchar(45) NOT NULL DEFAULT '',
  `returnRemarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_assetloan_assets`
--

DROP TABLE IF EXISTS `tbl_assetloan_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assetloan_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_assetmain`
--

DROP TABLE IF EXISTS `tbl_assetmain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assetmain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT '',
  `model` varchar(45) NOT NULL DEFAULT '',
  `assetStatus` varchar(45) NOT NULL DEFAULT '',
  `macAddress` varchar(45) NOT NULL DEFAULT '',
  `serial` varchar(45) NOT NULL DEFAULT '',
  `assetTag` varchar(45) NOT NULL DEFAULT '',
  `computerName` varchar(45) NOT NULL DEFAULT '',
  `assetCondition` varchar(45) NOT NULL DEFAULT '',
  `deliveryDate` date DEFAULT NULL,
  `warranty` varchar(45) NOT NULL DEFAULT '',
  `os` varchar(45) NOT NULL DEFAULT '',
  `assetRemarks` text,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `datetime` datetime DEFAULT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `brand` varchar(45) NOT NULL DEFAULT '',
  `activeDirectory` varchar(45) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  `osVersion` varchar(40) NOT NULL DEFAULT '',
  `supplier` varchar(32) NOT NULL DEFAULT '',
  `disposalDate` datetime DEFAULT NULL,
  `department` varchar(45) NOT NULL DEFAULT '',
  `recoveryKey` varchar(55) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_assetmainlogs`
--

DROP TABLE IF EXISTS `tbl_assetmainlogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assetmainlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serial` varchar(45) NOT NULL DEFAULT '',
  `assignedTo` varchar(255) NOT NULL DEFAULT '',
  `igg` varchar(45) NOT NULL DEFAULT '',
  `department` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT '',
  `bag` varchar(45) NOT NULL DEFAULT 'NO',
  `keyboard` varchar(45) NOT NULL DEFAULT 'NO',
  `mouse` varchar(45) NOT NULL DEFAULT 'NO',
  `ups` varchar(45) NOT NULL DEFAULT 'NO',
  `charger` varchar(45) NOT NULL DEFAULT 'NO',
  `dockingStation` varchar(45) NOT NULL DEFAULT 'NO',
  `monitor1` varchar(45) NOT NULL DEFAULT 'NO',
  `monitor2` varchar(45) NOT NULL DEFAULT 'NO',
  `permanentForms` varchar(255) NOT NULL DEFAULT '',
  `returnForms` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(45) NOT NULL DEFAULT '',
  `remarks` text NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_assetstatus`
--

DROP TABLE IF EXISTS `tbl_assetstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assetstatus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_assettype`
--

DROP TABLE IF EXISTS `tbl_assettype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assettype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_condition`
--

DROP TABLE IF EXISTS `tbl_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_condition` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_location`
--

DROP TABLE IF EXISTS `tbl_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_office`
--

DROP TABLE IF EXISTS `tbl_office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_office` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `office` varchar(255) NOT NULL DEFAULT '',
  `country` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_os`
--

DROP TABLE IF EXISTS `tbl_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_os` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `os` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_role`
--

DROP TABLE IF EXISTS `tbl_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_subscription`
--

DROP TABLE IF EXISTS `tbl_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_subscription` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscription` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_type`
--

DROP TABLE IF EXISTS `tbl_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `main` varchar(45) NOT NULL DEFAULT '',
  `mobile` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL DEFAULT '',
  `password` varchar(45) NOT NULL DEFAULT '',
  `role` varchar(45) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `lastChanged` datetime DEFAULT NULL,
  `byUser` varchar(45) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(45) NOT NULL DEFAULT '',
  `icon` varchar(45) NOT NULL DEFAULT '',
  `status` varchar(45) NOT NULL DEFAULT '',
  `datetime` datetime DEFAULT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-30 15:30:36
