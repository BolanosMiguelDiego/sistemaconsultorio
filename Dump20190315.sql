-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: centromedico
-- ------------------------------------------------------
-- Server version	5.7.14-log

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
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `citfecha` date NOT NULL,
  `cithora` time NOT NULL,
  `citPaciente` int(11) NOT NULL,
  `citMedico` int(11) NOT NULL,
  `citConsultorio` int(11) NOT NULL,
  `citestado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `citobservaciones` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idcita`),
  KEY `cithora` (`cithora`),
  KEY `idPaciente` (`citPaciente`),
  KEY `idMedico` (`citMedico`),
  KEY `idConsultorio` (`citConsultorio`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (21,'2018-12-27','11:45:00',6,10154,1,'asignado','Hpñas'),(22,'2018-12-20','11:45:00',6,10154,1,'asignado','asdasdas'),(23,'2018-12-26','09:00:00',6,10154,1,'asignado','Es muy temprano :c'),(24,'2018-12-26','11:45:00',6,10154,1,'asignado',''),(25,'2018-12-19','11:45:00',6,4234,1,'asignado','');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultorios`
--

DROP TABLE IF EXISTS `consultorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultorios` (
  `idConsultorio` int(11) NOT NULL AUTO_INCREMENT,
  `conNombre` char(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idConsultorio`),
  UNIQUE KEY `conNombre` (`conNombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultorios`
--

LOCK TABLES `consultorios` WRITE;
/*!40000 ALTER TABLE `consultorios` DISABLE KEYS */;
INSERT INTO `consultorios` VALUES (3,'1'),(1,'2'),(6,'3');
/*!40000 ALTER TABLE `consultorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `espNombre` char(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idespecialidad`),
  UNIQUE KEY `espNombre` (`espNombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
INSERT INTO `especialidades` VALUES (1,'pediatria'),(2,'psicologia');
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicos` (
  `idMedico` int(11) NOT NULL AUTO_INCREMENT,
  `medidentificacion` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `mednombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medapellidopat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medapellidomat` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `medEspecialidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `medtelefono` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `medcorreo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idMedico`),
  UNIQUE KEY `medidentificacion` (`medidentificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicos`
--

LOCK TABLES `medicos` WRITE;
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` VALUES (1,'10154','Raul Alberto','Fer','Matias','pediatria','7656756757','alberto@gmail.com'),(4,'4234','jorge','Santiago','Pineda','pediatria','7823483627','pineda@gmail.com'),(5,'1234567','nolberto','canseco','martinez','pediatria','9512346534','canseco@gmail.com'),(6,'7654321','juan','sanchez','arteaga','psicologia','9516785645','sanches45@gmail.com'),(7,'1416118','juanAntonio','cruz','hernandz','psicologia','9512345465','juan@gmail.com');
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `idPaciente` int(11) NOT NULL AUTO_INCREMENT,
  `pacIdentificacion` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `pacNombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pacApellidopat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pacApellidomat` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pacFechaNacimiento` date NOT NULL,
  `pacSexo` enum('Femenino','Masculino') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idPaciente`),
  UNIQUE KEY `pacIdentificacion` (`pacIdentificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (6,'63896394','luis','Antonio','Perez','2018-12-13','Masculino'),(7,'1234','carlos eduardo','Sanchez ','Ruiz','1995-05-18','Masculino'),(8,'123333','edgar','Cruz','Cruz','2018-12-04','Masculino'),(9,'14161856','angel','sanchez','castro','2019-03-19','Masculino');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidopat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidomat` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Roll` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'zai0382','3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79','zaira','hernandez','perez','admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-15 14:29:12
