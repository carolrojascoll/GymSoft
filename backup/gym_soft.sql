-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gym_soft
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `id_articulo` int(6) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_marca` smallint(4) NOT NULL,
  `descripcion` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_iva` tinyint(4) NOT NULL,
  `stock_actual` double(8,2) NOT NULL,
  `precio_compra` double(12,2) NOT NULL,
  `porcent_ganancia` double(3,1) NOT NULL,
  `precio_venta` double(12,2) NOT NULL,
  PRIMARY KEY (`id_articulo`),
  KEY `fk_marcas` (`id_marca`),
  KEY `fk_iva` (`id_iva`),
  CONSTRAINT `fk_iva` FOREIGN KEY (`id_iva`) REFERENCES `iva` (`id_iva`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marcas` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (13,'100',1,'AGUA MINERAL 500 ML',3,26.00,3000.00,99.9,6500.00),(14,'200',3,'ENERGIZANTE 500 ML',2,12.00,7000.00,71.4,12000.00),(15,'300',1,'AGUA MINERAL 1L',3,14.00,3600.00,99.9,7800.00),(26,'400',1,'AGUA MINERAL 2L',3,16.00,3800.00,99.9,9450.00),(27,'500',3,'ENERGIZANTE 1L',3,16.00,7000.00,85.7,13000.00),(28,'600',4,'PROTEINA 1 KG',3,6.00,140000.00,11.4,156000.00),(32,'700',1,'AGUA MINERAL 250ML',3,10.00,1800.00,66.0,3000.00);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `entrada` datetime NOT NULL,
  `salida` datetime DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_asistencia`),
  KEY `fk_cliente` (`id_cliente`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (4,29,'2023-05-11 11:34:59','2023-05-11 16:26:31','2023-05-11'),(5,38,'2023-05-12 10:37:03','2023-05-12 17:53:28','2023-05-12'),(6,38,'2023-05-16 14:25:18','2023-05-16 18:53:02','2023-05-16'),(7,38,'2023-05-18 14:16:51','2023-05-18 19:48:40','2023-05-18'),(8,29,'2023-05-18 19:25:09',NULL,'2023-05-18'),(9,38,'2023-05-24 12:00:23','2023-05-24 12:05:58','2023-05-24'),(10,38,'2023-05-24 12:04:34','2023-05-24 12:05:58','2023-05-24'),(11,38,'2023-05-25 09:47:15','2023-05-25 19:53:13','2023-05-25'),(12,38,'2023-05-25 19:52:39','2023-05-25 19:53:13','2023-05-25'),(13,38,'2023-07-06 15:47:46','2023-07-06 22:02:22','2023-07-06'),(14,38,'2023-07-06 22:00:42','2023-07-06 22:02:22','2023-07-06'),(15,38,'2023-07-06 22:02:08','2023-07-06 22:02:22','2023-07-06'),(16,38,'2023-07-14 10:56:19','2023-07-14 10:56:37','2023-07-14');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia_entrenadores`
--

DROP TABLE IF EXISTS `asistencia_entrenadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia_entrenadores` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrenador` int(11) NOT NULL,
  `entrada` datetime NOT NULL,
  `salida` datetime NOT NULL,
  `demora` datetime NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_asistencia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia_entrenadores`
--

LOCK TABLES `asistencia_entrenadores` WRITE;
/*!40000 ALTER TABLE `asistencia_entrenadores` DISABLE KEYS */;
INSERT INTO `asistencia_entrenadores` VALUES (1,2,'2023-05-25 19:37:01','2023-05-25 19:37:01','2023-05-25 13:37:01','2023-05-25');
/*!40000 ALTER TABLE `asistencia_entrenadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabecera_compra`
--

DROP TABLE IF EXISTS `cabecera_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cabecera_compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` smallint(11) NOT NULL,
  `num_factura` varchar(15) NOT NULL,
  `timbrado` varchar(15) NOT NULL,
  `condicion` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `total_iva0` double(14,2) NOT NULL DEFAULT 0.00,
  `total_iva5` double(14,2) NOT NULL DEFAULT 0.00,
  `total_iva10` double(14,2) NOT NULL,
  `total_compra` double(14,2) NOT NULL,
  `anulado` varchar(2) NOT NULL DEFAULT 'No',
  `pagado` varchar(2) NOT NULL DEFAULT 'Si',
  `efectivo` double(14,2) NOT NULL DEFAULT 0.00,
  `transferencia` double(14,2) NOT NULL DEFAULT 0.00,
  `cheque` double(14,2) NOT NULL DEFAULT 0.00,
  `importe` double(14,2) NOT NULL DEFAULT 0.00,
  `vuelto` double(14,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_compra`),
  KEY `fk_proveedor` (`id_proveedor`),
  CONSTRAINT `fk_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabecera_compra`
--

LOCK TABLES `cabecera_compra` WRITE;
/*!40000 ALTER TABLE `cabecera_compra` DISABLE KEYS */;
INSERT INTO `cabecera_compra` VALUES (1,8,'001-001-0001386','1245568','CONTADO','2023-07-14',0.00,0.00,1636.00,18000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(2,8,'001-001-0000012','1546688','CONTADO','2023-07-15',0.00,0.00,3545.00,39000.00,'No','Si',0.00,0.00,0.00,0.00,0.00),(3,8,'001-001-0000013','1545398','CONTADO','2023-07-15',0.00,0.00,2909.00,32000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(4,8,'001-001-0000014','1423563','CONTADO','2023-07-17',0.00,0.00,955.00,10500.00,'No','Si',20000.00,0.00,0.00,20000.00,4000.00),(5,8,'001-001-0000154','124523','CONTADO','2023-07-17',0.00,0.00,1455.00,16000.00,'No','Si',20000.00,0.00,0.00,20000.00,4000.00),(6,8,'001-001-0001254','145234','CONTADO','2023-07-17',0.00,0.00,1455.00,16000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(7,8,'001-001-0000012','1245354','CONTADO','2023-07-17',0.00,0.00,1455.00,16000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(8,8,'001-001-0000012','1254534','CONTADO','2023-07-17',0.00,0.00,2545.00,28000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(9,8,'001-001-0000015','1235482','CONTADO','2023-07-17',0.00,0.00,1818.00,20000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(10,8,'001-001-0000014','1234567','CONTADO','2023-07-17',0.00,0.00,1091.00,12000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(11,8,'001-001-0000014','1245653','CONTADO','2023-07-17',0.00,14000.00,3000.00,17000.00,'No','No',0.00,0.00,0.00,0.00,0.00),(12,9,'001-001-0000148','1548347','CONTADO','2023-07-17',0.00,0.00,42000.00,182000.00,'No','No',0.00,0.00,0.00,0.00,0.00);
/*!40000 ALTER TABLE `cabecera_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabecera_venta`
--

DROP TABLE IF EXISTS `cabecera_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cabecera_venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_entrenador` int(11) NOT NULL,
  `num_factura` int(15) NOT NULL,
  `timbrado` varchar(15) NOT NULL,
  `condicion` varchar(12) NOT NULL,
  `fecha` date NOT NULL,
  `total_iva0` double(14,2) NOT NULL DEFAULT 0.00,
  `total_iva5` double(14,2) NOT NULL DEFAULT 0.00,
  `total_iva10` double(14,2) NOT NULL,
  `total_venta` double(14,2) NOT NULL,
  `pagado` varchar(2) NOT NULL DEFAULT 'No',
  `anulado` varchar(2) NOT NULL DEFAULT 'No',
  `efectivo` double(14,2) NOT NULL DEFAULT 0.00,
  `transferencia` double(14,2) NOT NULL DEFAULT 0.00,
  `cheque` double(14,2) NOT NULL DEFAULT 0.00,
  `importe` double(14,2) NOT NULL DEFAULT 0.00,
  `vuelto` double(14,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_venta`),
  KEY `fk_clientes` (`id_cliente`),
  KEY `fk_entrenadores` (`id_entrenador`),
  CONSTRAINT `fk_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_entrenadores` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenadores` (`id_entrenador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabecera_venta`
--

LOCK TABLES `cabecera_venta` WRITE;
/*!40000 ALTER TABLE `cabecera_venta` DISABLE KEYS */;
INSERT INTO `cabecera_venta` VALUES (1,38,3,1,'12345678','CONTADO','2023-07-17',0.00,0.00,26000.00,26000.00,'Si','No',0.00,0.00,0.00,0.00,0.00);
/*!40000 ALTER TABLE `cabecera_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `ciudad` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudades`
--

LOCK TABLES `ciudades` WRITE;
/*!40000 ALTER TABLE `ciudades` DISABLE KEYS */;
INSERT INTO `ciudades` VALUES (91,'CONCEPCIÓN'),(168,'HORQUETA'),(173,'VALLEMI'),(180,'BELEN');
/*!40000 ALTER TABLE `ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `razon_social` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `direccion` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `sexo` varchar(10) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `f_nacimiento` date NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `id_ciudad` (`id_ciudad`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (29,'6892652','CAROLINA ROJAS',91,'REGIMIENTO 2 DE MAYO C/ ASUNCIÓN','0972234198','FEMENINO','2002-05-19'),(30,'6761829','CRISTHIAN VALENZUELA',91,'SAN CARLOS C/ AVENIDA BOQUERÓN','0981929063','MASCULINO','2002-03-04'),(33,'6891323','EUGENIO GONZALEZ',91,'VILLA ALTA','0971806102','MASCULINO','2000-12-30'),(38,'6658363','ALEXANDER RIVAS',91,'SANTO DOMINGO DE GUZMÁN','0986430579','MASCULINO','2001-01-20');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_compra` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_compra` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_marca` smallint(11) NOT NULL,
  `id_iva` tinyint(11) NOT NULL,
  `cantidad` double(10,2) NOT NULL,
  `precio` double(14,2) NOT NULL DEFAULT 0.00,
  `subtotal_iva0` double(14,2) NOT NULL,
  `subtotal_iva5` double(14,2) NOT NULL,
  `subtotal_iva10` double(14,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `fk_articulo` (`id_articulo`),
  KEY `fk_marca` (`id_marca`),
  KEY `fk_det_iva` (`id_iva`),
  KEY `fk_compra` (`id_compra`),
  CONSTRAINT `fk_articulo` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra` FOREIGN KEY (`id_compra`) REFERENCES `cabecera_compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_det_iva` FOREIGN KEY (`id_iva`) REFERENCES `iva` (`id_iva`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marca` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compra`
--

LOCK TABLES `detalle_compra` WRITE;
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` VALUES (1,3,13,1,3,5.00,3000.00,0.00,0.00,15000.00),(2,3,15,1,3,1.00,7000.00,0.00,0.00,7000.00),(3,3,32,1,3,4.00,2500.00,0.00,0.00,10000.00),(7,4,13,1,3,1.00,3500.00,0.00,0.00,3500.00),(8,4,14,3,3,1.00,7000.00,0.00,0.00,7000.00),(9,5,13,1,3,4.00,4000.00,0.00,0.00,16000.00),(10,6,13,1,3,4.00,4000.00,0.00,0.00,16000.00),(11,7,13,1,3,4.00,4000.00,0.00,0.00,16000.00),(12,8,13,1,3,7.00,4000.00,0.00,0.00,28000.00),(13,9,13,1,3,5.00,4000.00,0.00,0.00,20000.00),(14,10,13,1,3,3.00,4000.00,0.00,0.00,12000.00),(15,11,13,1,3,1.00,3000.00,0.00,0.00,3000.00),(16,11,14,3,2,2.00,7000.00,0.00,14000.00,0.00),(17,12,28,4,3,1.00,140000.00,0.00,0.00,140000.00),(18,12,27,3,3,6.00,7000.00,0.00,0.00,42000.00);
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_marca` smallint(11) NOT NULL,
  `id_iva` tinyint(11) NOT NULL,
  `cantidad` double(10,2) NOT NULL,
  `precio` double(14,2) NOT NULL DEFAULT 0.00,
  `subtotal_iva0` double(14,2) NOT NULL,
  `subtotal_iva5` double(14,2) NOT NULL,
  `subtotal_iva10` double(14,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `fk_articulos` (`id_articulo`),
  KEY `marcasFk` (`id_marca`),
  KEY `ivas_Fk` (`id_iva`),
  KEY `fk_ventas` (`id_venta`),
  CONSTRAINT `fk_articulos` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ventas` FOREIGN KEY (`id_venta`) REFERENCES `cabecera_venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ivas_Fk` FOREIGN KEY (`id_iva`) REFERENCES `iva` (`id_iva`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marcasFk` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,1,13,1,3,4.00,6500.00,0.00,0.00,26000.00);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ejercicios` (
  `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT,
  `ejercicio` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ejercicio`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicios`
--

LOCK TABLES `ejercicios` WRITE;
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
INSERT INTO `ejercicios` VALUES (4,'LAGARTIJA'),(13,'SENTADILLA'),(14,'ZANCADA');
/*!40000 ALTER TABLE `ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrenadores`
--

DROP TABLE IF EXISTS `entrenadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrenadores` (
  `id_entrenador` int(11) NOT NULL AUTO_INCREMENT,
  `ruc_ci` varchar(10) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellido` varchar(80) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `fecha_nac` date NOT NULL,
  `sueldo_bruto` double(14,2) NOT NULL,
  `horas_trabajo` int(11) NOT NULL COMMENT 'Horas de trabajo a cumplir',
  PRIMARY KEY (`id_entrenador`),
  KEY `fk_ciudad` (`id_ciudad`),
  CONSTRAINT `fk_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrenadores`
--

LOCK TABLES `entrenadores` WRITE;
/*!40000 ALTER TABLE `entrenadores` DISABLE KEYS */;
INSERT INTO `entrenadores` VALUES (2,'1234567','JUAN','PEREZ',91,'SIN DIRECCION','0984521345','MASCULINO','2000-04-01',1000000.00,6),(3,'6658363','ALEXANDER','RIVAS',91,'SANTO DOMINGO DE GUZMAN','0986430579','MASCULINO','2001-05-26',2500000.00,8),(4,'7654321','LUIS','LOPEZ',91,'SAN CARLOS','0000000','MASCULINO','2001-01-01',2000000.00,8),(5,'4563218','CARLOS','SUAREZ',91,'VIA SIN NOMBRE','000000','MASCULINO','2000-05-03',2000000.00,8),(6,'4563210','ANTONIO','PEREZ',91,'SAN CARLOS','000000','MASCULINO','2000-03-01',2000000.00,8);
/*!40000 ALTER TABLE `entrenadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iva`
--

DROP TABLE IF EXISTS `iva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iva` (
  `id_iva` tinyint(4) NOT NULL AUTO_INCREMENT,
  `tipo_iva` tinyint(4) NOT NULL,
  `divisor` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_iva`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iva`
--

LOCK TABLES `iva` WRITE;
/*!40000 ALTER TABLE `iva` DISABLE KEYS */;
INSERT INTO `iva` VALUES (1,0,0),(2,5,21),(3,10,11);
/*!40000 ALTER TABLE `iva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id_marca` smallint(6) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'DASANI'),(3,'POWERADE'),(4,'WHEY');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medidas`
--

DROP TABLE IF EXISTS `medidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medidas` (
  `id_medida` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `espalda` double(6,2) NOT NULL DEFAULT 0.00,
  `pecho` double(6,2) NOT NULL DEFAULT 0.00,
  `bicep_izq` double(6,2) NOT NULL DEFAULT 0.00,
  `bicep_der` double(6,2) NOT NULL DEFAULT 0.00,
  `cintura` double(6,2) NOT NULL DEFAULT 0.00,
  `nalga` double(6,2) NOT NULL DEFAULT 0.00,
  `muslo_izq` double(6,2) NOT NULL DEFAULT 0.00,
  `muslo_der` double(6,2) NOT NULL DEFAULT 0.00,
  `panto_izq` double(6,2) NOT NULL DEFAULT 0.00,
  `panto_der` double(6,2) NOT NULL DEFAULT 0.00,
  `peso` double(6,2) NOT NULL DEFAULT 0.00,
  `observacion` varchar(200) NOT NULL DEFAULT 'NINGUNA',
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_medida`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `medidas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medidas`
--

LOCK TABLES `medidas` WRITE;
/*!40000 ALTER TABLE `medidas` DISABLE KEYS */;
INSERT INTO `medidas` VALUES (1,38,10.00,11.00,12.00,13.00,14.00,15.00,16.00,17.00,18.00,19.00,20.00,'BAJO OBSERVACIÓN','2023-05-20'),(4,38,12.00,13.00,14.00,15.00,0.00,0.00,16.00,17.00,18.00,19.00,20.00,'OFF','2023-06-09'),(5,38,10.00,12.00,12.00,12.00,0.00,0.00,10.00,10.00,10.00,10.00,100.00,'OFF','2023-06-25'),(6,38,10.00,10.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,100.00,'SADSDFSD','2023-07-06'),(7,38,10.00,10.00,10.00,10.00,0.00,0.00,10.00,10.00,10.00,10.00,100.00,'ASSDFSDF','2023-07-06');
/*!40000 ALTER TABLE `medidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id_proveedor` smallint(6) NOT NULL AUTO_INCREMENT,
  `ruc` varchar(10) NOT NULL,
  `razon_social` varchar(80) NOT NULL,
  `direccion` varchar(80) NOT NULL DEFAULT 'FALTA COMPLETAR',
  `id_ciudad` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL DEFAULT '0000000',
  PRIMARY KEY (`id_proveedor`),
  KEY `fk_ciudades` (`id_ciudad`),
  CONSTRAINT `fk_ciudades` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (8,'1234567-1','PROVEEDOR PRIMARIO','POR COMPLETAR',91,'POR COMPLETAR'),(9,'7536143-2','PROVEEDOR HORQUETA','POR COMPLETAR',168,'POR COMPLETAR');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_rol` tinyint(4) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'ADMINISTRADOR'),(3,'LIMPIADOR'),(4,'SECRETARIO');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutina_cabecera`
--

DROP TABLE IF EXISTS `rutina_cabecera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutina_cabecera` (
  `id_rutina` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_rutina`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutina_cabecera`
--

LOCK TABLES `rutina_cabecera` WRITE;
/*!40000 ALTER TABLE `rutina_cabecera` DISABLE KEYS */;
INSERT INTO `rutina_cabecera` VALUES (1,'RUTINA DE PIERNAS'),(2,'RUTINA DE BRAZOS'),(3,'RUTINA');
/*!40000 ALTER TABLE `rutina_cabecera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutina_detalle`
--

DROP TABLE IF EXISTS `rutina_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutina_detalle` (
  `id_detalle` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_rutina` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  `cant_serie` int(11) NOT NULL,
  `cant_repeticiones` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `fk_rutina` (`id_rutina`),
  KEY `fk_ejercicios` (`id_ejercicio`),
  CONSTRAINT `fk_ejercicios` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rutina` FOREIGN KEY (`id_rutina`) REFERENCES `rutina_cabecera` (`id_rutina`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutina_detalle`
--

LOCK TABLES `rutina_detalle` WRITE;
/*!40000 ALTER TABLE `rutina_detalle` DISABLE KEYS */;
INSERT INTO `rutina_detalle` VALUES (19,1,1,4,4,15),(20,1,2,13,4,15),(21,2,1,4,4,15),(23,3,1,13,4,15),(24,3,2,4,4,15);
/*!40000 ALTER TABLE `rutina_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_entrenador` int(11) NOT NULL,
  `id_rol` tinyint(4) NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `usuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contrasena` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_rol` (`id_rol`),
  KEY `fk_entrenador` (`id_entrenador`),
  CONSTRAINT `fk_entrenador` FOREIGN KEY (`id_entrenador`) REFERENCES `entrenadores` (`id_entrenador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (10,3,1,'alexrivasbenitez324@gmail.com','alexander rivas.jpg','alex','44849e1a7831a6d01fc7ca75541ca8f3'),(30,4,1,'luis@gmail.com','luis lopez.jpg','luis','36f6348a8e1f34318e94bcf8b3c0c2bf'),(31,6,1,'antonio@gmail.com','antonio perez.png','antonio','e3c256274961ece54ff6a2710a24c569');
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

-- Dump completed on 2023-07-17 13:24:56
