-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 28-11-2021 a las 14:59:53
-- Versión del servidor: 10.5.8-MariaDB-1:10.5.8+maria~focal
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `T_ff86629b00ce7545e2f6be160cfcd925`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
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
-- Volcado de datos para la tabla `cobros`
--

INSERT INTO `cobros` (`id`, `codfactura`, `codcliente`, `importe`, `codformapago`, `numdocumento`, `fechacobro`, `observaciones`) VALUES
(6, 456465, 1, 230, 1, '123', '2021-11-10', 'Cliente feliz'),
(7, 456467, 1, 2300, 1, '789', '2021-11-25', 'Cliente feliz'),
(8, 456433, 1, 1235, 2, '789789789', '2021-10-01', 'otro cliente enojado '),
(9, 74561, 2, 564, 2, '789798', '2021-09-09', 'cliente enojado '),
(10, 456433, 1, 1235.5, 2, '789789789', '2021-10-01', 'otro cliente enojado '),
(11, 74561, 2, 564.2, 2, '789798', '2021-09-09', 'cliente enojado ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
