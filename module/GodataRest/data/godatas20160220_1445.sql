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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (0,0,1,1,1,'empty','','',NULL,NULL,0,0,1,0,NULL,NULL),(1,300001,1,1,3,'erster Artikel','lange desc für den ersten Artikel','',NULL,NULL,0,0,1,2,NULL,NULL),(2,300002,5,13,12,'ein zweiter Artikel :)','Dies ist der zweite Artikel','',NULL,NULL,0,0,1,0,NULL,NULL),(14,2311,4,3,0,'is wohl der 14te Artikel','','Part-ID 4711',NULL,NULL,0,0,1,0,NULL,NULL),(19,2342,2,6,6,'der mit ID 19','','',NULL,NULL,0,0,1,0,NULL,NULL),(23,666,6,17,8,'Beast article','','',NULL,NULL,0,0,1,0,NULL,NULL),(25,700,4,1,13,'007 geht nicht :((','','',NULL,NULL,0,0,1,0,NULL,NULL),(26,76,5,2,0,'um noch mehr zu haben','','',NULL,NULL,0,0,1,0,NULL,NULL),(27,10007,1,4,0,'lorem ipsum war noch nich','','',NULL,NULL,0,0,1,0,NULL,NULL),(28,2311,2,16,11,'dolor sit amet','','',NULL,NULL,0,0,1,0,NULL,NULL),(29,44,3,5,7,'mal ein anderer Text','ne lange','',NULL,NULL,0,0,1,0,NULL,NULL),(30,45,2,9,3,'wieder n article','','id mit 30 hat nummer 43',NULL,NULL,0,0,1,0,NULL,NULL),(31,43,5,1,0,'article with no 43','','',NULL,NULL,0,0,1,0,NULL,NULL),(32,5675432,2,1,0,'n test wieder','','',NULL,NULL,0,0,0,0,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_class`
--

LOCK TABLES `article_class` WRITE;
/*!40000 ALTER TABLE `article_class` DISABLE KEYS */;
INSERT INTO `article_class` VALUES (1,'keine Klasse'),(2,'C1 W Klima Druckkabine'),(3,'C1 P GO 21J Teile'),(4,'C2 P anderer 21J Teile'),(5,'C4 W Türen Luken'),(6,'C6 W Tank Wasser'),(7,'C7 W Mounts, Exhaust, Triebwerksteile'),(8,'C8 W Flight Controls'),(9,'C9 W Tank, Fuel, Fuelsystems'),(10,'C12 W Hydraulik'),(11,'C 14 W Fahrwerke'),(12,'C 16 W Spinner, Propteile'),(13,'C 18 W Enteisung, Feuerschutz'),(14,'C 20 W Teile Struktur');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_group`
--

LOCK TABLES `article_group` WRITE;
/*!40000 ALTER TABLE `article_group` DISABLE KEYS */;
INSERT INTO `article_group` VALUES (1,'leer'),(2,'AS 202'),(3,'C 208 Camera Kit'),(4,'C 340 Foto'),(5,'C208'),(6,'CALIF'),(7,'da42'),(8,'DO28'),(9,'DO28-G92'),(10,'DO28-G92-12.2-06-00-GFM'),(11,'EA 400'),(12,'enviscope'),(13,'Fischer'),(14,'Grob'),(15,'Heggemann'),(16,'Interner Auftrag'),(17,'MOGAS'),(18,'ROBIN'),(19,'ROTAX'),(20,'Xtreme'),(21,'Zepp');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_list`
--

LOCK TABLES `article_list` WRITE;
/*!40000 ALTER TABLE `article_list` DISABLE KEYS */;
INSERT INTO `article_list` VALUES (1,14,23,2.00000,'Beast von 14'),(2,14,19,5.00000,'foo'),(3,23,27,6.00000,'comes from postman'),(4,27,29,7.00000,'noch tiefer'),(5,29,31,44.00000,'noch viel tiefer');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
INSERT INTO `stock_in` VALUES (1,14,1,'H2R1','23s',5.00000,1,1455361472),(2,14,1,'H2R1','24',15.00000,0,1455362338),(4,27,2,'24tr','gf5',33.00000,2,1455453115),(5,27,2,'24tr','gf5',33.00000,2,1455456357),(6,27,2,'56hh','fr45',33.00000,4,1455456736),(7,29,5,'6zh78','3e4r',50.00000,4,1455456774);
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
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
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

-- Dump completed on 2016-02-20 14:45:20
