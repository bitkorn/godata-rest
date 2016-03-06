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
  `article_class` int(11) NOT NULL DEFAULT '0',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (0,0,1,1,1,'empty','desc long also empty','',NULL,NULL,0,0,1,0,NULL,NULL),(1,300001,1,1,3,'erster Artikel','lange desc für den ersten Artikel','',NULL,NULL,0,0,1,2,NULL,NULL),(2,300002,5,13,12,'ein zweiter Artikel :)','Dies ist der zweite Artikel','',NULL,NULL,0,0,1,0,NULL,NULL),(14,2311,4,3,0,'is wohl der 14te Artikel','','Part-ID 4711',NULL,NULL,0,0,1,0,NULL,NULL),(19,2342,2,6,6,'der mit ID 19','','',NULL,NULL,0,0,1,0,NULL,NULL),(23,6661,6,17,8,'Beast article','','',NULL,NULL,0,0,1,0,NULL,''),(25,700,4,1,13,'007 geht nicht :((','','',NULL,NULL,0,0,1,0,NULL,NULL),(26,76,5,2,0,'um noch mehr zu haben','','',NULL,NULL,0,0,1,0,NULL,NULL),(27,10007,1,4,0,'lorem ipsum war noch nich','adsf ewrgew g','',NULL,NULL,0,0,1,0,NULL,''),(28,2311,2,16,11,'dolor sit amet','','',NULL,NULL,0,0,1,0,NULL,NULL),(29,44,3,5,7,'mal ein anderer Text','ne lange','',NULL,NULL,0,0,1,0,NULL,NULL),(30,45,2,9,3,'wieder n article','','id mit 30 hat nummer 43',NULL,NULL,0,0,1,0,NULL,NULL),(31,43,5,1,0,'article with no 43','','',NULL,NULL,0,0,1,0,NULL,NULL),(32,5675432,2,1,0,'n test wieder','','',NULL,NULL,0,0,0,0,NULL,NULL),(33,3452,1,1,1,'empty','desc long also empty','',1456754750,NULL,0,0,1,0,NULL,''),(34,3452,1,1,1,'empty','desc long also empty','',1456754760,NULL,0,0,1,0,NULL,''),(35,3456,2,4,1,'a short one','veeeery looong description','',1456754850,NULL,0,0,1,0,NULL,''),(36,3452,1,1,1,'empty','desc long also empty','',1456755116,NULL,0,0,1,0,NULL,''),(48,86786,1,1,1,'empty','desc long also empty','',1456815252,NULL,0,0,1,0,NULL,''),(49,34523,1,1,1,'empty','desc long also empty','',1456815264,NULL,0,0,1,0,NULL,''),(50,86786,2,1,1,'empty','desc long no further empty','',1456821960,NULL,0,0,1,0,NULL,''),(51,86786,1,1,1,'empty','desc long also empty','',1456822111,NULL,0,0,1,0,NULL,'');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_class`
--

LOCK TABLES `article_class` WRITE;
/*!40000 ALTER TABLE `article_class` DISABLE KEYS */;
INSERT INTO `article_class` VALUES (1,'keine Klasse'),(15,'CE geprüft'),(16,'ABE'),(17,'TÜV');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_group`
--

LOCK TABLES `article_group` WRITE;
/*!40000 ALTER TABLE `article_group` DISABLE KEYS */;
INSERT INTO `article_group` VALUES (1,'leer'),(2,'Eisenwaren'),(3,'Farben und Lacke'),(22,'Kamera Kit'),(23,'Elektro'),(24,'Abgasanlage'),(25,'Karosserie');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_list`
--

LOCK TABLES `article_list` WRITE;
/*!40000 ALTER TABLE `article_list` DISABLE KEYS */;
INSERT INTO `article_list` VALUES (1,14,23,2.00000,'Beast von 14'),(2,14,19,5.00000,'foo'),(3,23,27,6.00000,'comes from postman'),(4,27,29,7.00000,'noch tiefer'),(5,29,31,44.00000,'noch viel tiefer'),(8,1,32,4.00000,'keine desc'),(9,27,28,42.00000,'jetzt modular');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_type`
--

LOCK TABLES `article_type` WRITE;
/*!40000 ALTER TABLE `article_type` DISABLE KEYS */;
INSERT INTO `article_type` VALUES (1,'Prodartikel'),(2,'Kaufteile'),(3,'Rohmaterial'),(4,'Arbeitsprozess'),(5,'Dienstleistung'),(6,'Handel');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
INSERT INTO `stock_in` VALUES (1,14,1,'H2R1','23s',5.00000,1,1455361472),(2,14,1,'H2R1','24',15.00000,0,1455362338),(4,27,2,'24tr','gf5',33.00000,2,1455453115),(5,27,2,'24tr','gf5',33.00000,2,1455456357),(6,27,2,'56hh','fr45',33.00000,4,1455456736),(7,29,5,'6zh78','3e4r',50.00000,4,1455456774),(8,5675432,1,'45dfggz','33ws',30.00000,2,1456491019),(9,2342,1,'12wsd','43edfr',100.00000,2,1456656443),(10,300001,2,'erf45','45tg',44.00000,2,1456656559),(11,700,2,'23sdc','dfr45',44.00000,3,1456827257),(12,2311,1,'33e','ggbb65',66.00000,3,1456827441),(13,27,2,'23we','tr56',20.00000,2,1457101680),(14,31,2,'fr45','45rf',30.00000,2,1457103154),(15,14,1,'1a','1a',1.00000,1,1457261870),(16,14,1,'1a','1a',1.00000,1,1457261890),(17,14,1,'1a','1a',1.00000,1,1457262108);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'Main Store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'a second store',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'meter','m',0),(2,'centimeter','cm',0),(3,'milimeter','mm',0),(4,'gram','g',0),(5,'kilogram','kg',0),(6,'box','box',0),(7,'liter','l',0),(8,'milliliter','ml',0),(9,'cubic meter','m³',0);
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
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

-- Dump completed on 2016-03-06 12:09:38
