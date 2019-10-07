-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: agfg
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
-- Table structure for table `agfg_competicion`
--

DROP TABLE IF EXISTS `agfg_competicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_competicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `tempada` varchar(200) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `categoria` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_competicion`
--

LOCK TABLES `agfg_competicion` WRITE;
/*!40000 ALTER TABLE `agfg_competicion` DISABLE KEYS */;
INSERT INTO `agfg_competicion` VALUES (1,'Liga Galega Feminina 19/20','2019-20','liga','F');
/*!40000 ALTER TABLE `agfg_competicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agfg_equipas`
--

DROP TABLE IF EXISTS `agfg_equipas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_equipas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(3) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `categoria` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_equipas`
--

LOCK TABLES `agfg_equipas` WRITE;
/*!40000 ALTER TABLE `agfg_equipas` DISABLE KEYS */;
INSERT INTO `agfg_equipas` VALUES (2,'EST','Estrela Vermelha',NULL,'F'),(3,'IRM','Irmandinhas',NULL,'F'),(4,'AUR','Auriense',NULL,'F'),(5,'HER','Herdeiras de Dhais',NULL,'F'),(6,'KEL','Keltoi',NULL,'F'),(7,'TUR','Turonia',NULL,'F'),(8,'FIL','Fillas de Breogán',NULL,'F');
/*!40000 ALTER TABLE `agfg_equipas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agfg_fase`
--

DROP TABLE IF EXISTS `agfg_fase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_fase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_competicion` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `tipo` varchar(200) DEFAULT NULL,
  `id_fase_pai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_competicion` (`id_competicion`),
  CONSTRAINT `agfg_fase_ibfk_1` FOREIGN KEY (`id_competicion`) REFERENCES `agfg_competicion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_fase`
--

LOCK TABLES `agfg_fase` WRITE;
/*!40000 ALTER TABLE `agfg_fase` DISABLE KEYS */;
INSERT INTO `agfg_fase` VALUES (2,1,'1ª volta',NULL,NULL),(3,1,'2ª volta (grupo A)',NULL,2),(4,1,'2ª volta (grupo B)',NULL,2);
/*!40000 ALTER TABLE `agfg_fase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agfg_fase_equipas`
--

DROP TABLE IF EXISTS `agfg_fase_equipas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_fase_equipas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_equipa` int(11) NOT NULL,
  `id_fase` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_fase_equipas`
--

LOCK TABLES `agfg_fase_equipas` WRITE;
/*!40000 ALTER TABLE `agfg_fase_equipas` DISABLE KEYS */;
INSERT INTO `agfg_fase_equipas` VALUES (15,2,2),(16,3,2),(17,4,2),(18,5,2),(19,6,2),(20,7,2),(21,8,2),(33,6,4),(34,7,4),(35,8,4),(36,2,3),(37,3,3),(38,4,3),(39,5,3);
/*!40000 ALTER TABLE `agfg_fase_equipas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agfg_partido`
--

DROP TABLE IF EXISTS `agfg_partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_partido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fase` int(11) NOT NULL,
  `id_equipo1` int(11) NOT NULL,
  `id_equipo2` int(11) NOT NULL,
  `goles_equipo1` int(11) DEFAULT NULL,
  `goles_equipo2` int(11) DEFAULT NULL,
  `tantos_equipo1` int(11) DEFAULT NULL,
  `tantos_equipo2` int(11) DEFAULT NULL,
  `data_partido` datetime DEFAULT NULL,
  `lugar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fase` (`id_fase`),
  KEY `id_equipo1` (`id_equipo1`),
  KEY `id_equipo2` (`id_equipo2`),
  CONSTRAINT `agfg_partido_ibfk_1` FOREIGN KEY (`id_fase`) REFERENCES `agfg_fase` (`id`),
  CONSTRAINT `agfg_partido_ibfk_2` FOREIGN KEY (`id_equipo1`) REFERENCES `agfg_equipas` (`id`),
  CONSTRAINT `agfg_partido_ibfk_3` FOREIGN KEY (`id_equipo2`) REFERENCES `agfg_equipas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_partido`
--

LOCK TABLES `agfg_partido` WRITE;
/*!40000 ALTER TABLE `agfg_partido` DISABLE KEYS */;
/*!40000 ALTER TABLE `agfg_partido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agfg_users`
--

DROP TABLE IF EXISTS `agfg_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) DEFAULT NULL,
  `contrasinal` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_users`
--

LOCK TABLES `agfg_users` WRITE;
/*!40000 ALTER TABLE `agfg_users` DISABLE KEYS */;
INSERT INTO `agfg_users` VALUES (1,'agfg-admin','$2a$10$BRzX/K3Ds/8dV1X6MsU2QOc3eBvu7J8bxOa3KyIDSWzztU4ggKfdW','Administrador','admin','2016-09-21 19:38:38','2016-09-21 19:38:38');
/*!40000 ALTER TABLE `agfg_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agfg_xornada`
--

DROP TABLE IF EXISTS `agfg_xornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agfg_xornada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fase` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agfg_xornada`
--

LOCK TABLES `agfg_xornada` WRITE;
/*!40000 ALTER TABLE `agfg_xornada` DISABLE KEYS */;
INSERT INTO `agfg_xornada` VALUES (3,2,'2019-10-12','1');
/*!40000 ALTER TABLE `agfg_xornada` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-08  1:27:42
