# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.16)
# Database: hrm
# Generation Time: 2015-06-23 03:25:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admins
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `last_login`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Ajay Kumar Choudhary','ajay@froiden.com','$2y$10$5mG.llwpA.F/4NSI3tH9JuD67s9trW7CBS0MagFKqW4N9UkW4ljHy','0000-00-00 00:00:00',NULL,'2015-06-23 03:24:57','2015-06-23 03:24:57');

/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table attendance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendance`;

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
  CONSTRAINT `attendance_halfdaytype_foreign` FOREIGN KEY (`halfDayType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_leavetype_foreign` FOREIGN KEY (`leaveType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table awards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `awards`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bank_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bank_details`;

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



# Dump of table countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;

INSERT INTO `countries` (`id_countries`, `name`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `currency_code`, `currency_name`, `currency_symbol`, `flag`)
VALUES
	(1,'Afghanistan','AF','AFG',4,'AFN','Afghani','؋','AF.png'),
	(2,'Albania','AL','ALB',8,'ALL','Lek','Lek','AL.png'),
	(3,'Algeria','DZ','DZA',12,'DZD','Dinar',NULL,'DZ.png'),
	(4,'American Samoa','AS','ASM',16,'USD','Dollar','$','AS.png'),
	(5,'Andorra','AD','AND',20,'EUR','Euro','€','AD.png'),
	(6,'Angola','AO','AGO',24,'AOA','Kwanza','Kz','AO.png'),
	(7,'Anguilla','AI','AIA',660,'XCD','Dollar','$','AI.png'),
	(8,'Antarctica','AQ','ATA',10,'','',NULL,'AQ.png'),
	(9,'Antigua and Barbuda','AG','ATG',28,'XCD','Dollar','$','AG.png'),
	(10,'Argentina','AR','ARG',32,'ARS','Peso','$','AR.png'),
	(11,'Armenia','AM','ARM',51,'AMD','Dram',NULL,'AM.png'),
	(12,'Aruba','AW','ABW',533,'AWG','Guilder','ƒ','AW.png'),
	(13,'Australia','AU','AUS',36,'AUD','Dollar','$','AU.png'),
	(14,'Austria','AT','AUT',40,'EUR','Euro','€','AT.png'),
	(15,'Azerbaijan','AZ','AZE',31,'AZN','Manat','ман','AZ.png'),
	(16,'Bahamas','BS','BHS',44,'BSD','Dollar','$','BS.png'),
	(17,'Bahrain','BH','BHR',48,'BHD','Dinar',NULL,'BH.png'),
	(18,'Bangladesh','BD','BGD',50,'BDT','Taka',NULL,'BD.png'),
	(19,'Barbados','BB','BRB',52,'BBD','Dollar','$','BB.png'),
	(20,'Belarus','BY','BLR',112,'BYR','Ruble','p.','BY.png'),
	(21,'Belgium','BE','BEL',56,'EUR','Euro','€','BE.png'),
	(22,'Belize','BZ','BLZ',84,'BZD','Dollar','BZ$','BZ.png'),
	(23,'Benin','BJ','BEN',204,'XOF','Franc',NULL,'BJ.png'),
	(24,'Bermuda','BM','BMU',60,'BMD','Dollar','$','BM.png'),
	(25,'Bhutan','BT','BTN',64,'BTN','Ngultrum',NULL,'BT.png'),
	(26,'Bolivia','BO','BOL',68,'BOB','Boliviano','$b','BO.png'),
	(27,'Bosnia and Herzegovina','BA','BIH',70,'BAM','Marka','KM','BA.png'),
	(28,'Botswana','BW','BWA',72,'BWP','Pula','P','BW.png'),
	(29,'Bouvet Island','BV','BVT',74,'NOK','Krone','kr','BV.png'),
	(30,'Brazil','BR','BRA',76,'BRL','Real','R$','BR.png'),
	(31,'British Indian Ocean Territory','IO','IOT',86,'USD','Dollar','$','IO.png'),
	(32,'British Virgin Islands','VG','VGB',92,'USD','Dollar','$','VG.png'),
	(33,'Brunei','BN','BRN',96,'BND','Dollar','$','BN.png'),
	(34,'Bulgaria','BG','BGR',100,'BGN','Lev','лв','BG.png'),
	(35,'Burkina Faso','BF','BFA',854,'XOF','Franc',NULL,'BF.png'),
	(36,'Burundi','BI','BDI',108,'BIF','Franc',NULL,'BI.png'),
	(37,'Cambodia','KH','KHM',116,'KHR','Riels','៛','KH.png'),
	(38,'Cameroon','CM','CMR',120,'XAF','Franc','FCF','CM.png'),
	(39,'Canada','CA','CAN',124,'CAD','Dollar','$','CA.png'),
	(40,'Cape Verde','CV','CPV',132,'CVE','Escudo',NULL,'CV.png'),
	(41,'Cayman Islands','KY','CYM',136,'KYD','Dollar','$','KY.png'),
	(42,'Central African Republic','CF','CAF',140,'XAF','Franc','FCF','CF.png'),
	(43,'Chad','TD','TCD',148,'XAF','Franc',NULL,'TD.png'),
	(44,'Chile','CL','CHL',152,'CLP','Peso',NULL,'CL.png'),
	(45,'China','CN','CHN',156,'CNY','Yuan Renminbi','¥','CN.png'),
	(46,'Christmas Island','CX','CXR',162,'AUD','Dollar','$','CX.png'),
	(47,'Cocos Islands','CC','CCK',166,'AUD','Dollar','$','CC.png'),
	(48,'Colombia','CO','COL',170,'COP','Peso','$','CO.png'),
	(49,'Comoros','KM','COM',174,'KMF','Franc',NULL,'KM.png'),
	(50,'Cook Islands','CK','COK',184,'NZD','Dollar','$','CK.png'),
	(51,'Costa Rica','CR','CRI',188,'CRC','Colon','₡','CR.png'),
	(52,'Croatia','HR','HRV',191,'HRK','Kuna','kn','HR.png'),
	(53,'Cuba','CU','CUB',192,'CUP','Peso','₱','CU.png'),
	(54,'Cyprus','CY','CYP',196,'CYP','Pound',NULL,'CY.png'),
	(55,'Czech Republic','CZ','CZE',203,'CZK','Koruna','Kč','CZ.png'),
	(56,'Democratic Republic of the Congo','CD','COD',180,'CDF','Franc',NULL,'CD.png'),
	(57,'Denmark','DK','DNK',208,'DKK','Krone','kr','DK.png'),
	(58,'Djibouti','DJ','DJI',262,'DJF','Franc',NULL,'DJ.png'),
	(59,'Dominica','DM','DMA',212,'XCD','Dollar','$','DM.png'),
	(60,'Dominican Republic','DO','DOM',214,'DOP','Peso','RD$','DO.png'),
	(61,'East Timor','TL','TLS',626,'USD','Dollar','$','TL.png'),
	(62,'Ecuador','EC','ECU',218,'USD','Dollar','$','EC.png'),
	(63,'Egypt','EG','EGY',818,'EGP','Pound','£','EG.png'),
	(64,'El Salvador','SV','SLV',222,'SVC','Colone','$','SV.png'),
	(65,'Equatorial Guinea','GQ','GNQ',226,'XAF','Franc','FCF','GQ.png'),
	(66,'Eritrea','ER','ERI',232,'ERN','Nakfa','Nfk','ER.png'),
	(67,'Estonia','EE','EST',233,'EEK','Kroon','kr','EE.png'),
	(68,'Ethiopia','ET','ETH',231,'ETB','Birr',NULL,'ET.png'),
	(69,'Falkland Islands','FK','FLK',238,'FKP','Pound','£','FK.png'),
	(70,'Faroe Islands','FO','FRO',234,'DKK','Krone','kr','FO.png'),
	(71,'Fiji','FJ','FJI',242,'FJD','Dollar','$','FJ.png'),
	(72,'Finland','FI','FIN',246,'EUR','Euro','€','FI.png'),
	(73,'France','FR','FRA',250,'EUR','Euro','€','FR.png'),
	(74,'French Guiana','GF','GUF',254,'EUR','Euro','€','GF.png'),
	(75,'French Polynesia','PF','PYF',258,'XPF','Franc',NULL,'PF.png'),
	(76,'French Southern Territories','TF','ATF',260,'EUR','Euro  ','€','TF.png'),
	(77,'Gabon','GA','GAB',266,'XAF','Franc','FCF','GA.png'),
	(78,'Gambia','GM','GMB',270,'GMD','Dalasi','D','GM.png'),
	(79,'Georgia','GE','GEO',268,'GEL','Lari',NULL,'GE.png'),
	(80,'Germany','DE','DEU',276,'EUR','Euro','€','DE.png'),
	(81,'Ghana','GH','GHA',288,'GHC','Cedi','¢','GH.png'),
	(82,'Gibraltar','GI','GIB',292,'GIP','Pound','£','GI.png'),
	(83,'Greece','GR','GRC',300,'EUR','Euro','€','GR.png'),
	(84,'Greenland','GL','GRL',304,'DKK','Krone','kr','GL.png'),
	(85,'Grenada','GD','GRD',308,'XCD','Dollar','$','GD.png'),
	(86,'Guadeloupe','GP','GLP',312,'EUR','Euro','€','GP.png'),
	(87,'Guam','GU','GUM',316,'USD','Dollar','$','GU.png'),
	(88,'Guatemala','GT','GTM',320,'GTQ','Quetzal','Q','GT.png'),
	(89,'Guinea','GN','GIN',324,'GNF','Franc',NULL,'GN.png'),
	(90,'Guinea-Bissau','GW','GNB',624,'XOF','Franc',NULL,'GW.png'),
	(91,'Guyana','GY','GUY',328,'GYD','Dollar','$','GY.png'),
	(92,'Haiti','HT','HTI',332,'HTG','Gourde','G','HT.png'),
	(93,'Heard Island and McDonald Islands','HM','HMD',334,'AUD','Dollar','$','HM.png'),
	(94,'Honduras','HN','HND',340,'HNL','Lempira','L','HN.png'),
	(95,'Hong Kong','HK','HKG',344,'HKD','Dollar','$','HK.png'),
	(96,'Hungary','HU','HUN',348,'HUF','Forint','Ft','HU.png'),
	(97,'Iceland','IS','ISL',352,'ISK','Krona','kr','IS.png'),
	(98,'India','IN','IND',356,'INR','Rupee','₹','IN.png'),
	(99,'Indonesia','ID','IDN',360,'IDR','Rupiah','Rp','ID.png'),
	(100,'Iran','IR','IRN',364,'IRR','Rial','﷼','IR.png'),
	(101,'Iraq','IQ','IRQ',368,'IQD','Dinar',NULL,'IQ.png'),
	(102,'Ireland','IE','IRL',372,'EUR','Euro','€','IE.png'),
	(103,'Israel','IL','ISR',376,'ILS','Shekel','₪','IL.png'),
	(104,'Italy','IT','ITA',380,'EUR','Euro','€','IT.png'),
	(105,'Ivory Coast','CI','CIV',384,'XOF','Franc',NULL,'CI.png'),
	(106,'Jamaica','JM','JAM',388,'JMD','Dollar','$','JM.png'),
	(107,'Japan','JP','JPN',392,'JPY','Yen','¥','JP.png'),
	(108,'Jordan','JO','JOR',400,'JOD','Dinar',NULL,'JO.png'),
	(109,'Kazakhstan','KZ','KAZ',398,'KZT','Tenge','лв','KZ.png'),
	(110,'Kenya','KE','KEN',404,'KES','Shilling',NULL,'KE.png'),
	(111,'Kiribati','KI','KIR',296,'AUD','Dollar','$','KI.png'),
	(112,'Kuwait','KW','KWT',414,'KWD','Dinar',NULL,'KW.png'),
	(113,'Kyrgyzstan','KG','KGZ',417,'KGS','Som','лв','KG.png'),
	(114,'Laos','LA','LAO',418,'LAK','Kip','₭','LA.png'),
	(115,'Latvia','LV','LVA',428,'LVL','Lat','Ls','LV.png'),
	(116,'Lebanon','LB','LBN',422,'LBP','Pound','£','LB.png'),
	(117,'Lesotho','LS','LSO',426,'LSL','Loti','L','LS.png'),
	(118,'Liberia','LR','LBR',430,'LRD','Dollar','$','LR.png'),
	(119,'Libya','LY','LBY',434,'LYD','Dinar',NULL,'LY.png'),
	(120,'Liechtenstein','LI','LIE',438,'CHF','Franc','CHF','LI.png'),
	(121,'Lithuania','LT','LTU',440,'LTL','Litas','Lt','LT.png'),
	(122,'Luxembourg','LU','LUX',442,'EUR','Euro','€','LU.png'),
	(123,'Macao','MO','MAC',446,'MOP','Pataca','MOP','MO.png'),
	(124,'Macedonia','MK','MKD',807,'MKD','Denar','ден','MK.png'),
	(125,'Madagascar','MG','MDG',450,'MGA','Ariary',NULL,'MG.png'),
	(126,'Malawi','MW','MWI',454,'MWK','Kwacha','MK','MW.png'),
	(127,'Malaysia','MY','MYS',458,'MYR','Ringgit','RM','MY.png'),
	(128,'Maldives','MV','MDV',462,'MVR','Rufiyaa','Rf','MV.png'),
	(129,'Mali','ML','MLI',466,'XOF','Franc',NULL,'ML.png'),
	(130,'Malta','MT','MLT',470,'MTL','Lira',NULL,'MT.png'),
	(131,'Marshall Islands','MH','MHL',584,'USD','Dollar','$','MH.png'),
	(132,'Martinique','MQ','MTQ',474,'EUR','Euro','€','MQ.png'),
	(133,'Mauritania','MR','MRT',478,'MRO','Ouguiya','UM','MR.png'),
	(134,'Mauritius','MU','MUS',480,'MUR','Rupee','₨','MU.png'),
	(135,'Mayotte','YT','MYT',175,'EUR','Euro','€','YT.png'),
	(136,'Mexico','MX','MEX',484,'MXN','Peso','$','MX.png'),
	(137,'Micronesia','FM','FSM',583,'USD','Dollar','$','FM.png'),
	(138,'Moldova','MD','MDA',498,'MDL','Leu',NULL,'MD.png'),
	(139,'Monaco','MC','MCO',492,'EUR','Euro','€','MC.png'),
	(140,'Mongolia','MN','MNG',496,'MNT','Tugrik','₮','MN.png'),
	(141,'Montserrat','MS','MSR',500,'XCD','Dollar','$','MS.png'),
	(142,'Morocco','MA','MAR',504,'MAD','Dirham',NULL,'MA.png'),
	(143,'Mozambique','MZ','MOZ',508,'MZN','Meticail','MT','MZ.png'),
	(144,'Myanmar','MM','MMR',104,'MMK','Kyat','K','MM.png'),
	(145,'Namibia','NA','NAM',516,'NAD','Dollar','$','NA.png'),
	(146,'Nauru','NR','NRU',520,'AUD','Dollar','$','NR.png'),
	(147,'Nepal','NP','NPL',524,'NPR','Rupee','₨','NP.png'),
	(148,'Netherlands','NL','NLD',528,'EUR','Euro','€','NL.png'),
	(149,'Netherlands Antilles','AN','ANT',530,'ANG','Guilder','ƒ','AN.png'),
	(150,'New Caledonia','NC','NCL',540,'XPF','Franc',NULL,'NC.png'),
	(151,'New Zealand','NZ','NZL',554,'NZD','Dollar','$','NZ.png'),
	(152,'Nicaragua','NI','NIC',558,'NIO','Cordoba','C$','NI.png'),
	(153,'Niger','NE','NER',562,'XOF','Franc',NULL,'NE.png'),
	(154,'Nigeria','NG','NGA',566,'NGN','Naira','₦','NG.png'),
	(155,'Niue','NU','NIU',570,'NZD','Dollar','$','NU.png'),
	(156,'Norfolk Island','NF','NFK',574,'AUD','Dollar','$','NF.png'),
	(157,'North Korea','KP','PRK',408,'KPW','Won','₩','KP.png'),
	(158,'Northern Mariana Islands','MP','MNP',580,'USD','Dollar','$','MP.png'),
	(159,'Norway','NO','NOR',578,'NOK','Krone','kr','NO.png'),
	(160,'Oman','OM','OMN',512,'OMR','Rial','﷼','OM.png'),
	(161,'Pakistan','PK','PAK',586,'PKR','Rupee','₨','PK.png'),
	(162,'Palau','PW','PLW',585,'USD','Dollar','$','PW.png'),
	(163,'Palestinian Territory','PS','PSE',275,'ILS','Shekel','₪','PS.png'),
	(164,'Panama','PA','PAN',591,'PAB','Balboa','B/.','PA.png'),
	(165,'Papua New Guinea','PG','PNG',598,'PGK','Kina',NULL,'PG.png'),
	(166,'Paraguay','PY','PRY',600,'PYG','Guarani','Gs','PY.png'),
	(167,'Peru','PE','PER',604,'PEN','Sol','S/.','PE.png'),
	(168,'Philippines','PH','PHL',608,'PHP','Peso','Php','PH.png'),
	(169,'Pitcairn','PN','PCN',612,'NZD','Dollar','$','PN.png'),
	(170,'Poland','PL','POL',616,'PLN','Zloty','zł','PL.png'),
	(171,'Portugal','PT','PRT',620,'EUR','Euro','€','PT.png'),
	(172,'Puerto Rico','PR','PRI',630,'USD','Dollar','$','PR.png'),
	(173,'Qatar','QA','QAT',634,'QAR','Rial','﷼','QA.png'),
	(174,'Republic of the Congo','CG','COG',178,'XAF','Franc','FCF','CG.png'),
	(175,'Reunion','RE','REU',638,'EUR','Euro','€','RE.png'),
	(176,'Romania','RO','ROU',642,'RON','Leu','lei','RO.png'),
	(177,'Russia','RU','RUS',643,'RUB','Ruble','руб','RU.png'),
	(178,'Rwanda','RW','RWA',646,'RWF','Franc',NULL,'RW.png'),
	(179,'Saint Helena','SH','SHN',654,'SHP','Pound','£','SH.png'),
	(180,'Saint Kitts and Nevis','KN','KNA',659,'XCD','Dollar','$','KN.png'),
	(181,'Saint Lucia','LC','LCA',662,'XCD','Dollar','$','LC.png'),
	(182,'Saint Pierre and Miquelon','PM','SPM',666,'EUR','Euro','€','PM.png'),
	(183,'Saint Vincent and the Grenadines','VC','VCT',670,'XCD','Dollar','$','VC.png'),
	(184,'Samoa','WS','WSM',882,'WST','Tala','WS$','WS.png'),
	(185,'San Marino','SM','SMR',674,'EUR','Euro','€','SM.png'),
	(186,'Sao Tome and Principe','ST','STP',678,'STD','Dobra','Db','ST.png'),
	(187,'Saudi Arabia','SA','SAU',682,'SAR','Rial','﷼','SA.png'),
	(188,'Senegal','SN','SEN',686,'XOF','Franc',NULL,'SN.png'),
	(189,'Serbia and Montenegro','CS','SCG',891,'RSD','Dinar','Дин','CS.png'),
	(190,'Seychelles','SC','SYC',690,'SCR','Rupee','₨','SC.png'),
	(191,'Sierra Leone','SL','SLE',694,'SLL','Leone','Le','SL.png'),
	(192,'Singapore','SG','SGP',702,'SGD','Dollar','$','SG.png'),
	(193,'Slovakia','SK','SVK',703,'SKK','Koruna','Sk','SK.png'),
	(194,'Slovenia','SI','SVN',705,'EUR','Euro','€','SI.png'),
	(195,'Solomon Islands','SB','SLB',90,'SBD','Dollar','$','SB.png'),
	(196,'Somalia','SO','SOM',706,'SOS','Shilling','S','SO.png'),
	(197,'South Africa','ZA','ZAF',710,'ZAR','Rand','R','ZA.png'),
	(198,'South Georgia and the South Sandwich Islands','GS','SGS',239,'GBP','Pound','£','GS.png'),
	(199,'South Korea','KR','KOR',410,'KRW','Won','₩','KR.png'),
	(200,'Spain','ES','ESP',724,'EUR','Euro','€','ES.png'),
	(201,'Sri Lanka','LK','LKA',144,'LKR','Rupee','₨','LK.png'),
	(202,'Sudan','SD','SDN',736,'SDD','Dinar',NULL,'SD.png'),
	(203,'Suriname','SR','SUR',740,'SRD','Dollar','$','SR.png'),
	(204,'Svalbard and Jan Mayen','SJ','SJM',744,'NOK','Krone','kr','SJ.png'),
	(205,'Swaziland','SZ','SWZ',748,'SZL','Lilangeni',NULL,'SZ.png'),
	(206,'Sweden','SE','SWE',752,'SEK','Krona','kr','SE.png'),
	(207,'Switzerland','CH','CHE',756,'CHF','Franc','CHF','CH.png'),
	(208,'Syria','SY','SYR',760,'SYP','Pound','£','SY.png'),
	(209,'Taiwan','TW','TWN',158,'TWD','Dollar','NT$','TW.png'),
	(210,'Tajikistan','TJ','TJK',762,'TJS','Somoni',NULL,'TJ.png'),
	(211,'Tanzania','TZ','TZA',834,'TZS','Shilling',NULL,'TZ.png'),
	(212,'Thailand','TH','THA',764,'THB','Baht','฿','TH.png'),
	(213,'Togo','TG','TGO',768,'XOF','Franc',NULL,'TG.png'),
	(214,'Tokelau','TK','TKL',772,'NZD','Dollar','$','TK.png'),
	(215,'Tonga','TO','TON',776,'TOP','Pa\"anga','T$','TO.png'),
	(216,'Trinidad and Tobago','TT','TTO',780,'TTD','Dollar','TT$','TT.png'),
	(217,'Tunisia','TN','TUN',788,'TND','Dinar',NULL,'TN.png'),
	(218,'Turkey','TR','TUR',792,'TRY','Lira','YTL','TR.png'),
	(219,'Turkmenistan','TM','TKM',795,'TMM','Manat','m','TM.png'),
	(220,'Turks and Caicos Islands','TC','TCA',796,'USD','Dollar','$','TC.png'),
	(221,'Tuvalu','TV','TUV',798,'AUD','Dollar','$','TV.png'),
	(222,'U.S. Virgin Islands','VI','VIR',850,'USD','Dollar','$','VI.png'),
	(223,'Uganda','UG','UGA',800,'UGX','Shilling',NULL,'UG.png'),
	(224,'Ukraine','UA','UKR',804,'UAH','Hryvnia','₴','UA.png'),
	(225,'United Arab Emirates','AE','ARE',784,'AED','Dirham',NULL,'AE.png'),
	(226,'United Kingdom','GB','GBR',826,'GBP','Pound','£','GB.png'),
	(227,'United States','US','USA',840,'USD','Dollar','$','US.png'),
	(228,'United States Minor Outlying Islands','UM','UMI',581,'USD','Dollar ','$','UM.png'),
	(229,'Uruguay','UY','URY',858,'UYU','Peso','$U','UY.png'),
	(230,'Uzbekistan','UZ','UZB',860,'UZS','Som','лв','UZ.png'),
	(231,'Vanuatu','VU','VUT',548,'VUV','Vatu','Vt','VU.png'),
	(232,'Vatican','VA','VAT',336,'EUR','Euro','€','VA.png'),
	(233,'Venezuela','VE','VEN',862,'VEF','Bolivar','Bs','VE.png'),
	(234,'Vietnam','VN','VNM',704,'VND','Dong','₫','VN.png'),
	(235,'Wallis and Futuna','WF','WLF',876,'XPF','Franc',NULL,'WF.png'),
	(236,'Western Sahara','EH','ESH',732,'MAD','Dirham',NULL,'EH.png'),
	(237,'Yemen','YE','YEM',887,'YER','Rial','﷼','YE.png'),
	(238,'Zambia','ZM','ZMB',894,'ZMK','Kwacha','ZK','ZM.png'),
	(239,'Zimbabwe','ZW','ZWE',716,'ZWD','Dollar','Z$','ZW.png');

/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deptName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table designation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `designation`;

CREATE TABLE `designation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deptID` int(10) unsigned NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `designation_deptid_foreign` (`deptID`),
  CONSTRAINT `designation_deptid_foreign` FOREIGN KEY (`deptID`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table employee_documents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee_documents`;

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



# Dump of table employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `fatherName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobileNumber` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `designation` int(10) unsigned DEFAULT NULL,
  `joiningDate` date DEFAULT NULL,
  `profileImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'default.jpg',
  `localAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `permanentAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `annual_leave` int(11) NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`),
  UNIQUE KEY `employees_employeeid_unique` (`employeeID`),
  KEY `employees_designation_foreign` (`designation`),
  CONSTRAINT `employees_designation_foreign` FOREIGN KEY (`designation`) REFERENCES `designation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

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



# Dump of table holidays
# ------------------------------------------------------------

DROP TABLE IF EXISTS `holidays`;

CREATE TABLE `holidays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `occassion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `holidays_date_unique` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table job_applications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_applications`;

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
  CONSTRAINT `job_applications_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `job_applications_jobid_foreign` FOREIGN KEY (`jobID`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

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



# Dump of table languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `locale`, `language`)
VALUES
	(1,'en','US English'),
	(2,'es','Spanish'),
	(3,'fr','French');

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table leave_applications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leave_applications`;

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
  CONSTRAINT `leave_applications_halfdaytype_foreign` FOREIGN KEY (`halfDayType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_leavetype_foreign` FOREIGN KEY (`leaveType`) REFERENCES `leavetypes` (`leaveType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `leave_applications_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `admins` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table leavetypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `leavetypes`;

CREATE TABLE `leavetypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leaveType` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `num_of_leave` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `leavetypes_leavetype_index` (`leaveType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `leavetypes` WRITE;
/*!40000 ALTER TABLE `leavetypes` DISABLE KEYS */;

INSERT INTO `leavetypes` (`id`, `leaveType`, `num_of_leave`, `created_at`, `updated_at`)
VALUES
	(1,'sick',5,'2015-06-23 03:24:57','2015-06-23 03:24:57'),
	(2,'casual',5,'2015-06-23 03:24:57','2015-06-23 03:24:57'),
	(3,'half day',5,'2015-06-23 03:24:57','2015-06-23 03:24:57'),
	(4,'maternity',0,'2015-06-23 03:24:57','2015-06-23 03:24:57'),
	(5,'annual',0,'2015-06-23 03:24:57','2015-06-23 03:24:57'),
	(6,'unpaid',0,'2015-06-23 03:24:57','2015-06-23 03:24:57'),
	(7,'others',0,'2015-06-23 03:24:57','2015-06-23 03:24:57');

/*!40000 ALTER TABLE `leavetypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2015_01_01_113224_create_department_table',1),
	('2015_01_02_113252_create_designation_table',1),
	('2015_01_03_051233_create_employees_table',1),
	('2015_01_14_095049_create_leavetypes_table',1),
	('2015_01_15_061824_create_admins_table',1),
	('2015_01_15_062941_create_bank_details_table',1),
	('2015_01_15_104831_create_employee_documents_table',1),
	('2015_01_15_105222_create_awards_table',1),
	('2015_01_15_110029_create_holidays_table',1),
	('2015_01_15_110255_create_attendance_table',1),
	('2015_01_20_100417_create_salary_table',1),
	('2015_01_22_150640_create_expenses_table',1),
	('2015_02_04_073542_create_settings_table',1),
	('2015_02_10_044023_create_noticeboards_table',1),
	('2015_05_18_041236_create_country_table',1),
	('2015_05_20_081903_create_leave_applications',1),
	('2015_05_23_063217_create_payrolls_table',1),
	('2015_06_02_174830_create_jobs_table',1),
	('2015_06_03_124443_create_jobApplications_table',1),
	('2015_06_07_112126_add_employeeID_to_expense_table',1),
	('2015_06_08_051127_add_expense_to_payrolls',1),
	('2015_06_10_040042_add_bsb_bank_details',1),
	('2015_06_11_094005_create_language_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table noticeboards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `noticeboards`;

CREATE TABLE `noticeboards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table payrolls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payrolls`;

CREATE TABLE `payrolls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_mode` enum('cash','paypal','bank_transfer','cheque') COLLATE utf8_unicode_ci NOT NULL,
  `basic` float(8,2) NOT NULL,
  `overtime_hours` float(8,2) NOT NULL,
  `overtime_pay` float(8,2) NOT NULL,
  `allowances` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_allowance` float(8,2) NOT NULL,
  `deductions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_deduction` float(8,2) NOT NULL,
  `additionals` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_additional` float(8,2) NOT NULL,
  `net_salary` float(8,2) NOT NULL,
  `pay_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expense` float(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payrolls_employeeid_index` (`employeeID`),
  CONSTRAINT `payrolls_employeeid_foreign` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table salary
# ------------------------------------------------------------

DROP TABLE IF EXISTS `salary`;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `website`, `email`, `name`, `logo`, `address`, `contact`, `currency`, `currency_symbol`, `award_notification`, `attendance_notification`, `leave_notification`, `notice_notification`, `payroll_notification`, `expense_notification`, `employee_add`, `job_notification`, `admin_add`, `admin_theme`, `front_theme`, `locale`, `created_at`, `updated_at`)
VALUES
	(1,'HRM','ajay@froiden.com','Administrator','logo.png','SNAP HRM ,Jaipur INDIA,302017','1234567891','INR','₹','1','0','1','1','0','0','0','0','0','darkblue','dark-blue','en','2015-06-23 03:24:57','2015-06-23 03:24:57');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
