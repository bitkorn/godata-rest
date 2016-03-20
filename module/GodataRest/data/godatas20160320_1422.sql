-- MySQL dump 10.13  Distrib 5.6.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: godatas
-- ------------------------------------------------------
-- Server version	5.6.28-0ubuntu0.14.04.1

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_no` int(11) NOT NULL DEFAULT '0',
  `article_type` int(11) NOT NULL DEFAULT '1',
  `article_group` int(11) NOT NULL DEFAULT '1',
  `article_class` int(11) NOT NULL DEFAULT '1',
  `desc_short` tinytext NOT NULL,
  `desc_long` text NOT NULL,
  `desc_tec` tinytext NOT NULL COMMENT 'Zeichn Nr Part ID',
  `date_create` int(11) DEFAULT NULL,
  `date_edit` int(11) DEFAULT NULL,
  `user_create` int(11) NOT NULL DEFAULT '0',
  `user_edit` int(11) NOT NULL DEFAULT '0',
  `unit` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  `default_store_id` int(11) DEFAULT NULL,
  `default_store_place` varchar(45) DEFAULT NULL,
  `price_independent` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (0,0,1,1,1,'empty','desc long also empty','',1456754750,NULL,0,0,1,0,NULL,NULL,0.00000,'1,0,1,1'),(1,300001,1,2,3,'erster Artikel','lange desc für den ersten Artikel','',1456754750,NULL,0,0,1,2,NULL,'',0.00000,'1,1,1,1'),(2,300002,5,23,12,'ein zweiter Artikel :)','Dies ist der zweite Artikel','',1456754750,1457778407,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(14,2311,4,23,0,'is wohl der 14te Artikel','','Part-ID 4711',1456754750,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(19,2342,2,22,6,'der mit ID 19','','',1456754750,NULL,0,0,1,0,NULL,'',3.60000,'1,1,1,1'),(23,6661,6,24,8,'Beast article','','',1456754750,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(25,700,4,1,13,'007 geht nicht :((','','',1456754750,NULL,0,0,1,0,NULL,NULL,0.00000,'1,1,1,1'),(26,76,5,2,0,'um noch mehr zu haben','','',1456754750,NULL,0,0,1,0,NULL,NULL,0.00000,'1,1,1,1'),(27,10007,1,24,0,'lorem ipsum war noch nich','adsf ewrgew g','',1456754750,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(28,2311,2,3,11,'dolor sit amet','','',1456754750,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(29,44,3,5,7,'mal ein anderer Text','ne lange','',1456754750,NULL,0,0,1,0,NULL,NULL,0.00000,'1,1,1,1'),(30,45,2,9,3,'wieder n article','','id mit 30 hat nummer 43',1456754750,NULL,0,0,1,0,NULL,NULL,0.00000,'1,1,1,1'),(31,43,5,1,0,'article with no 43','','',1456754750,NULL,0,0,1,0,NULL,NULL,0.00000,'1,1,1,1'),(32,5675432,2,1,0,'n test wieder','','',1456754750,NULL,0,0,0,0,NULL,NULL,0.00000,'1,1,1,1'),(33,3452,1,1,1,'empty','desc long also empty','',1456754750,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(34,3452,1,1,1,'empty','desc long also empty','',1456754760,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(35,3456,2,3,1,'a short one','veeeery looong description','',1456754850,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(36,3452,1,1,1,'empty','desc long also empty','',1456755116,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(48,86786,1,1,1,'empty','desc long also empty','',1456815252,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(49,34523,1,1,1,'empty','desc long also empty','',1456815264,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(50,86786,2,1,1,'empty','desc long no further empty','',1456821960,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(51,86786,1,1,1,'empty','desc long also empty','',1456822111,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(52,7976986,5,3,1,'fdcd dvvdfcv empty','ff  gg eg fgeg edesc long also empty','',1457282363,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(53,33334444,3,23,1,'empty','desc long also empty','',1457282678,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(54,666666666,5,24,1,'empty','desc long also empty','',1457282729,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(55,22222222,2,2,1,'empty','desc long also empty','',1457289929,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(56,55,1,1,1,'empty','desc long also empty','',1457604513,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(57,44,1,1,1,'empty','desc long also empty','',1457604682,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(58,666,1,1,1,'','desc long also empty','',1457604810,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(59,666,1,1,1,'','desc long also empty','',1457604812,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(60,4564,1,1,1,'','desc long also empty','',1457604907,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(61,4564,1,1,1,'','desc long also empty','',1457604908,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(62,345,1,1,1,'empty','desc long also empty','',1457605185,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(63,90909090,4,23,1,'etwas später','desc long also empty','',1457609039,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(64,90909090,4,23,1,'etwas später','desc long also empty','',1457609042,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(65,90909090,3,3,1,'etwas später','desc long also empty','',1457609057,NULL,0,0,1,0,NULL,'',0.00000,'1,1,1,1'),(68,234323,4,25,0,'mach mich crud anders','','',1458476917,0,0,0,0,0,0,'',0.00000,'1,1,1,1');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_calc`
--

DROP TABLE IF EXISTS `article_calc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_calc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `desc` tinytext NOT NULL,
  `add_cost_purchase` decimal(15,5) NOT NULL DEFAULT '0.00000' COMMENT 'additional purchase cost',
  `add_cost_extra` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `add_cost_percentage` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `add_cost_percentage_compound` decimal(15,5) NOT NULL DEFAULT '0.00000',
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_calc`
--

LOCK TABLES `article_calc` WRITE;
/*!40000 ALTER TABLE `article_calc` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_calc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_class`
--

DROP TABLE IF EXISTS `article_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_class`
--

LOCK TABLES `article_class` WRITE;
/*!40000 ALTER TABLE `article_class` DISABLE KEYS */;
INSERT INTO `article_class` VALUES (1,'keine Klasse','1,1,1,1'),(15,'CE geprüft','1,1,1,1'),(16,'ABE','1,1,1,1'),(17,'TÜV','1,1,1,1');
/*!40000 ALTER TABLE `article_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_group`
--

DROP TABLE IF EXISTS `article_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_group`
--

LOCK TABLES `article_group` WRITE;
/*!40000 ALTER TABLE `article_group` DISABLE KEYS */;
INSERT INTO `article_group` VALUES (1,'leer','1,1,1,1'),(2,'Eisenwaren','1,1,1,1'),(3,'Farben und Lacke','1,1,1,1'),(22,'Kamera Kit','1,1,1,1'),(23,'Elektro','1,1,1,1'),(24,'Abgasanlage','1,1,1,1'),(25,'Karosserie','1,1,1,1');
/*!40000 ALTER TABLE `article_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_list`
--

DROP TABLE IF EXISTS `article_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id_parent` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `quantity` decimal(12,5) NOT NULL DEFAULT '0.00000',
  `desc` tinytext NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_list`
--

LOCK TABLES `article_list` WRITE;
/*!40000 ALTER TABLE `article_list` DISABLE KEYS */;
INSERT INTO `article_list` VALUES (1,14,23,2.00000,'Beast von 14','1,1,1,1'),(2,14,19,5.00000,'foo','1,1,1,1'),(3,23,27,6.00000,'comes from postman','1,1,1,1'),(4,27,29,7.00000,'noch tiefer','1,1,1,1'),(5,29,31,44.00000,'noch viel tiefer','1,1,1,1'),(8,1,32,4.00000,'keine desc','1,1,1,1'),(9,27,28,42.00000,'jetzt modular','1,1,1,1'),(10,33,50,1.00000,'no desk','1,1,1,1'),(11,19,2,1.00000,'','1,1,1,1'),(12,19,23,1.00000,'','1,1,1,1');
/*!40000 ALTER TABLE `article_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_type`
--

DROP TABLE IF EXISTS `article_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_type`
--

LOCK TABLES `article_type` WRITE;
/*!40000 ALTER TABLE `article_type` DISABLE KEYS */;
INSERT INTO `article_type` VALUES (1,'untypisiert','1,1,1,1'),(2,'Prodartikel','1,1,1,1'),(3,'Kaufteile','1,1,1,1'),(4,'Rohmaterial','1,1,1,1'),(5,'Arbeitsprozess','1,1,1,1'),(6,'Dienstleistung','1,1,1,1'),(7,'Handel','1,1,1,1');
/*!40000 ALTER TABLE `article_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` varchar(6) NOT NULL,
  `name_de` varchar(100) NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_in`
--

DROP TABLE IF EXISTS `stock_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_place` varchar(45) NOT NULL,
  `charge` varchar(100) NOT NULL,
  `quantity` decimal(12,5) NOT NULL DEFAULT '0.00000',
  `unit` int(11) NOT NULL,
  `entry_time` int(11) NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
INSERT INTO `stock_in` VALUES (1,14,1,'H2R1','23s',5.00000,1,1455361472,'1,1,1,1'),(2,14,1,'H2R1','24',15.00000,0,1455362338,'1,1,1,1'),(4,27,2,'24tr','gf5',33.00000,2,1455453115,'1,1,1,1'),(5,27,2,'24tr','gf5',33.00000,2,1455456357,'1,1,1,1'),(6,27,2,'56hh','fr45',33.00000,4,1455456736,'1,1,1,1'),(7,29,5,'6zh78','3e4r',50.00000,4,1455456774,'1,1,1,1'),(8,5675432,1,'45dfggz','33ws',30.00000,2,1456491019,'1,1,1,1'),(9,2342,1,'12wsd','43edfr',100.00000,2,1456656443,'1,1,1,1'),(10,300001,2,'erf45','45tg',44.00000,2,1456656559,'1,1,1,1'),(11,700,2,'23sdc','dfr45',44.00000,3,1456827257,'1,1,1,1'),(12,2311,1,'33e','ggbb65',66.00000,3,1456827441,'1,1,1,1'),(13,27,2,'23we','tr56',20.00000,2,1457101680,'1,1,1,1'),(14,31,2,'fr45','45rf',30.00000,2,1457103154,'1,1,1,1'),(15,14,1,'1a','1a',1.00000,1,1457261870,'1,1,1,1'),(16,14,1,'1a','1a',1.00000,1,1457261890,'1,1,1,1'),(17,14,1,'1a','1a',1.00000,1,1457262108,'1,1,1,1');
/*!40000 ALTER TABLE `stock_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_out`
--

DROP TABLE IF EXISTS `stock_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_in_id` int(11) NOT NULL,
  `quantity` decimal(12,5) NOT NULL DEFAULT '0.00000',
  `entry_time` int(11) NOT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out`
--

LOCK TABLES `stock_out` WRITE;
/*!40000 ALTER TABLE `stock_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `str` varchar(100) DEFAULT NULL,
  `str_no` varchar(10) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `tel_fax` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'Main Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1,1,1,1'),(2,'a second store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1,1,1,1');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `symbol` varchar(45) NOT NULL,
  `order_priority` int(11) NOT NULL DEFAULT '0',
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'meter','m',0,'1,1,1,1'),(2,'centimeter','cm',0,'1,1,1,1'),(3,'milimeter','mm',0,'1,1,1,1'),(4,'gram','g',0,'1,1,1,1'),(5,'kilogram','kg',0,'1,1,1,1'),(6,'box','box',0,'1,1,1,1'),(7,'liter','l',0,'1,1,1,1'),(8,'milliliter','ml',0,'1,1,1,1'),(9,'cubic meter','m³',0,'1,1,1,1');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `email` tinytext NOT NULL,
  `groups` tinytext NOT NULL COMMENT 'CSV',
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'allapow','{SHA}zbb/GzpUOqOjfNCNt4XyBkcj5fA=','','1','1,1,1,1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_priority` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `desc` tinytext,
  `crud_groups` varchar(45) NOT NULL DEFAULT '1,1,1,1' COMMENT 'CSV (Create,Read,Update,Delete) group rights (default is all to admin)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,1000,'root','','1,1,1,1');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'godatas'
--

--
-- Dumping routines for database 'godatas'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-20 14:22:18
