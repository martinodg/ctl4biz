-- Evitando que siempre escriba la misma tabla use T_8d6846c85e8076b85318fd1054480812;
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Aug 24, 2021 at 02:51 PM
-- Server version: 10.5.8-MariaDB-1:10.5.8+maria~focal
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `albalinea`
--

CREATE TABLE `albalinea` (
                             `codalbaran` int(11) NOT NULL DEFAULT 0,
                             `numlinea` int(4) NOT NULL,
                             `codfamilia` int(3) DEFAULT NULL,
                             `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
                             `cantidad` float NOT NULL DEFAULT 0,
                             `precio` float NOT NULL DEFAULT 0,
                             `importe` float NOT NULL DEFAULT 0,
                             `dcto` tinyint(4) NOT NULL DEFAULT 0,
                             `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albalinea`
--



-- --------------------------------------------------------

--
-- Table structure for table `albalineap`
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
                              `dcto` tinyint(4) NOT NULL DEFAULT 0,
                              `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albalineap`
--



-- --------------------------------------------------------

--
-- Table structure for table `albalineaptmp`
--

CREATE TABLE `albalineaptmp` (
                                 `codalbaran` int(11) NOT NULL DEFAULT 0,
                                 `numlinea` int(4) NOT NULL,
                                 `codfamilia` int(3) DEFAULT NULL,
                                 `codigo` varchar(15) DEFAULT NULL,
                                 `cantidad` float NOT NULL DEFAULT 0,
                                 `precio` float NOT NULL DEFAULT 0,
                                 `importe` float NOT NULL DEFAULT 0,
                                 `dcto` tinyint(4) NOT NULL DEFAULT 0,
                                 `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `albalineatmp`
--

CREATE TABLE `albalineatmp` (
                                `codalbaran` int(11) NOT NULL DEFAULT 0,
                                `numlinea` int(4) NOT NULL,
                                `codfamilia` int(3) DEFAULT NULL,
                                `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
                                `cantidad` float NOT NULL DEFAULT 0,
                                `precio` float NOT NULL DEFAULT 0,
                                `importe` float NOT NULL DEFAULT 0,
                                `dcto` tinyint(4) NOT NULL DEFAULT 0,
                                `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `albaranes`
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

--
-- Dumping data for table `albaranes`
--

INSERT INTO `albaranes` (`codalbaran`, `codfactura`, `fecha`, `iva`, `codcliente`, `estado`, `totalalbaran`, `borrado`) VALUES
    (1, 0, '2021-05-26', 16, 2, '1', 8.3404, '1');

-- --------------------------------------------------------

--
-- Table structure for table `albaranesp`
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

--
-- Dumping data for table `albaranesp`
--



-- --------------------------------------------------------

--
-- Table structure for table `albaranesptmp`
--

CREATE TABLE `albaranesptmp` (
                                 `codalbaran` int(11) NOT NULL,
                                 `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Temporal de albaranes de proveedores para controlar acceso s';

-- --------------------------------------------------------

--
-- Table structure for table `albaranestmp`
--

CREATE TABLE `albaranestmp` (
                                `codalbaran` int(11) NOT NULL,
                                `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
                             `codarticulo` int(10) NOT NULL,
                             `codfamilia` int(5) NOT NULL,
                             `referencia` varchar(20) NOT NULL,
                             `descripcion` text NOT NULL,
                             `impuesto` float DEFAULT NULL,
                             `impuesto2` float NOT NULL,
                             `impuesto3` float NOT NULL,
                             `impuesto4` float NOT NULL,
                             `codproveedor1` int(5) NOT NULL DEFAULT 1,
                             `codproveedor2` int(5) NOT NULL,
                             `codproveedor3` int(11) NOT NULL,
                             `codproveedor4` int(11) NOT NULL,
                             `descripcion_corta` varchar(30) DEFAULT NULL,
                             `codubicacion` int(3) NOT NULL,
                             `stock` int(6) NOT NULL,
                             `codunidadmedida` int(5) NOT NULL,
                             `stock_minimo` int(6) NOT NULL,
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

INSERT INTO `articulos` (`codarticulo`, `codfamilia`, `referencia`, `descripcion`, `impuesto`, `impuesto2`, `impuesto3`, `impuesto4`, `codproveedor1`, `codproveedor2`, `codproveedor3`, `codproveedor4`, `descripcion_corta`, `codubicacion`, `stock`, `codunidadmedida`, `stock_minimo`, `codumstock_minimo`, `aviso_minimo`, `datos_producto`, `fecha_alta`, `codembalaje`, `unidades_caja`, `codumunidades_caja`, `precio_ticket`, `modificar_ticket`, `observaciones`, `precio_compra`, `precio_almacen`, `precio_tienda`, `precio_pvp`, `precio_iva`, `codigobarras`, `imagen`, `borrado`) VALUES
    (0, 0, '', 'undefined', NULL, 0, 0, 0, 1, 0, 0, 0, NULL, 0, 0, 0, 0, 0, '0', '', '0000-00-00', 0, 0, 0, '0', '0', '', NULL, NULL, NULL, NULL, NULL, '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `artpro`
--

CREATE TABLE `artpro` (
                          `codarticulo` varchar(15) NOT NULL,
                          `codfamilia` int(3) NOT NULL,
                          `codproveedor` int(5) NOT NULL,
                          `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artpro`
--



-- --------------------------------------------------------

--
-- Table structure for table `batch`
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



-- --------------------------------------------------------

--
-- Table structure for table `clientes`
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
    (1, '', 'Consumidor Final', '', '', 0, '', 1, 0, '', '', '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cobros`
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

--
-- Dumping data for table `cobros`
--



-- --------------------------------------------------------

--
-- Table structure for table `company_data`
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

CREATE TABLE `embalajes` (
                             `codembalaje` int(3) NOT NULL,
                             `nombre` varchar(30) DEFAULT NULL,
                             `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Embalajes';

--
-- Dumping data for table `embalajes`
--

INSERT INTO `embalajes` (`codembalaje`, `nombre`, `borrado`) VALUES
    (1, 'dummie pack', '0');

-- --------------------------------------------------------

--
-- Table structure for table `entidades`
--

CREATE TABLE `entidades` (
                             `codentidad` int(2) NOT NULL,
                             `nombreentidad` varchar(50) NOT NULL,
                             `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entidades Bancarias';

--
-- Dumping data for table `entidades`
--

INSERT INTO `entidades` (`codentidad`, `nombreentidad`, `borrado`) VALUES
    (1, 'Dummies Bank', '0');

-- --------------------------------------------------------

--
-- Table structure for table `estaciones`
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
    (1, 'Estacion no Asignada', '0');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
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

CREATE TABLE `factulinea` (
                              `codfactura` int(11) NOT NULL,
                              `numlinea` int(4) NOT NULL,
                              `descripcion` varchar(140) NOT NULL,
                              `codfamilia` int(3) NOT NULL,
                              `codigo` varchar(15) NOT NULL,
                              `cantidad` float NOT NULL,
                              `precio` float NOT NULL,
                              `importe` float NOT NULL,
                              `dcto` tinyint(4) NOT NULL,
                              `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas a clientes';

--
-- Dumping data for table `factulinea`
--



-- --------------------------------------------------------

--
-- Table structure for table `factulineap`
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
                               `dcto` tinyint(4) NOT NULL,
                               `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores';

--
-- Dumping data for table `factulineap`
--



-- --------------------------------------------------------

--
-- Table structure for table `factulineaptmp`
--

CREATE TABLE `factulineaptmp` (
                                  `codfactura` int(11) NOT NULL,
                                  `numlinea` int(4) NOT NULL,
                                  `codfamilia` int(3) NOT NULL,
                                  `codigo` varchar(15) NOT NULL,
                                  `cantidad` float NOT NULL,
                                  `precio` float NOT NULL,
                                  `importe` float NOT NULL,
                                  `dcto` tinyint(4) NOT NULL,
                                  `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lineas de facturas de proveedores temporal';

-- --------------------------------------------------------

--
-- Table structure for table `factulineatmp`
--

CREATE TABLE `factulineatmp` (
                                 `codfactura` int(11) NOT NULL,
                                 `numlinea` int(4) NOT NULL,
                                 `codfamilia` int(3) NOT NULL,
                                 `codigo` varchar(15) NOT NULL,
                                 `cantidad` float NOT NULL,
                                 `precio` float NOT NULL,
                                 `importe` float NOT NULL,
                                 `dcto` tinyint(4) NOT NULL,
                                 `TAX` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Temporal de linea de facturas a clientes';

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
                            `codfactura` int(11) NOT NULL,
                            `fecha` date NOT NULL,
                            `iva` tinyint(4) NOT NULL,
                            `codcliente` int(5) NOT NULL,
                            `estado` varchar(1) NOT NULL DEFAULT '0',
                            `impuestos` float NOT NULL,
                            `totalfactura` float NOT NULL,
                            `fechavencimiento` date NOT NULL DEFAULT '0000-00-00',
                            `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='facturas de ventas a clientes';

--
-- Dumping data for table `facturas`
--



-- --------------------------------------------------------

--
-- Table structure for table `facturasp`
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

--
-- Dumping data for table `facturasp`
--



-- --------------------------------------------------------

--
-- Table structure for table `facturasptmp`
--

CREATE TABLE `facturasptmp` (
                                `codfactura` int(11) NOT NULL,
                                `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas de proveedores';

-- --------------------------------------------------------

--
-- Table structure for table `facturastmp`
--

CREATE TABLE `facturastmp` (
                               `codfactura` int(11) NOT NULL,
                               `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='temporal de facturas a clientes';

--
-- Dumping data for table `facturastmp`
--



-- --------------------------------------------------------

--
-- Table structure for table `familias`
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
                                                               (4, 'internal supplies', '0'),
                                                               (5, 'Servicios', '0');

-- --------------------------------------------------------

--
-- Table structure for table `formapago`
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
                                                                    (5, 'Bitcoins', '0');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
                          `img_name` varchar(255) NOT NULL,
                          `img_data` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `impuestos`
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
                                                                          (2, 'Tax Free', 0, '0'),
                                                                          (3, 'IVA_ARG', 21, '0'),
                                                                          (4, 'TAX 23% Poland', 23, '0');

-- --------------------------------------------------------

--
-- Table structure for table `intUsersTable`
--

CREATE TABLE `intUsersTable` (
                                 `id_intUser` int(5) NOT NULL,
                                 `intUser_name` varchar(60) NOT NULL,
                                 `user_name` varchar(140) NOT NULL,
                                 `password` varchar(160) NOT NULL,
                                 `codstatus` int(1) NOT NULL,
                                 `avatar` varchar(140) NOT NULL,
                                 `borrado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intUsersTable`
--


-- --------------------------------------------------------

--
-- Table structure for table `librodiario`
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

--
-- Dumping data for table `librodiario`
--



-- --------------------------------------------------------

--
-- Table structure for table `listaDePrecios`
--

CREATE TABLE `listaDePrecios` (
                                  `codLista` int(5) NOT NULL,
                                  `nombre` varchar(120) NOT NULL,
                                  `porcentaje` float NOT NULL,
                                  `codusuario` int(10) NOT NULL,
                                  `fechaInser` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listaDePrecios`
--

INSERT INTO `listaDePrecios` (`codLista`, `nombre`, `porcentaje`, `codusuario`, `fechaInser`) VALUES
    (1, 'lista consumidor final', 30.5, 1, '2021-07-27');

-- --------------------------------------------------------

--
-- Table structure for table `lote`
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

--
-- Dumping data for table `lote`
--


-- --------------------------------------------------------

--
-- Table structure for table `margenPorArticulo`
--

CREATE TABLE `margenPorArticulo` (
                                     `codmargen` int(10) NOT NULL,
                                     `codarticulo` int(10) NOT NULL,
                                     `porcentaje` float(10,2) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `fechaultimamod` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `metaprocesos`
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


-- --------------------------------------------------------

--
-- Table structure for table `metaprocesoslinea`
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



-- --------------------------------------------------------

--
-- Table structure for table `pagos`
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

--
-- Dumping data for table `pagos`
--


-- --------------------------------------------------------

--
-- Table structure for table `pais`
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

CREATE TABLE `presulinea` (
                              `codpresupuesto` int(11) NOT NULL DEFAULT 0,
                              `numlinea` int(4) NOT NULL,
                              `descripcion` varchar(140) NOT NULL,
                              `codfamilia` int(3) DEFAULT NULL,
                              `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
                              `cantidad` float NOT NULL DEFAULT 0,
                              `precio` float NOT NULL DEFAULT 0,
                              `importe` float NOT NULL DEFAULT 0,
                              `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presulinea`
--


-- --------------------------------------------------------

--
-- Table structure for table `presulineatmp`
--

CREATE TABLE `presulineatmp` (
                                 `codpresupuesto` int(11) NOT NULL DEFAULT 0,
                                 `numlinea` int(4) NOT NULL,
                                 `descripcion` varchar(140) NOT NULL,
                                 `codfamilia` int(3) DEFAULT NULL,
                                 `codigo` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
                                 `cantidad` float NOT NULL DEFAULT 0,
                                 `precio` float NOT NULL DEFAULT 0,
                                 `importe` float NOT NULL DEFAULT 0,
                                 `dcto` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presulineatmp`
--


-- --------------------------------------------------------

--
-- Table structure for table `presupuestos`
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

--
-- Dumping data for table `presupuestos`
--



-- --------------------------------------------------------

--
-- Table structure for table `presupuestostmp`
--

CREATE TABLE `presupuestostmp` (
                                   `codpresupuesto` int(11) NOT NULL,
                                   `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Temporal de albaranes para controlar acceso simultaneo';

--
-- Dumping data for table `presupuestostmp`
--



-- --------------------------------------------------------

--
-- Table structure for table `procesos`
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



-- --------------------------------------------------------

--
-- Table structure for table `proclinea`
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



-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
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
                                                                                                                                                                                                                  (17, 'ABC BAKERY SUPPLIES & EQUIP', '', 0, '7200 NW 1ST AVE', 61, 'MIAMI', 0, '', '33150', '305-757-3885', '', '', '', '0'),
                                                                                                                                                                                                                  (18, 'Produccion propia', '', 0, '', 0, '', 0, '', '', '', '', '', '', '0'),
                                                                                                                                                                                                                  (19, 'Martin', '23456789-23', 0, 'puerto palo 23', 0, 'Trenquelauquen', 0, '', '', '', '', '', '', '1'),
                                                                                                                                                                                                                  (20, 'All Florida Paper', '', 0, '', 0, '', 0, '', '', '', '', '', '', '0'),
                                                                                                                                                                                                                  (21, 'PDP GROUP', '', 0, '', 0, '', 0, '', '', '', '', '', '', '1'),
                                                                                                                                                                                                                  (22, 'TITOS COLOMBIAN FOOD', '', 0, '', 0, '', 0, '', '', '', '', '', '', '0'),
                                                                                                                                                                                                                  (23, '', '', 0, '', 105, '', 0, '', '', '', '', '', '', '0'),
                                                                                                                                                                                                                  (24, 'Culo', '', 0, '', 0, '', 0, '', '', '', '', '', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
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

CREATE TABLE `resourcesTable` (
                                  `id_resource` int(10) NOT NULL,
                                  `resourceName` varchar(40) NOT NULL,
                                  `iconLink` varchar(200) NOT NULL,
                                  `traslation_tag` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resourcesTable`
--

INSERT INTO `resourcesTable` (`id_resource`, `resourceName`, `iconLink`, `traslation_tag`) VALUES
                                                                                               (2, 'produccion', 'produccion.svg', 'produccion'),
                                                                                               (3, 'ventas', 'ventas.svg', 'ventas'),
                                                                                               (4, 'compras', 'compras.svg', 'compras'),
                                                                                               (5, 'contabilidad', 'contabilidad.svg', 'contabilidad'),
                                                                                               (6, 'recursosHumanos', 'hr.svg', 'rrhh'),
                                                                                               (7, 'configuracion', 'config.svg', 'config'),
                                                                                               (8, 'Settings', '', ''),
                                                                                               (9, 'Dashboard', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `resourcesToRolesTable`
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
                                                                                         (11, 1, 1, 1),
                                                                                         (12, 3, 1, 0),
                                                                                         (13, 2, 1, 0),
                                                                                         (14, 7, 1, 0),
                                                                                         (15, 6, 1, 0),
                                                                                         (16, 5, 1, 0),
                                                                                         (17, 4, 1, 0),
                                                                                         (18, 6, 2, 1),
                                                                                         (19, 4, 2, 1),
                                                                                         (20, 3, 2, 1),
                                                                                         (21, 2, 2, 1),
                                                                                         (22, 8, 1, 0),
                                                                                         (23, 9, 1, 0),
                                                                                         (24, 8, 2, 1),
                                                                                         (25, 1, 2, 1),
                                                                                         (26, 7, 2, 1),
                                                                                         (27, 9, 2, 1),
                                                                                         (28, 5, 2, 0),
                                                                                         (29, 2, 3, 0),
                                                                                         (30, 3, 3, 0),
                                                                                         (31, 4, 3, 1),
                                                                                         (32, 5, 3, 0),
                                                                                         (33, 6, 3, 0),
                                                                                         (34, 7, 3, 0),
                                                                                         (35, 8, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rolesTable`
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
                                                                                   (11, 2, 1, 1),
                                                                                   (12, 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subresourcesToRolesTable`
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
                                                                                               (49, 33, 2, 0),
                                                                                               (50, 3, 2, 1),
                                                                                               (51, 22, 2, 0),
                                                                                               (52, 23, 2, 0),
                                                                                               (53, 24, 2, 0),
                                                                                               (54, 110, 1, 0),
                                                                                               (55, 120, 1, 0),
                                                                                               (56, 100, 1, 0),
                                                                                               (57, 10, 3, 1),
                                                                                               (58, 11, 3, 0),
                                                                                               (59, 13, 3, 0),
                                                                                               (60, 14, 3, 0),
                                                                                               (61, 110, 3, 0),
                                                                                               (62, 33, 3, 1),
                                                                                               (63, 112, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subResourceTable`
--

CREATE TABLE `subResourceTable` (
                                    `id_sresource` int(5) NOT NULL,
                                    `id_resource` int(10) NOT NULL,
                                    `subResourceName` varchar(20) NOT NULL,
                                    `iconLink` varchar(140) NOT NULL,
                                    `traslation_tag` varchar(40) NOT NULL,
                                    `subresourceLink` varchar(140) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subResourceTable`
--

INSERT INTO `subResourceTable` (`id_sresource`, `id_resource`, `subResourceName`, `iconLink`, `traslation_tag`, `subresourceLink`) VALUES
                                                                                                                                       (3, 2, 'tiposDeArticulos', 'tipos.svg', 'tipodart', './familias/index.php'),
                                                                                                                                       (4, 2, 'articulos', 'articulos.svg', 'articu', './articulos/index.php'),
                                                                                                                                       (5, 2, 'metaProcesos', 'metaproc.svg', 'metproc', './meta_procesos/index.php'),
                                                                                                                                       (6, 2, 'prcesosDeProduccion', 'procesos.svg', 'propru', './procesos/index.php'),
                                                                                                                                       (7, 2, 'batchDeProduccion', 'batch.svg', 'batchprod', './batch/index.php'),
                                                                                                                                       (8, 2, 'lotesDeProduccion', 'lotes.svg', 'lotdprod', './lotes/index.php'),
                                                                                                                                       (9, 2, 'estacionesDeTrabajo', 'estaciones.svg', 'estactra', './estaciones/index.php'),
                                                                                                                                       (10, 3, 'ventaMostrador', 'ventasmostrador.svg', 'vntmst', './ventas_mostrador/index.php'),
                                                                                                                                       (11, 3, 'facturas', 'factura.svg', 'factura', './facturas_clientes/index.php'),
                                                                                                                                       (12, 3, 'remitos', 'remito.svg', 'remitos', './albaranes_clientes/index.php'),
                                                                                                                                       (13, 3, 'facturarRemitos', 'facturarremito.svg', 'facturar_remitos', './lote_albaranes_clientes/index.php'),
                                                                                                                                       (14, 3, 'presupuestos', 'presupuesto.svg', 'presupuestos', './presupuestos_clientes/index.php'),
                                                                                                                                       (15, 4, 'facturas', 'factura-compras.svg', 'factura', './facturas_proveedores/index.php'),
                                                                                                                                       (16, 4, 'remitos', 'remito-compras.svg', 'remitos', './albaranes_proveedores/index.php'),
                                                                                                                                       (17, 4, 'facturarRemitos', 'facturarremito-compras.svg', 'facturar_remitos', './lote_albaranes_proveedores/index.php'),
                                                                                                                                       (18, 5, 'cobros', 'cobros.svg', 'cobros', './cobros/index.php'),
                                                                                                                                       (19, 5, 'pagos', 'pagos.svg', 'pagos', './pagos/index.php'),
                                                                                                                                       (20, 5, 'cajaDiaria', 'caja.svg', 'cjadiaria', './cerrarcaja/index.php'),
                                                                                                                                       (21, 5, 'libroDiario', 'librodiario.svg', 'librodrio', './librodiario/index.php'),
                                                                                                                                       (22, 5, 'formasDePago', 'formadepago.svg', 'forpago', './formaspago/index.php'),
                                                                                                                                       (23, 5, 'impuestos', 'impuestos.svg', 'impuestos', './impuestos/index.php'),
                                                                                                                                       (24, 5, 'entidadesBancarias', 'entidades.svg', 'entbcaria', './entidades/index.php'),
                                                                                                                                       (25, 6, 'partesDeTrabajo', 'hr.svg', 'ordentrabajo', './partes_trabajo/index.php'),
                                                                                                                                       (26, 6, 'empleados', 'empleados.svg', 'empleado', './trabajadores/index.php'),
                                                                                                                                       (27, 7, 'etiquetas', 'etiquetas.svg', 'etiquet', './etiquetas/index.php'),
                                                                                                                                       (28, 7, 'ubicaciones', 'ubicaciones.svg', 'ubica', './ubicaciones/index.php'),
                                                                                                                                       (29, 7, 'embalajes', 'embalajes.svg', 'embala', './embalajes/index.php'),
                                                                                                                                       (30, 8, 'Copias de Seguridad', '0', '', ''),
                                                                                                                                       (31, 8, 'Roles', '0', '', ''),
                                                                                                                                       (32, 8, 'Usuarios', '0', '', ''),
                                                                                                                                       (33, 9, 'Dashboard', '0', '', ''),
                                                                                                                                       (100, 4, 'proveedores', 'proveedores.svg', 'prov', './proveedores/index.php'),
                                                                                                                                       (110, 3, 'clientes', 'clientes.svg', 'clientes', './clientes/index.php'),
                                                                                                                                       (112, 3, 'ListaDePrecios', 'listaPrecios.svg', 'lstprecios', './lista_de_precios/index.php'),
                                                                                                                                       (120, 2, 'AgruparProcesos', 'agruparProcesos.svg', 'proagpru', './agrupar_procesos/index.php');

-- --------------------------------------------------------

--
-- Table structure for table `tabbackup`
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

CREATE TABLE `ubicaciones` (
                               `codubicacion` int(3) NOT NULL,
                               `nombre` varchar(50) NOT NULL,
                               `borrado` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Ubicaciones';

--
-- Dumping data for table `ubicaciones`
--

INSERT INTO `ubicaciones` (`codubicacion`, `nombre`, `borrado`) VALUES
    (1, 'My Place', '0');

-- --------------------------------------------------------

--
-- Table structure for table `unidadesmedidas`
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
-- Indexes for table `images`
--
ALTER TABLE `images`
    ADD UNIQUE KEY `img_name` (`img_name`);

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
-- Indexes for table `listaDePrecios`
--
ALTER TABLE `listaDePrecios`
    ADD PRIMARY KEY (`codLista`);

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
    MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albaranesptmp`
--
ALTER TABLE `albaranesptmp`
    MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `albaranestmp`
--
ALTER TABLE `albaranestmp`
    MODIFY `codalbaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
    MODIFY `codarticulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
    MODIFY `codbatch` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
    MODIFY `codcliente` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cobros`
--
ALTER TABLE `cobros`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `embalajes`
--
ALTER TABLE `embalajes`
    MODIFY `codembalaje` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `entidades`
--
ALTER TABLE `entidades`
    MODIFY `codentidad` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
    MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facturasptmp`
--
ALTER TABLE `facturasptmp`
    MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `facturastmp`
--
ALTER TABLE `facturastmp`
    MODIFY `codfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=640;

--
-- AUTO_INCREMENT for table `familias`
--
ALTER TABLE `familias`
    MODIFY `codfamilia` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `formapago`
--
ALTER TABLE `formapago`
    MODIFY `codformapago` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `impuestos`
--
ALTER TABLE `impuestos`
    MODIFY `codimpuesto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `intUsersTable`
--
ALTER TABLE `intUsersTable`
    MODIFY `id_intUser` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `librodiario`
--
ALTER TABLE `librodiario`
    MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `listaDePrecios`
--
ALTER TABLE `listaDePrecios`
    MODIFY `codLista` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pais`
--
ALTER TABLE `pais`
    MODIFY `codPais` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presupuestos`
--
ALTER TABLE `presupuestos`
    MODIFY `codpresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `presupuestostmp`
--
ALTER TABLE `presupuestostmp`
    MODIFY `codpresupuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `proclinea`
--
ALTER TABLE `proclinea`
    MODIFY `codproclinea` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
    MODIFY `codproveedor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
    MODIFY `id_srtr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rolesTable`
--
ALTER TABLE `rolesTable`
    MODIFY `id_role` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rolesToUsersTable`
--
ALTER TABLE `rolesToUsersTable`
    MODIFY `id_rtu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subresourcesToRolesTable`
--
ALTER TABLE `subresourcesToRolesTable`
    MODIFY `id_srtr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `subResourceTable`
--
ALTER TABLE `subResourceTable`
    MODIFY `id_sresource` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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




--
-- Estructura de tabla para la tabla `alias_articulos`
--

CREATE TABLE `alias_articulos` (
                                   `id_alias` int(11) NOT NULL,
                                   `codarticulo` int(11) NOT NULL,
                                   `alias` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alias_articulos`
--
ALTER TABLE `alias_articulos`
    ADD PRIMARY KEY (`id_alias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alias_articulos`
--
ALTER TABLE `alias_articulos`
    MODIFY `id_alias` int(11) NOT NULL AUTO_INCREMENT;


--
--  Estructura  la vista  `listado_articulos_alias`
--

CREATE VIEW  listado_articulos_alias AS
SELECT
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    articulos.descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos
         JOIN familias ON  articulos.codfamilia = familias.codfamilia
UNION
SELECT
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    alias_articulos.alias AS descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos
         JOIN familias ON  articulos.codfamilia = familias.codfamilia
         JOIN alias_articulos ON  alias_articulos.codarticulo = articulos.codarticulo;

--
-- Estructura  la vista `listado_articulos_precios_alias`
--

CREATE VIEW  listado_articulos_precios_alias AS
SELECT
    artpro.codproveedor,
    artpro.precio AS pcosto,
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    articulos.descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos
         JOIN familias ON  articulos.codfamilia = familias.codfamilia
         JOIN artpro ON  articulos.codarticulo =  articulos.codarticulo
WHERE articulos.borrado = 0
  AND artpro.codfamilia = articulos.codfamilia
UNION
SELECT
    artpro.codproveedor,
    artpro.precio AS pcosto,
    articulos.codarticulo ,
    articulos.codfamilia,
    articulos.referencia,
    alias_articulos.alias AS descripcion,
    articulos.impuesto,
    articulos.codproveedor1,
    articulos.codproveedor2,
    articulos.codproveedor3,
    articulos.codproveedor4,
    articulos.descripcion_corta,
    articulos.codubicacion,
    articulos.stock,
    articulos.codunidadmedida,
    articulos.stock_minimo,
    articulos.codumstock_minimo,
    articulos.aviso_minimo,
    articulos.datos_producto,
    articulos.fecha_alta,
    articulos.codembalaje,
    articulos.unidades_caja,
    articulos.codumunidades_caja,
    articulos.precio_ticket,
    articulos.modificar_ticket,
    articulos.observaciones,
    articulos.precio_compra,
    articulos.precio_almacen,
    articulos.precio_tienda,
    articulos.precio_pvp,
    articulos.precio_iva,
    articulos.codigobarras,
    articulos.imagen,
    articulos.borrado,
    familias.nombre AS nombrefamilia
FROM articulos
         JOIN familias ON  articulos.codfamilia = familias.codfamilia
         JOIN artpro ON  articulos.codarticulo =  articulos.codarticulo
         JOIN alias_articulos ON  alias_articulos.codarticulo = articulos.codarticulo
WHERE articulos.borrado = 0
  AND artpro.codfamilia = articulos.codfamilia ;


--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
                           `id_moneda` int(11) NOT NULL,
                           `moneda` varchar(255) NOT NULL,
                           `simbolo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`id_moneda`, `moneda`, `simbolo`) VALUES
                                                             (1, 'ARS', '&#36;'),
                                                             (2, 'USD', '&#36;'),
                                                             (3, 'EUR', '&#8364;'),
                                                             (4, 'PLN', '&#8484;&#10990;');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
    ADD PRIMARY KEY (`id_moneda`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
    MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


--
-- Actualizacion de las tabla company_data
--
ALTER TABLE `company_data`
    ADD `razon_soc` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL AFTER `id`,
    ADD `moneda_id` INT(11) NOT NULL AFTER `zip_code`,
    ADD `cod_fiscal` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
    ADD `leyenda` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    ADD `logo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ;



--
-- Poniendo las monedas en EUR
--
UPDATE `company_data` SET `moneda_id` = '3' WHERE `company_data`.`id` = 0;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
