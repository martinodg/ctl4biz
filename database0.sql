-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Dec 07, 2020 at 02:23 PM
-- Server version: 10.5.8-MariaDB-1:10.5.8+maria~focal
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `T_de10ff9fe0a37aa071be7586c5c3151f`
--

-- --------------------------------------------------------

--
-- Table structure for table `albalinea`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albalinea` (
  `codalbaran` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albalineap`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albalineap` (
  `codalbaran` int(10) NOT NULL DEFAULT 0,
  `codproveedor` int(5) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albalineaptmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albalineaptmp` (
  `codalbaran` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albalineatmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albalineatmp` (
  `codalbaran` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albaranes`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albaranes` (
  `codalbaran` int(11) NOT NULL,
  `codfactura` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `iva` tinyint(4) NOT NULL DEFAULT 0,
  `codcliente` int(5) DEFAULT 0,
  `estado` varchar(1) CHARACTER SET utf8 DEFAULT '1',
  `totalalbaran` float NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albaranesp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albaranesp` (
  `codalbaran` int(5) NOT NULL DEFAULT 0,
  `codproveedor` int(5) NOT NULL DEFAULT 0,
  `codfactura` int(20) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `iva` tinyint(4) NOT NULL DEFAULT 0,
  `estado` varchar(1) DEFAULT '1',
  `totalalbaran` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albaranesptmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albaranesptmp` (
  `codalbaran` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Temporal de albaranes de proveedores para controlar acceso s';

-- --------------------------------------------------------

--
-- Table structure for table `albaranestmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `albaranestmp` (
  `codalbaran` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `articulos` (
  `codarticulo` int(10) NOT NULL,
  `codfamilia` int(5) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `descripcion` text NOT NULL,
  `impuesto` float DEFAULT NULL,
  `codproveedor1` int(5) NOT NULL DEFAULT 1,
  `codproveedor2` int(5) NOT NULL,
  `codproveedor3` int(11) NOT NULL,
  `codproveedor4` int(11) NOT NULL,
  `descripcion_corta` varchar(30) DEFAULT NULL,
  `codubicacion` int(3) NOT NULL,
  `stock` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL,
  `stock_minimo` decimal(6,2) NOT NULL,
  `codumstock_minimo` int(5) NOT NULL,
  `aviso_minimo` varchar(1) NOT NULL DEFAULT '0',
  `datos_producto` varchar(200) NOT NULL,
  `fecha_alta` date NOT NULL DEFAULT '0000-00-00',
  `codembalaje` int(3) NOT NULL,
  `unidades_caja` int(8) NOT NULL,
  `codumunidades_caja` int(5) NOT NULL,
  `precio_ticket` varchar(1) NOT NULL DEFAULT '0',
  `modificar_ticket` varchar(1) NOT NULL DEFAULT '0',
  `observaciones` text NOT NULL,
  `precio_compra` float(10,2) DEFAULT NULL,
  `precio_almacen` float(10,2) DEFAULT NULL,
  `precio_tienda` float(10,2) DEFAULT NULL,
  `precio_pvp` float(10,2) DEFAULT NULL,
  `precio_iva` float(10,2) DEFAULT NULL,
  `codigobarras` varchar(15) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Articulos';

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`codarticulo`, `codfamilia`, `referencia`, `descripcion`, `impuesto`, `codproveedor1`, `codproveedor2`, `codproveedor3`, `codproveedor4`, `descripcion_corta`, `codubicacion`, `stock`, `codunidadmedida`, `stock_minimo`, `codumstock_minimo`, `aviso_minimo`, `datos_producto`, `fecha_alta`, `codembalaje`, `unidades_caja`, `codumunidades_caja`, `precio_ticket`, `modificar_ticket`, `observaciones`, `precio_compra`, `precio_almacen`, `precio_tienda`, `precio_pvp`, `precio_iva`, `codigobarras`, `imagen`, `borrado`) VALUES
(4, 3, 'paprika', 'paprika', 7, 13, 0, 0, 0, 'paprika', 1, '219.00', 3, '20.00', 3, '0', '', '2019-12-01', 1, 50, 3, '0', '', '', 211.00, 0.00, 0.00, NULL, 0.00, '8400000000000', 'foto1.jpg', '1'),
(6, 3, 'salt', 'salt', 7, 5, 0, 0, 0, 'salt', 1, '26.90', 3, '25.00', 3, '0', 'salt', '2019-12-01', 2, 25, 3, '0', '', '', 7.00, 0.00, 0.00, NULL, 0.00, '8400000000000', 'foto1.jpg', '1'),
(7, 3, 'white flour', 'white flour', 7, 5, 0, 0, 0, 'white flour', 1, '100.00', 3, '50.00', 3, '0', 'white flour', '2019-12-01', 1, 50, 3, '0', '', '', 16.00, 0.00, 0.00, NULL, 0.00, '8400000000000', 'foto1.jpg', '1'),
(9, 2, 'beef filling', 'beef filling', 7, 18, 0, 0, 0, 'beef filling', 1, '50.00', 3, '20.00', 3, '1', 'beef filling', '2019-12-01', 7, 40, 3, '0', '', '', 100.00, 0.00, 0.00, NULL, 0.00, '8400000000093', 'foto9.jpg', '0'),
(10, 1, '24600011020', 'SALT BULK', 0, 5, 0, 0, 0, '', 1, '1.00', 0, '1.00', 0, '0', '', '2020-11-22', 0, 25, 0, '0', '0', '', 0.29, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(11, 1, '785921070102', 'SUGAR GRANULATED', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 50, 0, '0', '0', '', 0.48, NULL, NULL, NULL, NULL, '', '', '0'),
(12, 1, '', 'CAYENN RED ', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 1, 0, '0', '0', '', 5.78, NULL, NULL, NULL, NULL, '', '', '0'),
(13, 1, '16000501119', 'FLOUR ALL TRUMP', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 50, 0, '0', '0', '', 0.34, NULL, NULL, NULL, NULL, '', '', '0'),
(14, 1, '796800356507', 'FLOUR HI GLUTEN', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 50, 0, '0', '0', '', 0.30, NULL, NULL, NULL, NULL, '', '', '0'),
(15, 1, '', 'TAPIOCA FLOUR', 0, 22, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 50, 0, '0', '0', '', 0.74, NULL, NULL, NULL, NULL, '', '', '0'),
(16, 1, 'ALMIDON', 'ALMIDON COLOMBIANO', 0, 22, 0, 0, 0, '', 1, '2.00', 0, '1.00', 0, '1', '', '2020-11-22', 0, 50, 2, '0', '0', '', 37.75, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(17, 1, '760695008810', 'BREAD CRUMB PLAIN', 0, 5, 0, 0, 0, '', 1, '2.00', 3, '1.00', 3, '0', '', '2020-11-22', 0, 5, 2, '0', '0', '', 4.20, 9.99, 9.99, NULL, 10.69, '', '', '0'),
(18, 1, '760695007059', 'WRAP WHITE FLOUR 12', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 1.08, NULL, NULL, NULL, NULL, '', '', '0'),
(19, 1, '850532000098', 'ROLL KAISER HAMBUR', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 0.35, NULL, NULL, NULL, NULL, '', '', '0'),
(20, 1, '72995013358', 'POTATO STICKS', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 6, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(21, 1, '74188165516', 'MAYO XTR HVY', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 7.78, NULL, NULL, NULL, NULL, '', '', '0'),
(22, 1, '74188021751', 'VEGETABLE OIL', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 2, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(23, 1, '760695004812', 'OIL CLEAR FRY', 0, 5, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 35, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(24, 1, '3 03C', 'DISCOS EMPANADA CRI 440', 0, 6, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 1.12, NULL, NULL, NULL, NULL, '', '', '0'),
(25, 1, '3 03CR', 'DISCOS EMPANADA ROST 500', 0, 6, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 1.47, NULL, NULL, NULL, NULL, '', '', '0'),
(26, 1, '3401TPHL', 'DISCOS PASCUALINA BRANSEN', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 30, 0, '0', '0', '', 1.57, NULL, NULL, NULL, NULL, '', '', '0'),
(27, 1, '720790', 'HAM', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 4, 0, '0', '0', '', 13.88, NULL, NULL, NULL, NULL, '', '', '0'),
(28, 1, '71270301623', 'TUNA CHUNKLITE', 0, 5, 0, 0, 0, '', 1, '0.00', 6, '0.00', 0, '0', '', '2020-11-22', 0, 6, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(29, 1, '760695229888', 'SOUR CREAM', 0, 5, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 4, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(30, 1, '400168', 'MOZZARELLA CHEESE 3%', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 4, 0, '0', '0', '', 15.86, NULL, NULL, NULL, NULL, '', '', '0'),
(31, 1, '780995', 'MOZZARELLA CHEESE 3%', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 6, 0, '0', '0', '', 13.07, NULL, NULL, NULL, NULL, '', '', '0'),
(32, 1, '208300235331', 'PROVOLONE CHEESE', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 3.08, NULL, NULL, NULL, NULL, '', '', '0'),
(33, 1, '206389105309', 'MUENSTER CHEESE', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 1, 0, '0', '0', '', 3.30, NULL, NULL, NULL, NULL, '', '', '0'),
(34, 1, '207132707061', 'SWIS CHEESE', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 1, 0, '0', '0', '', 2.53, NULL, NULL, NULL, NULL, '', '', '0'),
(35, 1, '760695031054', 'AMERICAN CHEESE', 0, 5, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '1'),
(36, 1, '206547', 'EGG SHL MED', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 3.81, NULL, NULL, NULL, NULL, '', '', '0'),
(37, 1, '209003', 'EGG SHL MED', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 2.96, NULL, NULL, NULL, NULL, '', '', '0'),
(38, 1, '434281', 'EGG SHL LRG', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 1.72, NULL, NULL, NULL, NULL, '', '', '0'),
(39, 1, '760695010783', 'EGG MED LOOSE', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.53, NULL, NULL, NULL, NULL, '', '', '0'),
(40, 1, '119474', 'SPINACH CHOPPED', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 4.08, NULL, NULL, NULL, NULL, '', '', '0'),
(41, 1, '', 'BASIL', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(42, 1, '', 'LETTUCE', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(43, 1, '', 'GARLIC PEELED', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(44, 1, '', 'TOMATOES 5X6', 0, 9, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 20, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(45, 1, '267929', 'ONIONS YELLOW MED-LRG', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 10, 0, '0', '0', '', 2.20, NULL, NULL, NULL, NULL, '', '', '0'),
(46, 1, '', 'ONIONS YELLOW MED-LRG', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(47, 1, '', 'PEPPER RED', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(48, 1, '', 'PEPPER GREEN', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(49, 1, '', 'ORANGES', 0, 9, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(50, 1, '630480', 'STROWBERRY FROZEN', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 2, 0, '0', '0', '', 12.24, NULL, NULL, NULL, NULL, '', '', '0'),
(51, 1, '227936', 'PULP MANGO GHUNKS', 0, 1, 0, 0, 0, '', 1, '0.00', 6, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 1.50, NULL, NULL, NULL, NULL, '', '', '0'),
(52, 1, '166720', 'CHOP BLUE BERRIES', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 13.01, NULL, NULL, NULL, NULL, '', '', '0'),
(53, 1, '459243', 'BEEF GROUND', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 4.07, NULL, NULL, NULL, NULL, '', '', '0'),
(54, 1, '602299', 'BEEF OUTSIDE P/L', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 5.07, NULL, NULL, NULL, NULL, '', '', '0'),
(55, 1, '604993', 'BEEF TNDRLN BNLS ', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 2.29, NULL, NULL, NULL, NULL, '', '', '0'),
(56, 1, '804309', 'BEEF SKIRT OUTSIDE', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 4.99, NULL, NULL, NULL, NULL, '', '', '0'),
(57, 1, '759820', 'BEEF SKIRT OUTSIDE', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 4.99, NULL, NULL, NULL, NULL, '', '', '0'),
(58, 1, '752131', 'BEEF SRLN COUL', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 4.30, NULL, NULL, NULL, NULL, '', '', '0'),
(59, 1, '284870', 'BEEF SIRLON FLAP', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 5.33, NULL, NULL, NULL, NULL, '', '', '0'),
(60, 1, '207756122073', 'BEEF INNER SKIRT', 0, 5, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 4.92, NULL, NULL, NULL, NULL, '', '', '0'),
(61, 1, '16952130047', 'PHILLY STEAK 4Z', 0, 5, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.00, NULL, NULL, NULL, NULL, '', '', '0'),
(62, 1, '710377', 'CHICKEN BREAST', 0, 1, 0, 0, 0, '', 1, '0.00', 0, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 10.64, NULL, NULL, NULL, NULL, '', '', '0'),
(63, 3, '607232', 'PORK BELLY', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 2.15, NULL, NULL, NULL, NULL, '', '', '0'),
(64, 3, '111250', 'PORK SPRRIB', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 2.81, NULL, NULL, NULL, NULL, '', '', '0'),
(65, 3, '267741', 'PORK RIB ST LOU', 0, 1, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 5.05, NULL, NULL, NULL, NULL, '', '', '0'),
(66, 3, '201053404566', 'PORK ROAST COOKED', 0, 5, 0, 0, 0, '', 1, '0.00', 2, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 3.80, NULL, NULL, NULL, NULL, '', '', '0'),
(67, 3, '7 02K', 'YERBA CRUZ MALTA ', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 6, 0, '0', '0', '', 7.33, NULL, NULL, NULL, NULL, '', '', '0'),
(68, 3, '07 05', 'YERBA ROSAMONTE', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 10, 0, '0', '0', '', 8.20, NULL, NULL, NULL, NULL, '', '', '0'),
(69, 3, '', 'YERBA CBSE HIERBAS SERRANAS', 0, 11, 0, 0, 0, '', 1, '0.00', 1, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 3.75, NULL, NULL, NULL, NULL, '', '', '0'),
(70, 3, '1 05C', 'ALFAJOR BON O BON PAQUETE ', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '2.00', 3, '0', '', '2020-11-22', 0, 16, 3, '0', '0', '', 3.44, 4.85, 4.85, NULL, 5.19, '', '', '0'),
(71, 3, 'GO-207-GA051', 'ALFAJOR MINI JORJITO CHOCOLATE', 0, 11, 0, 0, 0, '', 1, '10.00', 3, '4.00', 3, '0', '', '2020-11-22', 0, 18, 3, '0', '0', '', 2.98, 4.50, 4.50, NULL, 4.82, '', '', '0'),
(72, 3, 'GO-207-GA051', 'ALFAJOR JORJITO CHOCOLATE', 0, 11, 0, 0, 0, '', 1, '0.00', 3, '2.00', 3, '0', '', '2020-11-22', 0, 24, 3, '0', '0', '', 5.90, 8.99, 8.99, NULL, 9.62, '', '', '0'),
(73, 3, '10 00CP', 'CELUSAL PARRILLERA', 0, 10, 0, 0, 0, '', 1, '12.00', 3, '2.00', 3, '0', '', '2020-11-22', 0, 12, 3, '0', '0', '', 33.20, 3.99, 3.99, NULL, 4.27, '', '', '0'),
(74, 3, '14 09R', 'RUMBA X 3', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 2.07, NULL, NULL, NULL, NULL, '', '', '0'),
(75, 3, '14 03', 'CHOCOLINAS 170GR', 0, 10, 0, 0, 0, '', 1, '32.00', 3, '10.00', 3, '1', '', '2020-11-22', 0, 40, 3, '0', '0', '', 60.00, 1.99, 1.99, NULL, 2.14, '', '', '0'),
(76, 3, '14 03CG', 'CHOCOLINAS 250GR', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '10.00', 3, '0', '', '2020-11-22', 0, 25, 3, '0', '0', '', 2.20, 3.20, 3.20, NULL, 3.42, '', '', '0'),
(77, 3, '', 'VARIEDAD TERRABUSSI', 0, 11, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 20, 0, '0', '0', '', 3.61, NULL, NULL, NULL, NULL, '', '', '0'),
(78, 3, '14 09SB', 'SURTIDAS BAGLEY 400GR', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 21, 0, '0', '0', '', 2.10, NULL, NULL, NULL, NULL, '', '', '0'),
(79, 3, '', 'MELBA', 0, 11, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 21, 0, '0', '0', '', 2.55, NULL, NULL, NULL, NULL, '', '', '0'),
(80, 3, '14 09ML', 'MELLIZAS X 3', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 2.50, NULL, NULL, NULL, NULL, '', '', '0'),
(81, 3, '14 09S', 'SONRISAS X 3', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 2.50, NULL, NULL, NULL, NULL, '', '', '0'),
(82, 3, '14 090', 'OPERAS X 4', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 2.50, NULL, NULL, NULL, NULL, '', '', '0'),
(83, 3, 'GA-208-DS001', 'BIZCOCHOS DON SATUR SALADOS', 0, 11, 0, 0, 0, '', 1, '25.00', 3, '6.00', 3, '1', '', '2020-11-22', 0, 30, 3, '0', '0', '', 1.04, 1.90, 1.90, NULL, 2.03, '', '', '0'),
(84, 3, '14 31HST', 'HOGARENAS SALVADO ARCOR', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 25, 0, '0', '0', '', 2.20, NULL, NULL, NULL, NULL, '', '', '0'),
(85, 3, 'GA-209-GA016', 'CEREALITAS', 0, 11, 0, 0, 0, '', 1, '44.00', 3, '5.00', 3, '0', '', '2020-11-22', 0, 48, 3, '0', '0', '', 82.95, 2.49, 2.49, NULL, 2.66, '', '', '0'),
(86, 3, '15 31HST', 'DULCE DE LECHE SAN IGNACIO plastico', 0, 11, 0, 0, 0, '', 1, '0.00', 3, '2.00', 3, '0', '', '2020-11-22', 0, 12, 0, '0', '0', '', 3.85, 5.20, 5.20, NULL, 5.56, '', '', '0'),
(87, 3, '6 01S', 'DULCE DE LECHE LA SERENISIMA', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 3, '0', '', '2020-11-22', 0, 24, 3, '0', '0', '', 3.94, 5.89, 5.89, NULL, 6.30, '', '', '0'),
(88, 3, '8 02C', 'POLENTA ARCOR', 0, 10, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 30, 0, '0', '0', '', 1.70, NULL, NULL, NULL, NULL, '', '', '0'),
(89, 3, '780000002744', 'SUNKIST', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 0.32, NULL, NULL, NULL, NULL, '', '', '0'),
(90, 3, '77186330054', 'JUPIÑA', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 0.36, NULL, NULL, NULL, NULL, '', '', '0'),
(91, 3, '49000058482', 'SPRITE', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 35, 0, '0', '0', '', 0.36, NULL, NULL, NULL, NULL, '', '', '0'),
(92, 3, '611269917475', 'RED BULL', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 2.07, NULL, NULL, NULL, NULL, '', '', '0'),
(93, 3, '49000058468', 'COKE', 0, 5, 0, 0, 0, '', 1, '24.00', 0, '12.00', 0, '0', '', '2020-11-22', 0, 35, 3, '0', '0', '', 11.95, 1.00, 1.10, NULL, 1.07, '', '', '0'),
(94, 3, '77186306530', 'CAWY MALTA', 0, 5, 0, 0, 0, '', 1, '12.00', 3, '4.00', 3, '1', '', '2020-11-22', 0, 24, 3, '0', '0', '', 0.57, 1.99, 1.99, NULL, 2.13, '', '', '0'),
(95, 3, '613008715267', 'ARIZONA GREEN TEA', 0, 5, 0, 0, 0, '', 1, '10.00', 3, '5.00', 3, '1', '', '2020-11-22', 0, 24, 3, '0', '0', '', 0.66, 1.00, 1.10, NULL, 1.07, '', '', '0'),
(96, 3, '52000207842', 'GATORADE ', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 0.67, NULL, NULL, NULL, NULL, '', '', '0'),
(97, 3, '25000061530', 'ORANGE JUICE', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 1.19, NULL, NULL, NULL, NULL, '', '', '0'),
(98, 3, '25000061516', 'APPLE JUICE', 0, 5, 0, 0, 0, '', 1, '12.00', 3, '4.00', 3, '1', '', '2020-11-22', 0, 24, 3, '0', '0', '', 1.19, 1.99, 0.00, NULL, 0.00, '', '', '0'),
(99, 3, '75914460067852', 'MALTIN POLAR', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 0.57, NULL, NULL, NULL, NULL, '', '', '0'),
(100, 3, '51202008752', 'COLOMBIANA', 0, 5, 0, 0, 0, '', 1, '24.00', 3, '6.00', 3, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 0.42, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(101, 3, '80480595906', 'MALTA HATUEY', 0, 5, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 24, 0, '0', '0', '', 0.63, NULL, NULL, NULL, NULL, '', '', '0'),
(102, 4, 'CLOR222110', 'CLOROX LIQ', 0, 20, 0, 0, 0, '', 1, '1.00', 3, '1.00', 3, '0', '', '2020-11-22', 0, 3, 3, '0', '0', '', 6.08, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(103, 4, 'DART094143', 'CH64DEF SAFESEAL', 0, 20, 0, 0, 0, '', 1, '180.00', 3, '50.00', 3, '0', '', '2020-11-22', 0, 200, 3, '0', '0', '', 59.63, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(104, 4, '212094', 'CH48DEF CONT.PLASTIC', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 100, 0, '0', '0', '', 0.28, NULL, NULL, NULL, NULL, '', '', '0'),
(105, 4, '498297', 'LINER PAN 16.5X2', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 0, 0, '0', '0', '', 0.04, NULL, NULL, NULL, NULL, '', '', '0'),
(106, 4, 'BAGC092260', 'SANDW WRAP 15X15', 0, 20, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 3000, 0, '0', '0', '', 0.02, NULL, NULL, NULL, NULL, '', '', '0'),
(107, 4, '206342', '4JL VENT LID ', 0, 20, 1, 0, 0, '', 1, '1000.00', 0, '100.00', 0, '0', 'TAPA COLADA / CORTADITO', '2020-11-22', 0, 1000, 0, '0', '0', '', 0.02, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(108, 4, '113727', '4J4 CUP DART 4Z', 0, 20, 1, 0, 0, '', 1, '1000.00', 0, '100.00', 0, '0', 'COLADA / CORTADITO CUP', '2020-11-22', 0, 1000, 0, '0', '0', '', 0.02, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(109, 4, '504831', '12J16 CUP DART 12 OZ', 0, 20, 1, 0, 0, '', 1, '1000.00', 0, '100.00', 0, '1', 'COFFEE CUP SMALL', '2020-11-22', 0, 1000, 0, '0', '0', '', 0.04, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(110, 4, '556025', 'LID 16FTLS', 0, 1, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 1000, 0, '0', '0', '', 0.03, NULL, NULL, NULL, NULL, '', '', '0'),
(111, 4, 'DURO071570', 'BAG #6', 0, 20, 0, 0, 0, '', 1, '1000.00', 3, '500.00', 3, '1', '', '2020-11-22', 0, 500, 3, '0', '0', '', 0.03, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(112, 4, 'DURO071691', 'BAG #3', 0, 20, 0, 0, 0, '', 1, '3000.00', 3, '1000.00', 3, '1', '', '2020-11-22', 0, 500, 3, '0', '0', '', 0.02, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(113, 4, 'BAYW196107', 'C FOLD TOWEL', 0, 20, 0, 0, 0, '', 1, '800.00', 3, '200.00', 3, '0', '', '2020-11-22', 0, 2400, 3, '0', '0', '', 0.01, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(114, 4, 'PACT454015', 'FILM PVC CUTTERBOX', 0, 20, 0, 0, 0, '', 1, '1.00', 3, '1.00', 3, '1', '', '2020-11-22', 0, 1, 0, '0', '0', '', 18.84, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(115, 4, 'PLAS171782', 'CUBAN COFFE CUP', 0, 20, 0, 0, 0, '', 1, '3000.00', 0, '1000.00', 0, '0', '', '2020-11-22', 0, 5000, 0, '0', '0', '', 0.00, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(116, 4, 'SFLA300030', 'BATH TISS ', 0, 20, 0, 0, 0, '', 1, '135.00', 3, '96.00', 3, '1', '', '2020-11-22', 0, 96, 3, '0', '0', '', 0.35, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(117, 4, 'ICIN070660', 'BOXES #10', 0, 20, 0, 0, 0, '', 1, '100.00', 3, '50.00', 3, '0', '', '2020-11-22', 0, 50, 3, '0', '0', '', 0.75, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(118, 4, 'ICIN070650', 'BOXES #5', 0, 20, 0, 0, 0, '', 1, '75.00', 3, '50.00', 3, '0', '', '2020-11-22', 0, 50, 3, '0', '0', '', 0.67, 0.00, 0.00, NULL, 0.00, '', '', '0'),
(119, 4, 'UNIS242305', 'THNAK YOU BAG', 0, 20, 0, 0, 0, '', 1, '0.00', 3, '0.00', 0, '0', '', '2020-11-22', 0, 700, 0, '0', '0', '', 0.01, NULL, NULL, NULL, NULL, '', '', '0'),
(120, 3, 'GA-208-DS002', 'BIZCOCHOS DON SATUR DULCES', 0, 0, 0, 0, 0, '', 1, '25.00', 3, '5.00', 3, '1', '', '2020-11-27', 0, 30, 3, '0', '0', '', 1.04, 1.90, 1.90, NULL, 2.03, '8400000001205', 'foto120.jpg', '0'),
(121, 3, 'du-209-si0003', 'Dulce de leche San Ignacio - vidrio', 7, 11, 0, 0, 0, 'DULCE DE LECHE S.I. VIDRIO', 1, '12.00', 3, '0.00', 3, '0', '', '0000-00-00', 16, 0, 0, '0', '', '', 4.09, 5.89, 5.89, NULL, 6.30, '8400000001212', 'foto121.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `artpro`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `artpro` (
  `codarticulo` varchar(15) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `batch` (
  `codbatch` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` int(8) NOT NULL,
  `fechai` date NOT NULL,
  `horai` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `fechaf` date NOT NULL,
  `horaf` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`codbatch`, `codarticulo`, `cantidad`, `fechai`, `horai`, `fechaf`, `horaf`, `codstatus`, `borrado`) VALUES
(1, 9, 40, '2019-12-01', '21:02', '0000-00-00', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `clientes` (
  `codcliente` int(5) NOT NULL,
  `Pais` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nif` varchar(12) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL DEFAULT 0,
  `localidad` varchar(35) NOT NULL,
  `codformapago` int(2) NOT NULL DEFAULT 0,
  `codentidad` int(2) NOT NULL DEFAULT 0,
  `cuentabancaria` varchar(20) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `web` varchar(45) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Clientes';

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`codcliente`, `Pais`, `nombre`, `nif`, `direccion`, `codprovincia`, `localidad`, `codformapago`, `codentidad`, `cuentabancaria`, `codpostal`, `telefono`, `movil`, `email`, `web`, `borrado`) VALUES
(1, '', 'Consumidor Final', '', '', 0, '', 1, 0, '', '', '', '', '', '', '0'),
(2, '', 'empanandas pampa', '444444444', 'sunny beach 54', 61, 'miami', 1, 0, '', '', '', '', '', '', '0'),
(3, '', 'Giuseppe Piazza', '555555555', 'Green Palm Driv. 54', 61, 'Miami Vice', 1, 0, '', '54/13', '80046804', '', 'giuseppepizza@pizzaline.com', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cobros`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `cobros` (
  `id` int(11) NOT NULL,
  `codfactura` int(11) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `importe` float NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechacobro` date NOT NULL DEFAULT '0000-00-00',
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cobros de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `company_data`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `company_data` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(60) NOT NULL,
  `contact_telephone` varchar(20) NOT NULL,
  `main_email` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `language` varchar(40) NOT NULL,
  `address` varchar(80) NOT NULL,
  `zip_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `embalajes`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `embalajes` (
  `codembalaje` int(3) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Embalajes';

--
-- Dumping data for table `embalajes`
--

INSERT INTO `embalajes` (`codembalaje`, `nombre`, `borrado`) VALUES
(1, '50lbs bag', '0'),
(2, '25 lbs. box', '0'),
(3, '20 lbs. box', '0'),
(4, '15 lbs. box', '0'),
(5, '30 dozens box', '0'),
(6, '75 lbs. bag', '0'),
(7, '40 lbs box', '0'),
(8, '60 lbs box', '0'),
(9, '80 lbs box', '0'),
(10, '10lbs. BAG', '0'),
(11, '12 units CASE', '0'),
(12, '20 units case', '0'),
(13, '6 units case', '0'),
(14, '10 units case', '0'),
(15, '16 units case', '0'),
(16, 'Box', '0'),
(17, 'CASE', '0');

-- --------------------------------------------------------

--
-- Table structure for table `entidades`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `entidades` (
  `codentidad` int(2) NOT NULL,
  `nombreentidad` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidades Bancarias';

-- --------------------------------------------------------

--
-- Table structure for table `estaciones`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `estaciones` (
  `codestacion` int(5) NOT NULL,
  `nombre` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `estaciones`
--

INSERT INTO `estaciones` (`codestacion`, `nombre`, `borrado`) VALUES
(1, 'Estacion no Asignada', '0'),
(2, 'cortadora de discos', '0'),
(3, 'Mezcladora', '0'),
(4, 'conformadora', '0'),
(5, 'Zobadora', '0'),
(6, 'zona de empaque', '0'),
(7, 'cierre al vacio ', '0'),
(8, 'Cortado', '0'),
(9, 'Cocina', '0'),
(10, 'Horno', '0'),
(11, 'laboratorio gourmet', '0'),
(12, 'mount engine desk', '0'),
(13, 'Laminadora', '0');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `estado` (
  `codestado` int(1) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`codestado`, `estado`) VALUES
(1, 'initializated'),
(2, 'ended'),
(3, 'dischard'),
(4, 'activated'),
(5, 'deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `factulinea`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `factulinea` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `factulineap`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `factulineap` (
  `codfactura` varchar(20) NOT NULL DEFAULT '',
  `codproveedor` int(5) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `factulineaptmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `factulineaptmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores temporal';

-- --------------------------------------------------------

--
-- Table structure for table `factulineatmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `factulineatmp` (
  `codfactura` int(11) NOT NULL,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `importe` float NOT NULL,
  `dcto` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Temporal de linea de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `facturas` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `codcliente` int(5) NOT NULL,
  `estado` varchar(1) NOT NULL DEFAULT '0',
  `totalfactura` float NOT NULL,
  `fechavencimiento` date NOT NULL DEFAULT '0000-00-00',
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='facturas de ventas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `facturasp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `facturasp` (
  `codfactura` varchar(20) NOT NULL DEFAULT '',
  `codproveedor` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `iva` tinyint(4) NOT NULL,
  `estado` varchar(1) NOT NULL DEFAULT '0',
  `totalfactura` float NOT NULL,
  `fechapago` date NOT NULL DEFAULT '0000-00-00',
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='facturas de compras a proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `facturasptmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `facturasptmp` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas de proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `facturastmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `facturastmp` (
  `codfactura` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas a clientes';

--
-- Dumping data for table `facturastmp`
--

INSERT INTO `facturastmp` (`codfactura`, `fecha`) VALUES
(10, '2020-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `familias`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `familias` (
  `codfamilia` int(5) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='familia de articulos';

--
-- Dumping data for table `familias`
--

INSERT INTO `familias` (`codfamilia`, `nombre`, `borrado`) VALUES
(1, 'Raw material', '0'),
(2, 'Intermediate product', '0'),
(3, 'Final product', '0'),
(4, 'internal supplies', '0');

-- --------------------------------------------------------

--
-- Table structure for table `formapago`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `formapago` (
  `codformapago` int(2) NOT NULL,
  `nombrefp` varchar(40) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Forma de pago';

--
-- Dumping data for table `formapago`
--

INSERT INTO `formapago` (`codformapago`, `nombrefp`, `borrado`) VALUES
(1, 'Cash', '0'),
(2, 'Credit Card', '0'),
(3, 'Bank transaction', '0'),
(4, 'Cheques', '0'),
(5, 'Bitcoins', '1');

-- --------------------------------------------------------

--
-- Table structure for table `impuestos`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `impuestos` (
  `codimpuesto` int(3) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `valor` float NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tipos de impuestos';

--
-- Dumping data for table `impuestos`
--

INSERT INTO `impuestos` (`codimpuesto`, `nombre`, `valor`, `borrado`) VALUES
(1, 'tax', 7, '0'),
(2, 'Tax Free', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `intUsersTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `intUsersTable` (
  `id_intUser` int(5) NOT NULL,
  `intUser_name` varchar(60) NOT NULL,
  `user_name` varchar(140) NOT NULL,
  `password` varchar(160) NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

--



-- --------------------------------------------------------

--
-- Table structure for table `librodiario`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `librodiario` (
  `id` int(8) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `tipodocumento` varchar(1) NOT NULL,
  `coddocumento` varchar(20) NOT NULL,
  `codcomercial` int(5) NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numpago` varchar(30) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Movimientos diarios';

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `lote` (
  `codlote` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` int(8) DEFAULT NULL,
  `fechai` date NOT NULL,
  `horai` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `fechaf` date DEFAULT NULL,
  `horaf` varchar(8) COLLATE latin1_spanish_ci DEFAULT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metaprocesos`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `metaprocesos` (
  `codproceso` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `esbatch` int(1) NOT NULL,
  `cantidad` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL,
  `codstatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `metaprocesos`
--

INSERT INTO `metaprocesos` (`codproceso`, `codarticulo`, `nombre`, `esbatch`, `cantidad`, `codunidadmedida`, `codstatus`) VALUES
(1, 3, 'Beef filling - onios', 1, '0.00', 3, 4),
(2, 5, 'beef filling - red pepper', 1, '0.00', 3, 4),
(3, 1, 'beef filling - eggs', 1, '0.00', 3, 4),
(4, 4, 'beef filling - beef', 1, '0.00', 3, 4),
(5, 6, 'beef filling - salt', 1, '0.10', 3, 4),
(6, 6, 'prueba12', 0, '3.00', 4, 4),
(7, 9, 'prueba12', 0, '50.00', 3, 4),
(8, 2, 'prueba12', 1, '2.00', 3, 4),
(9, 5, 'prueba 13', 0, '4.00', 3, 4),
(10, 0, 'prueba14', 1, '50.00', 3, 4),
(11, 0, 'prueba15', 0, '50.00', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `metaprocesoslinea`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `metaprocesoslinea` (
  `codrecord` int(11) NOT NULL,
  `codproceso` int(5) NOT NULL,
  `codlinea` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `metaprocesoslinea`
--

INSERT INTO `metaprocesoslinea` (`codrecord`, `codproceso`, `codlinea`, `codarticulo`, `cantidad`, `codunidadmedida`) VALUES
(1, 4, 1, 8, '40.00', 2),
(2, 4, 2, 6, '0.15', 2),
(4, 2, 1, 5, '3.00', 0),
(5, 4, 3, 4, '1.00', 2),
(6, 1, 1, 3, '52.00', 0),
(7, 3, 1, 1, '36.00', 3),
(8, 5, 1, 6, '0.21', 2),
(9, 6, 1, 8, '5.00', 0),
(10, 6, 2, 9, '3.00', 0),
(11, 7, 1, 3, '25.00', 0),
(12, 7, 2, 8, '25.00', 0),
(13, 0, 1, 8, '25.00', 0),
(14, 10, 1, 8, '25.00', 0),
(15, 10, 2, 3, '25.00', 0),
(17, 11, 1, 8, '35.00', 2),
(18, 11, 2, 3, '25.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `codfactura` varchar(20) NOT NULL,
  `codproveedor` int(5) NOT NULL,
  `importe` float NOT NULL,
  `codformapago` int(2) NOT NULL,
  `numdocumento` varchar(30) NOT NULL,
  `fechapago` date DEFAULT '0000-00-00',
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pagos de facturas a proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `pais` (
  `codPais` int(5) NOT NULL,
  `lengua` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `nombrePais` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`codPais`, `lengua`, `nombrePais`, `borrado`) VALUES
(1, 'Spanish', 'Argentina', '0'),
(2, 'Spanish', 'Spain', '0'),
(3, 'English', 'United States of America', '0');

-- --------------------------------------------------------

--
-- Table structure for table `presulinea`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `presulinea` (
  `codpresupuesto` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presulineatmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `presulineatmp` (
  `codpresupuesto` int(11) NOT NULL DEFAULT 0,
  `numlinea` int(4) NOT NULL,
  `codfamilia` int(3) DEFAULT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` float NOT NULL DEFAULT 0,
  `precio` float NOT NULL DEFAULT 0,
  `importe` float NOT NULL DEFAULT 0,
  `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presupuestos`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `presupuestos` (
  `codpresupuesto` int(11) NOT NULL,
  `codfactura` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT '0000-00-00',
  `iva` tinyint(4) NOT NULL DEFAULT 0,
  `codcliente` int(5) DEFAULT 0,
  `estado` varchar(1) CHARACTER SET utf8 DEFAULT '1',
  `totalpresupuesto` float NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `presupuestostmp`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `presupuestostmp` (
  `codpresupuesto` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';

-- --------------------------------------------------------

--
-- Table structure for table `procesos`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `procesos` (
  `codproceso` int(5) NOT NULL,
  `codmproceso` int(35) NOT NULL,
  `bolasoc` int(5) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `codunidadmedida` int(2) NOT NULL,
  `fechai` date NOT NULL,
  `horai` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `horaf` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `fechaf` date NOT NULL,
  `codestacion` int(5) NOT NULL,
  `codtrabajador` int(5) NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `procesos`
--

INSERT INTO `procesos` (`codproceso`, `codmproceso`, `bolasoc`, `cantidad`, `codunidadmedida`, `fechai`, `horai`, `horaf`, `fechaf`, `codestacion`, `codtrabajador`, `codstatus`, `borrado`) VALUES
(1, 4, 1, 40, 1, '2019-12-07', '19:28', '19:39', '2019-12-07', 1, 1, 2, 0),
(2, 0, 0, 0, 1, '0000-00-00', '', '', '0000-00-00', 1, 1, 3, 0),
(3, 4, 1, 50, 1, '2019-12-29', '17:59', '18:05', '2019-12-29', 1, 1, 2, 0),
(4, 4, 1, 0, 1, '2019-12-30', '11:47', '', '0000-00-00', 1, 1, 1, 0),
(5, 4, 1, 0, 1, '2019-12-30', '13:23', '', '0000-00-00', 1, 1, 1, 0),
(6, 4, 1, 0, 1, '2019-12-30', '13:33', '', '0000-00-00', 1, 1, 1, 0),
(7, 4, 0, 0, 1, '2019-12-30', '13:34', '16:54', '2020-01-03', 1, 1, 2, 0),
(8, 11, 1, 0, 1, '2019-12-30', '13:34', '', '0000-00-00', 1, 1, 1, 0),
(9, 11, 0, 0, 0, '2020-01-01', '11:10', '', '0000-00-00', 1, 1, 1, 0),
(10, 4, 1, 0, 0, '2020-01-01', '11:52', '', '0000-00-00', 1, 1, 1, 0),
(11, 4, 1, 0, 0, '2020-01-01', '12:23', '', '0000-00-00', 1, 1, 1, 0),
(12, 4, 1, 2, 0, '2020-01-01', '15:43', '17:23', '2020-01-01', 1, 1, 2, 0),
(13, 4, 1, 1, 0, '2020-01-02', '10:37', '10:44', '2020-01-02', 1, 1, 2, 0),
(14, 4, 1, 1, 0, '2020-01-02', '10:45', '10:45', '2020-01-02', 1, 1, 2, 0),
(15, 4, 1, 1, 0, '2020-01-02', '11:22', '11:23', '2020-01-02', 1, 1, 2, 0),
(16, 4, 1, 1, 0, '2020-01-02', '11:36', '11:36', '2020-01-02', 1, 1, 2, 0),
(17, 4, 1, 0, 0, '2020-01-02', '12:28', '', '0000-00-00', 1, 1, 1, 0),
(18, 4, 1, 0, 0, '2020-01-02', '12:30', '', '0000-00-00', 1, 1, 1, 0),
(19, 4, 1, 0, 0, '2020-01-02', '12:32', '', '0000-00-00', 1, 1, 1, 0),
(20, 4, 1, 0, 0, '2020-01-02', '12:39', '', '0000-00-00', 1, 1, 1, 0),
(21, 4, 1, 0, 0, '2020-01-02', '12:43', '', '0000-00-00', 1, 1, 1, 0),
(22, 4, 1, 1, 0, '2020-01-02', '12:49', '12:51', '2020-01-02', 1, 1, 2, 0),
(23, 4, 1, 1, 0, '2020-01-02', '12:52', '13:02', '2020-01-02', 1, 1, 2, 0),
(24, 0, 0, 0, 0, '0000-00-00', '', '', '0000-00-00', 1, 1, 5, 0),
(25, 4, 1, 1, 0, '2020-01-02', '13:02', '13:03', '2020-01-02', 1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proclinea`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `proclinea` (
  `codproclinea` int(5) NOT NULL,
  `codproceso` int(5) NOT NULL,
  `codlinea` int(5) NOT NULL,
  `codarticulo` int(5) NOT NULL,
  `cantidad` decimal(6,2) NOT NULL,
  `codunidadmedida` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proclinea`
--

INSERT INTO `proclinea` (`codproclinea`, `codproceso`, `codlinea`, `codarticulo`, `cantidad`, `codunidadmedida`) VALUES
(5, 1, 1, 8, '40.00', 0),
(6, 1, 2, 6, '0.10', 0),
(7, 1, 3, 4, '1.00', 0),
(8, 3, 1, 8, '40.00', 0),
(9, 3, 2, 6, '0.15', 0),
(10, 3, 3, 4, '1.00', 0),
(11, 12, 1, 8, '40.00', 0),
(12, 12, 2, 6, '0.15', 0),
(13, 12, 3, 4, '1.00', 0),
(14, 13, 1, 8, '40.00', 0),
(15, 13, 2, 6, '0.15', 0),
(16, 13, 3, 4, '1.00', 0),
(17, 14, 1, 8, '40.00', 0),
(18, 14, 2, 6, '0.15', 0),
(19, 14, 3, 4, '1.00', 0),
(20, 15, 1, 8, '40.00', 0),
(21, 15, 2, 6, '0.15', 0),
(22, 15, 3, 4, '1.00', 0),
(23, 16, 1, 8, '40.00', 0),
(24, 16, 2, 6, '0.15', 0),
(25, 16, 3, 4, '1.00', 0),
(26, 17, 1, 8, '40.00', 0),
(27, 17, 2, 6, '0.15', 0),
(28, 17, 3, 4, '1.00', 0),
(29, 18, 1, 8, '40.00', 0),
(30, 18, 2, 6, '0.15', 0),
(31, 18, 3, 4, '1.00', 0),
(32, 19, 1, 8, '40.00', 0),
(33, 19, 2, 6, '0.15', 0),
(34, 19, 3, 4, '1.00', 0),
(35, 20, 1, 8, '40.00', 0),
(36, 20, 2, 6, '0.15', 0),
(37, 20, 3, 4, '1.00', 0),
(38, 21, 1, 8, '40.00', 0),
(39, 21, 2, 6, '0.15', 0),
(40, 21, 3, 4, '1.00', 0),
(41, 22, 1, 8, '40.00', 0),
(42, 22, 2, 6, '0.15', 0),
(43, 22, 3, 4, '1.00', 0),
(44, 23, 1, 8, '40.00', 0),
(45, 23, 2, 6, '0.15', 0),
(46, 23, 3, 4, '1.00', 0),
(47, 25, 1, 8, '40.00', 0),
(48, 25, 2, 6, '0.15', 0),
(49, 25, 3, 4, '1.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `proveedores` (
  `codproveedor` int(5) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nif` varchar(12) NOT NULL,
  `codpais` int(3) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `codprovincia` int(2) NOT NULL,
  `localidad` varchar(35) NOT NULL,
  `codentidad` int(2) NOT NULL,
  `cuentabancaria` varchar(20) NOT NULL,
  `codpostal` varchar(5) NOT NULL,
  `telefono` varchar(14) NOT NULL,
  `movil` varchar(14) NOT NULL,
  `email` varchar(35) NOT NULL,
  `web` varchar(45) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Proveedores';

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`codproveedor`, `nombre`, `nif`, `codpais`, `direccion`, `codprovincia`, `localidad`, `codentidad`, `cuentabancaria`, `codpostal`, `telefono`, `movil`, `email`, `web`, `borrado`) VALUES
(1, 'GORDON FOOD ', '', 0, 'Miami Distribution Ctr ', 0, 'Miami', 0, '', '33167', '800-830-9767', '954-895-4997', 'jarrett.sammel@gfs.com', '', '0'),
(2, 'Tapam llc', '', 0, '71st Street', 0, 'miami', 0, '', '33166', '', '', '', '', '0'),
(3, 'SOUTH FLORIDA TRAINING CORP.', '', 0, '13 street', 0, 'miami', 0, '', '33172', '3059947817', '', '', '', '0'),
(4, 'SYSCO', '', 0, '12500 sysco way', 0, 'medley', 0, '', '33178', '305-651-5421', '305-926-3189', 'dicembrino.alesandro@sfl.sysco.com', '', '0'),
(5, 'RESTAURANT DEPOT', '', 0, '3500 davie rd', 0, '', 0, '', '33314', '', '', '', 'www.restaurantdepot.com', '0'),
(6, 'tama corp.', '', 0, '7921 nw 21st st', 0, 'doral', 0, '', '33122', '305-592-1717', '', '', 'www.elpaisa.net', '0'),
(7, 'DEL ROSARIO DISTRIBUTION', '', 0, '7341 nw 79th terrace', 0, 'medley', 0, '', '33166', '305-592-0050', '', 'info@delrosariodistribution.com', '', '0'),
(8, 'BOLUFE SERVICES & SALES', '', 0, '', 0, '', 0, '', '', '954-513-8440', '305-746-7162', '', '', '0'),
(9, 'BEITAR FRESH PRODUCTS', '', 0, '', 0, '', 0, '', '', '7886-306-0048', '', '', '', '0'),
(10, 'PDP GROUP', '', 0, '8040NW 71ST', 0, 'MIAMI', 0, '', '33166', '786-357-8261', '786-331-7500', '', '', '0'),
(11, 'ALIMENTOS AUSTRALES', '', 0, '13049 SW 122ND AVE', 0, 'MIAMI', 0, '', '', '305-238-7755', '', '', '', '0'),
(12, 'INTERMARK FOODS, INC', '', 0, '1355 NW 97 AVE', 0, 'DORAL', 0, '', '33172', '305-718-8754', '', '', '', '0'),
(13, 'SIGNATURE SEASONING', '', 0, 'POBOX 56438', 0, 'VIRGINIA BEACH', 0, '', '23456', '757-572-8995', '', 'SUSAN@SIGNATURESEASONINGS.COM', '', '0'),
(14, 'ORSO', '', 0, '8420 NW 61ST STREET', 0, 'MIAMI', 0, '', '33166', '', '', '', '', '0'),
(15, 'CHEF MERITO, INC', '', 0, '7915 SEPULVEDA BLVD', 0, 'VAN NUYS', 0, '', '91405', '818-787-0100', '', '', 'WWW.CHEFMERITO.COM', '0'),
(16, 'MEDINA BAKING & POWDER PRODUCTS', '', 0, '1864 NW 22ND ST', 0, 'MIAMI', 0, '', '33142', '305-545-5436', '305-545-5437', 'SALES@MEDINABAKING.COM', 'WWW.MEDINABAKING.COM', '0'),
(17, 'ABC BAKERY SUPPLIES & EQUIP', '', 0, '7200 NW 1ST AVE', 0, 'MIAMI', 0, '', '33150', '305-757-3885', '', '', '', '0'),
(18, 'Produccion propia', '', 0, '', 0, '', 0, '', '', '', '', '', '', '0'),
(19, 'Martin', '23456789-23', 0, 'puerto palo 23', 0, 'Trenquelauquen', 0, '', '', '', '', '', '', '1'),
(20, 'All Florida Paper', '', 0, '', 0, '', 0, '', '', '', '', '', '', '0'),
(21, 'PDP GROUP', '', 0, '', 0, '', 0, '', '', '', '', '', '', '1'),
(22, 'TITOS COLOMBIAN FOOD', '', 0, '', 0, '', 0, '', '', '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `provincias` (
  `codprovincia` int(2) NOT NULL,
  `codpais` int(3) NOT NULL,
  `stateCode` varchar(4) NOT NULL,
  `nombreprovincia` varchar(40) NOT NULL,
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias';

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`codprovincia`, `codpais`, `stateCode`, `nombreprovincia`, `region`) VALUES
(1, 2, '', 'Alava', ''),
(2, 2, '', 'Albacete', ''),
(3, 2, '', 'Alicante', ''),
(4, 2, '', 'Almeria', ''),
(5, 2, '', 'Asturias', ''),
(6, 2, '', 'Avila', ''),
(7, 2, '', 'Badajoz', ''),
(8, 2, '', 'Baleares', ''),
(9, 2, '', 'Barcelona', ''),
(10, 2, '', 'Burgos', ''),
(11, 2, '', 'Caceres', ''),
(12, 2, '', 'Cadiz', ''),
(13, 2, '', 'Cantabria', ''),
(14, 2, '', 'Castellon', ''),
(15, 2, '', 'Ceuta', ''),
(16, 2, '', 'Ciudad Real', ''),
(17, 2, '', 'Cordoba', ''),
(18, 2, '', 'La Coru?a', ''),
(19, 2, '', 'Cuenca', ''),
(20, 2, '', 'Gerona', ''),
(21, 2, '', 'Granada', ''),
(22, 2, '', 'Guadalajara', ''),
(23, 2, '', 'Guipuzcoa', ''),
(24, 2, '', 'Huelva', ''),
(25, 2, '', 'Huesca', ''),
(26, 2, '', 'Jaen', ''),
(27, 2, '', 'Leon', ''),
(28, 2, '', 'Lerida', ''),
(29, 2, '', 'Lugo', ''),
(30, 2, '', 'Madrid', ''),
(31, 2, '', 'Malaga', ''),
(32, 2, '', 'Melilla', ''),
(33, 2, '', 'Murcia', ''),
(34, 2, '', 'Navarra', ''),
(35, 2, '', 'Orense', ''),
(36, 2, '', 'Palencia', ''),
(37, 2, '', 'Las Palmas', ''),
(38, 2, '', 'Pontevedra', ''),
(39, 2, '', 'La Rioja', ''),
(40, 2, '', 'Salamanca', ''),
(41, 2, '', 'Sta. Cruz de Tenerife', ''),
(42, 2, '', 'Segovia', ''),
(43, 2, '', 'Sevilla', ''),
(44, 2, '', 'Soria', ''),
(45, 2, '', 'Tarragona', ''),
(46, 2, '', 'Teruel', ''),
(47, 2, '', 'Toledo', ''),
(48, 2, '', 'Valencia', ''),
(49, 2, '', 'Valladolid', ''),
(50, 2, '', 'Vizcaya', ''),
(51, 2, '', 'Zamora', ''),
(52, 2, '', 'Zaragoza', ''),
(53, 3, 'AK', 'Alaska', ''),
(54, 3, 'AZ', 'Arizona', ''),
(55, 3, 'AR', 'Arkansas', ''),
(56, 3, 'CA', 'California', ''),
(57, 3, 'CO', 'Colorado', ''),
(58, 3, 'CT', 'Connecticut', ''),
(59, 3, 'DE', 'Delaware', ''),
(60, 3, 'DC', 'District of Columbia', ''),
(61, 3, 'FL', 'Florida', ''),
(62, 3, 'GA', 'Georgia', ''),
(63, 3, 'HI', 'Hawaii', ''),
(64, 3, 'ID', 'Idaho', ''),
(65, 3, 'IL', 'Illinois', ''),
(66, 3, 'IN', 'Indiana', ''),
(67, 3, 'IA', 'Iowa', ''),
(68, 3, 'KS', 'Kansas', ''),
(69, 3, 'KY', 'Kentucky', ''),
(70, 3, 'LA', 'Louisiana', ''),
(71, 3, 'ME', 'Maine', ''),
(72, 3, 'MD', 'Maryland', ''),
(73, 3, 'MA', 'Massachusetts', ''),
(74, 3, 'MI', 'Michigan', ''),
(75, 3, 'MN', 'Minnesota', ''),
(76, 3, 'MS', 'Mississippi', ''),
(77, 3, 'MO', 'Missouri', ''),
(78, 3, 'MT', 'Montana', ''),
(79, 3, 'NE', 'Nebraska', ''),
(80, 3, 'NV', 'Nevada', ''),
(81, 3, 'NH', 'New Hampshire', ''),
(82, 3, 'NJ', 'New Jersey', ''),
(83, 3, 'NM', 'New Mexico', ''),
(84, 3, 'NY', 'New York', ''),
(85, 3, 'NC', 'North Carolina', ''),
(86, 3, 'ND', 'North Dakota', ''),
(87, 3, 'OH', 'Ohio', ''),
(88, 3, 'OK', 'Oklahoma', ''),
(89, 3, 'OR', 'Oregon', ''),
(90, 3, 'PA', 'Pennsylvania', ''),
(91, 3, 'PR', 'Puerto Rico', ''),
(92, 3, 'RI', 'Rhode Island', ''),
(93, 3, 'SC', 'South Carolina', ''),
(94, 3, 'SD', 'South Dakota', ''),
(95, 3, 'TN', 'Tennessee', ''),
(96, 3, 'TX', 'Texas', ''),
(97, 3, 'UT', 'Utah', ''),
(98, 3, 'VT', 'Vermont', ''),
(99, 3, 'VA', 'Virginia', ''),
(100, 3, 'WA', 'Washington', ''),
(101, 3, 'WV', 'West Virginia', ''),
(102, 3, 'WI', 'Wisconsin', ''),
(103, 3, 'WY', 'Wyoming', ''),
(104, 3, 'AL', 'Alabama', ''),
(105, 1, 'BA', 'Buenos Aires', ''),
(106, 1, 'GBA', 'Buenos Aires-GBA', ''),
(107, 1, 'CABA', 'Capital Federal', ''),
(108, 1, 'CTMC', 'Catamarca', ''),
(109, 1, 'CHCO', 'Chaco', ''),
(110, 1, 'CHBT', 'Chubut', ''),
(111, 1, 'CDBA', 'Córdoba', ''),
(112, 1, 'CRT', 'Corrientes', ''),
(113, 1, 'ENR', 'Entre Ríos', ''),
(114, 1, 'FRZ', 'Formosa', ''),
(115, 1, 'JJY', 'Jujuy', ''),
(116, 1, 'LP', 'La Pampa', ''),
(117, 1, 'LRJ', 'La Rioja', ''),
(118, 1, 'MDZ', 'Mendoza', ''),
(119, 1, 'MSN', 'Misiones', ''),
(120, 1, 'NQN', 'Neuquén', ''),
(121, 1, 'RNGR', 'Río Negro', ''),
(122, 1, 'SAL', 'Salta', ''),
(123, 1, 'SNJN', 'San Juan', ''),
(124, 1, 'SNLS', 'San Luis', ''),
(125, 1, 'STCZ', 'Santa Cruz', ''),
(126, 1, 'STFE', 'Santa Fe', ''),
(127, 1, 'SDE', 'Santiago del Estero', ''),
(128, 1, 'TDF', 'Tierra del Fuego', ''),
(129, 1, 'TUCU', 'Tucumán', '');

-- --------------------------------------------------------

--
-- Table structure for table `resourcesTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `resourcesTable` (
  `id_resource` int(10) NOT NULL,
  `resourceName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resourcesTable`
--

INSERT INTO `resourcesTable` (`id_resource`, `resourceName`) VALUES
(1, 'interComerciales'),
(2, 'produccion'),
(3, 'ventas'),
(4, 'compras'),
(5, 'contabilidad'),
(6, 'recursosHumanos'),
(7, 'configuracion'),
(8, 'Settings'),
(9, 'Dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `resourcesToRolesTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `resourcesToRolesTable` (
  `id_srtr` int(10) NOT NULL,
  `id_resource` int(10) NOT NULL,
  `id_role` int(11) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resourcesToRolesTable`
--

INSERT INTO `resourcesToRolesTable` (`id_srtr`, `id_resource`, `id_role`, `borrado`) VALUES
(11, 1, 1, 0),
(12, 3, 1, 0),
(13, 2, 1, 0),
(14, 7, 1, 0),
(15, 6, 1, 0),
(16, 5, 1, 0),
(17, 4, 1, 0),
(18, 6, 2, 0),
(19, 4, 2, 1),
(20, 3, 2, 1),
(21, 2, 2, 1),
(22, 8, 1, 0),
(23, 9, 1, 0),
(24, 8, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rolesTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `rolesTable` (
  `id_role` int(5) NOT NULL,
  `roleName` varchar(40) NOT NULL,
  `codstatus` int(1) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolesTable`
--

INSERT INTO `rolesTable` (`id_role`, `roleName`, `codstatus`, `borrado`) VALUES
(1, 'admin', 4, 0),
(2, 'accountability', 4, 0),
(3, 'production', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rolesToUsersTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `rolesToUsersTable` (
  `id_rtu` int(10) NOT NULL,
  `id_role` int(10) NOT NULL,
  `id_intUser` int(11) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolesToUsersTable`
--

INSERT INTO `rolesToUsersTable` (`id_rtu`, `id_role`, `id_intUser`, `borrado`) VALUES
(1, 1, 2, 0),
(4, 3, 2, 1),
(5, 2, 2, 1),
(6, 1, 1, 0),
(7, 3, 1, 1),
(8, 1, 4, 1),
(9, 3, 4, 1),
(10, 2, 4, 0),
(11, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subresourcesToRolesTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `subresourcesToRolesTable` (
  `id_srtr` int(10) NOT NULL,
  `id_subresource` int(10) NOT NULL,
  `id_role` int(11) NOT NULL,
  `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subresourcesToRolesTable`
--

INSERT INTO `subresourcesToRolesTable` (`id_srtr`, `id_subresource`, `id_role`, `borrado`) VALUES
(1, 1, 1, 0),
(2, 4, 1, 0),
(3, 7, 1, 0),
(4, 12, 1, 0),
(5, 28, 1, 0),
(6, 2, 3, 0),
(7, 8, 3, 0),
(8, 12, 3, 0),
(9, 21, 3, 0),
(10, 27, 2, 0),
(11, 1, 2, 1),
(12, 18, 2, 0),
(13, 19, 2, 0),
(14, 20, 2, 0),
(15, 21, 2, 0),
(16, 2, 1, 0),
(17, 29, 1, 0),
(18, 27, 1, 0),
(19, 26, 1, 0),
(20, 25, 1, 0),
(21, 24, 1, 0),
(22, 23, 1, 0),
(23, 22, 1, 0),
(24, 21, 1, 0),
(25, 20, 1, 0),
(26, 19, 1, 0),
(27, 18, 1, 0),
(28, 17, 1, 0),
(29, 16, 1, 0),
(30, 15, 1, 0),
(31, 14, 1, 0),
(32, 13, 1, 0),
(33, 11, 1, 0),
(34, 10, 1, 0),
(35, 9, 1, 0),
(36, 8, 1, 0),
(37, 6, 1, 0),
(38, 5, 1, 0),
(39, 3, 1, 0),
(40, 3, 3, 1),
(41, 25, 3, 0),
(42, 30, 1, 0),
(43, 31, 1, 0),
(44, 32, 1, 0),
(45, 33, 1, 0),
(46, 32, 2, 0),
(47, 31, 2, 0),
(48, 30, 2, 0),
(49, 33, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subResourceTable`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `subResourceTable` (
  `id_sresource` int(5) NOT NULL,
  `id_resource` int(10) NOT NULL,
  `subResourceName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subResourceTable`
--

INSERT INTO `subResourceTable` (`id_sresource`, `id_resource`, `subResourceName`) VALUES
(1, 1, 'proveedores'),
(2, 1, 'clientes'),
(3, 2, 'tiposDeArticulos'),
(4, 2, 'articulos'),
(5, 2, 'metaProcesos'),
(6, 2, 'prcesosDeProduccion'),
(7, 2, 'batchDeProduccion'),
(8, 2, 'lotesDeProduccion'),
(9, 2, 'estacionesDeTrabajo'),
(10, 3, 'ventaMostrador'),
(11, 3, 'facturas'),
(12, 3, 'remitos'),
(13, 3, 'facturarRemitos'),
(14, 3, 'presupuestos'),
(15, 4, 'facturas'),
(16, 4, 'remitos'),
(17, 4, 'facturarRemitos'),
(18, 5, 'cobros'),
(19, 5, 'pagos'),
(20, 5, 'cajaDiaria'),
(21, 5, 'libroDiario'),
(22, 5, 'formasDePago'),
(23, 5, 'impuestos'),
(24, 5, 'entidadesBancarias'),
(25, 6, 'partesDeTrabajo'),
(26, 6, 'empleados'),
(27, 7, 'etiquetas'),
(28, 7, 'ubicaciones'),
(29, 7, 'embalajes'),
(30, 8, 'Copias de Seguridad'),
(31, 8, 'Roles'),
(32, 8, 'Usuarios'),
(33, 9, 'Dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `tabbackup`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `tabbackup` (
  `id` int(6) NOT NULL,
  `denominacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `archivo` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipoproceso`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `tipoproceso` (
  `codtipo` int(5) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipoproceso`
--

INSERT INTO `tipoproceso` (`codtipo`, `nombre`) VALUES
(0, 'lot'),
(1, 'batch');

-- --------------------------------------------------------

--
-- Table structure for table `trabajadores`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `trabajadores` (
  `codtrabajador` int(5) NOT NULL,
  `nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `nif` varchar(12) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(14) COLLATE latin1_spanish_ci NOT NULL,
  `movil` varchar(14) COLLATE latin1_spanish_ci NOT NULL,
  `movilavisos` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `emailavisos` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `borrado` varchar(1) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `trabajadores`
--

INSERT INTO `trabajadores` (`codtrabajador`, `nombre`, `nif`, `password`, `telefono`, `movil`, `movilavisos`, `email`, `emailavisos`, `borrado`) VALUES
(1, 'Not defined', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ubicaciones`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `ubicaciones` (
  `codubicacion` int(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ubicaciones';

--
-- Dumping data for table `ubicaciones`
--

INSERT INTO `ubicaciones` (`codubicacion`, `nombre`, `borrado`) VALUES
(1, 'SFF -Wiley St.', '0');

-- --------------------------------------------------------

--
-- Table structure for table `unidadesmedidas`
--
-- Creation: Dec 07, 2020 at 01:51 PM
--

CREATE TABLE `unidadesmedidas` (
  `codunidadmedida` int(2) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unidadesmedidas`
--

INSERT INTO `unidadesmedidas` (`codunidadmedida`, `nombre`) VALUES
(0, 'Undefined'),
(1, 'gr.'),
(2, 'lbs.'),
(3, 'units'),
(4, 'kg.'),
(6, 'Oz.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albalinea`
--
ALTER TABLE `albalinea`
  ADD PRIMARY KEY (`codalbaran`,`numlinea`);

--
-- Indexes for table `albalineap`
--
ALTER TABLE `albalineap`
  ADD PRIMARY KEY (`codalbaran`,`codproveedor`,`numlinea`);

--
-- Indexes for table `albalineaptmp`
--
ALTER TABLE `albalineaptmp`
  ADD PRIMARY KEY (`codalbaran`,`numlinea`);

--
-- Indexes for table `albalineatmp`
--
ALTER TABLE `albalineatmp`
  ADD PRIMARY KEY (`codalbaran`,`numlinea`);

--
-- Indexes for table `albaranes`
--
ALTER TABLE `albaranes`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `albaranesp`
--
ALTER TABLE `albaranesp`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `albaranesptmp`
--
ALTER TABLE `albaranesptmp`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `albaranestmp`
--
ALTER TABLE `albaranestmp`
  ADD PRIMARY KEY (`codalbaran`);

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`codarticulo`);

--
-- Indexes for table `artpro`
--
ALTER TABLE `artpro`
  ADD PRIMARY KEY (`codarticulo`,`codfamilia`,`codproveedor`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`codbatch`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`codcliente`);

--
-- Indexes for table `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_data`
--
ALTER TABLE `company_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `embalajes`
--
ALTER TABLE `embalajes`
  ADD PRIMARY KEY (`codembalaje`);

--
-- Indexes for table `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`codentidad`);

--
-- Indexes for table `estaciones`
--
ALTER TABLE `estaciones`
  ADD PRIMARY KEY (`codestacion`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`codestado`);

--
-- Indexes for table `factulinea`
--
ALTER TABLE `factulinea`
  ADD PRIMARY KEY (`codfactura`,`numlinea`);

--
-- Indexes for table `factulineap`
--
ALTER TABLE `factulineap`
  ADD PRIMARY KEY (`codfactura`,`codproveedor`,`numlinea`);

--
-- Indexes for table `factulineaptmp`
--
ALTER TABLE `factulineaptmp`
  ADD PRIMARY KEY (`codfactura`,`numlinea`);

--
-- Indexes for table `factulineatmp`
--
ALTER TABLE `factulineatmp`
  ADD PRIMARY KEY (`codfactura`,`numlinea`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`codfactura`);

--
-- Indexes for table `facturasp`
--
ALTER TABLE `facturasp`
  ADD PRIMARY KEY (`codfactura`,`codproveedor`);

--
-- Indexes for table `facturasptmp`
--
ALTER TABLE `facturasptmp`
  ADD PRIMARY KEY (`codfactura`);

--
-- Indexes for table `facturastmp`
--
ALTER TABLE `facturastmp`
  ADD PRIMARY KEY (`codfactura`);

--
-- Indexes for table `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`codfamilia`);

--
-- Indexes for table `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`codformapago`);

--
-- Indexes for table `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`codimpuesto`);

--
-- Indexes for table `intUsersTable`
--
ALTER TABLE `intUsersTable`
  ADD PRIMARY KEY (`id_intUser`);

--
-- Indexes for table `librodiario`
--
ALTER TABLE `librodiario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`codlote`);

--
-- Indexes for table `metaprocesos`
--
ALTER TABLE `metaprocesos`
  ADD PRIMARY KEY (`codproceso`);

--
-- Indexes for table `metaprocesoslinea`
--
ALTER TABLE `metaprocesoslinea`
  ADD PRIMARY KEY (`codrecord`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`codPais`);

--
-- Indexes for table `presulinea`
--
ALTER TABLE `presulinea`
  ADD PRIMARY KEY (`codpresupuesto`,`numlinea`);

--
-- Indexes for table `presulineatmp`
--
ALTER TABLE `presulineatmp`
  ADD PRIMARY KEY (`codpresupuesto`,`numlinea`);

--
-- Indexes for table `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`codpresupuesto`);

--
-- Indexes for table `presupuestostmp`
--
ALTER TABLE `presupuestostmp`
  ADD PRIMARY KEY (`codpresupuesto`);

--
-- Indexes for table `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`codproceso`);

--
-- Indexes for table `proclinea`
--
ALTER TABLE `proclinea`
  ADD PRIMARY KEY (`codproclinea`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`codprovincia`);

--
-- Indexes for table `resourcesTable`
--
ALTER TABLE `resourcesTable`
  ADD PRIMARY KEY (`id_resource`);

--
-- Indexes for table `resourcesToRolesTable`
--
ALTER TABLE `resourcesToRolesTable`
  ADD PRIMARY KEY (`id_srtr`);

--
-- Indexes for table `rolesTable`
--
ALTER TABLE `rolesTable`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `rolesToUsersTable`
--
ALTER TABLE `rolesToUsersTable`
  ADD PRIMARY KEY (`id_rtu`);

--
-- Indexes for table `subresourcesToRolesTable`
--
ALTER TABLE `subresourcesToRolesTable`
  ADD PRIMARY KEY (`id_srtr`);

--
-- Indexes for table `subResourceTable`
--
ALTER TABLE `subResourceTable`
  ADD PRIMARY KEY (`id_sresource`);

--
-- Indexes for table `tabbackup`
--
ALTER TABLE `tabbackup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipoproceso`
--
ALTER TABLE `tipoproceso`
  ADD PRIMARY KEY (`codtipo`);

--
-- Indexes for table `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`codtrabajador`);

--
-- Indexes for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`codubicacion`);

--
-- Indexes for table `unidadesmedidas`
--
ALTER TABLE `unidadesmedidas`
  ADD PRIMARY KEY (`codunidadmedida`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albaranes`
--
ALTER TABLE `albaranes`
  MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albaranesptmp`
--
ALTER TABLE `albaranesptmp`
  MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `albaranestmp`
--
ALTER TABLE `albaranestmp`
  MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `codarticulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `codbatch` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `codcliente` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `embalajes`
--
ALTER TABLE `embalajes`
  MODIFY `codembalaje` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `entidades`
--
ALTER TABLE `entidades`
  MODIFY `codentidad` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estaciones`
--
ALTER TABLE `estaciones`
  MODIFY `codestacion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `codestado` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facturasptmp`
--
ALTER TABLE `facturasptmp`
  MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facturastmp`
--
ALTER TABLE `facturastmp`
  MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
  MODIFY `codfamilia` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `formapago`
--
ALTER TABLE `formapago`
  MODIFY `codformapago` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `codimpuesto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `intUsersTable`
--
ALTER TABLE `intUsersTable`
  MODIFY `id_intUser` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `librodiario`
--
ALTER TABLE `librodiario`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metaprocesos`
--
ALTER TABLE `metaprocesos`
  MODIFY `codproceso` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `metaprocesoslinea`
--
ALTER TABLE `metaprocesoslinea`
  MODIFY `codrecord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
  MODIFY `codPais` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `codpresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presupuestostmp`
--
ALTER TABLE `presupuestostmp`
  MODIFY `codpresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proclinea`
--
ALTER TABLE `proclinea`
  MODIFY `codproclinea` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `codproveedor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `codprovincia` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `resourcesTable`
--
ALTER TABLE `resourcesTable`
  MODIFY `id_resource` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resourcesToRolesTable`
--
ALTER TABLE `resourcesToRolesTable`
  MODIFY `id_srtr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rolesTable`
--
ALTER TABLE `rolesTable`
  MODIFY `id_role` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rolesToUsersTable`
--
ALTER TABLE `rolesToUsersTable`
  MODIFY `id_rtu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subresourcesToRolesTable`
--
ALTER TABLE `subresourcesToRolesTable`
  MODIFY `id_srtr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `subResourceTable`
--
ALTER TABLE `subResourceTable`
  MODIFY `id_sresource` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tabbackup`
--
ALTER TABLE `tabbackup`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipoproceso`
--
ALTER TABLE `tipoproceso`
  MODIFY `codtipo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `codtrabajador` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `codubicacion` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unidadesmedidas`
--
ALTER TABLE `unidadesmedidas`
  MODIFY `codunidadmedida` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
