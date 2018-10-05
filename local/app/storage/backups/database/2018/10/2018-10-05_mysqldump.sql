-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: skubbsde_skhrms_1
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (8,'Skubbs','skubbs.dev@gmail.com','$2y$10$Oy6UYCBzugoODa717x2KK.gaZ2PyunOJ4v7ANFW7U5ph1UJHl3Ke2',0,'2018-06-18 10:47:35','ma6hiU9AYBcNAWkAOkjx5wkiHuFHabLW4DRHoDBwnbFWgYq9b0QemBqQSrg3','0000-00-00 00:00:00','2018-08-09 02:43:11'),(9,'Randy b','rhanbarredo@gmail.com','$2y$10$wYQtZfXhHcotoGrTWfR9RO6ZzG3WgTO..uoSjW0t6YVMBTjTEFP2W',0,'2018-09-21 12:28:27','7sH7HpYsFbymbcz4g6cvJVpxQTkKKalKR8RtJnZReWCvFaEqRRzHEoopFrji','2018-08-09 02:42:28','2018-09-21 04:28:27'),(11,'HRS','hrs@mail.com','$2y$10$5MHNTZ8PSSQuo3fCLmEcAe19eUOH/MmdtET8ZwLJ7pV/kCzWa5Cd.',3,'2018-09-21 11:31:42','9XwxxclJBgtVPWCTKjuSIFNWvXsnTYKHuTHUOPzcsJLBqyLnvEaUSq66ZgUE','2018-08-24 09:26:00','2018-09-21 04:06:55'),(12,'Operation','operation@mail.com','$2y$10$qo.DXllVLgQSR/ft0hrBauReQIAs1B/vMfocRtMaRKX8Iq5D4kLZC',4,'0000-00-00 00:00:00',NULL,'2018-09-12 03:36:16','2018-09-12 03:36:16'),(13,'Administration','admin@mail.com','$2y$10$HWjecluhxStnPo4N/QBccO5XR0yJ0P3K2z5kW6EJeU.Oxr1B1Uv/2',1,'2018-09-12 17:23:39','Dhrl4EobKJSL1xxedAWvZvV8sj2wbZb0iN3mDXRSZqNxnc1NEcWUj3GmKZr3','2018-09-12 03:41:31','2018-09-12 10:33:47'),(14,'Finance','finance@mail.com','$2y$10$9qGKmhVcqPEkeCVm5PjyQeLfGnqrzCMHJysry6a2U72HNhvu7g6Am',2,'0000-00-00 00:00:00',NULL,'2018-09-12 03:42:15','2018-09-12 03:42:15'),(15,'Innovation and Marketing','innov_marketing@mail.com','$2y$10$dj2aMn96wgLKFBP1/THxmOltc4GssgEFH.dyk/Pkhq1XYpjb7Z3Gu',5,'0000-00-00 00:00:00',NULL,'2018-09-12 03:44:51','2018-09-12 03:44:51'),(16,'Production','production@mail.com','$2y$10$rHG8pg/WggXiWG9VcRFtY.C7gkIYh8J8h0supGq0Q8MvZj9MNzHg.',6,'2018-09-21 11:03:21','6OOcXKQtRBLDq1BO776oW4y0eBoYEe0W5aTgqjvriGOAZpBIkepIgqFrv5zS','2018-09-12 06:26:40','2018-09-21 03:04:51'),(17,'NCR','ncr@mail.com','$2y$10$MDr5xjQ68rlTIpu7/gbyW.QwKtx8IHIlJssSacnH9Ptxw5tF/nwW6',7,'2018-09-12 18:41:16','yLVy5Ecui8L8mfmMlDY2YGo7Ojof0VgYRq8UXbMI12ZbSj7azpeFbOtDvCXh','2018-09-12 10:40:58','2018-09-12 10:43:23'),(18,'Provincial@mail.com','provincial@mail.com','$2y$10$w0lCLdJljzHgqZqiyjyT/.J/w2QxCC996vz9gHJ0YEfha6F6xX0CS',8,'2018-09-12 18:43:38','wwbou8dL3NmccCYg6Nax8Xj3Y9A37GpgqDkvrjAvF2gkViXsi02UDGIUERZA','2018-09-12 10:43:13','2018-09-13 05:22:44');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appraisal_questions`
--

DROP TABLE IF EXISTS `appraisal_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appraisal_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `app_for` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appraisal_questions`
--

LOCK TABLES `appraisal_questions` WRITE;
/*!40000 ALTER TABLE `appraisal_questions` DISABLE KEYS */;
INSERT INTO `appraisal_questions` VALUES (1,'Skill And Proficiency in carrying out assignments',2,NULL),(2,'Possesses skills and knowledge to perform the job competently',2,NULL),(3,'Skill And Proficiency in carrying out assignments',1,NULL),(4,'Possesses skills and knowledge to perform the job competently',1,NULL),(5,'Skill at planning, organizing and prioritizing workload (For self and direct reports, if applicable)',2,NULL),(6,'Holds self accountable for assigned responsibilities; sees tasks through to completion in a timely manner.',2,NULL),(7,'Proficiency at improving work methods and procedures as a means toward greater efficiency',2,NULL),(8,'Communicates effectively with supervisors, peers, and customers',2,NULL),(9,'Ability to work independently',2,NULL),(10,'Ability to work cooperatively with supervisors or as part of a team',2,NULL),(11,'Willingness to take on additional responsibilities',2,NULL),(12,'Reliability (attendance, punctuality, meeting deadlines)',2,NULL),(13,'Adeptness at analyzing facts, problem solving, decision-making, and demonstrating good judgement.',2,NULL),(14,'Displays fairness towards peers',2,NULL),(15,'Identifies performance expectations, gives timely feedback and conducts formal performance appraisals.',2,NULL),(16,'Helps employees to see the potential for developing their skills; assist them in eliminating barriers, to their development.',2,NULL),(17,'Delegates responsibility where appropriate, based on the employee\'s ability and potential',2,NULL);
/*!40000 ALTER TABLE `appraisal_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` enum('absent','present') COLLATE utf8_unicode_ci NOT NULL,
  `leaveType` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `halfDayType` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `application_status` enum('approved','rejected','pending') COLLATE utf8_unicode_ci DEFAULT NULL,
  `applied_on` date DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendance_employeeid_date_unique` (`employeeID`,`date`),
  KEY `attendance_employeeid_index` (`employeeID`),
  KEY `attendance_leavetype_index` (`leaveType`),
  KEY `attendance_updated_by_index` (`updated_by`),
  KEY `attendance_halfdaytype_index` (`halfDayType`),
  CONSTRAINT `attendance_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_halfdaytype_foreign` FOREIGN KEY (`halfDayType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_leavetype_foreign` FOREIGN KEY (`leaveType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (1,'SKUBBS01','2018-10-11','absent','sick_leave',NULL,'Test','approved','2018-10-03','rhanbarredo@gmail.com','2018-10-03 06:10:45','2018-10-03 06:10:45'),(2,'SKUBBS01','2018-10-12','absent','sick_leave',NULL,'Test','approved','2018-10-03','rhanbarredo@gmail.com','2018-10-03 06:10:45','2018-10-03 06:10:46'),(3,'TGSD-16-151R','2018-10-04','absent','sick_leave',NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:56','2018-10-04 11:21:12'),(4,'TGSD-16-150','2018-10-04','absent','sick_leave',NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:56','2018-10-04 11:21:13'),(5,'SKUBBS01','2018-10-04','absent','sick_leave',NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:57','2018-10-04 11:21:13'),(6,'TGSD-16-120','2018-10-04','absent','sick_leave',NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:57','2018-10-04 11:21:13'),(7,'TGSD-16-121','2018-10-04','present',NULL,NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:57','2018-10-04 11:05:57'),(8,'TGSD-16-159','2018-10-04','present',NULL,NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:58','2018-10-04 11:05:58'),(9,'TGSD-16-163','2018-10-04','present',NULL,NULL,'',NULL,NULL,'rhanbarredo@gmail.com','2018-10-04 11:05:58','2018-10-04 11:05:58');
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awards`
--

DROP TABLE IF EXISTS `awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `awards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `awardName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gift` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cashPrice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forMonth` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `forYear` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `awards_employeeid_index` (`employeeID`),
  CONSTRAINT `awards_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awards`
--

LOCK TABLES `awards` WRITE;
/*!40000 ALTER TABLE `awards` DISABLE KEYS */;
INSERT INTO `awards` VALUES (1,'TGSD-16-151R','TEST AWARD EDITED','TEST GIFT','10000','september','2013','2018-09-13 04:28:11','2018-09-13 05:08:48');
/*!40000 ALTER TABLE `awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_details`
--

DROP TABLE IF EXISTS `bank_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `accountName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `accountNumber` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ifsc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bsb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_details_employeeid_index` (`employeeID`),
  CONSTRAINT `bank_details_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_details`
--

LOCK TABLES `bank_details` WRITE;
/*!40000 ALTER TABLE `bank_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `designationID` int(10) unsigned NOT NULL,
  `branch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `branch_designationid_foreign` (`designationID`),
  CONSTRAINT `branch_designationid_foreign` FOREIGN KEY (`designationID`) REFERENCES `designation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,54,'SM Mega Mall','0000-00-00 00:00:00','2018-09-11 04:27:32'),(2,54,'SM Sucat','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,55,'SM Davao','2018-09-10 08:59:49','2018-09-10 08:59:49'),(5,55,'SM Cebu','2018-09-10 08:59:49','2018-09-10 08:59:49');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_advance`
--

DROP TABLE IF EXISTS `cash_advance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cash_advance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `approved_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('approved','rejected','pending') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `cash_advance_employeeid_index` (`employeeID`),
  CONSTRAINT `cash_advance_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_advance`
--

LOCK TABLES `cash_advance` WRITE;
/*!40000 ALTER TABLE `cash_advance` DISABLE KEYS */;
INSERT INTO `cash_advance` VALUES (10,'TGSD-16-150',1500,'','','','pending','2018-09-25 05:54:39','2018-09-25 05:54:39'),(12,'SKUBBS01',15000,'9','Invalid remarks','Allowance','rejected','2018-09-25 10:39:05','2018-09-27 05:06:37'),(14,'SKUBBS01',2000,'9','','Test','approved','2018-09-25 11:10:02','2018-09-26 02:07:22');
/*!40000 ALTER TABLE `cash_advance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id_countries` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `iso_alpha2` varchar(2) DEFAULT NULL,
  `iso_alpha3` varchar(3) DEFAULT NULL,
  `iso_numeric` int(11) DEFAULT NULL,
  `currency_code` char(3) DEFAULT NULL,
  `currency_name` varchar(32) DEFAULT NULL,
  `currency_symbol` varchar(3) DEFAULT NULL,
  `flag` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id_countries`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan','AF','AFG',4,'AFN','Afghani','؋','AF.png'),(2,'Albania','AL','ALB',8,'ALL','Lek','Lek','AL.png'),(3,'Algeria','DZ','DZA',12,'DZD','Dinar',NULL,'DZ.png'),(4,'American Samoa','AS','ASM',16,'USD','Dollar','$','AS.png'),(5,'Andorra','AD','AND',20,'EUR','Euro','€','AD.png'),(6,'Angola','AO','AGO',24,'AOA','Kwanza','Kz','AO.png'),(7,'Anguilla','AI','AIA',660,'XCD','Dollar','$','AI.png'),(8,'Antarctica','AQ','ATA',10,'','',NULL,'AQ.png'),(9,'Antigua and Barbuda','AG','ATG',28,'XCD','Dollar','$','AG.png'),(10,'Argentina','AR','ARG',32,'ARS','Peso','$','AR.png'),(11,'Armenia','AM','ARM',51,'AMD','Dram',NULL,'AM.png'),(12,'Aruba','AW','ABW',533,'AWG','Guilder','ƒ','AW.png'),(13,'Australia','AU','AUS',36,'AUD','Dollar','$','AU.png'),(14,'Austria','AT','AUT',40,'EUR','Euro','€','AT.png'),(15,'Azerbaijan','AZ','AZE',31,'AZN','Manat','ман','AZ.png'),(16,'Bahamas','BS','BHS',44,'BSD','Dollar','$','BS.png'),(17,'Bahrain','BH','BHR',48,'BHD','Dinar',NULL,'BH.png'),(18,'Bangladesh','BD','BGD',50,'BDT','Taka',NULL,'BD.png'),(19,'Barbados','BB','BRB',52,'BBD','Dollar','$','BB.png'),(20,'Belarus','BY','BLR',112,'BYR','Ruble','p.','BY.png'),(21,'Belgium','BE','BEL',56,'EUR','Euro','€','BE.png'),(22,'Belize','BZ','BLZ',84,'BZD','Dollar','BZ$','BZ.png'),(23,'Benin','BJ','BEN',204,'XOF','Franc',NULL,'BJ.png'),(24,'Bermuda','BM','BMU',60,'BMD','Dollar','$','BM.png'),(25,'Bhutan','BT','BTN',64,'BTN','Ngultrum',NULL,'BT.png'),(26,'Bolivia','BO','BOL',68,'BOB','Boliviano','$b','BO.png'),(27,'Bosnia and Herzegovina','BA','BIH',70,'BAM','Marka','KM','BA.png'),(28,'Botswana','BW','BWA',72,'BWP','Pula','P','BW.png'),(29,'Bouvet Island','BV','BVT',74,'NOK','Krone','kr','BV.png'),(30,'Brazil','BR','BRA',76,'BRL','Real','R$','BR.png'),(31,'British Indian Ocean Territory','IO','IOT',86,'USD','Dollar','$','IO.png'),(32,'British Virgin Islands','VG','VGB',92,'USD','Dollar','$','VG.png'),(33,'Brunei','BN','BRN',96,'BND','Dollar','$','BN.png'),(34,'Bulgaria','BG','BGR',100,'BGN','Lev','лв','BG.png'),(35,'Burkina Faso','BF','BFA',854,'XOF','Franc',NULL,'BF.png'),(36,'Burundi','BI','BDI',108,'BIF','Franc',NULL,'BI.png'),(37,'Cambodia','KH','KHM',116,'KHR','Riels','៛','KH.png'),(38,'Cameroon','CM','CMR',120,'XAF','Franc','FCF','CM.png'),(39,'Canada','CA','CAN',124,'CAD','Dollar','$','CA.png'),(40,'Cape Verde','CV','CPV',132,'CVE','Escudo',NULL,'CV.png'),(41,'Cayman Islands','KY','CYM',136,'KYD','Dollar','$','KY.png'),(42,'Central African Republic','CF','CAF',140,'XAF','Franc','FCF','CF.png'),(43,'Chad','TD','TCD',148,'XAF','Franc',NULL,'TD.png'),(44,'Chile','CL','CHL',152,'CLP','Peso',NULL,'CL.png'),(45,'China','CN','CHN',156,'CNY','Yuan Renminbi','¥','CN.png'),(46,'Christmas Island','CX','CXR',162,'AUD','Dollar','$','CX.png'),(47,'Cocos Islands','CC','CCK',166,'AUD','Dollar','$','CC.png'),(48,'Colombia','CO','COL',170,'COP','Peso','$','CO.png'),(49,'Comoros','KM','COM',174,'KMF','Franc',NULL,'KM.png'),(50,'Cook Islands','CK','COK',184,'NZD','Dollar','$','CK.png'),(51,'Costa Rica','CR','CRI',188,'CRC','Colon','₡','CR.png'),(52,'Croatia','HR','HRV',191,'HRK','Kuna','kn','HR.png'),(53,'Cuba','CU','CUB',192,'CUP','Peso','₱','CU.png'),(54,'Cyprus','CY','CYP',196,'CYP','Pound',NULL,'CY.png'),(55,'Czech Republic','CZ','CZE',203,'CZK','Koruna','Kč','CZ.png'),(56,'Democratic Republic of the Congo','CD','COD',180,'CDF','Franc',NULL,'CD.png'),(57,'Denmark','DK','DNK',208,'DKK','Krone','kr','DK.png'),(58,'Djibouti','DJ','DJI',262,'DJF','Franc',NULL,'DJ.png'),(59,'Dominica','DM','DMA',212,'XCD','Dollar','$','DM.png'),(60,'Dominican Republic','DO','DOM',214,'DOP','Peso','RD$','DO.png'),(61,'East Timor','TL','TLS',626,'USD','Dollar','$','TL.png'),(62,'Ecuador','EC','ECU',218,'USD','Dollar','$','EC.png'),(63,'Egypt','EG','EGY',818,'EGP','Pound','£','EG.png'),(64,'El Salvador','SV','SLV',222,'SVC','Colone','$','SV.png'),(65,'Equatorial Guinea','GQ','GNQ',226,'XAF','Franc','FCF','GQ.png'),(66,'Eritrea','ER','ERI',232,'ERN','Nakfa','Nfk','ER.png'),(67,'Estonia','EE','EST',233,'EEK','Kroon','kr','EE.png'),(68,'Ethiopia','ET','ETH',231,'ETB','Birr',NULL,'ET.png'),(69,'Falkland Islands','FK','FLK',238,'FKP','Pound','£','FK.png'),(70,'Faroe Islands','FO','FRO',234,'DKK','Krone','kr','FO.png'),(71,'Fiji','FJ','FJI',242,'FJD','Dollar','$','FJ.png'),(72,'Finland','FI','FIN',246,'EUR','Euro','€','FI.png'),(73,'France','FR','FRA',250,'EUR','Euro','€','FR.png'),(74,'French Guiana','GF','GUF',254,'EUR','Euro','€','GF.png'),(75,'French Polynesia','PF','PYF',258,'XPF','Franc',NULL,'PF.png'),(76,'French Southern Territories','TF','ATF',260,'EUR','Euro  ','€','TF.png'),(77,'Gabon','GA','GAB',266,'XAF','Franc','FCF','GA.png'),(78,'Gambia','GM','GMB',270,'GMD','Dalasi','D','GM.png'),(79,'Georgia','GE','GEO',268,'GEL','Lari',NULL,'GE.png'),(80,'Germany','DE','DEU',276,'EUR','Euro','€','DE.png'),(81,'Ghana','GH','GHA',288,'GHC','Cedi','¢','GH.png'),(82,'Gibraltar','GI','GIB',292,'GIP','Pound','£','GI.png'),(83,'Greece','GR','GRC',300,'EUR','Euro','€','GR.png'),(84,'Greenland','GL','GRL',304,'DKK','Krone','kr','GL.png'),(85,'Grenada','GD','GRD',308,'XCD','Dollar','$','GD.png'),(86,'Guadeloupe','GP','GLP',312,'EUR','Euro','€','GP.png'),(87,'Guam','GU','GUM',316,'USD','Dollar','$','GU.png'),(88,'Guatemala','GT','GTM',320,'GTQ','Quetzal','Q','GT.png'),(89,'Guinea','GN','GIN',324,'GNF','Franc',NULL,'GN.png'),(90,'Guinea-Bissau','GW','GNB',624,'XOF','Franc',NULL,'GW.png'),(91,'Guyana','GY','GUY',328,'GYD','Dollar','$','GY.png'),(92,'Haiti','HT','HTI',332,'HTG','Gourde','G','HT.png'),(93,'Heard Island and McDonald Islands','HM','HMD',334,'AUD','Dollar','$','HM.png'),(94,'Honduras','HN','HND',340,'HNL','Lempira','L','HN.png'),(95,'Hong Kong','HK','HKG',344,'HKD','Dollar','$','HK.png'),(96,'Hungary','HU','HUN',348,'HUF','Forint','Ft','HU.png'),(97,'Iceland','IS','ISL',352,'ISK','Krona','kr','IS.png'),(98,'India','IN','IND',356,'INR','Rupee','₹','IN.png'),(99,'Indonesia','ID','IDN',360,'IDR','Rupiah','Rp','ID.png'),(100,'Iran','IR','IRN',364,'IRR','Rial','﷼','IR.png'),(101,'Iraq','IQ','IRQ',368,'IQD','Dinar',NULL,'IQ.png'),(102,'Ireland','IE','IRL',372,'EUR','Euro','€','IE.png'),(103,'Israel','IL','ISR',376,'ILS','Shekel','₪','IL.png'),(104,'Italy','IT','ITA',380,'EUR','Euro','€','IT.png'),(105,'Ivory Coast','CI','CIV',384,'XOF','Franc',NULL,'CI.png'),(106,'Jamaica','JM','JAM',388,'JMD','Dollar','$','JM.png'),(107,'Japan','JP','JPN',392,'JPY','Yen','¥','JP.png'),(108,'Jordan','JO','JOR',400,'JOD','Dinar',NULL,'JO.png'),(109,'Kazakhstan','KZ','KAZ',398,'KZT','Tenge','лв','KZ.png'),(110,'Kenya','KE','KEN',404,'KES','Shilling',NULL,'KE.png'),(111,'Kiribati','KI','KIR',296,'AUD','Dollar','$','KI.png'),(112,'Kuwait','KW','KWT',414,'KWD','Dinar',NULL,'KW.png'),(113,'Kyrgyzstan','KG','KGZ',417,'KGS','Som','лв','KG.png'),(114,'Laos','LA','LAO',418,'LAK','Kip','₭','LA.png'),(115,'Latvia','LV','LVA',428,'LVL','Lat','Ls','LV.png'),(116,'Lebanon','LB','LBN',422,'LBP','Pound','£','LB.png'),(117,'Lesotho','LS','LSO',426,'LSL','Loti','L','LS.png'),(118,'Liberia','LR','LBR',430,'LRD','Dollar','$','LR.png'),(119,'Libya','LY','LBY',434,'LYD','Dinar',NULL,'LY.png'),(120,'Liechtenstein','LI','LIE',438,'CHF','Franc','CHF','LI.png'),(121,'Lithuania','LT','LTU',440,'LTL','Litas','Lt','LT.png'),(122,'Luxembourg','LU','LUX',442,'EUR','Euro','€','LU.png'),(123,'Macao','MO','MAC',446,'MOP','Pataca','MOP','MO.png'),(124,'Macedonia','MK','MKD',807,'MKD','Denar','ден','MK.png'),(125,'Madagascar','MG','MDG',450,'MGA','Ariary',NULL,'MG.png'),(126,'Malawi','MW','MWI',454,'MWK','Kwacha','MK','MW.png'),(127,'Malaysia','MY','MYS',458,'MYR','Ringgit','RM','MY.png'),(128,'Maldives','MV','MDV',462,'MVR','Rufiyaa','Rf','MV.png'),(129,'Mali','ML','MLI',466,'XOF','Franc',NULL,'ML.png'),(130,'Malta','MT','MLT',470,'MTL','Lira',NULL,'MT.png'),(131,'Marshall Islands','MH','MHL',584,'USD','Dollar','$','MH.png'),(132,'Martinique','MQ','MTQ',474,'EUR','Euro','€','MQ.png'),(133,'Mauritania','MR','MRT',478,'MRO','Ouguiya','UM','MR.png'),(134,'Mauritius','MU','MUS',480,'MUR','Rupee','₨','MU.png'),(135,'Mayotte','YT','MYT',175,'EUR','Euro','€','YT.png'),(136,'Mexico','MX','MEX',484,'MXN','Peso','$','MX.png'),(137,'Micronesia','FM','FSM',583,'USD','Dollar','$','FM.png'),(138,'Moldova','MD','MDA',498,'MDL','Leu',NULL,'MD.png'),(139,'Monaco','MC','MCO',492,'EUR','Euro','€','MC.png'),(140,'Mongolia','MN','MNG',496,'MNT','Tugrik','₮','MN.png'),(141,'Montserrat','MS','MSR',500,'XCD','Dollar','$','MS.png'),(142,'Morocco','MA','MAR',504,'MAD','Dirham',NULL,'MA.png'),(143,'Mozambique','MZ','MOZ',508,'MZN','Meticail','MT','MZ.png'),(144,'Myanmar','MM','MMR',104,'MMK','Kyat','K','MM.png'),(145,'Namibia','NA','NAM',516,'NAD','Dollar','$','NA.png'),(146,'Nauru','NR','NRU',520,'AUD','Dollar','$','NR.png'),(147,'Nepal','NP','NPL',524,'NPR','Rupee','₨','NP.png'),(148,'Netherlands','NL','NLD',528,'EUR','Euro','€','NL.png'),(149,'Netherlands Antilles','AN','ANT',530,'ANG','Guilder','ƒ','AN.png'),(150,'New Caledonia','NC','NCL',540,'XPF','Franc',NULL,'NC.png'),(151,'New Zealand','NZ','NZL',554,'NZD','Dollar','$','NZ.png'),(152,'Nicaragua','NI','NIC',558,'NIO','Cordoba','C$','NI.png'),(153,'Niger','NE','NER',562,'XOF','Franc',NULL,'NE.png'),(154,'Nigeria','NG','NGA',566,'NGN','Naira','₦','NG.png'),(155,'Niue','NU','NIU',570,'NZD','Dollar','$','NU.png'),(156,'Norfolk Island','NF','NFK',574,'AUD','Dollar','$','NF.png'),(157,'North Korea','KP','PRK',408,'KPW','Won','₩','KP.png'),(158,'Northern Mariana Islands','MP','MNP',580,'USD','Dollar','$','MP.png'),(159,'Norway','NO','NOR',578,'NOK','Krone','kr','NO.png'),(160,'Oman','OM','OMN',512,'OMR','Rial','﷼','OM.png'),(161,'Pakistan','PK','PAK',586,'PKR','Rupee','₨','PK.png'),(162,'Palau','PW','PLW',585,'USD','Dollar','$','PW.png'),(163,'Palestinian Territory','PS','PSE',275,'ILS','Shekel','₪','PS.png'),(164,'Panama','PA','PAN',591,'PAB','Balboa','B/.','PA.png'),(165,'Papua New Guinea','PG','PNG',598,'PGK','Kina',NULL,'PG.png'),(166,'Paraguay','PY','PRY',600,'PYG','Guarani','Gs','PY.png'),(167,'Peru','PE','PER',604,'PEN','Sol','S/.','PE.png'),(168,'Philippines','PH','PHL',608,'PHP','Peso','Php','PH.png'),(169,'Pitcairn','PN','PCN',612,'NZD','Dollar','$','PN.png'),(170,'Poland','PL','POL',616,'PLN','Zloty','zł','PL.png'),(171,'Portugal','PT','PRT',620,'EUR','Euro','€','PT.png'),(172,'Puerto Rico','PR','PRI',630,'USD','Dollar','$','PR.png'),(173,'Qatar','QA','QAT',634,'QAR','Rial','﷼','QA.png'),(174,'Republic of the Congo','CG','COG',178,'XAF','Franc','FCF','CG.png'),(175,'Reunion','RE','REU',638,'EUR','Euro','€','RE.png'),(176,'Romania','RO','ROU',642,'RON','Leu','lei','RO.png'),(177,'Russia','RU','RUS',643,'RUB','Ruble','руб','RU.png'),(178,'Rwanda','RW','RWA',646,'RWF','Franc',NULL,'RW.png'),(179,'Saint Helena','SH','SHN',654,'SHP','Pound','£','SH.png'),(180,'Saint Kitts and Nevis','KN','KNA',659,'XCD','Dollar','$','KN.png'),(181,'Saint Lucia','LC','LCA',662,'XCD','Dollar','$','LC.png'),(182,'Saint Pierre and Miquelon','PM','SPM',666,'EUR','Euro','€','PM.png'),(183,'Saint Vincent and the Grenadines','VC','VCT',670,'XCD','Dollar','$','VC.png'),(184,'Samoa','WS','WSM',882,'WST','Tala','WS$','WS.png'),(185,'San Marino','SM','SMR',674,'EUR','Euro','€','SM.png'),(186,'Sao Tome and Principe','ST','STP',678,'STD','Dobra','Db','ST.png'),(187,'Saudi Arabia','SA','SAU',682,'SAR','Rial','﷼','SA.png'),(188,'Senegal','SN','SEN',686,'XOF','Franc',NULL,'SN.png'),(189,'Serbia and Montenegro','CS','SCG',891,'RSD','Dinar','Дин','CS.png'),(190,'Seychelles','SC','SYC',690,'SCR','Rupee','₨','SC.png'),(191,'Sierra Leone','SL','SLE',694,'SLL','Leone','Le','SL.png'),(192,'Singapore','SG','SGP',702,'SGD','Dollar','$','SG.png'),(193,'Slovakia','SK','SVK',703,'SKK','Koruna','Sk','SK.png'),(194,'Slovenia','SI','SVN',705,'EUR','Euro','€','SI.png'),(195,'Solomon Islands','SB','SLB',90,'SBD','Dollar','$','SB.png'),(196,'Somalia','SO','SOM',706,'SOS','Shilling','S','SO.png'),(197,'South Africa','ZA','ZAF',710,'ZAR','Rand','R','ZA.png'),(198,'South Georgia and the South Sandwich Islands','GS','SGS',239,'GBP','Pound','£','GS.png'),(199,'South Korea','KR','KOR',410,'KRW','Won','₩','KR.png'),(200,'Spain','ES','ESP',724,'EUR','Euro','€','ES.png'),(201,'Sri Lanka','LK','LKA',144,'LKR','Rupee','₨','LK.png'),(202,'Sudan','SD','SDN',736,'SDD','Dinar',NULL,'SD.png'),(203,'Suriname','SR','SUR',740,'SRD','Dollar','$','SR.png'),(204,'Svalbard and Jan Mayen','SJ','SJM',744,'NOK','Krone','kr','SJ.png'),(205,'Swaziland','SZ','SWZ',748,'SZL','Lilangeni',NULL,'SZ.png'),(206,'Sweden','SE','SWE',752,'SEK','Krona','kr','SE.png'),(207,'Switzerland','CH','CHE',756,'CHF','Franc','CHF','CH.png'),(208,'Syria','SY','SYR',760,'SYP','Pound','£','SY.png'),(209,'Taiwan','TW','TWN',158,'TWD','Dollar','NT$','TW.png'),(210,'Tajikistan','TJ','TJK',762,'TJS','Somoni',NULL,'TJ.png'),(211,'Tanzania','TZ','TZA',834,'TZS','Shilling',NULL,'TZ.png'),(212,'Thailand','TH','THA',764,'THB','Baht','฿','TH.png'),(213,'Togo','TG','TGO',768,'XOF','Franc',NULL,'TG.png'),(214,'Tokelau','TK','TKL',772,'NZD','Dollar','$','TK.png'),(215,'Tonga','TO','TON',776,'TOP','Pa\"anga','T$','TO.png'),(216,'Trinidad and Tobago','TT','TTO',780,'TTD','Dollar','TT$','TT.png'),(217,'Tunisia','TN','TUN',788,'TND','Dinar',NULL,'TN.png'),(218,'Turkey','TR','TUR',792,'TRY','Lira','YTL','TR.png'),(219,'Turkmenistan','TM','TKM',795,'TMM','Manat','m','TM.png'),(220,'Turks and Caicos Islands','TC','TCA',796,'USD','Dollar','$','TC.png'),(221,'Tuvalu','TV','TUV',798,'AUD','Dollar','$','TV.png'),(222,'U.S. Virgin Islands','VI','VIR',850,'USD','Dollar','$','VI.png'),(223,'Uganda','UG','UGA',800,'UGX','Shilling',NULL,'UG.png'),(224,'Ukraine','UA','UKR',804,'UAH','Hryvnia','₴','UA.png'),(225,'United Arab Emirates','AE','ARE',784,'AED','Dirham',NULL,'AE.png'),(226,'United Kingdom','GB','GBR',826,'GBP','Pound','£','GB.png'),(227,'United States','US','USA',840,'USD','Dollar','$','US.png'),(228,'United States Minor Outlying Islands','UM','UMI',581,'USD','Dollar ','$','UM.png'),(229,'Uruguay','UY','URY',858,'UYU','Peso','$U','UY.png'),(230,'Uzbekistan','UZ','UZB',860,'UZS','Som','лв','UZ.png'),(231,'Vanuatu','VU','VUT',548,'VUV','Vatu','Vt','VU.png'),(232,'Vatican','VA','VAT',336,'EUR','Euro','€','VA.png'),(233,'Venezuela','VE','VEN',862,'VEF','Bolivar','Bs','VE.png'),(234,'Vietnam','VN','VNM',704,'VND','Dong','₫','VN.png'),(235,'Wallis and Futuna','WF','WLF',876,'XPF','Franc',NULL,'WF.png'),(236,'Western Sahara','EH','ESH',732,'MAD','Dirham',NULL,'EH.png'),(237,'Yemen','YE','YEM',887,'YER','Rial','﷼','YE.png'),(238,'Zambia','ZM','ZMB',894,'ZMK','Kwacha','ZK','ZM.png'),(239,'Zimbabwe','ZW','ZWE',716,'ZWD','Dollar','Z$','ZW.png');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daily_time_records`
--

DROP TABLE IF EXISTS `daily_time_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daily_time_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `timeIn` datetime NOT NULL,
  `timeOut` datetime NOT NULL,
  `breakIn` datetime NOT NULL,
  `breakOut` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_time_records_employeeid_index` (`employeeID`),
  CONSTRAINT `daily_time_records_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daily_time_records`
--

LOCK TABLES `daily_time_records` WRITE;
/*!40000 ALTER TABLE `daily_time_records` DISABLE KEYS */;
INSERT INTO `daily_time_records` VALUES (1,'TGSD-16-120','2018-09-13 09:30:14','2018-09-13 18:30:00','2018-09-12 12:00:00','2018-09-12 13:00:00',1),(3,'TGSD-16-120','2018-09-15 08:00:00','2018-09-15 18:00:00','2018-09-15 12:00:00','2018-09-14 13:00:00',1),(7,'TGSD-16-151R','2018-09-17 11:00:00','2018-09-17 19:00:00','2018-09-17 02:00:00','2018-09-17 03:00:00',1),(8,'TGSD-16-151R','2018-09-17 12:00:00','2018-09-17 19:00:00','2018-09-17 02:00:00','2018-09-17 03:00:00',1),(10,'TGSD-16-151R','2018-09-17 12:10:00','2018-09-17 19:00:00','2018-09-17 03:00:00','2018-09-17 04:00:00',1),(11,'TGSD-16-151R','2018-09-17 12:10:00','2018-09-17 19:00:00','2018-09-17 03:00:00','2018-09-17 04:00:00',1),(12,'TGSD-16-151R','2018-09-17 12:10:00','2018-09-17 21:00:00','2018-09-17 13:30:00','2018-09-17 03:00:00',1),(100,'TGSD-16-150','2018-09-19 09:30:14','2018-09-19 18:30:14','2018-09-19 11:30:14','2018-09-19 12:30:14',1),(101,'TGSD-16-150','2018-09-20 09:30:14','2018-09-20 18:30:14','2018-09-20 11:30:14','2018-09-20 12:30:14',1),(102,'TGSD-16-150','2018-09-21 09:30:14','2018-09-21 18:30:14','2018-09-21 11:30:14','2018-09-21 12:30:14',1),(103,'TGSD-16-150','2018-09-22 09:30:14','2018-09-22 18:30:14','2018-09-22 11:30:14','2018-09-22 12:30:14',1),(104,'TGSD-16-150','2018-09-23 09:30:14','2018-09-23 18:30:14','2018-09-23 11:30:14','2018-09-23 12:30:14',1),(105,'TGSD-16-150','2018-09-19 09:30:14','2018-09-19 18:30:14','2018-09-19 11:30:14','2018-09-19 12:30:14',1),(106,'TGSD-16-150','2018-09-20 09:30:14','2018-09-20 18:30:14','2018-09-20 11:30:14','2018-09-20 12:30:14',1),(107,'TGSD-16-150','2018-09-21 09:30:14','2018-09-21 18:30:14','2018-09-21 11:30:14','2018-09-21 12:30:14',1),(108,'TGSD-16-150','2018-09-22 09:30:14','2018-09-22 18:30:14','2018-09-22 11:30:14','2018-09-22 12:30:14',1),(109,'TGSD-16-150','2018-09-23 09:30:14','2018-09-23 18:30:14','2018-09-23 11:30:14','2018-09-23 12:30:14',1);
/*!40000 ALTER TABLE `daily_time_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deptName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'Employee','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Internal','2018-08-28 10:35:57','2018-08-28 10:35:57'),(5,'External','2018-09-04 07:06:16','2018-09-04 07:06:16');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `designation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deptID` int(10) unsigned NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `designation_deptid_foreign` (`deptID`),
  CONSTRAINT `designation_deptid_foreign` FOREIGN KEY (`deptID`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `designation`
--

LOCK TABLES `designation` WRITE;
/*!40000 ALTER TABLE `designation` DISABLE KEYS */;
INSERT INTO `designation` VALUES (41,1,'Employee','0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,4,'Administration','2018-08-28 10:35:57','2018-08-28 10:35:57'),(49,4,'Finance','2018-08-28 10:35:57','2018-08-28 10:35:57'),(50,4,'Human Resource and Sales','2018-08-28 10:35:57','2018-08-28 10:35:57'),(51,4,'Operations','2018-08-28 10:35:57','2018-08-28 10:35:57'),(52,4,'Innovation and Marketing','2018-08-28 10:35:57','2018-08-28 10:35:57'),(53,4,'Production','2018-08-28 10:35:57','2018-08-28 10:35:57'),(54,5,'NCR','2018-09-04 07:06:16','2018-09-11 04:23:38'),(55,5,'Provincial','2018-09-04 07:06:16','2018-09-11 04:25:25');
/*!40000 ALTER TABLE `designation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_appraisal`
--

DROP TABLE IF EXISTS `employee_appraisal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_appraisal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeID` int(11) DEFAULT NULL,
  `for_quarter` varchar(255) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `remarks` text,
  `appraised_by` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:not admin|1:admin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_appraisal`
--

LOCK TABLES `employee_appraisal` WRITE;
/*!40000 ALTER TABLE `employee_appraisal` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_appraisal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_documents`
--

DROP TABLE IF EXISTS `employee_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fileName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `employee_documents_employeeid_index` (`employeeID`),
  CONSTRAINT `employee_documents_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_documents`
--

LOCK TABLES `employee_documents` WRITE;
/*!40000 ALTER TABLE `employee_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `middleName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suffix` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `fatherName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobileNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` enum('single','married','widowed') COLLATE utf8_unicode_ci NOT NULL,
  `dependent` enum('0','1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `designation` int(10) unsigned DEFAULT NULL,
  `jobTitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `joiningDate` date DEFAULT NULL,
  `profileImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default.jpg',
  `localAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `permanentAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `employment_status` enum('regular','freelancer','probationary') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'regular',
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `branch` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`),
  UNIQUE KEY `employees_employeeid_unique` (`employeeID`),
  KEY `employees_designation_foreign` (`designation`),
  KEY `employees_branch_foreign` (`branch`),
  CONSTRAINT `employees_branch_foreign` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `employees_designation_foreign` FOREIGN KEY (`designation`) REFERENCES `designation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (94,'TGSD-16-151R','','Rhan','Dela Cruz','','','sdsad@mail.com','$2y$10$0FhyK7WviC/Sgwtv.XY2KeDduE4YD.Vqfx/VjIrXZGWLsnW.C7goO','male','Renato Barredo','0929-205-7530','1970-01-01','single','0',54,'Demo Roving','2018-07-04','default.jpg','xdasdsasdadsa','asdasdsa','active','regular','0000-00-00 00:00:00',NULL,NULL,'2018-09-07 03:51:03','2018-09-07 03:51:03',1),(95,'TGSD-16-150','','Mike','Miller','','','mike@mail.com','$2y$10$IKDJ5Kn8Z1Z5IACnKjMEZeQdnt.J3Mfexo2raMYomMDKSosbGsKgC','male','Test','0999-72-0833','1970-01-01','single','0',48,'Demo Roving','2018-04-03','default.jpg','USA','USA','active','regular','0000-00-00 00:00:00',NULL,NULL,'2018-09-07 04:27:37','2018-09-07 04:27:37',NULL),(96,'SKUBBS01','','Rhan','Barredo','','','rhanbarredo@gmail.com','$2y$10$6by5.m1TCW0asUwjxoV5T.HB5wAunmLWN.net4ATwmg4M8wSpWEXG','male','Renato Barredo','0999-72-0839','2018-03-27','single','0',48,'web developer','2018-04-02','default.jpg','TEST','TEST','active','regular','2018-09-25 18:21:39','vzgTc7t1mJTMf5jpY2oqyvBrSKtFrHYVhmivopx7o2L7BnvBZyv80CCHVZ0y',NULL,'2018-09-10 03:20:09','2018-09-25 10:21:39',NULL),(97,'TGSD-16-120','','John','Doe','','','johndoe@mail.com','$2y$10$lJEXeciHFy0puWcaIdf48uv8t4yIqRLYcQns2xhjU9iNecFzOWoqa','male','John Doe Ii','0949-322-9979','2018-09-18','single','0',53,'Sewer','2018-04-04','default.jpg','California, USA','California, USA','active','regular','0000-00-00 00:00:00',NULL,NULL,'2018-09-13 05:18:16','2018-09-13 05:18:16',NULL),(99,'TGSD-16-121','','Rod','Macam','','','rodmacam@mail.com','$2y$10$itb/mPzwYVXlxU2hvJUTruPuIVd1l/Asuc5BhRpCB5A8muQfj1vee','male','Rod Macam Ii','0999-72-0833','1970-01-01','single','0',53,'Sewer','2018-04-05','default.jpg','Brazil','Brazil','active','regular','0000-00-00 00:00:00',NULL,NULL,'2018-09-13 05:28:12','2018-09-13 05:28:12',NULL),(119,'TGSD-16-159','','Jhen','Alcobar','','','jhen@mail.com','$2y$10$ZthKLhhJwT/RI5xGbha8ienFsd8PeNbj5QDpvrcUhqjYnyELWhS/O','female','Juan Delacruz Ii','0999-72-0833','2009-09-01','single','0',50,'Encoder','2018-04-01','default.jpg','Philippines','Philippines','active','regular','0000-00-00 00:00:00',NULL,NULL,'2018-09-21 03:29:58','2018-09-21 03:29:58',NULL),(120,'TGSD-16-163','','Mike','Dela Cruz','','','m.delacruz@mail.com','$2y$10$jx1Hd8MNrnZ/w5V6sFfp0O4ZUAeBJ9u3q/MYcBMApOyUhc6509ky6','male','John Doe Ii','','2018-09-18','single','0',54,'Demo Roving','2018-09-06','default.jpg','TEST','TEST','active','probationary','0000-00-00 00:00:00',NULL,NULL,'2018-09-27 10:45:42','2018-09-27 10:45:42',2);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchaseDate` date NOT NULL,
  `purchaseFrom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `bill` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `employeeID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_employeeid_index` (`employeeID`),
  CONSTRAINT `expenses_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `occassion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `holidays_date_unique` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (78,'2017-10-31','Additional special (non-working) day','2017-01-25 21:54:43','2017-01-25 21:54:43'),(82,'2017-09-01','Eidul Adha Muslim Festival 2017','2017-08-22 23:13:17','2017-08-22 23:13:17'),(83,'2018-02-16','Chinese New Year','2018-01-03 01:48:04','2018-01-03 01:48:05'),(84,'2018-03-29','Maundy Thursday (Holy Week)','2018-01-03 01:50:08','2018-01-03 01:50:09'),(85,'2018-03-30','Good Friday (Holy Week)','2018-01-03 01:50:09','2018-01-03 01:50:09'),(86,'2018-04-09','Araw ng Kagitingan','2018-01-03 01:51:14','2018-01-03 01:51:14'),(87,'2018-05-01','Labor Day','2018-01-03 01:51:58','2018-01-03 01:51:58'),(88,'2018-06-12','Independence Day','2018-01-03 01:53:12','2018-01-03 01:53:12'),(89,'2018-08-21','Ninoy Aquino Day','2018-01-03 01:54:16','2018-01-03 01:54:16'),(90,'2018-08-27','National Heroes Day','2018-01-03 01:55:04','2018-01-03 01:55:04'),(91,'2018-11-01','All Saint\'s Day','2018-01-03 01:57:04','2018-01-03 01:57:04'),(92,'2018-11-02','Additional Holiday Declared by Malacañang (providing more time for the traditional All Saint\'s Day)','2018-01-03 01:57:04','2018-01-03 01:57:04'),(93,'2018-11-30','Bonifacio Day','2018-01-03 01:57:33','2018-01-03 01:57:33'),(94,'2018-12-24','Additional Special Non Working Holiday (declared by Malacañang, to strengthen family ties)','2018-01-03 01:59:54','2018-01-03 01:59:54'),(95,'2018-12-25','Christmas Day','2018-01-03 01:59:54','2018-01-03 01:59:54'),(96,'2018-12-31','Last day of the YEAR','2018-01-03 02:08:21','2018-01-03 02:08:21'),(97,'2018-03-01','Muntinlupa Day','2018-02-26 01:51:06','2018-02-26 01:51:06');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_applications`
--

DROP TABLE IF EXISTS `job_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jobID` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `resume` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cover_letter` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('selected','rejected','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `submitted_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `job_applications_jobid_foreign` (`jobID`),
  KEY `job_applications_submitted_by_index` (`submitted_by`),
  CONSTRAINT `job_applications_jobid_foreign` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_applications_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_applications`
--

LOCK TABLES `job_applications` WRITE;
/*!40000 ALTER TABLE `job_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `posted_date` date NOT NULL,
  `last_date` date NOT NULL,
  `close_date` date NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'en','US English'),(2,'es','Spanish'),(3,'fr','French');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_applications`
--

DROP TABLE IF EXISTS `leave_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `leaveType` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `halfDayType` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `days` int(11) NOT NULL,
  `applied_on` date DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `application_status` enum('approved','rejected','pending') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `leave_applications_employeeid_index` (`employeeID`),
  KEY `leave_applications_leavetype_index` (`leaveType`),
  KEY `leave_applications_updated_by_index` (`updated_by`),
  KEY `leave_applications_halfdaytype_index` (`halfDayType`),
  CONSTRAINT `leave_applications_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_halfdaytype_foreign` FOREIGN KEY (`halfDayType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_leavetype_foreign` FOREIGN KEY (`leaveType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_applications`
--

LOCK TABLES `leave_applications` WRITE;
/*!40000 ALTER TABLE `leave_applications` DISABLE KEYS */;
INSERT INTO `leave_applications` VALUES (1,'SKUBBS01','sick_leave',NULL,'2018-09-06',NULL,1,'2018-09-20',NULL,'','approved','2018-09-20 09:02:39','2018-09-24 06:31:44'),(2,'TGSD-16-151R','sick_leave',NULL,'2018-09-03','2018-09-04',1,'2018-09-25','rhanbarredo@gmail.com','','pending','2018-09-25 06:07:03','2018-09-25 06:07:03'),(3,'SKUBBS01','annual_leave',NULL,'2018-10-10','2018-10-10',12,'2018-10-03',NULL,'Anuual ','approved','2018-10-03 05:48:03','2018-10-03 05:49:09'),(4,'SKUBBS01','sick_leave',NULL,'2018-10-11','2018-10-12',2,'2018-10-03',NULL,'Test','approved','2018-10-03 06:10:17','2018-10-03 06:10:45');
/*!40000 ALTER TABLE `leave_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_credits`
--

DROP TABLE IF EXISTS `leave_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `leaveType` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `leave_credit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `employeeID` (`employeeID`),
  KEY `leaveType` (`leaveType`),
  KEY `employeeID_2` (`employeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_credits`
--

LOCK TABLES `leave_credits` WRITE;
/*!40000 ALTER TABLE `leave_credits` DISABLE KEYS */;
INSERT INTO `leave_credits` VALUES (1,'SKUBBS-01','sick_leave',12,'2017-09-10 19:10:11','2018-08-17 07:47:33'),(2,'SKUBBS-01','annual_leave',12,'2017-09-10 19:10:11','2018-08-17 07:47:33'),(3,'SKUBBS-02','sick_leave',12,'2017-09-10 19:10:26','2017-11-07 20:31:20'),(4,'SKUBBS-02','annual_leave',12,'2017-09-10 19:10:26','2017-11-07 20:31:20'),(5,'SKUBBS-03','sick_leave',12,'2017-09-10 19:10:29','0000-00-00 00:00:00'),(6,'SKUBBS-03','annual_leave',12,'2017-09-10 19:10:29','0000-00-00 00:00:00'),(7,'SKUBBS-04','sick_leave',12,'2017-09-10 19:10:41','2018-04-11 05:54:09'),(8,'SKUBBS-04','annual_leave',12,'2017-09-10 19:10:41','2018-04-11 05:54:09'),(9,'SKUBBS-05','sick_leave',12,'2017-09-10 19:10:48','2017-09-29 02:07:57'),(10,'SKUBBS-05','annual_leave',12,'2017-09-10 19:10:48','2017-09-29 02:07:57'),(11,'SKUBBS-06','sick_leave',12,'2017-09-10 19:10:57','2017-11-02 01:45:10'),(12,'SKUBBS-06','annual_leave',12,'2017-09-10 19:10:57','2017-11-02 01:45:10'),(13,'SKUBBS-07','sick_leave',12,'2017-09-10 19:11:04','0000-00-00 00:00:00'),(14,'SKUBBS-07','annual_leave',12,'2017-09-10 19:11:04','0000-00-00 00:00:00'),(15,'SKUBBS-08','sick_leave',12,'2017-09-10 19:11:07','0000-00-00 00:00:00'),(16,'SKUBBS-08','annual_leave',12,'2017-09-10 19:11:07','0000-00-00 00:00:00'),(17,'SKUBBS-09','sick_leave',12,'2017-09-10 19:11:25','0000-00-00 00:00:00'),(18,'SKUBBS-09','annual_leave',12,'2017-09-10 19:11:25','0000-00-00 00:00:00'),(19,'SKUBBS-10','sick_leave',12,'2017-09-10 19:11:29','0000-00-00 00:00:00'),(20,'SKUBBS-10','annual_leave',12,'2017-09-10 19:11:29','0000-00-00 00:00:00'),(21,'SKUBBS-11','sick_leave',12,'2017-09-10 19:11:32','2018-03-04 21:53:23'),(22,'SKUBBS-11','annual_leave',12,'2017-09-10 19:11:32','2018-03-04 21:53:23'),(23,'SKUBBS-12','sick_leave',12,'2017-09-10 19:11:45','2017-11-02 01:45:26'),(24,'SKUBBS-12','annual_leave',12,'2017-09-10 19:11:45','2017-11-02 01:45:26'),(25,'SKUBBS-13','sick_leave',12,'2017-09-10 19:11:48','2017-09-20 00:20:33'),(26,'SKUBBS-13','annual_leave',12,'2017-09-10 19:11:48','2017-09-20 00:20:33'),(27,'SKUBBS-14','sick_leave',0,'2017-09-10 19:11:55','2017-11-02 01:45:38'),(28,'SKUBBS-14','annual_leave',0,'2017-09-10 19:11:55','2017-11-02 01:45:38'),(29,'SKUBBS-15','sick_leave',12,'2017-09-10 19:12:06','2017-11-26 21:25:27'),(30,'SKUBBS-15','annual_leave',12,'2017-09-10 19:12:06','2017-11-26 21:25:27'),(31,'SKUBBS-16','sick_leave',12,'2017-09-10 19:12:12','2017-11-26 21:25:53'),(32,'SKUBBS-16','annual_leave',12,'2017-09-10 19:12:12','2017-11-26 21:25:53'),(33,'SKUBBS-17','sick_leave',12,'2017-09-10 19:12:22','2018-02-21 02:05:22'),(34,'SKUBBS-17','annual_leave',12,'2017-09-10 19:12:22','2018-02-21 02:05:22'),(35,'SKUBBS-18','sick_leave',12,'2017-09-10 19:12:25','2017-11-02 01:45:52'),(36,'SKUBBS-18','annual_leave',12,'2017-09-10 19:12:25','2017-11-02 01:45:52'),(37,'SKUBBS-19','sick_leave',12,'2017-09-10 19:12:31','2018-02-21 02:05:42'),(38,'SKUBBS-19','annual_leave',12,'2017-09-10 19:12:31','2018-02-21 02:05:42'),(39,'SKUBBS-20','sick_leave',12,'2017-09-10 19:12:44','2018-02-21 02:05:59'),(40,'SKUBBS-20','annual_leave',12,'2017-09-10 19:12:44','2018-02-21 02:05:59'),(41,'SKUBBS-21','sick_leave',12,'2017-09-10 19:12:51','2017-11-20 19:28:54'),(42,'SKUBBS-21','annual_leave',12,'2017-09-10 19:12:51','2017-11-20 19:28:54'),(43,'SKUBBS-22','sick_leave',12,'2017-09-10 19:13:03','0000-00-00 00:00:00'),(44,'SKUBBS-22','annual_leave',12,'2017-09-10 19:13:03','0000-00-00 00:00:00'),(45,'SKUBBS-23','sick_leave',0,'2017-09-10 19:13:09','2018-01-03 01:37:34'),(46,'SKUBBS-23','annual_leave',0,'2017-09-10 19:13:09','2018-01-03 01:37:34'),(47,'SKUBBS-24','sick_leave',12,'2017-09-10 19:13:19','0000-00-00 00:00:00'),(48,'SKUBBS-24','annual_leave',12,'2017-09-10 19:13:19','0000-00-00 00:00:00'),(49,'SKUBBS-26','sick_leave',0,'2017-11-07 00:20:10','2017-11-07 00:21:39'),(50,'SKUBBS-26','annual_leave',0,'2017-11-07 00:20:10','2017-11-07 00:21:39'),(51,'SKUBBS-28','sick_leave',0,'2017-11-07 00:32:03','0000-00-00 00:00:00'),(52,'SKUBBS-28','annual_leave',0,'2017-11-07 00:32:03','0000-00-00 00:00:00'),(53,'SKUBBS-29','sick_leave',0,'2017-11-07 00:35:33','2017-12-03 20:01:46'),(54,'SKUBBS-29','annual_leave',0,'2017-11-07 00:35:33','2017-12-03 20:01:46'),(55,'SKUBBS-30','sick_leave',0,'2017-11-07 00:40:55','0000-00-00 00:00:00'),(56,'SKUBBS-30','annual_leave',0,'2017-11-07 00:40:55','0000-00-00 00:00:00'),(57,'SKUBBS-31','sick_leave',0,'2017-11-16 22:59:29','2017-11-16 22:59:59'),(58,'SKUBBS-31','annual_leave',0,'2017-11-16 22:59:29','2017-11-16 22:59:59'),(59,'SKUBBS-32','sick_leave',0,'2017-11-21 22:05:55','0000-00-00 00:00:00'),(60,'SKUBBS-32','annual_leave',0,'2017-11-21 22:05:55','0000-00-00 00:00:00'),(61,'SKUBBS-33','sick_leave',0,'2017-11-28 00:29:20','0000-00-00 00:00:00'),(62,'SKUBBS-33','annual_leave',0,'2017-11-28 00:29:20','0000-00-00 00:00:00'),(63,'SKUBBS-34','sick_leave',0,'2017-11-28 21:51:08','2017-12-13 22:51:08'),(64,'SKUBBS-34','annual_leave',0,'2017-11-28 21:51:08','2017-12-13 22:51:08'),(65,'SKUBBS-35','sick_leave',0,'2017-11-28 21:56:05','2017-11-28 21:57:18'),(66,'SKUBBS-35','annual_leave',0,'2017-11-28 21:56:05','2017-11-28 21:57:18'),(67,'SKUBBS-36','sick_leave',0,'2017-11-29 01:28:45','2018-01-16 23:51:26'),(68,'SKUBBS-36','annual_leave',0,'2017-11-29 01:28:45','2018-01-16 23:51:26'),(69,'SKUBBS-37','sick_leave',0,'2017-12-13 22:40:37','2018-01-23 22:57:01'),(70,'SKUBBS-37','annual_leave',0,'2017-12-13 22:40:37','2018-01-23 22:57:01'),(71,'SKUBBS-38','sick_leave',12,'2018-01-09 01:44:26','2018-01-17 00:07:09'),(72,'SKUBBS-38','annual_leave',12,'2018-01-09 01:44:26','2018-01-17 00:07:09'),(73,'SKUBBS-39','sick_leave',0,'2018-01-09 01:47:29','0000-00-00 00:00:00'),(74,'SKUBBS-39','annual_leave',0,'2018-01-09 01:47:29','0000-00-00 00:00:00'),(75,'SKUBBS-40','sick_leave',0,'2018-01-09 18:52:06','0000-00-00 00:00:00'),(76,'SKUBBS-40','annual_leave',0,'2018-01-09 18:52:06','0000-00-00 00:00:00'),(77,'SKUBBS-41','sick_leave',0,'2018-01-23 22:25:29','0000-00-00 00:00:00'),(78,'SKUBBS-41','annual_leave',0,'2018-01-23 22:25:29','0000-00-00 00:00:00'),(79,'SKUBBS-42','sick_leave',0,'2018-01-23 22:29:05','0000-00-00 00:00:00'),(80,'SKUBBS-42','annual_leave',0,'2018-01-23 22:29:05','0000-00-00 00:00:00'),(81,'SKUBBS-43','sick_leave',0,'2018-02-08 01:32:14','0000-00-00 00:00:00'),(82,'SKUBBS-43','annual_leave',0,'2018-02-08 01:32:14','0000-00-00 00:00:00'),(83,'SKUBBS-01','sick_leave',12,'2018-04-11 02:03:31','0000-00-00 00:00:00'),(84,'SKUBBS-01','annual_leave',12,'2018-04-11 02:03:31','0000-00-00 00:00:00'),(85,'SKUBBS-07','sick_leave',12,'2018-04-11 02:04:08','0000-00-00 00:00:00'),(86,'SKUBBS-07','annual_leave',12,'2018-04-11 02:04:08','0000-00-00 00:00:00'),(87,'SKUBBS-04','sick_leave',12,'2018-04-11 02:04:51','0000-00-00 00:00:00'),(88,'SKUBBS-04','annual_leave',12,'2018-04-11 02:04:51','0000-00-00 00:00:00'),(89,'sdasdsa','sick_leave',12,'2018-08-09 02:30:06','0000-00-00 00:00:00'),(90,'sdasdsa','annual_leave',12,'2018-08-09 02:30:06','0000-00-00 00:00:00'),(91,'TGSD-16-150000','sick_leave',12,'2018-08-17 02:59:47','0000-00-00 00:00:00'),(92,'TGSD-16-150000','annual_leave',12,'2018-08-17 02:59:47','0000-00-00 00:00:00'),(93,'TGSD-16-15099','sick_leave',12,'2018-08-17 07:55:34','0000-00-00 00:00:00'),(94,'TGSD-16-15099','annual_leave',12,'2018-08-17 07:55:34','0000-00-00 00:00:00'),(95,'TGSD-160-15','sick_leave',12,'2018-08-28 06:26:23','0000-00-00 00:00:00'),(96,'TGSD-160-15','annual_leave',12,'2018-08-28 06:26:23','0000-00-00 00:00:00'),(97,'TGSD-16-150dsadsd','sick_leave',12,'2018-08-31 02:23:32','2018-08-31 02:29:24'),(98,'TGSD-16-150dsadsd','annual_leave',12,'2018-08-31 02:23:32','2018-08-31 02:29:24'),(99,'TGSD-16-1554','sick_leave',12,'2018-09-04 11:08:05','0000-00-00 00:00:00'),(100,'TGSD-16-1554','annual_leave',12,'2018-09-04 11:08:05','0000-00-00 00:00:00'),(101,'TGSD-16-1513','sick_leave',12,'2018-09-05 03:42:46','0000-00-00 00:00:00'),(102,'TGSD-16-1513','annual_leave',12,'2018-09-05 03:42:46','0000-00-00 00:00:00'),(103,'TGSD-16-151R','sick_leave',12,'2018-09-07 03:51:03','0000-00-00 00:00:00'),(104,'TGSD-16-151R','annual_leave',12,'2018-09-07 03:51:03','0000-00-00 00:00:00'),(105,'TGSD-16-150','sick_leave',12,'2018-09-07 04:27:37','0000-00-00 00:00:00'),(106,'TGSD-16-150','annual_leave',12,'2018-09-07 04:27:37','0000-00-00 00:00:00'),(107,'SKUBBS01','sick_leave',12,'2018-09-10 03:20:09','2018-09-24 06:22:09'),(108,'SKUBBS01','annual_leave',12,'2018-09-10 03:20:09','2018-09-24 06:22:10'),(109,'TGSD-16-120','sick_leave',12,'2018-09-13 05:18:16','0000-00-00 00:00:00'),(110,'TGSD-16-120','annual_leave',12,'2018-09-13 05:18:16','0000-00-00 00:00:00'),(111,'TGSD-16-121','sick_leave',12,'2018-09-13 05:28:13','0000-00-00 00:00:00'),(112,'TGSD-16-121','annual_leave',12,'2018-09-13 05:28:13','0000-00-00 00:00:00'),(113,'TGSD-16-122','sick_leave',12,'2018-09-13 05:30:01','0000-00-00 00:00:00'),(114,'TGSD-16-122','annual_leave',12,'2018-09-13 05:30:01','0000-00-00 00:00:00'),(115,'TGSD-16-159','sick_leave',12,'2018-09-21 03:29:58','0000-00-00 00:00:00'),(116,'TGSD-16-159','annual_leave',12,'2018-09-21 03:29:58','0000-00-00 00:00:00'),(117,'TGSD-16-163','sick_leave',12,'2018-09-27 10:45:42','0000-00-00 00:00:00'),(118,'TGSD-16-163','annual_leave',12,'2018-09-27 10:45:42','0000-00-00 00:00:00'),(119,'TGSD-16-15ssdsdsadsa','sick_leave',12,'2018-09-28 03:31:45','0000-00-00 00:00:00'),(120,'TGSD-16-15ssdsdsadsa','annual_leave',12,'2018-09-28 03:31:45','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `leave_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leavetypes`
--

DROP TABLE IF EXISTS `leavetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leavetypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leaveType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `num_of_leave` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `leavetypes_leavetype_index` (`leaveType`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leavetypes`
--

LOCK TABLES `leavetypes` WRITE;
/*!40000 ALTER TABLE `leavetypes` DISABLE KEYS */;
INSERT INTO `leavetypes` VALUES (1,'sick_leave',12,'2015-06-22 19:24:57','2016-01-05 22:11:00'),(5,'annual_leave',12,'2015-06-22 19:24:57','2015-06-22 19:24:57');
/*!40000 ALTER TABLE `leavetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2015_01_01_113224_create_department_table',1),('2015_01_02_113252_create_designation_table',1),('2015_01_03_051233_create_employees_table',1),('2015_01_14_095049_create_leavetypes_table',1),('2015_01_15_061824_create_admins_table',1),('2015_01_15_062941_create_bank_details_table',1),('2015_01_15_104831_create_employee_documents_table',1),('2015_01_15_105222_create_awards_table',1),('2015_01_15_110029_create_holidays_table',1),('2015_01_15_110255_create_attendance_table',1),('2015_01_20_100417_create_salary_table',1),('2015_01_22_150640_create_expenses_table',1),('2015_02_04_073542_create_settings_table',1),('2015_02_10_044023_create_noticeboards_table',1),('2015_05_18_041236_create_country_table',1),('2015_05_20_081903_create_leave_applications',1),('2015_05_23_063217_create_payrolls_table',1),('2015_06_02_174830_create_jobs_table',1),('2015_06_03_124443_create_jobApplications_table',1),('2015_06_07_112126_add_employeeID_to_expense_table',1),('2015_06_08_051127_add_expense_to_payrolls',1),('2015_06_10_040042_add_bsb_bank_details',1),('2015_06_11_094005_create_language_table',1),('2018_08_16_153553_add_first_last_suffixname',2),('2018_08_17_152546_add_job_title_employeetbl',3),('2018_08_20_135742_working_history_table',4),('2018_08_24_162618_add_admin_level',5),('2018_08_29_113127_create_schedule_table',6),('2018_09_04_183340_create_branch',7),('2018_09_05_103020_add_branch_employee',8),('2018_09_14_124642_create_daily_time_record_tbl',9),('2018_09_21_182510_add_remarks_overtime_tbl',10),('2018_09_24_164957_create_cash_advance_tbl',11),('2018_09_24_184128_add_purpose_cash_advance',12),('2018_09_26_102943_create_rentals_tbl',13),('2018_09_26_174607_create_request_other_tbl',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticeboards`
--

DROP TABLE IF EXISTS `noticeboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticeboards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticeboards`
--

LOCK TABLES `noticeboards` WRITE;
/*!40000 ALTER TABLE `noticeboards` DISABLE KEYS */;
INSERT INTO `noticeboards` VALUES (1,'Leave Application > REMINDER <','<p>1.No WFH (Work from Home) application unless it was approved by Zave.</p><p>2. All leave(s) must be approved by Zave first before you apply it.</p><p><br></p><p><br></p>','active','2016-01-05 23:53:20','2017-05-24 22:43:44');
/*!40000 ALTER TABLE `noticeboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `overtime_applications`
--

DROP TABLE IF EXISTS `overtime_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `overtime_applications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) NOT NULL,
  `start_date` varchar(60) DEFAULT NULL,
  `end_date` varchar(60) DEFAULT NULL,
  `reason` longtext,
  `remarks` varchar(255) DEFAULT NULL,
  `daily_rate` double DEFAULT NULL,
  `total_overtime` double DEFAULT NULL,
  `total_overtime_pay` double DEFAULT NULL,
  `type` enum('ordinary','restday','regular_holiday','regular_holiday_restday') DEFAULT NULL,
  `period` tinyint(4) DEFAULT '0' COMMENT '0 - No period, 1 - first period, 2 - second period...',
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `updated_by` varchar(20) NOT NULL,
  `application_status` enum('approved','rejected','pending') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `overtime_applications`
--

LOCK TABLES `overtime_applications` WRITE;
/*!40000 ALTER TABLE `overtime_applications` DISABLE KEYS */;
INSERT INTO `overtime_applications` VALUES (1,'SKUBBS-22','2017-09-30 22:00:00','2017-10-01 01:00:00','EMRS',NULL,909.09,3,443.19,'restday',1,'10','2017','skubbs.dev@gmail.com','approved','2017-10-04 18:54:40','2017-10-04 19:16:48'),(2,'SKUBBS-21','2017-09-22 22:15:00','2017-09-22 23:15:00','1 hr',NULL,818.18,1,127.84,'ordinary',1,'10','2017','skubbs.dev@gmail.com','approved','2017-10-04 19:21:01','2017-10-04 21:55:25'),(3,'SKUBBS-21','2017-09-24 16:25:00','2017-09-24 21:00:00','4 hrs 35 mins',NULL,818.18,4.5,598.27,'restday',1,'10','2017','skubbs.dev@gmail.com','approved','2017-10-04 19:22:02','2017-10-04 21:56:44'),(4,'SKUBBS-21','2017-09-26 20:15:00','2017-09-27 00:20:00','4 hrs 5 mins',NULL,818.18,4.5,575.28,'ordinary',1,'10','2017','skubbs.dev@gmail.com','approved','2017-10-04 19:22:58','2017-10-04 21:57:17'),(5,'SKUBBS-21','2017-10-01 12:10:00','2017-10-01 19:20:00','7 hrs 10 mins',NULL,818.18,7.5,997.12,'restday',1,'10','2017','skubbs.dev@gmail.com','approved','2017-10-04 19:23:33','2017-10-04 21:58:00'),(6,'SKUBBS-21','2017-10-03 21:45:00','2017-10-03 23:00:00','1 hr 15 mins',NULL,818.18,1.5,191.76,'ordinary',1,'10','2017','skubbs.dev@gmail.com','approved','2017-10-04 19:24:12','2017-10-04 21:58:36'),(7,'SKUBBS-31','2017-11-13 09:30:00','2017-11-13 15:30:00','6-hr Holiday OT',NULL,1,6,2.04,'regular_holiday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-16 23:21:38','2017-11-19 19:21:12'),(8,'SKUBBS-31','2017-11-14 09:30:00','2017-11-14 15:30:00','6-hr Holiday OT',NULL,1,6,2.04,'regular_holiday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-16 23:21:38','2017-11-19 19:21:00'),(9,'SKUBBS-31','2017-11-15 09:30:00','2017-11-15 15:30:00','6-hr Holiday OT',NULL,1,6,2.04,'regular_holiday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-16 23:21:38','2017-11-19 19:20:45'),(10,'SKUBBS-08','2017-11-13 09:00:00','2017-11-13 14:00:00','BBQ House Christmas Template',NULL,0,5,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 18:19:50','2017-11-19 19:24:01'),(11,'SKUBBS-08','2017-11-14 10:00:00','2017-11-14 11:00:00','BBQ House Go live template',NULL,0,1,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 18:19:50','2017-11-19 19:23:39'),(12,'SKUBBS-08','2017-11-15 02:00:00','2017-11-15 03:00:00','Trustlink ir8a adjustment',NULL,0,1,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 18:19:50','2017-11-19 19:23:21'),(13,'SKUBBS-22','2017-11-14 10:30:00','2017-11-14 13:00:00','safra',NULL,909.09,2.5,738.65,'regular_holiday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:21:28','2017-11-19 19:25:10'),(14,'SKUBBS-22','2017-11-14 19:00:00','2017-11-14 21:00:00','fhg',NULL,909.09,2,590.92,'regular_holiday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:21:28','2017-11-19 19:24:52'),(15,'SKUBBS-28','2017-11-17 18:30:00','2017-11-18 01:00:00','Design for Geoharbour\'s brochure',NULL,1,6.5,1.1,'restday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:22:22','2017-11-19 19:25:59'),(16,'SKUBBS-15','2017-11-14 12:25:00','2017-11-14 04:30:00','so our work load can be lessen due to long weekend',NULL,0,0,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 19:23:19','2017-11-19 19:32:25'),(17,'SKUBBS-26','2017-11-13 09:30:00','2017-11-13 18:30:00','Work on holiday.',NULL,2045.45,9,5982.93,'regular_holiday',1,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:24:07','2017-11-19 19:35:54'),(18,'SKUBBS-26','2017-11-14 09:30:00','2017-11-14 18:30:00','Work on holiday.',NULL,2045.45,9,5982.93,'regular_holiday',1,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:24:07','2017-11-19 19:35:31'),(19,'SKUBBS-26','2017-11-15 09:30:00','2017-11-15 18:30:00','Work on holiday.',NULL,2,9,5.85,'regular_holiday',1,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:24:07','2017-11-19 19:33:21'),(20,'SKUBBS-15','2017-11-15 12:16:00','2017-11-15 04:00:00','so our work load can be lessen due to long week end',NULL,0,0,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 19:25:42','2017-11-19 19:32:35'),(21,'SKUBBS-08','2017-11-13 09:00:00','2017-11-13 14:00:00','BBQ House Christmas Template',NULL,909.09,5,710.25,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:27:21','2017-11-19 19:47:20'),(22,'SKUBBS-08','2017-11-14 10:00:00','2017-11-14 11:00:00','BBQ House Go live template',NULL,909.09,1,142.05,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:27:21','2017-11-19 19:47:43'),(23,'SKUBBS-08','2017-11-15 14:00:00','2017-11-15 15:00:00','Trustlink ir8a adjustment',NULL,909.09,1,142.05,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:27:21','2017-11-19 19:48:00'),(24,'SKUBBS-15','2017-11-14 12:00:00','2017-11-14 16:00:00','our work load can be lessen due to holiday',NULL,909.09,4,568.2,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:33:39','2017-11-19 19:46:10'),(25,'SKUBBS-07','2017-11-14 10:00:00','2017-11-14 04:00:00','Safety Made Simple development updates',NULL,0,0,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 19:34:17','2017-11-19 19:49:15'),(26,'SKUBBS-15','2017-11-15 12:30:00','2017-11-15 16:00:00','our work load can be lessen due to holiday',NULL,909.09,3.5,497.18,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:34:23','2017-11-19 19:45:33'),(27,'SKUBBS-07','2017-11-15 10:00:00','2017-11-15 04:00:00','Skubbs site development update',NULL,0,0,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 19:36:14','2017-11-19 19:49:26'),(28,'SKUBBS-16','2017-11-14 10:00:00','2017-11-14 16:00:00','Start my bartender web development to lessen workload due to holiday.',NULL,909.09,6,852.3,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:41:14','2017-11-19 19:51:44'),(29,'SKUBBS-16','2017-11-15 10:00:00','2017-11-15 16:00:00','Start my bartender web development to lessen workload due to holiday.',NULL,909.09,6,852.3,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:41:14','2017-11-19 19:52:09'),(30,'SKUBBS-31','2017-11-13 09:30:00','2017-11-13 15:30:00','6-hr Holiday OT',NULL,1681.82,6,1576.74,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:46:18','2017-11-19 19:53:03'),(31,'SKUBBS-31','2017-11-14 09:30:00','2017-11-14 15:30:00','6-hr Holiday OT',NULL,1681.82,6,1576.74,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:46:18','2017-11-19 19:53:22'),(32,'SKUBBS-31','2017-11-15 09:30:00','2017-11-20 15:30:00','6-hr Holiday OT',NULL,1681.82,126,33111.54,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-19 19:46:18','2017-11-19 19:54:03'),(33,'SKUBBS-26','2017-11-13 09:30:00','2017-11-13 18:30:00','Work on holiday.',NULL,2045.45,9,2876.4,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:46:28','2017-11-19 19:50:17'),(34,'SKUBBS-26','2017-11-14 09:30:00','2017-11-14 18:30:00','Work on holiday.',NULL,2045.45,9,2876.4,'ordinary',1,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:46:28','2017-11-19 19:50:38'),(35,'SKUBBS-26','2017-11-15 09:30:00','2017-11-15 18:30:00','Work on holiday.',NULL,2045.45,9,2876.4,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:46:28','2017-11-19 19:50:58'),(36,'SKUBBS-22','2017-11-14 10:30:00','2017-11-14 13:00:00','safra',NULL,909.09,2.5,355.13,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:49:30','2017-11-19 19:55:02'),(37,'SKUBBS-22','2017-11-14 19:00:00','2017-11-14 21:00:00','fhg',NULL,909.09,2,284.1,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:49:30','2017-11-19 19:55:23'),(38,'SKUBBS-07','2017-11-14 10:00:00','2017-11-14 16:00:00','Safety Made Simple development updates',NULL,909.09,6,852.3,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:53:56','2017-11-19 19:56:32'),(39,'SKUBBS-07','2017-11-15 10:00:00','2017-11-15 16:00:00','Skubbs development updates',NULL,909.09,6,852.3,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:53:56','2017-11-19 19:57:02'),(40,'SKUBBS-07','2017-11-17 21:00:00','2017-11-17 22:00:00','Pasta Brava site new page development',NULL,909.09,1,142.05,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:53:56','2017-11-19 19:57:21'),(41,'SKUBBS-31','2017-11-15 09:30:00','2017-11-15 15:30:00','6-hr Holiday OT',NULL,1681.82,6,1576.74,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-19 19:55:35','2017-11-19 19:57:53'),(42,'SKUBBS-03','2017-11-12 15:00:00','2017-11-12 19:00:00','COSSB (fixes)\r\n\r\n- No validation shown for the medical e card (screenshots attached)\r\n-  Error in GPS directions (screenshots attached)\r\n- Error in Contact Us enquiry email address (screenshots attached)\r\n- upload ios and android builds to drive\r\n',NULL,1363.64,4,886.4,'restday',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-20 18:31:46','2017-11-20 18:41:27'),(43,'SKUBBS-03','2017-11-13 14:00:00','2017-11-13 18:00:00','adocnow demo upload in testflight\r\n- fix error in uploading the build\r\n- add additional testers\r\n- fix error in compiling the builds\r\n',NULL,1363.64,4,852.32,'ordinary',2,'11','2017','debbie@im.skubbs.com','approved','2017-11-20 18:33:49','2017-11-20 18:42:34'),(44,'SKUBBS-03','2017-11-13 16:00:00','2017-11-13 19:00:00','adocnowdemo - upload to testflight, fix error and add testers',NULL,0,3,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-20 18:46:37','2017-12-05 22:43:36'),(45,'SKUBBS-07','2017-11-20 22:00:00','2017-11-21 00:30:00','[SKUBBS DEVSITE] PORTFOLIO SLIDER',NULL,909.09,2.5,355.13,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-26 18:09:56','2017-12-05 22:45:52'),(46,'SKUBBS-07','2017-11-21 21:30:00','2017-11-21 23:30:00','[SKUBBS DEVSITE] DEVELOPMENT UDPATES',NULL,909.09,2,284.1,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-26 18:09:56','2017-12-05 22:46:34'),(47,'SKUBBS-07','2017-11-26 17:30:00','2017-11-26 23:40:00','[FHGMEDICAL CONCIERGE WEB PORTAL DEVSITE] HOMEPAGE DEVELOPMENT',NULL,909.09,6.5,923.33,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-26 18:09:56','2017-12-05 22:47:06'),(48,'SKUBBS-05','2017-11-25 10:00:00','2017-11-25 18:00:00','ASSETS OWNERS\r\n- develop single property page\r\n- develop single reward page\r\n\r\nALLIANCE\r\n- log request form page\r\n- letter of guarantee page\r\n- login via mobile number page\r\n- forgot password page\r\n- change password page\r\n- send otp page\r\n- verify otp page\r\n- log password login page',NULL,818.18,8,1063.6,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-26 22:57:55','2017-12-05 23:45:01'),(49,'SKUBBS-29','2017-11-23 22:00:00','2017-11-23 11:30:00','fhgindo',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 00:51:31','2017-12-05 23:43:41'),(50,'SKUBBS-29','2017-11-23 22:00:00','2017-11-23 11:30:00','fhgindo',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 00:51:32','2017-12-05 23:43:28'),(51,'SKUBBS-28','2017-11-21 22:00:00','2017-11-22 00:00:00','FHG Indonesia icon resizing',NULL,1818.18,2,568.18,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-27 01:02:45','2017-12-05 23:43:15'),(52,'SKUBBS-28','2017-11-24 22:00:00','2017-11-25 00:00:00','Purikool flyer design',NULL,1818.18,2,568.18,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-27 01:03:22','2017-12-05 23:42:29'),(53,'SKUBBS-29','2017-11-25 10:00:00','2017-11-25 17:00:00','fhgindo',NULL,0,7,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 01:03:27','2017-12-05 23:40:55'),(54,'SKUBBS-29','2017-11-26 16:00:00','2017-11-26 08:30:00','fhgindo',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 01:04:00','2017-12-05 23:40:43'),(55,'SKUBBS-32','2017-11-25 08:00:00','2017-11-25 17:00:00','OT for FHG react native app',NULL,0,9,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 01:04:14','2017-11-28 19:10:42'),(56,'SKUBBS-32','2017-11-26 13:00:00','2017-11-27 19:00:00','OT for FHG react native app',NULL,0,30,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 01:04:14','2017-11-28 19:12:16'),(57,'SKUBBS-32','2017-11-23 22:00:00','2017-11-24 01:00:00','OT for FHG react native',NULL,0,3,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 01:04:14','2017-11-28 19:12:10'),(58,'SKUBBS-32','2017-11-25 08:00:00','2017-11-25 15:00:00','FHG react native application',NULL,1454.55,7,1654.59,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-27 02:14:30','2017-12-05 23:39:36'),(59,'SKUBBS-32','2017-11-26 13:00:00','2017-11-27 18:00:00','FHG react native application',NULL,0,29,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-27 02:16:20','2017-11-28 19:10:34'),(60,'SKUBBS-32','2017-11-26 13:00:00','2017-11-26 17:00:00','FHG react native application',NULL,1454.55,4,945.48,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-27 02:18:25','2017-12-05 23:40:23'),(61,'SKUBBS-03','2017-11-26 13:00:00','2017-11-26 22:00:00','(Pure Angel Feedback Spa)\r\n     - UI Development for 4 pages\r\n     - search for updated autolayout development for latest xcode\r\n     - Implement autolayout and adaptive sizes development\r\n     - fix radio buttons on feedback form\r\n     - update passing of data on api\r\n     - fix segue\r\n     - update alertview to alertcontroller to update deprecated object',NULL,1363.64,9,1994.4,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-27 19:15:40','2017-11-28 19:07:16'),(62,'SKUBBS-31','2017-11-30 09:00:00','2017-12-01 13:00:00','4-hour holiday OT to work on Skubbs Website Content',NULL,0,28,0,'ordinary',2,'11','2017','debbie@im.skubbs.com','rejected','2017-11-30 23:18:22','2017-12-05 23:10:09'),(63,'SKUBBS-26','2017-11-30 09:30:00','2017-11-30 18:30:00','Work on holiday.',NULL,2045.45,9,5982.93,'regular_holiday',1,'12','2017','debbie@im.skubbs.com','approved','2017-11-30 23:19:28','2017-12-05 23:09:28'),(64,'SKUBBS-07','2017-12-01 08:45:00','2017-12-01 23:30:00','[ OLIVE AND LATTE ABS ] HOMEPAGE UPDATE\r\n\r\n[ SUMMARY PROJECT REPORT ] EMAIL',NULL,909.09,14.5,2059.73,'ordinary',2,'12','2017','debbie@im.skubbs.com','rejected','2017-12-03 17:40:19','2017-12-05 23:06:42'),(65,'SKUBBS-10','2017-12-02 11:00:00','2017-12-02 15:00:00','Trustlink (Payroll Module Update)\r\n- Create Payroll Update\r\n- Save comments\r\n   - Front-end input naming changes\r\n   - Change back-end input indices (after changing front-end input names)\r\n   - Debug expected errors\r\n   - Develop function for saving comment keys and values of each payroll\r\n- Save and record cpf employee / employer share on every payroll',NULL,909.09,4,590.92,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-03 18:21:01','2017-12-05 23:03:46'),(66,'SKUBBS-32','2017-11-30 13:00:00','2017-11-30 18:00:00','FHG INDO',NULL,1454.55,5,1136.35,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-04 21:19:08','2017-12-05 23:01:17'),(67,'SKUBBS-32','2017-12-02 13:00:00','2017-12-02 18:00:00','FHG INDO',NULL,1454.55,5,1181.85,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-04 21:19:08','2017-12-05 23:01:59'),(68,'SKUBBS-03','2017-12-02 14:00:00','2017-12-02 23:00:00','alliance phase 2 \r\n- elog development\r\n- elog api clarification/correction with AHG Alliance api team',NULL,1363.64,9,1994.4,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-04 21:25:37','2017-12-05 22:56:18'),(69,'SKUBBS-03','2017-12-03 10:00:00','2017-12-03 15:00:00','alliance phase 2\r\n- development continuation',NULL,1363.64,5,1108,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-04 21:27:11','2017-12-05 22:57:01'),(70,'SKUBBS-30','2017-11-30 10:30:00','2017-11-30 13:30:00','[ Live ] Stylemart OMS - PDPA Module - QA\r\n\r\n[ UAT ] Aegle Wellness - QA',NULL,1590.91,3,745.74,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-04 21:28:12','2017-12-05 22:52:59'),(71,'SKUBBS-30','2017-11-30 22:30:00','2017-12-01 00:00:00','[ Live site - QA ] Bargain Hunters - QA\r\n\r\nAssets owners 2nd qa and revisions - QA',NULL,1590.91,1.5,372.87,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-04 21:28:12','2017-12-05 22:54:16'),(72,'SKUBBS-08','2017-11-27 21:00:00','2017-11-27 22:00:00','Develop Payroll settings page\r\n9pm - 10pm',NULL,909.09,1,142.05,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 00:59:53','2017-12-05 22:49:04'),(73,'SKUBBS-08','2017-11-30 10:30:00','2017-11-30 14:00:00','Assets Owners\r\nMeeting / qa revision updates',NULL,909.09,3.5,497.18,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 00:59:53','2017-12-05 22:49:49'),(74,'SKUBBS-08','2017-12-03 15:00:00','2017-12-03 17:00:00','Trustlink\r\n - Fix cpf api computation\r\n - Add cpf delay effectivity\r\n - Update cpf settings page',NULL,909.09,2,295.46,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 00:59:53','2017-12-05 22:50:37'),(75,'SKUBBS-08','2017-12-03 20:00:00','2017-12-04 00:00:00','Trustlink\r\n8pm - 12\r\n - Update payroll edit page\r\n - Update payroll computations (create, edit, view, pdf generation)\r\n - Update fields and pages (create, edit, view, pdf generation)',NULL,909.09,4,568.2,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 00:59:53','2017-12-05 22:51:18'),(76,'SKUBBS-07','2017-12-01 20:30:00','2017-12-01 23:30:00','[ OLIVE AND LATTE ABS ] HOMEPAGE UPDATE\r\n[ SUMMARY PROJECT REPORT ] EMAIL',NULL,909.09,3,426.15,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:08:20','2017-12-05 23:10:58'),(77,'SKUBBS-07','2017-12-05 20:00:00','2017-12-05 23:00:00','[FHGMEDICAL CONCIERGE WEB PORTAL DEVSITE] Dynamic menu and product hooks function',NULL,909.09,3,426.12,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:08:20','2017-12-05 23:11:44'),(78,'SKUBBS-29','2017-11-23 22:00:00','2017-11-24 12:00:00','fhgindo 2hrs OT',NULL,0,14,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:11:43','2017-12-05 23:13:20'),(79,'SKUBBS-29','2017-12-26 16:00:00','2017-12-26 20:30:00','fhgindo 4hr 1/2 OT',NULL,0,4.5,0,'ordinary',1,'12','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:11:43','2017-12-05 23:14:08'),(80,'SKUBBS-31','2017-11-30 09:30:00','2017-11-30 13:30:00','4-hour holiday OT',NULL,1681.82,4,2186.4,'regular_holiday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:13:54','2017-12-05 23:15:10'),(81,'SKUBBS-29','2017-11-23 22:00:00','2017-11-23 00:00:00','fhgindo 2hrs OT',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:14:40','2017-12-05 23:17:35'),(82,'SKUBBS-09','2017-12-05 21:00:00','2017-12-05 22:00:00','CRM SCREENSHOTS:\r\n1. One Strategic LLP\r\n2. Express IT Service Pte. Ltd.\r\n3. Artisan Communications Pte Ltd\r\n4. Straits of Asia Pte Ltd\r\n5. Paneva Asia Pte Ltd\r\n6. Acoustic Integration\r\n7. Wings to Wings Pte Ltd',NULL,681.82,1,106.54,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:19:17','2017-12-05 23:37:46'),(83,'SKUBBS-09','2017-12-06 08:30:00','2017-12-06 09:30:00','CRM SCREENSHOTS:\r\n1. One Strategic LLP\r\n2. Express IT Service Pte. Ltd.\r\n3. Artisan Communications Pte Ltd\r\n4. Straits of Asia Pte Ltd\r\n5. Paneva Asia Pte Ltd\r\n6. Acoustic Integration\r\n7. Wings to Wings Pte Ltd',NULL,681.82,1,106.41,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:19:17','2017-12-05 23:38:09'),(84,'SKUBBS-29','2017-11-23 22:00:00','2017-11-23 00:00:00','fhgindonesia',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:25:47','2017-12-05 23:26:33'),(85,'SKUBBS-29','2017-11-23 10:00:00','2017-11-24 00:00:00','fhgindonesia',NULL,0,14,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:27:44','2017-12-05 23:28:01'),(86,'SKUBBS-29','2017-11-23 10:00:00','2017-11-23 00:00:00','fhgindonesia',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:28:25','2017-12-05 23:28:51'),(87,'SKUBBS-29','2017-11-23 22:00:00','2017-11-23 00:00:00','fhgindonesia',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:30:21','2017-12-05 23:31:51'),(88,'SKUBBS-29','2017-11-23 22:00:00','2017-11-23 00:00:00','fhgindonesia',NULL,0,0,0,'ordinary',1,'11','2017','debbie@im.skubbs.com','rejected','2017-12-05 23:31:30','2017-12-05 23:32:39'),(89,'SKUBBS-29','2017-11-23 22:00:00','2017-11-24 00:00:00','fhgindonesia',NULL,1454.55,2,454.54,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:32:22','2017-12-05 23:35:25'),(90,'SKUBBS-29','2017-11-25 10:00:00','2017-11-25 16:00:00','fhgindonesia',NULL,1454.55,6,1418.22,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:33:22','2017-12-05 23:35:55'),(91,'SKUBBS-29','2017-11-26 16:00:00','2017-11-26 20:30:00','fhgindonesia',NULL,1454.55,4.5,1063.66,'restday',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-05 23:34:00','2017-12-05 23:36:32'),(92,'SKUBBS-35','2017-12-08 21:30:00','2017-12-09 00:30:00','Need to finish KO BROWS social media ads for the whole week. ',NULL,1136.36,3,532.5,'ordinary',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-10 08:06:45','2017-12-25 19:43:50'),(93,'SKUBBS-15','2017-12-09 21:10:00','2017-12-10 01:00:00','Food Corner - site responsiveness',NULL,909.09,3.5,517.05,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-10 19:54:33','2017-12-25 19:37:53'),(94,'SKUBBS-15','2017-12-10 09:30:00','2017-12-10 11:42:00','Food Corder - site responsiveness',NULL,909.09,2.5,369.32,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-10 19:55:57','2017-12-25 19:39:12'),(95,'SKUBBS-15','2017-12-10 12:35:00','2017-12-10 14:30:00','Food Corner - site responsiveness',NULL,909.09,1.5,221.59,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-10 19:59:11','2017-12-25 19:42:47'),(96,'SKUBBS-28','2017-12-08 18:30:00','2017-12-11 22:00:00','Purikool flyer revisions & Social media posts for KO Brows',NULL,0,75.5,0,'ordinary',1,'12','2017','debbie@im.skubbs.com','rejected','2017-12-11 07:46:50','2017-12-12 23:55:58'),(97,'SKUBBS-35','2017-12-11 21:30:00','2017-12-12 23:00:00','Revise BBQ house Facebook ADs (total of three designs) as per Ms. Casey. ',NULL,0,25.5,0,'ordinary',2,'12','2017','debbie@im.skubbs.com','rejected','2017-12-11 18:27:08','2017-12-12 23:57:25'),(98,'SKUBBS-36','2017-12-08 18:30:00','2017-12-09 01:00:00','Pure Angel Social Media Posts - Week 1. Made 14 designs.',NULL,1227.27,6.5,1246.44,'ordinary',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-12 02:42:41','2017-12-25 19:47:17'),(99,'SKUBBS-05','2017-12-10 10:00:00','2017-12-13 18:00:00','Wallich Project',NULL,0,80,0,'ordinary',2,'12','2017','debbie@im.skubbs.com','rejected','2017-12-12 22:59:50','2017-12-25 19:46:22'),(100,'SKUBBS-28','2017-12-08 18:30:00','2017-12-08 22:00:00','Purikool flyer & KO Brows Social Media Posts',NULL,1818.18,3.5,994.31,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-12 23:58:21','2017-12-25 19:33:40'),(101,'SKUBBS-28','2017-12-08 18:30:00','2017-12-08 22:00:00','Purikool flyer & KO Brows Social Media Posts',NULL,0,3.5,0,'ordinary',1,'12','2017','debbie@im.skubbs.com','rejected','2017-12-12 23:58:23','2017-12-13 00:00:33'),(102,'SKUBBS-35','2017-12-11 21:30:00','2017-12-11 23:00:00','Need to catch up with the social media designs for BBQ HOUSE as per Ms. Casey.',NULL,1136.36,1.5,266.33,'ordinary',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-13 00:01:22','2017-12-25 19:35:56'),(103,'SKUBBS-28','2017-12-14 21:00:00','2017-12-14 23:30:00','PAB Social Media Posts Week 3',NULL,1818.18,2.5,710.22,'ordinary',1,'12','2017','debbie@im.skubbs.com','approved','2017-12-14 07:28:13','2017-12-25 19:34:30'),(104,'SKUBBS-15','2017-12-16 10:43:00','2017-12-16 12:00:00','Omobella',NULL,909.09,1.5,221.59,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-18 00:29:12','2017-12-25 19:29:45'),(105,'SKUBBS-16','2017-12-16 13:00:00','2017-12-16 18:30:00','Edit Images for Mama Shop Website',NULL,909.09,5.5,812.51,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-18 00:29:22','2017-12-25 19:30:43'),(106,'SKUBBS-15','2017-12-16 19:14:00','2017-12-17 01:25:00','Atmamashop product upload',NULL,909.09,6.5,960.24,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-18 00:31:26','2017-12-25 19:24:06'),(107,'SKUBBS-15','2017-12-17 13:08:00','2017-12-17 17:16:00','Atmamashop front end development',NULL,909.09,4.5,664.78,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-18 00:33:46','2017-12-25 19:23:03'),(108,'SKUBBS-08','2017-12-16 08:00:00','2017-12-16 16:00:00','Trustlink\r\n- Create Payroll\r\n	- Dropdoswn of Fields\r\n	- Audit Trail\r\n		-  Add Audit trail to keep track who inserted and who updated a certain payroll.\r\n	- Once a payroll in created, and a user(HR) wants to use it, a pop up should show asking for the password.\r\n	- Create payroll for employees then go to the next employee until the end of the list instead of picking employee from the list.\r\n	- Dropdown (employees)\r\n		- Name of new joiners should only appear on or after the effectivity date\r\n		- Name of Resigned employees should on be removed a day after the next month.',NULL,909.09,8,1181.84,'restday',2,'12','2017','debbie@im.skubbs.com','rejected','2017-12-24 19:57:45','2017-12-25 19:20:04'),(109,'SKUBBS-08','2017-12-16 08:00:00','2017-12-16 16:00:00','Trustlink\r\n- Create Payroll\r\n	- Dropdoswn of Fields\r\n	- Audit Trail\r\n		-  Add Audit trail to keep track who inserted and who updated a certain payroll.\r\n	- Once a payroll in created, and a user(HR) wants to use it, a pop up should show asking for the password.\r\n	- Create payroll for employees then go to the next employee until the end of the list instead of picking employee from the list.\r\n	- Dropdown (employees)\r\n		- Name of new joiners should only appear on or after the effectivity date\r\n		- Name of Resigned employees should on be removed a day after the next month.',NULL,909.09,8,1181.84,'restday',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-25 19:24:37','2017-12-25 19:34:56'),(110,'SKUBBS-05','2017-12-10 10:00:00','2017-12-10 18:00:00','Wallich Project',NULL,818.18,8,1022.48,'ordinary',2,'12','2017','debbie@im.skubbs.com','approved','2017-12-25 19:48:34','2017-12-25 19:49:58'),(111,'SKUBBS-16','2017-12-29 20:00:00','2017-12-29 01:00:00','Upload images and insert product information to Ming Optique Webiste',NULL,0,0,0,'ordinary',2,'12','2018','debbie@im.skubbs.com','rejected','2017-12-29 19:48:24','2018-01-04 23:57:48'),(112,'SKUBBS-16','2017-12-30 10:00:00','2017-12-30 19:00:00','Upload images and insert product information to Ming Optique Webiste',NULL,909.09,9,1329.57,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2017-12-30 02:59:38','2018-01-05 01:37:45'),(113,'SKUBBS-15','2017-12-31 09:00:00','2017-12-31 09:50:00','Upload omobella\'s banner and product images',NULL,909.09,0.5,73.86,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2017-12-30 18:03:20','2018-01-05 01:43:53'),(114,'SKUBBS-07','2017-12-28 22:00:00','2017-12-29 03:00:00','JOBS 4 LANGUAGES',NULL,909.09,5,710.25,'ordinary',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-03 22:48:15','2018-01-05 01:49:36'),(115,'SKUBBS-07','2017-12-27 20:30:00','2018-01-27 23:30:00','FHG Medical Conierge Web Portal',NULL,0,747,0,'ordinary',2,'12','2018','debbie@im.skubbs.com','rejected','2018-01-04 18:48:26','2018-01-05 01:48:22'),(116,'SKUBBS-07','2017-12-27 20:30:00','2017-12-27 23:30:00','Medical Concierge Web Portal',NULL,909.09,3,426.15,'ordinary',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-04 18:49:25','2018-01-05 01:47:56'),(117,'SKUBBS-03','2018-01-04 22:00:00','2018-01-04 00:30:00','alliance fix issues for release on 01/05/2018',NULL,0,0,0,'ordinary',2,'1','2018','debbie@im.skubbs.com','rejected','2018-01-04 18:51:32','2018-01-05 01:39:47'),(118,'SKUBBS-16','2017-12-29 20:00:00','2017-12-30 00:00:00','Upload Image and product information to Ming Optique Website',NULL,909.09,4,568.2,'ordinary',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-05 00:07:02','2018-01-05 01:36:58'),(119,'SKUBBS-03','2018-01-04 22:00:00','2018-01-05 00:30:00','alliance phase 2 fixes release for tomorrow',NULL,1363.64,2.5,532.42,'ordinary',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-05 01:41:31','2018-01-05 01:45:49'),(120,'SKUBBS-15','2018-01-07 10:30:00','2018-01-07 16:42:00','Omobella Adjustments',NULL,909.09,6.5,960.24,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-07 00:51:23','2018-01-07 18:05:04'),(121,'SKUBBS-03','2018-01-06 02:00:00','2018-01-06 22:30:00','alliance and ge android and ios releases',NULL,0,20.5,0,'ordinary',2,'1','2018','debbie@im.skubbs.com','rejected','2018-01-07 02:08:08','2018-01-07 18:09:30'),(122,'SKUBBS-03','2018-01-06 14:00:00','2018-01-06 22:30:00','alliance and ge android and ios releases',NULL,1363.64,8.5,1883.6,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-07 02:14:20','2018-01-07 18:08:27'),(123,'SKUBBS-03','2018-01-07 15:00:00','2018-01-07 18:00:00','alliance and ge android and ios releases',NULL,1363.64,3,664.8,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-07 02:16:25','2018-01-07 18:09:19'),(124,'SKUBBS-15','2018-01-07 18:00:00','2018-01-07 20:00:00','atmamashop\'s client feedback and adjustments',NULL,909.09,2,295.46,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-07 17:21:30','2018-01-07 18:05:56'),(125,'SKUBBS-07','2018-01-07 06:30:00','2018-01-07 14:00:00','Goffy Pets homepage development',NULL,909.09,7.5,1107.97,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-07 17:33:22','2018-01-07 18:10:33'),(126,'SKUBBS-05','2018-01-07 10:00:00','2018-01-07 18:00:00','A-Tech Home Page',NULL,818.18,8,1063.6,'restday',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-07 17:41:43','2018-01-07 18:11:37'),(127,'SKUBBS-03','2018-01-09 22:00:00','2018-01-09 02:30:00','alliance and ge issue fix',NULL,0,0,0,'ordinary',2,'1','2018','debbie@im.skubbs.com','rejected','2018-01-11 18:13:52','2018-01-21 23:06:24'),(128,'SKUBBS-03','2018-01-09 22:00:00','2018-01-10 02:30:00','alliance and ge fix issues',NULL,1363.64,4.5,958.86,'ordinary',2,'1','2018','debbie@im.skubbs.com','approved','2018-01-11 18:14:27','2018-01-21 23:07:59'),(129,'SKUBBS-03','2018-01-11 23:00:00','2018-01-12 01:00:00','alliance fix issue submitted by primula',NULL,1363.64,2,426.16,'ordinary',2,'1','2018','debbie@im.skubbs.com','approved','2018-01-11 18:15:17','2018-01-21 23:08:39'),(130,'SKUBBS-03','2018-01-20 01:00:00','2018-01-20 03:30:00','alliance and ge submit to google play store - preparing app requirements',NULL,1363.64,2.5,554,'restday',2,'1','2018','debbie@im.skubbs.com','approved','2018-01-20 00:09:15','2018-01-21 23:10:05'),(131,'SKUBBS-03','2018-01-20 14:30:00','2018-01-20 16:30:00','alliance and ge submit to apple store - preparing app requirements',NULL,1363.64,2,443.2,'restday',2,'1','2018','debbie@im.skubbs.com','approved','2018-01-20 00:09:15','2018-01-21 23:09:09'),(132,'SKUBBS-26','2018-01-11 20:00:00','2018-01-11 23:00:00','Social Media reports as requested by Casey and approved by Zave.',NULL,2045.45,3,958.8,'ordinary',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-21 23:09:03','2018-01-21 23:15:42'),(133,'SKUBBS-30','2018-01-12 23:30:00','2018-01-13 01:30:00','1st Run of QA of Live Site Milk and Moons',NULL,1590.91,2,496.88,'ordinary',1,'1','2018','debbie@im.skubbs.com','approved','2018-01-21 23:09:39','2018-01-21 23:17:09'),(134,'SKUBBS-30','2018-01-13 20:30:00','2018-01-13 23:00:00','Revalidation of fixes of Milk and Moons live site',NULL,1590.91,2.5,646.3,'restday',2,'1','2018','debbie@im.skubbs.com','approved','2018-01-21 23:09:39','2018-01-21 23:18:36'),(135,'SKUBBS-15','2018-01-27 14:07:00','2018-01-27 15:43:00','Develop ivision site',NULL,909.09,1.5,221.59,'restday',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-27 03:58:24','2018-02-06 19:48:53'),(136,'SKUBBS-15','2018-01-27 16:12:00','2018-01-27 19:56:00','Develop ivision site',NULL,909.09,3.5,517.05,'restday',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-27 03:59:36','2018-02-06 19:52:22'),(137,'SKUBBS-15','2018-01-28 13:30:00','2018-01-28 17:45:00','I-vision responsiveness and develop product page',NULL,909.09,4.5,664.78,'restday',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-28 02:01:51','2018-02-06 19:53:00'),(138,'SKUBBS-30','2018-01-26 21:00:00','2018-01-26 23:30:00','QA for Goofy Pets',NULL,1590.91,2.5,621.45,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-29 06:56:50','2018-02-06 19:38:01'),(139,'SKUBBS-30','2018-01-27 03:00:00','2018-01-27 04:00:00','QA for mobile responsiveness of Goofy Pets',NULL,1590.91,1,258.52,'restday',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-29 06:56:50','2018-02-06 19:39:20'),(140,'SKUBBS-07','2018-01-29 19:30:00','2018-01-29 23:30:00','GOOFY PETS - REVISIONS AND LIVE MIGRATION',NULL,909.09,4,568.2,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-29 07:55:13','2018-02-06 19:46:05'),(141,'SKUBBS-07','2018-01-30 22:00:00','2018-01-30 23:00:00','Goofy pets - fix registration functionality',NULL,909.09,1,142.04,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-01-30 06:44:16','2018-02-06 19:47:04'),(142,'SKUBBS-30','2018-02-05 22:00:00','2018-02-06 00:00:00','QA - Jobs4languages',NULL,1590.91,2,496.88,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-02-06 19:06:25','2018-02-06 19:43:10'),(143,'SKUBBS-30','2018-02-01 19:30:00','2018-02-01 22:30:00','UAT QA of My Bartender Site Updates',NULL,1590.91,3,745.32,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-02-06 19:11:15','2018-02-06 19:40:02'),(144,'SKUBBS-30','2018-02-02 22:00:00','2018-02-03 00:00:00','Overall QA for Kee Song Live Site',NULL,1590.91,2,496.88,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-02-06 19:11:15','2018-02-06 19:40:36'),(145,'SKUBBS-40','2018-02-02 21:06:00','2018-02-02 22:10:00','OT Design',NULL,1227.27,1.5,287.58,'ordinary',1,'2','2018','debbie@im.skubbs.com','approved','2018-02-06 22:26:46','2018-02-06 22:30:42'),(146,'SKUBBS-16','2018-02-10 10:00:00','2018-02-10 16:00:00','Resize Product Images to decrease file size (Goofy Pets Website)',NULL,909.09,6,886.38,'restday',2,'2','2018','debbie@im.skubbs.com','approved','2018-02-10 00:07:14','2018-02-20 19:08:54'),(147,'SKUBBS-15','2018-02-10 21:14:00','2018-02-10 22:56:00','Goofy pets product upload',NULL,909.09,1.5,221.59,'restday',2,'2','2018','debbie@im.skubbs.com','approved','2018-02-10 18:59:13','2018-02-20 19:29:02'),(148,'SKUBBS-15','2018-02-11 08:50:00','2018-02-11 10:56:00','Goofy pets product upload',NULL,909.09,2.5,369.32,'restday',2,'2','2018','debbie@im.skubbs.com','approved','2018-02-10 19:00:25','2018-02-20 19:31:38'),(149,'SKUBBS-08','2018-02-13 12:00:00','2018-02-13 12:00:00','OT editable Test',NULL,909.09,3,426.15,'ordinary',2,'2','2018','debbie@im.skubbs.com','approved','2018-02-12 23:32:47','2018-02-20 19:39:46'),(150,'SKUBBS-15','2018-02-11 16:30:00','2018-02-11 18:56:00','Goofy Pets product upload',NULL,909.09,2.5,369.32,'restday',2,'2','2018','debbie@im.skubbs.com','approved','2018-02-19 17:41:19','2018-02-20 19:35:31'),(151,'SKUBBS-30','2018-02-20 22:00:00','2018-02-21 00:30:00','QA for Updated Quotation of MyBartender',NULL,1590.91,2.5,621.45,'ordinary',2,'2','2018','debbie@im.skubbs.com','approved','2018-02-20 08:42:34','2018-02-20 20:04:26'),(152,'SKUBBS-31','2018-02-25 17:00:00','2018-02-25 19:00:00','Work on edm flowchart',NULL,1681.82,2,546.6,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-02-26 22:41:17','2018-03-05 20:03:02'),(153,'SKUBBS-07','2018-03-01 09:30:00','2018-03-01 17:30:00','Muntinlupa Day',NULL,0,9,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 18:35:17','2018-03-05 00:05:16'),(154,'SKUBBS-08','2018-03-01 09:30:00','2018-03-01 17:30:00','Muntinlupa day',NULL,0,9,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 18:39:09','2018-03-05 00:03:51'),(155,'SKUBBS-09','2018-03-01 08:00:00','2018-03-01 16:00:00','Training Client WeHaul ( Appointment Booking System )',NULL,0,8,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 18:39:56','2018-03-05 00:04:16'),(156,'SKUBBS-32','2018-03-02 18:00:00','2018-03-02 21:00:00','OT for filet app email smtp',NULL,1454.55,3,681.81,'ordinary',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-04 18:41:02','2018-03-05 19:57:28'),(157,'SKUBBS-32','2018-03-03 08:00:00','2018-03-03 11:00:00','OT for filet app email verification',NULL,1454.55,3,681.81,'ordinary',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-04 18:41:02','2018-03-05 19:59:03'),(158,'SKUBBS-17','2018-03-01 09:30:00','2018-03-01 17:30:00','working on holiday',NULL,0,9,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 18:41:57','2018-03-05 00:03:23'),(159,'SKUBBS-15','2018-03-01 09:30:00','2018-03-01 18:30:00','i-vision development',NULL,0,9,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 18:55:57','2018-03-05 00:03:31'),(160,'SKUBBS-26','2018-03-01 09:30:00','2018-03-01 18:30:00','Muntinlupa Holiday - Work from home.',NULL,0,9,0,'ordinary',1,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 21:45:25','2018-03-05 19:12:30'),(161,'SKUBBS-30','2018-03-01 09:30:00','2018-03-01 17:30:00','QA for Asia Retina, Kingsforce and KOBrows',NULL,0,9,0,'ordinary',1,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 23:54:27','2018-03-05 00:02:57'),(162,'SKUBBS-05','2018-03-01 09:30:00','2018-03-01 05:30:00','asia retina web and mobile app',NULL,0,0,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-04 23:56:07','2018-03-05 00:02:40'),(163,'SKUBBS-19','2018-03-01 09:30:00','2018-03-01 17:30:00','Rush work load',NULL,1204.55,8,1565.92,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 00:03:35','2018-03-05 19:06:45'),(164,'SKUBBS-05','2018-03-01 09:30:00','2018-03-01 17:30:00','asia retina website and app',NULL,818.18,8,1063.6,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 00:04:20','2018-03-05 19:00:04'),(165,'SKUBBS-15','2018-03-01 09:30:00','2018-03-01 17:30:00','I-vision development',NULL,909.09,8,1181.84,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 00:04:37','2018-03-05 18:57:56'),(166,'SKUBBS-07','2018-03-01 09:30:00','2018-03-01 17:30:00','Muntinlupa Holiday - Twig and Mercer updates',NULL,909.09,8,1181.84,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 00:05:10','2018-03-05 18:26:32'),(167,'SKUBBS-30','2018-03-01 09:30:00','2018-03-01 17:30:00','QA for asia retina, kobrows and kingsforce',NULL,1590.91,8,2068.16,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 00:07:37','2018-03-05 00:19:39'),(168,'SKUBBS-09','2018-03-01 09:30:00','2018-03-01 17:30:00','Training Client WeHaul ( Appointment Booking System )',NULL,681.82,8,886.4,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 00:10:00','2018-03-05 18:24:17'),(169,'SKUBBS-26','2018-03-01 09:30:00','2018-03-01 17:30:00','Muntinlupa Holiday. Work from home.',NULL,2045.45,8,2659.04,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 19:15:25','2018-03-05 19:31:15'),(170,'SKUBBS-31','2018-03-01 09:30:00','2018-03-01 17:30:00','Muntinlupa Holiday - work from home',NULL,1681.82,8,2186.4,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 19:36:28','2018-03-05 19:44:20'),(171,'SKUBBS-17','2018-03-01 09:30:00','2018-03-01 17:30:00','working on holiday',NULL,1300.91,8,1691.12,'restday',1,'3','2018','debbie@im.skubbs.com','approved','2018-03-05 20:09:43','2018-03-05 21:51:16'),(172,'SKUBBS-26','2018-03-07 18:30:00','2018-03-07 21:30:00','3 hours OT (6:30 - 9:30). Daily tasks recovery due to client meeting - re: Tygie',NULL,0,123,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-12 00:56:28','2018-03-19 22:25:42'),(173,'SKUBBS-33','2018-03-09 21:00:00','2018-03-10 00:30:00','Trustlink Flatfile',NULL,1363.64,3.5,745.78,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-12 19:33:40','2018-03-19 22:23:03'),(174,'SKUBBS-33','2018-03-10 06:00:00','2018-03-10 08:00:00','Trustlink Flatfile',NULL,1363.64,2,443.2,'restday',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-12 19:33:40','2018-03-19 22:21:25'),(175,'SKUBBS-33','2018-03-13 21:30:00','2018-03-13 22:30:00','Trustlink Flatfile',NULL,1363.64,1,213.08,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-14 01:49:37','2018-03-19 22:23:53'),(176,'SKUBBS-41','2018-03-14 21:00:00','2018-03-15 01:00:00','TEF HTML/CSS DESIGN',NULL,1136.36,4,710.2,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-14 22:22:35','2018-03-19 20:13:59'),(177,'SKUBBS-43','2018-03-01 09:30:00','2018-03-01 17:30:00','Muntinlupa Day',NULL,2500,8,3250,'restday',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-15 00:33:57','2018-03-19 20:13:17'),(178,'SKUBBS-33','2018-03-15 22:30:00','2018-03-16 01:00:00','Trustlink Flatfile',NULL,1363.64,2.5,532.7,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-16 15:35:54','2018-03-19 21:34:00'),(179,'SKUBBS-33','2018-03-16 06:30:00','2018-03-16 09:30:00','Trustlink Flatfile',NULL,1363.64,3,639.24,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-16 15:35:54','2018-03-19 22:20:35'),(180,'SKUBBS-33','2018-03-16 18:30:00','2018-03-16 23:00:00','Trustlink Flatfile',NULL,0,4.5,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-16 15:35:54','2018-03-19 21:40:20'),(181,'SKUBBS-41','2018-03-18 13:00:00','2018-03-18 18:00:00','Converts TEF PSD Landing page to HTML/CSS',NULL,1136.36,5,923.25,'restday',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-18 06:49:12','2018-03-19 20:11:24'),(182,'SKUBBS-41','2018-03-18 01:00:00','2018-03-18 06:00:00','TEF DESIGN CONVERT PSD to HTML/CSS',NULL,0,5,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-18 17:21:11','2018-03-19 20:10:07'),(183,'SKUBBS-33','2018-03-17 15:30:00','2018-03-17 17:00:00','Trustlink Flatfile',NULL,0,49.5,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-18 18:15:54','2018-03-19 21:00:54'),(184,'SKUBBS-40','2018-03-16 19:00:00','2018-03-16 21:00:00','Renal Team Mobile view mockup',NULL,1045.45,2,326.7,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-18 19:41:20','2018-03-19 20:07:52'),(185,'SKUBBS-32','2018-03-07 20:00:00','2018-03-07 23:00:00','ot filet app',NULL,1454.55,3,681.81,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 02:28:11','2018-03-19 20:06:19'),(186,'SKUBBS-32','2018-03-08 20:00:00','2018-03-08 22:00:00','ot filet app',NULL,1454.55,2,454.54,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 02:28:11','2018-03-19 20:06:51'),(187,'SKUBBS-32','2018-03-19 19:00:00','2018-03-19 23:00:00','ot filet app producer and talent',NULL,1454.55,4,909.08,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 20:41:39','2018-03-19 22:38:17'),(188,'SKUBBS-30','2018-03-08 23:00:00','2018-03-09 01:00:00','QA for Filet Talent App',NULL,1590.91,2,497.16,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 20:48:32','2018-03-19 22:40:06'),(189,'SKUBBS-30','2018-03-07 22:00:00','2018-03-08 00:00:00','QA for Filet Talent App',NULL,1590.91,2,497.16,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 20:48:32','2018-03-19 22:39:32'),(190,'SKUBBS-30','2018-03-19 21:00:00','2018-03-20 00:30:00','QA for Filet Producer App and Talent App',NULL,1590.91,3.5,870.03,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 20:48:32','2018-03-19 22:40:35'),(191,'SKUBBS-33','2018-03-17 15:30:00','2018-03-17 17:00:00','Trustlink Flatfile',NULL,1363.64,1.5,332.4,'restday',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 21:02:50','2018-03-19 21:33:10'),(192,'SKUBBS-33','2018-03-16 18:30:00','2018-03-16 23:00:00','Trustlink Flatfile',NULL,1363.64,4.5,958.86,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 21:42:31','2018-03-19 22:19:14'),(193,'SKUBBS-11','2018-03-20 18:30:00','2018-03-20 23:00:00','g',NULL,0,4.5,0,'ordinary',2,'3','2018','debbie@im.skubbs.com','rejected','2018-03-19 22:18:15','2018-03-19 22:18:39'),(194,'SKUBBS-26','2018-03-07 18:30:00','2018-03-07 20:30:00','3 hours OT (6:30 - 9:30). Daily tasks recovery due to client meeting - re: Tygie',NULL,0,4,0,'ordinary',1,'3','2018','debbie@im.skubbs.com','rejected','2018-03-19 22:28:07','2018-03-19 22:30:44'),(195,'SKUBBS-26','2018-03-20 18:30:00','2018-03-20 21:30:00','3 hours OT (6:30 - 9:30). Daily tasks recovery due to client meeting - re: Tygie',NULL,0,2,0,'ordinary',1,'3','2018','debbie@im.skubbs.com','rejected','2018-03-19 22:31:06','2018-03-19 22:33:19'),(196,'SKUBBS-26','2018-03-07 18:30:00','2018-03-07 21:30:00','3 hours OT (6:30 - 9:30). Daily tasks recovery due to client meeting - re: Tygie',NULL,2045.45,3,958.8,'ordinary',2,'3','2018','debbie@im.skubbs.com','approved','2018-03-19 22:34:04','2018-03-19 22:37:14'),(197,'SKUBBS-09','2018-03-08 00:00:00','2018-03-08 02:30:00','Testing',NULL,NULL,2.5,NULL,'ordinary',0,NULL,NULL,'','pending','2018-03-21 01:50:41','0000-00-00 00:00:00'),(198,'SKUBBS-15','2018-03-21 17:55:00','2018-03-22 01:00:00','test application',NULL,NULL,7.5,NULL,'ordinary',0,NULL,NULL,'','pending','2018-03-21 01:56:01','0000-00-00 00:00:00'),(199,'SKUBBS-09','2018-03-15 01:00:00','2018-03-15 22:00:00','testing',NULL,NULL,21,NULL,'ordinary',0,NULL,NULL,'','pending','2018-03-21 18:54:44','0000-00-00 00:00:00'),(200,'SKUBBS-30','2018-02-28 21:30:00','2018-03-01 01:30:00','TEST REASON',NULL,0,4,0,'ordinary',1,'2','2018','skubbs.dev@gmail.com','rejected','2018-03-21 19:41:16','2018-03-22 04:04:13'),(201,'SKUBBS-09','2018-03-23 00:00:00','2018-03-23 03:00:00','as',NULL,NULL,3,NULL,'ordinary',0,NULL,NULL,'','pending','2018-03-22 03:54:47','0000-00-00 00:00:00'),(202,'SKUBBS-30','2018-02-28 00:00:00','2018-02-28 02:00:00','test reason',NULL,NULL,2,NULL,'ordinary',0,NULL,NULL,'','pending','2018-03-22 04:34:08','0000-00-00 00:00:00'),(203,'SKUBBS-01','2018-07-04 17:01:00','2018-07-06 23:30:00','a',NULL,NULL,54.5,NULL,'ordinary',0,NULL,NULL,'','pending','2018-07-06 09:01:20','0000-00-00 00:00:00'),(205,'TGSD-16-150000','2018-03-21 21:00:00','2018-03-21 23:00:00','tettsts',NULL,NULL,2,NULL,'ordinary',0,NULL,NULL,'','pending','2018-08-31 07:19:23','0000-00-00 00:00:00'),(206,'SKUBBS01','2018-03-21 21:00:00','2018-03-21 23:00:00','tst','',0,2,0,'ordinary',1,'3','2018','rhanbarredo@gmail.co','approved','2018-09-20 08:59:25','2018-09-24 04:30:42'),(207,'SKUBBS01','2018-03-21 21:00:00','2018-03-21 23:00:00','Rush',NULL,NULL,2,NULL,'ordinary',0,NULL,NULL,'','pending','2018-09-25 10:52:13','0000-00-00 00:00:00'),(208,'SKUBBS01','2018-03-21 21:00:00','2018-03-21 23:30:00','Test','',0,2.5,0,'ordinary',1,'3','2018','rhanbarredo@gmail.co','approved','2018-10-03 06:59:55','2018-10-03 07:01:05');
/*!40000 ALTER TABLE `overtime_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payrolls`
--

DROP TABLE IF EXISTS `payrolls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payrolls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `period` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - No period, 1 - first period, 2 - second period...',
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_mode` enum('cash','paypal','bank_transfer','cheque') COLLATE utf8_unicode_ci NOT NULL,
  `basic` float(8,2) NOT NULL,
  `overtime_hours` float(8,2) NOT NULL,
  `overtime_pay` float(8,2) NOT NULL,
  `allowances` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_allowance` float(8,2) NOT NULL,
  `deductions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_deduction` float(8,2) NOT NULL,
  `sss_deduction` float(11,2) NOT NULL,
  `philhealth_deduction` float(11,2) NOT NULL,
  `pagibig_deduction` float(11,2) NOT NULL,
  `withholding_tax` float(11,2) NOT NULL,
  `additionals` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_additional` float(8,2) NOT NULL,
  `net_salary` float(8,2) NOT NULL,
  `pay_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expense` float(8,2) NOT NULL,
  `acpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dcpf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ecpf` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=339 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payrolls`
--

LOCK TABLES `payrolls` WRITE;
/*!40000 ALTER TABLE `payrolls` DISABLE KEYS */;
INSERT INTO `payrolls` VALUES (25,'SKUBBS-01','9',1,'2017','cash',25000.00,0.00,0.00,'{\"Bonus\":\"10000\"}',10000.00,'[]',0.00,0.00,0.00,0.00,4026.82,'',0.00,30973.18,'0000-00-00','2017-09-29 02:10:52','2017-10-01 23:33:02',0.00,'','',''),(26,'SKUBBS-02','9',1,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"1000\"}',1000.00,'[]',0.00,0.00,0.00,0.00,2381.01,'',0.00,12618.99,'0000-00-00','2017-09-29 02:10:52','2017-10-01 23:39:25',0.00,'','',''),(27,'SKUBBS-03','9',1,'2017','cash',15000.00,2.00,426.04,'{\"Bonus\":\"1000\"}',1000.00,'[]',0.00,0.00,0.00,0.00,2688.81,'',0.00,13737.23,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:03:48',0.00,'','',''),(28,'SKUBBS-04','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"4000\"}',4000.00,'[]',0.00,0.00,0.00,0.00,1350.21,'',0.00,12649.79,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:07:07',0.00,'','',''),(29,'SKUBBS-05','9',1,'2017','cash',9000.00,5.00,664.77,'{\"Bonus\":\"3500\"}',3500.00,'[]',0.00,0.00,0.00,0.00,332.03,'',0.00,12832.74,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:09:25',0.00,'','',''),(30,'SKUBBS-06','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3500\"}',3500.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,13019.85,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:36:29',0.00,'','',''),(31,'SKUBBS-07','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3750\"}',3750.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,13269.85,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:16:21',0.00,'','',''),(32,'SKUBBS-08','9',1,'2017','cash',10000.00,22.00,3227.27,'{\"Bonus\":\"4250\"}',4250.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,16997.12,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:14:26',0.00,'','',''),(33,'SKUBBS-09','9',1,'2017','cash',7500.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',0.00,0.00,0.00,0.00,158.38,'',0.00,9841.62,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:17:39',0.00,'','',''),(34,'SKUBBS-10','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3000\"}',3000.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,12519.85,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:18:36',0.00,'','',''),(35,'SKUBBS-11','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:19:08',0.00,'','',''),(36,'SKUBBS-12','9',1,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(37,'SKUBBS-13','9',1,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(38,'SKUBBS-14','9',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(39,'SKUBBS-15','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(40,'SKUBBS-16','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(41,'SKUBBS-17','9',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(42,'SKUBBS-18','9',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(43,'SKUBBS-19','9',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(44,'SKUBBS-20','9',1,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-09-29 02:10:52','2017-09-29 02:10:52',0.00,'','',''),(45,'SKUBBS-21','9',1,'2017','cash',9000.00,1.30,166.91,'{\"Bonus\":\"2500\"}',2500.00,'[]',0.00,0.00,0.00,0.00,332.03,'',0.00,11334.88,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:21:26',0.00,'','',''),(46,'SKUBBS-22','9',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',0.00,0.00,0.00,0.00,983.30,'',0.00,11516.70,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:23:30',0.00,'','',''),(47,'SKUBBS-23','9',1,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',17272.73,0.00,0.00,0.00,0.00,'',0.00,30227.27,'0000-00-00','2017-09-29 02:10:52','2017-10-02 00:25:42',0.00,'','',''),(49,'SKUBBS-01','9',2,'2017','cash',25000.00,0.00,0.00,'{\"Bonus\":\"25000\"}',25000.00,'[]',1118.80,581.30,437.50,100.00,4026.82,'',0.00,44854.38,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:30:10',0.00,'','',''),(50,'SKUBBS-02','9',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"1738.32\"}',1738.32,'{\"SSS Loan\":\"738.32\"}',1769.62,581.30,350.00,100.00,2381.01,'',0.00,11587.69,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:44:16',0.00,'','',''),(51,'SKUBBS-03','9',2,'2017','cash',15000.00,12.50,2769.89,'{\"Bonus\":\"1000\"}',1000.00,'[]',1056.30,581.30,375.00,100.00,2688.81,'',0.00,15024.78,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:47:12',0.00,'','',''),(52,'SKUBBS-04','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"4000\"}',4000.00,'[]',931.30,581.30,250.00,100.00,1350.21,'',0.00,11718.49,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:48:36',0.00,'','',''),(53,'SKUBBS-05','9',2,'2017','cash',9000.00,0.00,0.00,'{\"Bonus\":\"3500\"}',3500.00,'[]',906.30,581.30,225.00,100.00,332.03,'',0.00,11261.67,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:50:20',0.00,'','',''),(54,'SKUBBS-06','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3500\"}',3500.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,12088.55,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:51:20',0.00,'','',''),(55,'SKUBBS-07','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3750\"}',3750.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,12338.55,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:52:19',0.00,'','',''),(56,'SKUBBS-08','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"4250\"}',4250.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,12838.55,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:53:56',0.00,'','',''),(57,'SKUBBS-09','9',2,'2017','cash',7500.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',832.50,545.00,187.50,100.00,158.38,'',0.00,9009.12,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:54:34',0.00,'','',''),(58,'SKUBBS-10','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3000\"}',3000.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,11588.55,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:55:13',0.00,'','',''),(59,'SKUBBS-11','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:55:46',0.00,'','',''),(60,'SKUBBS-12','9',2,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:56:08',0.00,'','',''),(61,'SKUBBS-13','9',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:56:28',0.00,'','',''),(62,'SKUBBS-14','9',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:56:56',0.00,'','',''),(63,'SKUBBS-15','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:57:18',0.00,'','',''),(64,'SKUBBS-16','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:57:40',0.00,'','',''),(65,'SKUBBS-17','9',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:33:23',0.00,'','',''),(66,'SKUBBS-18','9',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:58:01',0.00,'','',''),(67,'SKUBBS-19','9',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 00:58:58',0.00,'','',''),(68,'SKUBBS-20','9',2,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Unpaid leave\":\"2090.90\"}',2090.90,0.00,0.00,0.00,0.00,'',0.00,9409.10,'0000-00-00','2017-10-02 00:27:19','2017-10-02 01:00:52',0.00,'','',''),(69,'SKUBBS-21','9',2,'2017','cash',9000.00,16.33,2142.61,'{\"Bonus\":\"2500\"}',2500.00,'[]',906.30,581.30,225.00,100.00,332.03,'',0.00,12404.28,'0000-00-00','2017-10-02 00:27:19','2017-10-02 01:03:23',0.00,'','',''),(70,'SKUBBS-22','9',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',993.80,581.30,312.50,100.00,983.30,'',0.00,10522.90,'0000-00-00','2017-10-02 00:27:19','2017-10-02 01:05:13',0.00,'','',''),(71,'SKUBBS-23','9',2,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,47500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 01:05:35',0.00,'','',''),(72,'SKUBBS-24','9',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-10-02 00:27:19','2017-10-02 01:05:59',0.00,'','',''),(73,'SKUBBS-01','10',1,'2017','cash',25000.00,0.00,0.00,'{\"Bonus\":\"15000\"}',15000.00,'[]',0.00,0.00,0.00,0.00,4026.82,'',0.00,35973.18,'0000-00-00','2017-10-04 21:58:57','2017-10-18 00:47:15',0.00,'','',''),(74,'SKUBBS-02','10',1,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"1000\"}',1000.00,'[]',0.00,0.00,0.00,0.00,2381.01,'',0.00,12618.99,'0000-00-00','2017-10-04 21:58:57','2017-10-18 00:46:03',0.00,'','',''),(75,'SKUBBS-03','10',1,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"1000\"}',1000.00,'[]',0.00,0.00,0.00,0.00,2688.81,'',0.00,13311.19,'0000-00-00','2017-10-04 21:58:58','2017-10-18 00:44:54',0.00,'','',''),(76,'SKUBBS-04','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"4000\"}',4000.00,'[]',0.00,0.00,0.00,0.00,1350.21,'',0.00,12649.79,'0000-00-00','2017-10-04 21:58:58','2017-10-18 00:32:17',0.00,'','',''),(77,'SKUBBS-05','10',1,'2017','cash',9000.00,0.00,0.00,'{\"Bonus\":\"3500\"}',3500.00,'[]',0.00,0.00,0.00,0.00,332.03,'',0.00,12167.97,'0000-00-00','2017-10-04 21:58:58','2017-10-18 00:29:21',0.00,'','',''),(78,'SKUBBS-06','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3500\"}',3500.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,13019.85,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:31:18',0.00,'','',''),(79,'SKUBBS-07','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3750\"}',3750.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,13269.85,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:25:33',0.00,'','',''),(80,'SKUBBS-08','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"4250\"}',4250.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,13769.85,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:24:18',0.00,'','',''),(81,'SKUBBS-09','10',1,'2017','cash',7500.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',0.00,0.00,0.00,0.00,158.38,'',0.00,9841.62,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:23:07',0.00,'','',''),(82,'SKUBBS-10','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3000\"}',3000.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,12519.85,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:21:31',0.00,'','',''),(83,'SKUBBS-11','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(84,'SKUBBS-12','10',1,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(85,'SKUBBS-13','10',1,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(86,'SKUBBS-14','10',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(87,'SKUBBS-15','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(88,'SKUBBS-16','10',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(89,'SKUBBS-17','10',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(90,'SKUBBS-18','10',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(91,'SKUBBS-19','10',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(92,'SKUBBS-20','10',1,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(93,'SKUBBS-21','10',1,'2017','cash',9000.00,18.10,2490.34,'{\"Bonus\":\"2500\"}',2500.00,'[]',0.00,0.00,0.00,0.00,332.03,'',0.00,13658.31,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:18:58',0.00,'','',''),(94,'SKUBBS-22','10',1,'2017','cash',10000.00,3.00,443.19,'{\"Bonus\":\"2500\"}',2500.00,'[]',0.00,0.00,0.00,0.00,983.30,'',0.00,11959.89,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:16:11',0.00,'','',''),(95,'SKUBBS-23','10',1,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,47500.00,'0000-00-00','2017-10-04 21:58:58','2017-10-04 21:58:58',0.00,'','',''),(96,'SKUBBS-24','10',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"8 days\":\"9818.18\"}',9818.18,0.00,0.00,0.00,0.00,'',0.00,3681.82,'0000-00-00','2017-10-04 21:58:58','2017-10-16 23:13:30',0.00,'','',''),(97,'SKUBBS-01','10',2,'2017','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',1118.80,581.30,437.50,100.00,4026.82,'',0.00,34854.38,'0000-00-00','2017-11-06 23:12:44','2018-02-21 21:40:29',0.00,'','',''),(98,'SKUBBS-03','10',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"1000\"}',1000.00,'[]',1056.30,581.30,375.00,100.00,2688.81,'',0.00,12254.89,'0000-00-00','2017-11-06 23:12:45','2017-11-07 18:59:30',0.00,'','',''),(99,'SKUBBS-05','10',2,'2017','cash',9000.00,0.00,0.00,'{\"Bonus\":\"3500\"}',3500.00,'[]',906.30,581.30,225.00,100.00,332.03,'',0.00,11261.67,'0000-00-00','2017-11-06 23:12:45','2017-11-07 18:57:47',0.00,'','',''),(100,'SKUBBS-07','10',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3750\"}',3750.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,12338.55,'0000-00-00','2017-11-06 23:12:45','2017-11-07 18:56:34',0.00,'','',''),(101,'SKUBBS-08','10',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"4250\"}',4250.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,12838.55,'0000-00-00','2017-11-06 23:12:45','2017-11-07 18:55:34',0.00,'','',''),(102,'SKUBBS-09','10',2,'2017','cash',7500.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',832.50,545.00,187.50,100.00,158.38,'',0.00,9009.12,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:05:49',0.00,'','',''),(103,'SKUBBS-10','10',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"3000\"}',3000.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,11588.55,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:04:41',0.00,'','',''),(105,'SKUBBS-13','10',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:02:58',0.00,'','',''),(106,'SKUBBS-15','10',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:02:40',0.00,'','',''),(107,'SKUBBS-16','10',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:02:23',0.00,'','',''),(108,'SKUBBS-17','10',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:02:04',0.00,'','',''),(109,'SKUBBS-19','10',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:01:43',0.00,'','',''),(110,'SKUBBS-20','10',2,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:01:26',0.00,'','',''),(111,'SKUBBS-21','10',2,'2017','cash',9000.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',906.30,581.30,225.00,100.00,332.03,'',0.00,10261.67,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:01:05',0.00,'','',''),(112,'SKUBBS-22','10',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"2500\"}',2500.00,'[]',993.80,581.30,312.50,100.00,983.30,'',0.00,10522.90,'0000-00-00','2017-11-06 23:12:45','2017-11-07 02:00:03',0.00,'','',''),(113,'SKUBBS-23','10',2,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,47500.00,'0000-00-00','2017-11-06 23:12:45','2017-11-07 01:57:24',0.00,'','',''),(115,'SKUBBS-26','10',2,'2017','cash',22500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,22500.00,'0000-00-00','2017-11-07 19:12:44','2017-11-07 19:12:44',0.00,'','',''),(116,'SKUBBS-02','10',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"1000\"}',1000.00,'[]',1031.30,581.30,350.00,100.00,2381.01,'',0.00,11587.69,'0000-00-00','2017-11-07 20:29:27','2017-11-07 20:29:27',0.00,'','',''),(117,'SKUBBS-01','11',2,'2017','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',1118.80,581.30,437.50,100.00,4026.82,'',0.00,34854.38,'0000-00-00','2017-12-03 18:16:03','2017-12-03 23:56:56',0.00,'','',''),(118,'SKUBBS-03','11',2,'2017','cash',15000.00,0.00,0.00,'{\"Allowance\":\"3250\"}',3250.00,'[]',1056.30,581.30,375.00,100.00,2688.81,'',0.00,14504.89,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:55:57',0.00,'','',''),(119,'SKUBBS-05','11',2,'2017','cash',9000.00,0.00,0.00,'{\"Allowance\":\"5500\"}',5500.00,'[]',906.30,581.30,225.00,100.00,332.03,'',0.00,13261.67,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:54:39',0.00,'','',''),(120,'SKUBBS-07','11',2,'2017','cash',10000.00,13.00,1846.68,'{\"Allowance\":\"7500\"}',7500.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,17935.23,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:53:04',0.00,'','',''),(121,'SKUBBS-08','11',2,'2017','cash',10000.00,7.00,994.35,'{\"Allowance\":\"6750\"}',6750.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,16332.90,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:47:36',0.00,'','',''),(122,'SKUBBS-09','11',2,'2017','cash',7500.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',832.50,545.00,187.50,100.00,158.38,'',0.00,11009.12,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:43:09',0.00,'','',''),(123,'SKUBBS-10','11',2,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,13088.55,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:42:33',0.00,'','',''),(125,'SKUBBS-13','11',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:40:55',0.00,'','',''),(126,'SKUBBS-15','11',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:39:56',0.00,'','',''),(127,'SKUBBS-16','11',2,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:39:12',0.00,'','',''),(128,'SKUBBS-17','11',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:28:06',0.00,'','',''),(129,'SKUBBS-19','11',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:26:34',0.00,'','',''),(130,'SKUBBS-20','11',2,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:23:27',0.00,'','',''),(131,'SKUBBS-22','11',2,'2017','cash',10000.00,0.00,639.23,'{\"Allowance\":\"5000\"}',5000.00,'[]',931.30,581.30,250.00,100.00,983.30,'',0.00,13724.63,'0000-00-00','2017-12-03 18:16:04','2017-12-03 23:19:16',0.00,'','',''),(132,'SKUBBS-23','11',2,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,47500.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 22:56:37',0.00,'','',''),(134,'SKUBBS-26','11',2,'2017','cash',22500.00,27.00,8629.20,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,31129.20,'0000-00-00','2017-12-03 18:16:04','2017-12-03 20:05:38',0.00,'','',''),(135,'SKUBBS-28','11',2,'2017','cash',20000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20000.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 18:16:04',0.00,'','',''),(138,'SKUBBS-31','11',2,'2017','cash',18500.00,18.00,4730.22,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,23230.22,'0000-00-00','2017-12-03 18:16:04','2017-12-03 20:00:30',0.00,'','',''),(140,'SKUBBS-33','11',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-12-03 18:16:04','2017-12-03 19:55:10',0.00,'','',''),(143,'SKUBBS-36','11',2,'2017','cash',13500.00,8.00,1227.27,'{\"Additional Pay x 5 Days\":\"6136.35\"}',6136.35,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20863.62,'0000-00-00','2017-12-03 18:16:04','2017-12-03 19:52:48',0.00,'','',''),(144,'SKUBBS-01','11',1,'2017','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',0.00,0.00,0.00,0.00,4026.82,'',0.00,35973.18,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:47:39',0.00,'','',''),(145,'SKUBBS-03','11',1,'2017','cash',15000.00,0.00,0.00,'{\"Allowance\":\"3250\"}',3250.00,'[]',0.00,0.00,0.00,0.00,2688.81,'',0.00,15561.19,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:44:04',0.00,'','',''),(146,'SKUBBS-05','11',1,'2017','cash',9000.00,0.00,0.00,'{\"Allowance\":\"5500\"}',5500.00,'[]',0.00,0.00,0.00,0.00,332.03,'',0.00,14167.97,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:42:14',0.00,'','',''),(147,'SKUBBS-07','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"7500\"}',7500.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,17019.85,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:39:39',0.00,'','',''),(148,'SKUBBS-08','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"6750\"}',6750.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,16269.85,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:36:50',0.00,'','',''),(149,'SKUBBS-09','11',1,'2017','cash',7500.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,158.38,'',0.00,11841.62,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:35:13',0.00,'','',''),(150,'SKUBBS-10','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,14019.85,'0000-00-00','2017-12-03 18:16:36','2017-12-03 19:33:35',0.00,'','',''),(151,'SKUBBS-11','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-03 18:16:36','2017-12-03 18:16:36',0.00,'','',''),(152,'SKUBBS-13','11',1,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-12-03 18:16:36','2017-12-03 18:16:36',0.00,'','',''),(153,'SKUBBS-15','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-03 18:16:36','2017-12-03 18:16:36',0.00,'','',''),(154,'SKUBBS-16','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-03 18:16:36','2017-12-03 18:16:36',0.00,'','',''),(155,'SKUBBS-17','11',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-12-03 18:16:36','2017-12-03 18:16:36',0.00,'','',''),(156,'SKUBBS-19','11',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-12-03 18:16:36','2017-12-03 18:16:37',0.00,'','',''),(157,'SKUBBS-20','11',1,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-12-03 18:16:37','2017-12-03 18:16:37',0.00,'','',''),(158,'SKUBBS-22','11',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"5000\"}',5000.00,'[]',0.00,0.00,0.00,0.00,983.30,'',0.00,14016.70,'0000-00-00','2017-12-03 18:16:37','2017-12-03 19:26:15',0.00,'','',''),(159,'SKUBBS-23','11',1,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,47500.00,'0000-00-00','2017-12-03 18:16:37','2017-12-03 20:06:33',0.00,'','',''),(161,'SKUBBS-26','11',1,'2017','cash',22500.00,0.00,0.00,'{\"Additional Pay x 5 Days\":\"10227.27\"}',10227.27,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,32727.27,'0000-00-00','2017-12-03 18:16:37','2017-12-03 19:23:17',0.00,'','',''),(162,'SKUBBS-28','11',1,'2017','cash',20000.00,8.00,1818.18,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,21818.18,'0000-00-00','2017-12-03 18:16:37','2017-12-03 19:20:30',0.00,'','',''),(164,'SKUBBS-30','11',1,'2017','cash',17500.00,0.00,0.00,'{\"Additional Pay x 8 days\":\"12727.27\"}',12727.27,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,30227.27,'0000-00-00','2017-12-03 18:16:37','2017-12-03 18:33:22',0.00,'','',''),(171,'SKUBBS-29','11',1,'2017','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Half day\":\"727.27\"}',727.27,0.00,0.00,0.00,0.00,'',0.00,15272.73,'0000-00-00','2017-12-03 18:40:01','2017-12-03 18:40:01',0.00,'','',''),(172,'SKUBBS-29','11',2,'2017','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2017-12-03 20:02:21','2017-12-03 20:02:21',0.00,'','',''),(173,'SKUBBS-01','12',1,'2017','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',0.00,0.00,0.00,0.00,4026.82,'',0.00,35973.18,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:14:27',0.00,'','',''),(174,'SKUBBS-03','12',1,'2017','cash',15000.00,22.00,4841.12,'{\"Allowance\":\"3250\"}',3250.00,'[]',0.00,0.00,0.00,0.00,2688.81,'',0.00,20402.31,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:16:34',0.00,'','',''),(175,'SKUBBS-05','12',1,'2017','cash',9000.00,8.00,1063.60,'{\"Allowance\":\"5500\"}',5500.00,'[]',0.00,0.00,0.00,0.00,332.03,'',0.00,15231.57,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:18:29',0.00,'','',''),(176,'SKUBBS-07','12',1,'2017','cash',10000.00,17.00,2414.80,'{\"Allowance\":\"7500\"}',7500.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,19434.65,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:21:11',0.00,'','',''),(177,'SKUBBS-08','12',1,'2017','cash',10000.00,10.50,1502.89,'{\"Allowance\":\"6750\"}',6750.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,17772.74,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:22:44',0.00,'','',''),(178,'SKUBBS-09','12',1,'2017','cash',7500.00,2.00,213.08,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,158.38,'',0.00,12054.70,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:24:26',0.00,'','',''),(179,'SKUBBS-10','12',1,'2017','cash',10000.00,4.00,590.22,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,480.15,'',0.00,14610.07,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:25:56',0.00,'','',''),(180,'SKUBBS-11','12',1,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:28:00',0.00,'','',''),(181,'SKUBBS-13','12',1,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:28:21',0.00,'','',''),(182,'SKUBBS-15','12',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:28:53',0.00,'','',''),(183,'SKUBBS-16','12',1,'2017','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:29:11',0.00,'','',''),(184,'SKUBBS-17','12',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:11:45',0.00,'','',''),(185,'SKUBBS-19','12',1,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:11:45',0.00,'','',''),(186,'SKUBBS-20','12',1,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:11:45',0.00,'','',''),(187,'SKUBBS-22','12',1,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',0.00,0.00,0.00,0.00,983.30,'',0.00,14016.70,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:27:13',0.00,'','',''),(188,'SKUBBS-23','12',1,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,47500.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:29:52',0.00,'','',''),(189,'SKUBBS-24','12',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:11:45',0.00,'','',''),(190,'SKUBBS-26','12',1,'2017','cash',22500.00,9.00,5982.93,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,28482.93,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:31:43',0.00,'','',''),(191,'SKUBBS-28','12',1,'2017','cash',20000.00,4.00,1136.36,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,21136.36,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:42:38',0.00,'','',''),(192,'SKUBBS-29','12',1,'2017','cash',16000.00,12.50,2936.42,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18936.42,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:43:19',0.00,'','',''),(193,'SKUBBS-30','12',1,'2017','cash',17500.00,4.50,1118.81,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18618.81,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:43:58',0.00,'','',''),(194,'SKUBBS-31','12',1,'2017','cash',18500.00,4.00,2186.40,'{\"Additional Pay x 6 days\":\"10090.91\"}',10090.91,'{\"Absent 3.50\":\"5886.36\"}',5886.36,0.00,0.00,0.00,0.00,'',0.00,24890.95,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:45:20',0.00,'','',''),(195,'SKUBBS-32','12',1,'2017','cash',16000.00,21.00,4918.27,'{\"Additional Pay x 9 days\":\"13090.91\"}',13090.91,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,34009.18,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:47:33',0.00,'','',''),(196,'SKUBBS-33','12',1,'2017','cash',15000.00,0.00,0.00,'{\"Additional Pay x 3 Days\":\"4090.91\"}',4090.91,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,19090.91,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:46:29',0.00,'','',''),(198,'SKUBBS-35','12',1,'2017','cash',12500.00,0.00,0.00,'{\"Additional Pay x 3 Days\":\"3409.09\"}',3409.09,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15909.09,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:55:21',0.00,'','',''),(199,'SKUBBS-36','12',1,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent \":\"1227.27\"}',1227.27,0.00,0.00,0.00,0.00,'',0.00,12272.73,'0000-00-00','2017-12-13 22:11:45','2017-12-13 22:55:46',0.00,'','',''),(200,'SKUBBS-37','12',1,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2017-12-13 22:42:02','2017-12-13 22:42:02',0.00,'','',''),(201,'SKUBBS-34','12',1,'2017','cash',14000.00,0.00,0.00,'{\"Additional Pay x 4 Days\":\"5090.91\"}',5090.91,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,19090.91,'0000-00-00','2017-12-13 22:54:44','2017-12-13 22:54:44',0.00,'','',''),(202,'SKUBBS-01','12',2,'2017','cash',25000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',1118.80,581.30,437.50,100.00,0.00,'',0.00,23881.20,'0000-00-00','2017-12-25 20:02:12','2017-12-25 20:02:12',0.00,'','',''),(203,'SKUBBS-03','12',2,'2017','cash',15000.00,0.00,0.00,'{\"Allowance\":\"3250\"}',3250.00,'[]',1056.30,581.30,375.00,100.00,2688.81,'',0.00,14504.89,'0000-00-00','2017-12-25 20:02:12','2018-01-03 21:36:05',0.00,'','',''),(204,'SKUBBS-05','12',2,'2017','cash',9000.00,8.00,1022.46,'{\"Allowance\":\"5500\"}',5500.00,'[]',906.30,581.30,225.00,100.00,332.03,'',0.00,14284.13,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:12:19',0.00,'','',''),(205,'SKUBBS-07','12',2,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"7500\"}',7500.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,16088.55,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:13:09',0.00,'','',''),(206,'SKUBBS-08','12',2,'2017','cash',10000.00,8.00,1181.84,'{\"Allowance\":\"6750\"}',6750.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,16520.39,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:14:45',0.00,'','',''),(207,'SKUBBS-09','12',2,'2017','cash',7500.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',832.50,545.00,187.50,100.00,158.38,'',0.00,11009.12,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:15:54',0.00,'','',''),(208,'SKUBBS-10','12',2,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',931.30,581.30,250.00,100.00,480.15,'',0.00,13088.55,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:20:50',0.00,'','',''),(209,'SKUBBS-11','12',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:29:59',0.00,'','',''),(210,'SKUBBS-13','12',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:30:27',0.00,'','',''),(211,'SKUBBS-15','12',2,'2017','cash',10000.00,20.00,2954.57,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12954.57,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:31:24',0.00,'','',''),(212,'SKUBBS-16','12',2,'2017','cash',10000.00,5.50,812.51,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10812.51,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:32:17',0.00,'','',''),(213,'SKUBBS-17','12',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:32:54',0.00,'','',''),(214,'SKUBBS-19','12',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:33:28',0.00,'','',''),(215,'SKUBBS-20','12',2,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:33:55',0.00,'','',''),(216,'SKUBBS-22','12',2,'2017','cash',10000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',931.30,581.30,250.00,100.00,983.30,'',0.00,13085.40,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:21:41',0.00,'','',''),(217,'SKUBBS-23','12',2,'2017','cash',47500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',1118.80,581.30,437.50,100.00,0.00,'',0.00,46381.20,'0000-00-00','2017-12-25 20:02:12','2017-12-25 20:02:12',0.00,'','',''),(218,'SKUBBS-24','12',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',1018.80,581.30,337.50,100.00,0.00,'',0.00,12481.20,'0000-00-00','2017-12-25 20:02:12','2017-12-25 20:02:12',0.00,'','',''),(219,'SKUBBS-26','12',2,'2017','cash',22500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,22500.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:34:30',0.00,'','',''),(220,'SKUBBS-28','12',2,'2017','cash',20000.00,6.00,1704.53,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 1\":\"1818.18\"}',1818.18,0.00,0.00,0.00,0.00,'',0.00,19886.35,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:35:41',0.00,'','',''),(221,'SKUBBS-29','12',2,'2017','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:36:04',0.00,'','',''),(222,'SKUBBS-30','12',2,'2017','cash',17500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 4\":\"6363.64\"}',6363.64,0.00,0.00,0.00,0.00,'',0.00,11136.36,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:36:48',0.00,'','',''),(223,'SKUBBS-31','12',2,'2017','cash',18500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 7 \":\"11772.73\"}',11772.73,0.00,0.00,0.00,0.00,'',0.00,6727.27,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:37:34',0.00,'','',''),(224,'SKUBBS-32','12',2,'2017','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:37:58',0.00,'','',''),(225,'SKUBBS-33','12',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:38:33',0.00,'','',''),(226,'SKUBBS-34','12',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:38:55',0.00,'','',''),(227,'SKUBBS-35','12',2,'2017','cash',12500.00,4.50,798.83,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13298.83,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:39:38',0.00,'','',''),(228,'SKUBBS-36','12',2,'2017','cash',13500.00,6.50,1246.44,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14746.44,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:40:14',0.00,'','',''),(229,'SKUBBS-37','12',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2017-12-25 20:02:12','2018-01-03 22:40:38',0.00,'','',''),(230,'SKUBBS-01','11',2,'2018','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',1118.80,581.30,437.50,100.00,4026.82,'',0.00,34854.38,'0000-00-00','2018-01-03 21:01:09','2018-01-03 21:01:09',0.00,'','',''),(231,'SKUBBS-01','1',1,'2018','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',0.00,0.00,0.00,0.00,5563.66,'',0.00,34436.34,'0000-00-00','2018-01-16 23:41:18','2018-01-16 23:41:18',0.00,'','',''),(232,'SKUBBS-03','1',1,'2018','cash',15000.00,14.00,3080.82,'{\"Allowance\":\"3250\"}',3250.00,'[]',0.00,0.00,0.00,0.00,2281.19,'',0.00,19049.63,'0000-00-00','2018-01-16 23:42:02','2018-01-16 23:42:02',0.00,'','',''),(233,'SKUBBS-05','1',1,'2018','cash',9000.00,8.00,1063.60,'{\"Allowance\":\"5500\"}',5500.00,'[]',0.00,0.00,0.00,0.00,220.05,'',0.00,15343.55,'0000-00-00','2018-01-16 23:42:39','2018-01-16 23:42:39',0.00,'','',''),(234,'SKUBBS-07','1',1,'2018','cash',10000.00,15.50,2244.37,'{\"Allowance\":\"7500\"}',7500.00,'[]',0.00,0.00,0.00,0.00,477.29,'',0.00,19267.08,'0000-00-00','2018-01-16 23:43:24','2018-01-16 23:43:24',0.00,'','',''),(235,'SKUBBS-08','1',1,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"6750\"}',6750.00,'[]',0.00,0.00,0.00,0.00,409.10,'',0.00,16340.90,'0000-00-00','2018-01-16 23:44:06','2018-01-16 23:44:08',0.00,'','',''),(236,'SKUBBS-09','1',1,'2018','cash',7500.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12000.00,'0000-00-00','2018-01-16 23:44:39','2018-01-16 23:44:40',0.00,'','',''),(237,'SKUBBS-10','1',1,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,340.92,'',0.00,14159.08,'0000-00-00','2018-01-16 23:45:19','2018-01-16 23:45:19',0.00,'','',''),(238,'SKUBBS-22','1',1,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"5000\",\"Tax Return\":\"4213.29\"}',9213.29,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,19213.29,'0000-00-00','2018-01-16 23:46:08','2018-01-16 23:46:08',0.00,'','',''),(239,'SKUBBS-15','1',1,'2018','cash',10000.00,9.00,1329.56,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11329.56,'0000-00-00','2018-01-16 23:46:30','2018-01-16 23:46:30',0.00,'','',''),(240,'SKUBBS-16','1',1,'2018','cash',10000.00,13.00,1897.77,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11897.77,'0000-00-00','2018-01-16 23:46:46','2018-01-16 23:46:46',0.00,'','',''),(241,'SKUBBS-11','1',1,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-01-16 23:46:57','2018-01-16 23:46:57',0.00,'','',''),(242,'SKUBBS-13','1',1,'2018','cash',15000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',0.00,0.00,0.00,0.00,886.83,'',0.00,19113.17,'0000-00-00','2018-01-16 23:47:36','2018-01-16 23:47:36',0.00,'','',''),(243,'SKUBBS-26','1',1,'2018','cash',22500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,22500.00,'0000-00-00','2018-01-16 23:48:27','2018-01-16 23:48:27',0.00,'','',''),(244,'SKUBBS-28','1',1,'2018','cash',20000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20000.00,'0000-00-00','2018-01-16 23:50:39','2018-01-16 23:50:39',0.00,'','',''),(245,'SKUBBS-29','1',1,'2018','cash',16000.00,0.00,0.00,'[]',0.00,'{\"Absent x 2\":\"2909.09\"}',2909.09,0.00,0.00,0.00,0.00,'',0.00,13090.91,'0000-00-00','2018-01-16 23:55:06','2018-01-16 23:55:10',0.00,'','',''),(246,'SKUBBS-30','1',1,'2018','cash',17500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,17500.00,'0000-00-00','2018-01-16 23:55:30','2018-01-16 23:55:30',0.00,'','',''),(247,'SKUBBS-31','1',1,'2018','cash',18500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent x 7\":\"11772.73\"}',11772.73,0.00,0.00,0.00,0.00,'',0.00,6727.27,'0000-00-00','2018-01-16 23:56:40','2018-01-16 23:56:40',0.00,'','',''),(248,'SKUBBS-33','1',1,'2018','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2018-01-16 23:57:31','2018-01-16 23:57:31',0.00,'','',''),(249,'SKUBBS-32','1',1,'2018','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent x 1\":\"1454.55\"}',1454.55,0.00,0.00,0.00,0.00,'',0.00,14545.45,'0000-00-00','2018-01-16 23:58:23','2018-01-16 23:58:25',0.00,'','',''),(250,'SKUBBS-34','1',1,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',1272.73,0.00,0.00,0.00,0.00,'',0.00,12727.27,'0000-00-00','2018-01-16 23:59:09','2018-01-16 23:59:09',0.00,'','',''),(251,'SKUBBS-35','1',1,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-01-16 23:59:44','2018-01-16 23:59:44',0.00,'','',''),(252,'SKUBBS-39','1',1,'2018','cash',11000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11000.00,'0000-00-00','2018-01-17 00:00:03','2018-01-17 00:00:03',0.00,'','',''),(253,'SKUBBS-38','1',1,'2018','cash',17500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,17500.00,'0000-00-00','2018-01-17 00:07:27','2018-01-17 00:07:27',0.00,'','',''),(254,'SKUBBS-40','1',1,'2018','cash',11500.00,0.00,0.00,'[]',0.00,'{\"Start date is not within cut off\":\"5227.27\"}',5227.27,0.00,0.00,0.00,0.00,'',0.00,6272.73,'0000-00-00','2018-01-17 00:09:38','2018-01-17 00:09:38',0.00,'','',''),(255,'SKUBBS-17','1',1,'2018','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2018-01-17 00:10:02','2018-01-17 00:10:02',0.00,'','',''),(256,'SKUBBS-19','1',1,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-01-17 00:10:15','2018-01-17 00:10:15',0.00,'','',''),(257,'SKUBBS-20','1',1,'2018','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2018-01-17 00:10:37','2018-01-17 00:10:37',0.00,'','',''),(258,'SKUBBS-01','1',2,'2018','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',1231.30,581.30,550.00,100.00,5563.66,'',0.00,33205.04,'0000-00-00','2018-02-21 00:29:00','2018-02-21 00:29:00',0.00,'','',''),(259,'SKUBBS-03','1',2,'2018','cash',15000.00,11.00,2382.22,'{\"Allowance\":\"3250\"}',3250.00,'[]',1093.80,581.30,412.50,100.00,2281.19,'',0.00,17257.23,'0000-00-00','2018-02-21 00:30:17','2018-02-21 00:30:22',0.00,'','',''),(260,'SKUBBS-05','1',2,'2018','cash',9000.00,0.00,0.00,'{\"Allowance\":\"5500\"}',5500.00,'[]',928.80,581.30,247.50,100.00,220.05,'',0.00,13351.15,'0000-00-00','2018-02-21 00:31:34','2018-02-21 00:31:34',0.00,'','',''),(261,'SKUBBS-07','1',2,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"7500\"}',7500.00,'[]',956.30,581.30,275.00,100.00,477.29,'',0.00,16066.41,'0000-00-00','2018-02-21 00:33:13','2018-02-21 00:33:13',0.00,'','',''),(262,'SKUBBS-08','1',2,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"6750\"}',6750.00,'[]',956.30,581.30,275.00,100.00,409.10,'',0.00,15384.60,'0000-00-00','2018-02-21 00:34:16','2018-02-21 00:34:16',0.00,'','',''),(263,'SKUBBS-09','1',2,'2018','cash',7500.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',851.25,545.00,206.25,100.00,0.00,'',0.00,11148.75,'0000-00-00','2018-02-21 00:35:31','2018-02-21 00:35:31',0.00,'','',''),(264,'SKUBBS-10','1',2,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',956.30,581.30,275.00,100.00,340.92,'',0.00,13202.78,'0000-00-00','2018-02-21 00:36:10','2018-02-21 00:36:10',0.00,'','',''),(265,'SKUBBS-22','1',2,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',956.30,581.30,275.00,100.00,0.00,'',0.00,14043.70,'0000-00-00','2018-02-21 00:36:52','2018-02-21 00:36:52',0.00,'','',''),(266,'SKUBBS-15','1',2,'2018','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',956.30,581.30,275.00,100.00,0.00,'',0.00,9043.70,'0000-00-00','2018-02-21 00:37:45','2018-02-21 00:37:45',0.00,'','',''),(267,'SKUBBS-16','1',2,'2018','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',956.30,581.30,275.00,100.00,0.00,'',0.00,9043.70,'0000-00-00','2018-02-21 00:38:11','2018-02-21 00:38:11',0.00,'','',''),(268,'SKUBBS-11','1',2,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-02-21 00:38:35','2018-02-21 00:38:35',0.00,'','',''),(269,'SKUBBS-13','1',2,'2018','cash',15000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',1093.80,581.30,412.50,100.00,886.83,'',0.00,18019.37,'0000-00-00','2018-02-21 00:39:59','2018-02-21 00:39:59',0.00,'','',''),(270,'SKUBBS-26','1',2,'2018','cash',22500.00,3.00,958.80,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,23458.80,'0000-00-00','2018-02-21 00:41:40','2018-02-21 00:41:40',0.00,'','',''),(271,'SKUBBS-17','1',2,'2018','cash',13500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13500.00,'0000-00-00','2018-02-21 00:42:06','2018-02-21 00:42:06',0.00,'','',''),(272,'SKUBBS-19','1',2,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 00:43:01','2018-02-21 00:43:01',0.00,'','',''),(273,'SKUBBS-20','1',2,'2018','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2018-02-21 00:43:27','2018-02-21 00:43:27',0.00,'','',''),(274,'SKUBBS-28','1',2,'2018','cash',20000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20000.00,'0000-00-00','2018-02-21 00:43:48','2018-02-21 00:43:48',0.00,'','',''),(275,'SKUBBS-29','1',2,'2018','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2018-02-21 00:44:21','2018-02-21 00:44:21',0.00,'','',''),(276,'SKUBBS-30','1',2,'2018','cash',17500.00,4.50,1143.18,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18643.18,'0000-00-00','2018-02-21 00:45:05','2018-02-21 00:45:06',0.00,'','',''),(277,'SKUBBS-31','1',2,'2018','cash',18500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18500.00,'0000-00-00','2018-02-21 00:45:31','2018-02-21 00:45:31',0.00,'','',''),(278,'SKUBBS-33','1',2,'2018','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2018-02-21 00:45:49','2018-02-21 00:45:49',0.00,'','',''),(279,'SKUBBS-32','1',2,'2018','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 1\":\"1454.55\"}',1454.55,0.00,0.00,0.00,0.00,'',0.00,14545.45,'0000-00-00','2018-02-21 00:46:33','2018-02-21 00:46:33',0.00,'','',''),(280,'SKUBBS-34','1',2,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-02-21 00:48:33','2018-02-21 00:48:33',0.00,'','',''),(281,'SKUBBS-35','1',2,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 00:53:16','2018-02-21 00:53:16',0.00,'','',''),(282,'SKUBBS-40','1',2,'2018','cash',11500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2018-02-21 00:54:30','2018-02-21 00:54:30',0.00,'','',''),(283,'SKUBBS-38','1',2,'2018','cash',17500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,17500.00,'0000-00-00','2018-02-21 00:55:44','2018-02-21 00:55:44',0.00,'','',''),(284,'SKUBBS-39','1',2,'2018','cash',11000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11000.00,'0000-00-00','2018-02-21 00:57:38','2018-02-21 00:57:38',0.00,'','',''),(285,'SKUBBS-41','1',2,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 00:58:32','2018-02-21 00:58:32',0.00,'','',''),(286,'SKUBBS-42','1',2,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"4 Days\":\"4545.45\"}',4545.45,0.00,0.00,0.00,0.00,'',0.00,7954.55,'0000-00-00','2018-02-21 01:00:16','2018-02-21 01:00:16',0.00,'','',''),(287,'SKUBBS-01','2',1,'2018','cash',25000.00,0.00,0.00,'{\"Allowance\":\"15000\"}',15000.00,'[]',0.00,0.00,0.00,0.00,3345.14,'',0.00,36654.86,'0000-00-00','2018-02-21 01:09:13','2018-02-21 01:09:13',0.00,'','',''),(288,'SKUBBS-03','2',1,'2018','cash',15000.00,0.00,0.00,'{\"Allowance\":\"3250\"}',3250.00,'[]',0.00,0.00,0.00,0.00,886.83,'',0.00,17363.17,'0000-00-00','2018-02-21 01:32:21','2018-02-21 01:32:21',0.00,'','',''),(289,'SKUBBS-05','2',1,'2018','cash',9000.00,0.00,0.00,'{\"Allowance\":\"5500\"}',5500.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14500.00,'0000-00-00','2018-02-21 01:32:50','2018-02-21 01:32:50',0.00,'','',''),(290,'SKUBBS-07','2',1,'2018','cash',10000.00,5.00,710.24,'{\"Allowance\":\"7500\"}',7500.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18210.24,'0000-00-00','2018-02-21 01:33:20','2018-02-21 01:33:21',0.00,'','',''),(291,'SKUBBS-08','2',1,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"6750\"}',6750.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16750.00,'0000-00-00','2018-02-21 01:33:50','2018-02-21 01:33:50',0.00,'','',''),(292,'SKUBBS-09','2',1,'2018','cash',7500.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12000.00,'0000-00-00','2018-02-21 01:43:42','2018-02-21 01:43:42',0.00,'','',''),(293,'SKUBBS-10','2',1,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"4500\"}',4500.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14500.00,'0000-00-00','2018-02-21 01:44:25','2018-02-21 01:44:25',0.00,'','',''),(294,'SKUBBS-22','2',1,'2018','cash',10000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2018-02-21 01:45:04','2018-02-21 01:45:04',0.00,'','',''),(295,'SKUBBS-15','2',1,'2018','cash',10000.00,9.50,1403.42,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11403.42,'0000-00-00','2018-02-21 01:45:23','2018-02-21 01:45:23',0.00,'','',''),(296,'SKUBBS-16','2',1,'2018','cash',10000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,10000.00,'0000-00-00','2018-02-21 01:45:40','2018-02-21 01:45:40',0.00,'','',''),(297,'SKUBBS-11','2',1,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-02-21 01:53:57','2018-02-21 01:53:57',0.00,'','',''),(298,'SKUBBS-13','2',1,'2018','cash',15000.00,0.00,0.00,'{\"Allowance\":\"5000\"}',5000.00,'[]',0.00,0.00,0.00,0.00,886.83,'',0.00,19113.17,'0000-00-00','2018-02-21 01:54:34','2018-02-21 01:54:34',0.00,'','',''),(299,'SKUBBS-26','2',1,'2018','cash',22500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,22500.00,'0000-00-00','2018-02-21 01:55:03','2018-02-21 01:55:03',0.00,'','',''),(300,'SKUBBS-28','2',1,'2018','cash',20000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20000.00,'0000-00-00','2018-02-21 01:55:22','2018-02-21 01:55:22',0.00,'','',''),(301,'SKUBBS-29','2',1,'2018','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 1\":\"1454.55\"}',1454.55,0.00,0.00,0.00,0.00,'',0.00,14545.45,'0000-00-00','2018-02-21 01:56:12','2018-02-21 01:56:12',0.00,'','',''),(302,'SKUBBS-30','2',1,'2018','cash',17500.00,10.50,2619.05,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20119.05,'0000-00-00','2018-02-21 01:56:30','2018-02-21 01:56:30',0.00,'','',''),(303,'SKUBBS-31','2',1,'2018','cash',18500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18500.00,'0000-00-00','2018-02-21 01:56:48','2018-02-21 01:56:48',0.00,'','',''),(304,'SKUBBS-33','2',1,'2018','cash',15000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2018-02-21 01:57:09','2018-02-21 01:57:09',0.00,'','',''),(305,'SKUBBS-32','2',1,'2018','cash',16000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2018-02-21 01:57:25','2018-02-21 01:57:25',0.00,'','',''),(306,'SKUBBS-34','2',1,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-02-21 01:57:40','2018-02-21 01:57:40',0.00,'','',''),(307,'SKUBBS-35','2',1,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent x 5\":\"5681.82\"}',5681.82,0.00,0.00,0.00,0.00,'',0.00,6818.18,'0000-00-00','2018-02-21 01:58:17','2018-02-21 01:58:17',0.00,'','',''),(308,'SKUBBS-40','2',1,'2018','cash',11500.00,1.50,287.58,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 5\":\"5227.27\"}',5227.27,0.00,0.00,0.00,0.00,'',0.00,6560.31,'0000-00-00','2018-02-21 02:01:50','2018-02-21 02:01:50',0.00,'','',''),(309,'SKUBBS-38','2',1,'2018','cash',17500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,17500.00,'0000-00-00','2018-02-21 02:02:07','2018-02-21 02:02:07',0.00,'','',''),(310,'SKUBBS-39','2',1,'2018','cash',11000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11000.00,'0000-00-00','2018-02-21 02:02:24','2018-02-21 02:02:24',0.00,'','',''),(311,'SKUBBS-41','2',1,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 02:02:39','2018-02-21 02:02:39',0.00,'','',''),(312,'SKUBBS-42','2',1,'2018','cash',12500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 02:02:54','2018-02-21 02:02:54',0.00,'','',''),(313,'SKUBBS-43','2',1,'2018','cash',27500.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'{\"Absent 2\":\"5000\"}',5000.00,0.00,0.00,0.00,0.00,'',0.00,22500.00,'0000-00-00','2018-02-21 02:03:49','2018-02-21 02:03:49',0.00,'','',''),(314,'SKUBBS-17','2',1,'2018','cash',14310.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14310.00,'0000-00-00','2018-02-21 02:06:28','2018-02-21 02:06:28',0.00,'','',''),(315,'SKUBBS-19','2',1,'2018','cash',13250.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,13250.00,'0000-00-00','2018-02-21 02:06:44','2018-02-21 02:06:44',0.00,'','',''),(316,'SKUBBS-20','2',1,'2018','cash',12190.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12190.00,'0000-00-00','2018-02-21 02:07:04','2018-02-21 02:07:04',0.00,'','',''),(317,'SKUBBS-11','10',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',1031.30,581.30,350.00,100.00,0.00,'',0.00,12968.70,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(318,'SKUBBS-24','10',2,'2017','cash',13500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',1018.80,581.30,337.50,100.00,0.00,'',0.00,12481.20,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(319,'SKUBBS-28','10',2,'2017','cash',20000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,20000.00,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(320,'SKUBBS-29','10',2,'2017','cash',16000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(321,'SKUBBS-30','10',2,'2017','cash',17500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,17500.00,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(322,'SKUBBS-31','10',2,'2017','cash',18500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,18500.00,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(323,'SKUBBS-32','10',2,'2017','cash',16000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,16000.00,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:46',0.00,'','',''),(324,'SKUBBS-33','10',2,'2017','cash',15000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,15000.00,'0000-00-00','2018-02-21 21:51:46','2018-02-21 21:51:47',0.00,'','',''),(325,'SKUBBS-34','10',2,'2017','cash',14000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(326,'SKUBBS-35','10',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(327,'SKUBBS-38','10',2,'2017','cash',17500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,17500.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(328,'SKUBBS-39','10',2,'2017','cash',11000.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11000.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(329,'SKUBBS-40','10',2,'2017','cash',11500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,11500.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(330,'SKUBBS-41','10',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(331,'SKUBBS-42','10',2,'2017','cash',12500.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,12500.00,'0000-00-00','2018-02-21 21:51:47','2018-02-21 21:51:47',0.00,'','',''),(333,'SKUBBS-11','2',2,'2018','cash',14000.00,0.00,0.00,'{\"Bonus\":\"0\"}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,14000.00,'0000-00-00','2018-03-04 21:55:21','2018-03-04 21:55:21',0.00,'','',''),(334,'SKUBBS-04','1',1,'2018','cash',0.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,0.00,'0000-00-00','2018-06-18 02:49:56','2018-06-18 02:49:57',0.00,'','',''),(335,'SKUBBS-01','4',2,'2018','cash',0.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,0.00,'0000-00-00','2018-06-18 02:50:33','2018-06-18 02:50:33',0.00,'','',''),(336,'SKUBBS-07','4',2,'2018','cash',0.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,0.00,'0000-00-00','2018-06-18 02:50:33','2018-06-18 02:50:33',0.00,'','',''),(337,'SKUBBS-04','4',2,'2018','cash',0.00,0.00,0.00,'{\"Bonus\":0}',0.00,'[]',0.00,0.00,0.00,0.00,0.00,'',0.00,0.00,'0000-00-00','2018-06-18 02:50:33','2018-06-18 02:50:33',0.00,'','',''),(338,'TGSD-16-151R','1',1,'2018','cash',7500.00,0.00,0.00,'{\"Incentives\":\"1000\"}',1000.00,'{\"Rental\":\"2500\"}',2500.00,0.00,0.00,0.00,0.00,'',0.00,6000.00,'0000-00-00','2018-09-21 06:55:15','2018-09-21 06:55:15',0.00,'','','');
/*!40000 ALTER TABLE `payrolls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `philhealth_settings`
--

DROP TABLE IF EXISTS `philhealth_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `philhealth_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_share` float(11,2) NOT NULL,
  `total_share` float(11,2) NOT NULL,
  `salary_from` float(11,2) NOT NULL,
  `salary_to` float(11,2) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `updated_at` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `philhealth_settings`
--

LOCK TABLES `philhealth_settings` WRITE;
/*!40000 ALTER TABLE `philhealth_settings` DISABLE KEYS */;
INSERT INTO `philhealth_settings` VALUES (1,100.00,200.00,0.00,8999.99,'2017-07-21 08:44:23','2017-08-02 04:26:31'),(2,112.50,225.00,9000.00,9999.99,'2017-07-21 08:44:47',NULL),(3,125.00,250.00,10000.00,10999.99,'2017-07-31 04:48:31','2017-07-31 05:02:03'),(4,137.50,275.00,11000.00,11999.99,'2017-07-31 06:21:30',NULL),(5,150.00,300.00,12000.00,12999.99,'2017-07-31 06:22:12',NULL),(6,162.50,325.00,13000.00,13999.99,'2017-07-31 06:23:25',NULL),(7,175.00,350.00,14000.00,14999.99,'2017-07-31 06:23:52',NULL),(8,187.50,375.00,15000.00,15999.99,'2017-07-31 06:24:18',NULL),(9,200.00,400.00,16000.00,16999.99,'2017-07-31 06:24:41',NULL),(10,212.50,425.00,17000.00,17999.99,'2017-07-31 06:25:12',NULL),(11,225.00,450.00,18000.00,18999.99,'2017-08-02 03:35:37',NULL),(12,237.50,475.00,19000.00,19999.99,'2017-08-02 03:36:14',NULL),(13,250.00,500.00,20000.00,20999.99,'2017-08-02 03:37:00',NULL),(14,262.50,525.00,21000.00,21999.99,'2017-08-02 03:37:27',NULL),(15,275.00,550.00,22000.00,22999.99,'2017-08-02 03:37:55',NULL),(16,287.50,575.00,23000.00,23999.99,'2017-08-02 03:38:20',NULL),(17,300.00,600.00,24000.00,24999.99,'2017-08-02 03:38:52',NULL),(18,312.50,625.00,25000.00,25999.99,'2017-08-02 03:39:19',NULL),(19,325.00,650.00,26000.00,26999.99,'2017-08-02 03:39:46',NULL),(20,337.50,675.00,27000.00,27999.99,'2017-08-02 03:40:12',NULL),(21,350.00,700.00,28000.00,28999.99,'2017-08-02 03:40:33',NULL),(22,362.50,725.00,29000.00,29999.99,'2017-08-02 03:41:09',NULL),(23,375.00,750.00,30000.00,30999.99,'2017-08-02 03:41:35',NULL),(24,387.50,775.00,31000.00,31999.99,'2017-08-02 03:41:55',NULL),(25,400.00,800.00,32000.00,32999.99,'2017-08-02 03:42:33',NULL),(26,412.50,825.00,33000.00,33000.00,'2017-08-02 03:43:04',NULL),(27,425.00,850.00,34000.00,34999.99,'2017-08-02 03:43:27',NULL),(28,437.50,875.00,35000.00,999999.00,'2017-08-02 03:43:28','2017-08-03 04:26:19');
/*!40000 ALTER TABLE `philhealth_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rentals`
--

DROP TABLE IF EXISTS `rentals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rentals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date_covered` date NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('paid','unpaid','partial') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `rentals_employeeid_index` (`employeeID`),
  CONSTRAINT `rentals_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rentals`
--

LOCK TABLES `rentals` WRITE;
/*!40000 ALTER TABLE `rentals` DISABLE KEYS */;
INSERT INTO `rentals` VALUES (2,'SKUBBS01',2000,'2018-10-30','','paid','2018-09-26 06:03:47','2018-09-26 06:56:58');
/*!40000 ALTER TABLE `rentals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_others`
--

DROP TABLE IF EXISTS `request_others`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_others` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `approved_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('approved','rejected','pending') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `request_others_employeeid_index` (`employeeID`),
  CONSTRAINT `request_others_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_others`
--

LOCK TABLES `request_others` WRITE;
/*!40000 ALTER TABLE `request_others` DISABLE KEYS */;
INSERT INTO `request_others` VALUES (2,'SKUBBS01','Notebook',5,'9','For my note use','approved','2018-09-27 04:08:37','2018-09-27 05:11:02');
/*!40000 ALTER TABLE `request_others` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salary`
--

DROP TABLE IF EXISTS `salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salary` double NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `salary_employeeid_index` (`employeeID`),
  CONSTRAINT `salary_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salary`
--

LOCK TABLES `salary` WRITE;
/*!40000 ALTER TABLE `salary` DISABLE KEYS */;
INSERT INTO `salary` VALUES (90,'TGSD-16-151R','basic',15000,'Basic Salary','2018-09-07 03:51:03','2018-09-07 03:51:03'),(91,'TGSD-16-150','basic',0,'Basic Salary','2018-09-07 04:27:37','2018-09-07 04:27:37'),(92,'SKUBBS01','basic',34998,'Basic Salary','2018-09-10 03:20:09','2018-09-24 06:22:09'),(93,'TGSD-16-120','basic',0,'Basic Salary','2018-09-13 05:18:16','2018-09-13 05:18:16'),(94,'TGSD-16-121','basic',0,'Basic Salary','2018-09-13 05:28:12','2018-09-13 05:28:12'),(114,'TGSD-16-159','basic',15000,'Basic Salary','2018-09-21 03:29:58','2018-09-21 03:29:58'),(115,'TGSD-16-163','basic',0,'Basic Salary','2018-09-27 10:45:42','2018-09-27 10:45:42');
/*!40000 ALTER TABLE `salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `timeFrom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timeTo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `schedule_employeeid_index` (`employeeID`),
  CONSTRAINT `schedule_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (1,'SKUBBS01','2018-09-01','2018-09-15','9:30 AM','6:30 PM','Openning','Test','2018-09-11 05:32:28','2018-09-11 05:32:28');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `award_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `attendance_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `leave_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `notice_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `payroll_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `expense_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `employee_add` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `job_notification` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `admin_add` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `admin_theme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `front_theme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `enable_two_payroll_period` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - disabled, 1 - enabled',
  `sss_deduction_period` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `pagibig_deduction_period` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `philhealth_deduction_period` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'Skubbs Inc','accounts@im.skubbs.com','Administrator','logo.jpg','4th Flr Unit 4K\r\nWestgate Tower 1709 Investment Drive, Madrigal Business Park\r\nAyala Alabang, Muntinlupa City, Manila, Philippines','028314690','PHP','Php','0','1','0','1','0','0','1','0','0','darkblue','tygie-red','en',1,'2','2','2','2015-06-22 19:24:57','2018-10-04 11:14:24');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sss_settings`
--

DROP TABLE IF EXISTS `sss_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sss_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_share` float(11,2) NOT NULL,
  `employer_ec` float(11,2) NOT NULL,
  `total_share` float(11,2) NOT NULL,
  `salary_from` float(11,2) NOT NULL,
  `salary_to` float(11,2) NOT NULL,
  `created_at` varchar(60) NOT NULL,
  `updated_at` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sss_settings`
--

LOCK TABLES `sss_settings` WRITE;
/*!40000 ALTER TABLE `sss_settings` DISABLE KEYS */;
INSERT INTO `sss_settings` VALUES (1,36.30,10.00,110.00,1000.00,1249.99,'2017-07-20 10:05:30','2017-08-03 02:46:22'),(2,54.50,10.00,165.00,1250.00,1749.99,'2017-07-21 08:42:35','2017-07-31 07:57:20'),(3,72.70,10.00,220.00,1750.00,2249.99,'2017-08-03 03:06:06',NULL),(4,90.80,10.00,275.00,2250.00,2749.99,'2017-08-03 03:16:08',NULL),(5,109.00,10.00,330.00,2750.00,3249.99,'2017-08-03 03:17:02',NULL),(6,127.20,10.00,385.00,3250.00,3749.99,'2017-08-03 03:18:01',NULL),(7,145.30,10.00,440.00,3750.00,4249.99,'2017-08-03 03:19:31',NULL),(8,163.50,10.00,495.00,4250.00,4749.99,'2017-08-03 03:20:04',NULL),(9,181.70,10.00,550.00,4750.00,5249.99,'2017-08-03 03:20:41',NULL),(10,199.80,10.00,605.00,5250.00,5749.99,'2017-08-03 03:22:10',NULL),(11,218.00,10.00,660.00,5750.00,6249.99,'2017-08-03 03:23:11',NULL),(12,236.20,10.00,715.00,6250.00,6749.99,'2017-08-03 03:24:08','2017-08-03 03:26:26'),(13,254.30,10.00,770.00,6750.00,7249.99,'2017-08-03 03:25:08','2017-08-03 03:27:50'),(14,275.50,10.00,825.00,7250.00,7749.99,'2017-08-03 03:28:51',NULL),(15,290.70,10.00,880.00,7750.00,8249.99,'2017-08-03 03:29:24',NULL),(16,308.80,10.00,935.00,8250.00,8749.99,'2017-08-03 03:30:34',NULL),(17,327.00,10.00,990.00,8750.00,9249.99,'2017-08-03 03:31:30','2017-08-03 03:32:55'),(18,345.20,10.00,1045.00,9250.00,9749.99,'2017-08-03 03:33:50',NULL),(19,363.30,10.00,1100.00,9750.00,10249.99,'2017-08-03 03:34:58',NULL),(20,381.50,10.00,1155.00,10250.00,10749.99,'2017-08-03 03:35:56',NULL),(21,399.70,10.00,1210.00,10750.00,11249.99,'2017-08-03 03:37:18',NULL),(22,417.80,10.00,1265.00,11250.00,11749.99,'2017-08-03 03:38:03',NULL),(23,436.00,10.00,1320.00,11750.00,12249.99,'2017-08-03 03:39:06',NULL),(24,454.20,10.00,1375.00,12250.00,12749.99,'2017-08-03 03:40:04',NULL),(25,472.30,10.00,1430.00,12750.00,13249.99,'2017-08-03 03:40:54',NULL),(26,490.50,10.00,1485.00,13250.00,13749.99,'2017-08-03 03:41:55',NULL),(27,508.70,10.00,1540.00,13750.00,14249.99,'2017-08-03 03:42:37',NULL),(28,526.80,10.00,1595.00,14250.00,14749.99,'2017-08-03 03:43:12',NULL),(29,545.00,30.00,1650.00,14750.00,15249.99,'2017-08-03 03:44:29',NULL),(30,563.20,30.00,1705.00,15250.00,15749.99,'2017-08-03 03:45:47',NULL),(31,581.30,30.00,1760.00,15750.00,999999.00,'2017-08-03 03:49:51',NULL);
/*!40000 ALTER TABLE `sss_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `working_history`
--

DROP TABLE IF EXISTS `working_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `working_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `companyName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `reasonToLeave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `working_history_employeeid_index` (`employeeID`),
  CONSTRAINT `working_history_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `working_history`
--

LOCK TABLES `working_history` WRITE;
/*!40000 ALTER TABLE `working_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `working_history` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-05 11:27:46
